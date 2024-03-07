namespace :autoscale do

    desc 'List all servers in the autoscaling group.'
    task :list_servers do
        ec2 = get_ec2_client
        instance_ids = get_instance_ids

        instance_ids.each do |instance_id|
            puts "#{ec2.instance(instance_id).private_ip_address} (#{instance_id})"
        end
    end

    desc 'Set all the servers to deploy to.'
    task :set_servers do
        puts 'Gathering list of servers in group.'

        ec2 = get_ec2_client
        instance_ids = get_instance_ids

        instance_ids.each do |instance_id|
            server "#{ec2.instance(instance_id).private_ip_address}", user: "#{$aws_config['ec2']['deployment_user']}", roles: %w{web}
        end
    end

    desc 'Create new AMI.'
    task :snapshot do

        puts 'Generating new AMI.'

        ec2 = get_ec2_client
        instance_ids = get_instance_ids

        # IMPORTANT: Adding a "no_reboot" here stuffs the imaging, and it images the older version of the server instead
        # of the one that has just been updated. No idea how or why, but I guess it comes down to AWS's "Can't guarantee
        # image integrity if you image without a reboot."
        # DANGER: For mission critical systems this means you should have at least two instances in your cluster before
        # performing a deploy, otherwise there's potential for a downtime blip, especially on slow reboot servers.
        ami_config = $aws_config['ec2']['autoscaling']['amis']["#{fetch(:stage)}"]
        image = ec2.instance(instance_ids.first).create_image({
            name: "#{ami_config['prefix']}-#{Time.now.to_i}"
        })

        puts 'Waiting 20 seconds for AMI to register...'

        sleep(20)

        update_launch_config image.id
    end

    desc 'Suspend AutoScaling Processes'
    task :suspend do
        puts 'Suspending autoscaling processes for group.'

        group = get_autoscaling_group
        group.suspend_processes
    end

    desc 'Resume AutoScaling Processes'
    task :resume do
        puts 'Resuming autoscaling processes for group.'

        group = get_autoscaling_group
        group.resume_processes
    end

    desc 'Clean Old AMIs, Snapshots and Launch Configurations'
    task :clean do

        puts "Cleaning old AMIs / Snapshots / Launch Configurations"

        ec2 = get_ec2_client
        image_ids = get_image_ids


        ami_config = $aws_config['ec2']['autoscaling']['amis']["#{fetch(:stage)}"]
        amis = ec2.images({
            "filters": [
                "name": "name",
                "values": ["#{ami_config['prefix']}*"]
            ],
            "owners": ["self"]
        })

        puts amis
        puts ami_config

        as = get_autoscaling_client

        ami_lc_map = {}
        as.describe_launch_configurations.launch_configurations.each do |lc|
            ami_lc_map[lc.image_id] = lc
        end

        amis.each do |ami|

            next if image_ids.include?(ami.id) # Leave any in use images ALONE.

            now = DateTime.now
            retention = now - ami_config['retention']
            created = DateTime.parse(ami.creation_date)

            next if created > retention # Don't delete images still within the retention period

            snapshot_ids = []
            ami.block_device_mappings.each do |mapping|
                snapshot_ids.push(mapping.ebs.snapshot_id)
            end

            puts "Deregistering AMI #{ami.id}"
            ami.deregister
            # TODO: Add a catch in here?

            snapshot_ids.each do |snapshot_id|
               puts "Deleting snapshot #{snapshot_id}"
               ec2.snapshot(snapshot_id).delete
            end

            if ami_lc_map.key?(ami.id)
                lc = ami_lc_map[ami.id]
                puts "Deleting launch configuration #{lc.launch_configuration_name}"
                lc.delete({})
            end

        end
    end

    def update_launch_config(image_id)

        puts 'Creating new launch configuration.'

        as = get_autoscaling_client

        lc_config = $aws_config['ec2']['autoscaling']['launch_configurations']["#{fetch(:stage)}"]
        lc_name = "#{lc_config['name_prefix']}-#{Time.now.strftime('%Y%m%d-%H%M')}"

        device_mappings = []
        lc_config['block_device_mappings'].each do |mapping|
            device_mappings.push({
                device_name: mapping['device_name'],
                ebs: {
                    volume_size: mapping['ebs']['volume_size'],
                    volume_type: mapping['ebs']['volume_type'],
                    delete_on_termination: mapping['ebs']['delete_on_termination']
                }
            })
        end

        lc = as.create_launch_configuration({
            image_id: image_id,
            instance_type: lc_config['instance_type'],
            launch_configuration_name: lc_name,
            security_groups: lc_config['security_groups'],
            associate_public_ip_address: lc_config['associate_public_ip_address'],
            instance_monitoring: {
                enabled: lc_config['instance_monitoring']
            },
            key_name: lc_config['key_name'],
            block_device_mappings: device_mappings
        })

        # TODO: Clean up old launch configs? Probably a separate job for that.

        puts 'Updating autoscaling group with new launch configuration.'

        group = get_autoscaling_group
        group.update({
            launch_configuration_name: lc_name
        })
    end

    def get_instance_ids
        as = get_autoscaling_group

        return as.instances.map(&:instance_id)
    end

    def get_image_ids
        as = get_autoscaling_group
        ec2 = get_ec2_client

        ami_ids = []

        as.instances.each do |instance|
            ami_ids.push(ec2.instance(instance.id).image_id)
        end

        return ami_ids

        return as.instances.map(&:image_id)
    end

    def get_autoscaling_client
        return Aws::AutoScaling::Client.new({
            region: $aws_config['ec2']['regions']["#{fetch(:stage)}"],
        }) # TODO: Should these come from A yaml conf like the env file stuff? This is currently coming from my own AWS account, which is perhaps fine due to the sensitive nature of what this part of deployment does?
    end

    def get_autoscaling_group
        return Aws::AutoScaling::AutoScalingGroup.new({
            name: $aws_config['ec2']['autoscaling']['group_names']["#{fetch(:stage)}"],
            region: $aws_config['ec2']['regions']["#{fetch(:stage)}"],
        }) # TODO: Should these come from A yaml conf like the env file stuff? This is currently coming from my own AWS account, which is perhaps fine due to the sensitive nature of what this part of deployment does?
    end

    def get_ec2_client
        return Aws::EC2::Resource.new({
            region: $aws_config['ec2']['regions']["#{fetch(:stage)}"],
        }) # TODO: Should these come from A yaml conf like the env file stuff? This is currently coming from my own AWS account, which is perhaps fine due to the sensitive nature of what this part of deployment does?
    end
end

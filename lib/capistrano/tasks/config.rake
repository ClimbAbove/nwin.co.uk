namespace :config do
    task :load_env do
        on roles(:web), in: :sequence, wait: 5 do

            client = Aws::S3::Client.new(
                region: $aws_config['s3']['region'],
                access_key_id: $aws_config['s3']['access_key_id'],
                secret_access_key: $aws_config['s3']['secret_access_key'],
            )

            $aws_config['s3']['files']["#{fetch(:stage)}"].each do |conf|

                filename = "#{conf['target']}-#{Time.now.to_i}.tmp"
                File.open(filename, 'wb') do |file|

                    stream = client.get_object({
                        bucket: $aws_config['s3']['bucket'], key: conf['key']
                    }, target: file)

                    upload! filename, "#{release_path}/#{conf['target']}"

                end

                FileUtils.rm(filename)
            end
        end
    end

    task :restartsupervisor do
        on roles(:web), in: :sequence, wait: 5 do
            execute "sudo /bin/systemctl restart supervisor.service"
        end
    end
end

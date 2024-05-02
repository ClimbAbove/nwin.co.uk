module Slackistrano
  class DeploymentSlack < Messaging::Base

    # Send failed message to #ops. Send all other messages to default channels.
    def channels_for(action)
      super
    end

    # Supress updating message.
    def payload_for_updating
      {
        attachments: [{
          color: 'warning',
          title: "Deployment Starting...",
          fields: [
            {title: "Project", value: application, short: true},
            {title: "Environment", value: stage, short: true},
            {title: "Deployer", value: deployer, short: true},
          ],
          fallback: super[:text],
      }]}
    end

    # Supress reverting message.
    def payload_for_reverting
      nil
    end

    # Fancy updated message.
    # See https://api.slack.com/docs/message-attachments
    # TODO: I'd like the commit message in here, really, but can't for the life of me figure that one out.
    def payload_for_updated
      {
        attachments: [{
        color: 'good',
        title: "Deployment Complete.",
        fields: [
          {title: "Project", value: application, short: true},
          {title: "Environment", value: stage, short: true},
          {title: "Deployer", value: deployer, short: true},
          {title: "Branch", value: branch, short: true},
          {title: "Time", value: elapsed_time, short: true},
        ],
        fallback: super[:text],
      }]}
    end

    # Default reverted message.  Alternatively we could have simply not
    # redefined this method at all.
    def payload_for_reverted
      payload = super
      payload[:text] = ":face_with_rolling_eyes: #{payload[:text]}"
      payload
    end

    # Slightly tweaked failed message.
    # See https://api.slack.com/docs/message-formatting
    def payload_for_failed
      payload = super
      payload[:text] = ":fire: #{payload[:text]}"
      payload
    end

    # Override the deployer helper to pull the full name from the password
    # file.
    # See https://github.com/phallstrom/slackistrano/blob/master/lib/slackistrano/messaging/helpers.rb
    def deployer
      super
    end

  end
end
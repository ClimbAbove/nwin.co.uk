# We've put the deploy files in a custom location, because the default
# one is "config" where Laravel keeps all it's configuration stuff, and
# we don't want to mix the two.
set :deploy_config_path, File.expand_path('tools/capistrano/deploy.rb')
set :stage_config_path, File.expand_path('tools/capistrano/stages/')

# Load DSL and set up stages
require "capistrano/setup"

# Include default deployment tasks
require "capistrano/deploy"
require "capistrano/composer"
require 'slackistrano/capistrano'
require 'aws-sdk-s3'
require 'aws-sdk-autoscaling'
require 'aws-sdk-ec2'

require "capistrano/scm/git"
install_plugin Capistrano::SCM::Git

# Load custom tasks from `lib/capistrano/tasks` if you have any defined
Dir.glob("lib/capistrano/tasks/*.rake").each { |r| import r }

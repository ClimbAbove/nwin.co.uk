# STANDARD CONFIGURATION
# ======================
# Standard Configuration. This file is re-usable cross project. That's why we
# have the project.conf.rb file (included further down)

# config valid only for current version of Capistrano
# lock "3.9.1"

# Default branch is :master
ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp
if (['ire', 'prod'].include? "#{fetch(:stage)}") == true && (['hotfix', 'master', 'main'].include? "#{fetch(:branch)}") == false
    abort("You may only deploy hotfix, master or main to #{fetch(:stage)}")
end

# PROJECT SPECIFIC SETTINGS
# =========================

# Application to deploy. Change this bit across projects.
set :application, "nwin.co.uk"
set :repo_url, "git@github.com:ClimbAbove/nwin.co.uk.git"

# AWS Settings
# ============

$aws_config = YAML.load(File.read(File.join(File.dirname(__FILE__),'.aws_config.yaml')))

# Deployment
# ==========
namespace :deploy do

      # Clear the existing cache (disk space saver)
      #before :starting, 'storage:clear_cache'

      # Load in the env file.
      after :updating, 'config:load_env'
      after :updating, 'storage:symlink'
      after :updating, 'storage:setfacl'

end

# Slackistrano
# ============

#set :slackistrano, {
#    klass: Slackistrano::DeploymentSlack,
#    channel: '#deployment',
#    webhook: 'https://hooks.slack.com/services/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'
#}


# Directory on remote server(s) to deploy to.
set :deploy_to, '/var/www/nwin.co.uk/prod'

server "18.171.82.232", user: "capistrano", roles: %w(web)
#  keys: %w(~/.ssh/climbabove/id_rsa),

set :ssh_options, {
  user: 'capistrano',
  forward_agent: true,
  auth_methods: %w(publickey)
}

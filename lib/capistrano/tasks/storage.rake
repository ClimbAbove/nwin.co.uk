namespace :storage do
    task :symlink do
        on roles(:web), in: :sequence, wait: 5 do
            #execute "rm -rf #{release_path}/storage && ln -s #{shared_path}/storage #{release_path}/storage"
            #execute "ln -s #{shared_path}/token.json #{release_path}/token.json"
            #execute "ln -s #{shared_path}/apps_token.json #{release_path}/apps_token.json"
        end
    end

    task :setfacl do
        on roles(:web), in: :sequence, wait: 5 do
            execute "setfacl -Rdm u:capistrano:rwx,u:www-data:rwx #{release_path}/storage/"
            execute "setfacl -Rm u:capistrano:rwX,u:www-data:rwX #{release_path}/storage/"
        end
    end

    task :clear_cache do
        on roles(:web), in: :sequence, wait: 5 do
            execute "cd #{current_path} && php artisan cache:clear"
        end
    end
end

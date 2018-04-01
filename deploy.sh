# install core
composer install

# fill db
php artisan db:seed

# storage symbolic link
php artisan storage:link

#optimize...
php artisan config:cache

#run
php artisan serve
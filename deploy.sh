# install core
composer install

# fill db
php artisan db:seed

#optimize...
php artisan config:cache

#run
php artisan serve
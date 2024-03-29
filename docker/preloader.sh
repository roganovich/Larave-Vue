# Work Dir
cd /var/www/
# Folders
rm -rf /var/www/storage/logs
rm -rf /var/www/storage/framework
mkdir -p  /var/www/bootstrap/cache && chmod 777 /var/www/bootstrap/cache
mkdir -p  /var/www/storage && chmod 777 /var/www/storage
mkdir -p  /var/www/storage/logs && chmod 777 /var/www/storage/logs
mkdir -p  /var/www/storage/framework && chmod 777 /var/www/storage/framework
mkdir -p  /var/www/storage/framework/views && chmod 777 /var/www/storage/framework/views
mkdir -p  /var/www/storage/framework/testing && chmod 777 /var/www/storage/framework/testing
mkdir -p  /var/www/storage/framework/cache && chmod 777 /var/www/storage/framework/cache
mkdir -p  /var/www/storage/framework/sessions && chmod 777 /var/www/storage/framework/sessions
# Cборка
composer install
# Backend
php artisan key:generate
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan migrate
php artisan db:seed
# Frontend
npm install
npm run prod

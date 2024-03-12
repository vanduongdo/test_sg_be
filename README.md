#php 7.*
#laravel 8.*

composer install

composer update

cp .env.example .env

php artisan migrate

php artisan serve




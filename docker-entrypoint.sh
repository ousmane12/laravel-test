#!/bin/bash

# Execute migrations and seeds
composer install
php artisan migrate --force
php artisan db:seed --force

# Check and generate app key
if [ ! -f .env ]; then
  cp .env.example .env
fi
php artisan key:generate

# Clean cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:clear

# Launch PHP server
php-fpm

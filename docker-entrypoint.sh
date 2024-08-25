#!/bin/bash
set -e

# Execute migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Launch PHP server
php-fpm

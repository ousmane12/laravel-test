# Use an official PHP image with all the necessary extensions for Laravel
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev

# Install php extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Define work directory
WORKDIR /var/www/html

# Give the required permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Install the dependencies with composer
RUN composer install --no-dev --optimize-autoloader

# Expose port 80
EXPOSE 80

# Copy entry point file
COPY docker-entrypoint.sh /usr/local/bin/

# Make script to be executed
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Use the script as entrypoint
ENTRYPOINT ["docker-entrypoint.sh"]
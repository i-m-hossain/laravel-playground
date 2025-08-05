# Stage 1: Get Composer binary
FROM composer:latest AS composer

# Stage 2: Build the base PHP-FPM image
FROM php:8.2-fpm

# Install system dependencies and PHP extensions required for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Xdebug for development (not included in production)
RUN pecl install redis xdebug && docker-php-ext-enable redis xdebug

# Copy Composer binary from the composer stage
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code (assuming Laravel project is in the build context)
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy custom PHP configuration (optional, for dev settings like Xdebug)
COPY ./docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]




# 1. nginx -> php fpm (php.ini, php libraries) ->  worker pool(www.conf) -> laravel application -> composer install -> composer update

# Stage 1: Get Composer binary
FROM composer:latest AS composer
FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \ 
    supervisor \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd pdo pdo_mysql zip mbstring exif pcntl bcmath \
 && pecl install redis swoole \
 && docker-php-ext-enable redis swoole \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*


 # Copy Composer binary from the composer stage
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader
# Copy supervisor config file
COPY ./docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY ./docker/supervisor/supervisord.conf /etc/supervisord.conf

# Ensure logs and cache directories are owned correctly
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Run Supervisor (manages Laravel queue worker)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

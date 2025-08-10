# Stage 1: Get Composer binary
FROM composer:latest AS composer

# Stage 2: Build the base PHP-FPM image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl\
    procps\
    vim\
    zip\
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install php extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip mbstring exif pcntl bcmath opcache

# install composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code (assuming Laravel project is in the build context)
COPY . .

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# install additional PHP extensions
RUN pecl install redis && docker-php-ext-enable redis


# Copy Supervisor configuration
COPY ./docker/php/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

COPY ./docker/php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh


# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Use custom entrypoint
ENTRYPOINT ["/entrypoint.sh"]



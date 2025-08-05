FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Copy supervisor config file
COPY ./docker/supervisor/supervisord.conf /etc/supervisord.conf

# Ensure logs and cache directories are owned correctly
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Run Supervisor (manages Laravel queue worker)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

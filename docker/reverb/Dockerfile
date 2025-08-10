# Stage 1: Get Composer binary
FROM composer:latest AS composer

# Stage 2: Build the base PHP image
FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libonig-dev \
    supervisor \
    procps\
    vim\
    && apt-get clean && rm -rf /var/lib/apt/lists/*


# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip mbstring bcmath pcntl

# Install Composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy Supervisor configuration
COPY ./docker/reverb/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy entrypoint script
COPY ./docker/reverb/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8080 for Laravel Reverb
EXPOSE 8080

# Start Laravel Reverb
CMD ["/entrypoint.sh"]

#!/bin/bash

# Ensure storage and cache directories have the correct permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Run any necessary migrations
php artisan migrate --force

# Start Supervisor to manage the Reverb WebSocket server
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf

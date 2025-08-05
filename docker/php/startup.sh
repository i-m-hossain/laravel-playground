#!/bin/bash
set -e

echo "📁 Preparing Laravel permissions..."
mkdir -p storage/logs/nginx
chown -R www-data:www-data storage bootstrap/cache


echo "🚀 Starting PHP-FPM..."
exec php-fpm

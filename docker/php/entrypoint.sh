#!/bin/bash
# Start PHP-FPM in the background
php-fpm &

# Start Supervisor
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

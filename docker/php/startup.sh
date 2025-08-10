#!/bin/bash
set -e

echo "📁 Preparing Laravel permissions..."
mkdir -p storage/logs/nginx storage/logs
chown -R www-data:www-data storage bootstrap/cache


echo "🚀 Starting Supervisor..."


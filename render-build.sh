#!/usr/bin/env bash
# exit on error
set -o errexit

echo "🚀 Starting Render build process..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies
echo "📦 Installing NPM dependencies..."
npm ci

# Build frontend assets
echo "🏗️  Building frontend assets..."
npm run build

# Clear all caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache production config
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force --no-interaction

echo "✅ Build complete!"

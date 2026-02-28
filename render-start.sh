#!/usr/bin/env bash

echo "🚀 Starting Daily~Track application..."
echo "📍 Port: $PORT"
echo "🌐 Environment: $APP_ENV"

# Start PHP built-in server
php artisan serve --host=0.0.0.0 --port=$PORT

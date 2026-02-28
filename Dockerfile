FROM php:8.4-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . /var/www

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
RUN npm install && npm run build

# Set permissions
RUN chmod -R 755 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Create storage directories if they don't exist
RUN mkdir -p storage/framework/{sessions,views,cache} && \
    mkdir -p storage/logs && \
    chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 10000

# Run migrations and start server
CMD php artisan storage:link && \
    php artisan migrate --force --no-interaction && \
    php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-10000}

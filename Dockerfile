FROM php:8.2-cli

# Install PostgreSQL extension & dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev unzip git zip curl \
    && docker-php-ext-install pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Clear and cache Laravel config
RUN php artisan config:clear && php artisan config:cache

# Expose port 8080 for Laravel dev server
EXPOSE 8080

# Run Laravel's built-in web server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]

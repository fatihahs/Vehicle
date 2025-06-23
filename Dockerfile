FROM php:8.2-fpm

# Install system dependencies and PHP extensions for Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    git zip unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo_pgsql pgsql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:cache

# Copy entrypoint script and make it executable
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]


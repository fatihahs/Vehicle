# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql

# Enable Apache mod_rewrite for Laravel routes
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files from local to container
COPY . /var/www/html

# Install Composer (from official Composer image)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies without dev packages, optimize autoloader
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel folders (storage and cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for web access
EXPOSE 80

# Run Apache in the foreground
CMD ["apache2-foreground"]

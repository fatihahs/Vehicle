FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install zip pdo pdo_mysql

RUN a2enmod rewrite

# Set Apache document root to Laravel's public folder
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

WORKDIR /var/www/html

COPY . /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]

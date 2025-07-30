FROM php:8.2-apache

# Cài extension Laravel cần
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git curl libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Enable Apache Rewrite
RUN a2enmod rewrite

# Copy Laravel project vào container
COPY . /var/www/html/

# Set working dir + quyền cho Laravel
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Apache DocumentRoot về public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

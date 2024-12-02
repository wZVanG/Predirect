FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    zip \
    git \
    unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

COPY composer.json /var/www/html/

EXPOSE 80
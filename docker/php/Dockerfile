FROM php:8.2-fpm-alpine
RUN apt-get update && apt-get install -y --no-install-recommends git && docker-php-ext-install pdo_mysql mysqli

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

COPY . /var/www/project
WORKDIR /var/www/project/


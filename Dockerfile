FROM php:8.0.2-fpm-alpine

WORKDIR /var/www/app

RUN touch /usr/local/var/log/php-fpm-error.log

RUN docker-php-ext-install pdo pdo_mysql

FROM php:8.1-fpm

RUN apt update && docker-php-ext-install pdo_mysql

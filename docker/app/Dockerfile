FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
        git \
        libpng-dev \
        mysql-client

RUN docker-php-ext-install \
    gd \
    pdo_mysql \
    zip

RUN pecl install xdebug

RUN docker-php-ext-enable xdebug

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
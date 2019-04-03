FROM php:7-fpm

RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql sockets
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis
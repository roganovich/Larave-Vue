FROM php:8.0-fpm


RUN apt-get update && apt-get upgrade -y \
    && apt-get install apt-utils -y \
    && docker-php-ext-install pdo pdo_mysql

RUN apt-get install unzip -y
RUN apt-get install zip -y
RUN apt-get install git -y
RUN apt-get install nodejs -y
RUN apt-get install npm -y

RUN rm -rf /var/www/storage/logs
RUN rm -rf /var/www/storage/framework

RUN mkdir /var/www/storage && chmod 777 /var/www/storage
RUN mkdir /var/www/storage/logs && chmod 777 /var/www/storage/logs
RUN mkdir /var/www/storage/framework && chmod 777 /var/www/storage/framework
RUN mkdir /var/www/storage/framework/views && chmod 777 /var/www/storage/framework/views
RUN mkdir /var/www/storage/framework/testing && chmod 777 /var/www/storage/framework/testing
RUN mkdir /var/www/storage/framework/cache && chmod 777 /var/www/storage/framework/cache
RUN mkdir /var/www/storage/framework/sessions && chmod 777 /var/www/storage/framework/sessions


WORKDIR /var/www

ADD https://getcomposer.org/download/latest-2.x/composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

COPY composer.json composer.lock ./
RUN composer install

RUN npm install --production && npm run build:production && rm -rf node_module


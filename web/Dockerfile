FROM php:7.2-apache

ENV TZ=Europe/Budapest

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
  && apt-get update \
  && docker-php-ext-install pdo pdo_mysql

EXPOSE 80

RUN a2enmod rewrite

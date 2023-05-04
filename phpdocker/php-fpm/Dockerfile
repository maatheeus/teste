FROM php:8.2-fpm
WORKDIR "/application"

RUN apt-get update

RUN apt-get install software-properties-common -y

RUN apt-get update && \
    apt-get install -y libzip-dev libpq-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
         
# Instalando composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

EXPOSE 80 443
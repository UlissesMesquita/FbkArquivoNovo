#Instala e Configura o PHP
# FROM php

# RUN apt-get update && apt-get install -y libmcrypt-dev \
#     libmagickwand-dev --no-install-recommends \
#     && pecl install imagick \
#     && docker-php-ext-enable imagick \
#     && docker-php-ext-install mcrypt pdo_mysql \ 
#     && docker-php-ext-install mysqli \
#     && a2enmod rewrite

# # Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN php artisan serve

FROM php:8.0-fpm-alpine
RUN apk add --no-cache openssl bash nodejs npm postgresql-dev
RUN docker-php-ext-install bcmath pdo pdo_pgsql
RUN apk add --no-cache mysql-client msmtp perl wget procps shadow libzip libpng libjpeg-turbo libwebp freetype icu

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install intl && \
    docker-php-ext-install opcache && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip && \
    apk del build-essentials && rm -rf /usr/src/php*

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

RUN rm  /usr/local/etc/php/php.ini-production
COPY .docker/php/php.ini /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


#COPY ./ /var/www

#RUN chmod -R 777 /var/www/storage
#RUN php artisan storage:link

EXPOSE 9000

ENTRYPOINT [ "php-fpm" ]
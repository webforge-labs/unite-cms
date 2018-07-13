FROM php:7.2-fpm-stretch

ARG TZ=Europe/Berlin
ENV TZ=$TZ

RUN apt-get update && apt-get install -y \
        # dev tools and handy stuff
        zile \
        git-core \
        unzip \
        tzdata \
        # php extension deps
        libfontconfig \
        libicu-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev
#TODO: concatenate this with docker-php-ext-install
RUN docker-php-ext-install -j$(nproc) iconv intl opcache bcmath mbstring pdo pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    # set timezone to $TZ
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./config/docker/php/conf.d/*.ini /usr/local/etc/php/conf.d/
COPY ./config/docker/php/www.conf /etc/php-fpm.d/www.conf

RUN mkdir -p /var/www/app

WORKDIR /var/www/app

#COPY ./.env.dist ./composer.* bin/console ./
#
#RUN composer install -o --prefer-dist --no-interaction \
#   && composer clear-cache
#
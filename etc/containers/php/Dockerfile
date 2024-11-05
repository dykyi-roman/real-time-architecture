FROM php:8.3-fpm

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

WORKDIR /var/www/html/code

RUN apt-get update && apt-get install -y \
        libzip-dev \
        libmcrypt-dev \
        libcurl4-openssl-dev \
        libssl-dev \
        libonig-dev \
        libicu-dev \
        libevent-dev \
        uuid-dev \
        librabbitmq-dev \
        libssh-dev \
        libgeoip-dev \
        libmemcached-dev \
        openssl \
        openssh-server \
        nano \
        git \
        libpng-dev \
        && rm -rf /var/lib/apt/lists/*

RUN apt-get install -y $PHPIZE_DEPS

RUN docker-php-ext-install -j$(nproc) iconv \
        && docker-php-ext-install pcntl \
        && docker-php-ext-configure intl \
        && docker-php-ext-install intl \
        && docker-php-ext-enable intl \
        && docker-php-ext-install opcache \
        && docker-php-ext-enable opcache \
        && docker-php-ext-install mbstring \
        && docker-php-ext-enable mbstring \
        && docker-php-ext-install zip \
        && docker-php-ext-enable zip \
        && docker-php-ext-install gd \
        && docker-php-ext-enable gd \
        && docker-php-ext-install pdo_mysql \
        && docker-php-ext-enable pdo_mysql

RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd --gid ${GID} rta \
    && useradd --gid ${GID} --uid ${UID} rta \
    && sed -i "s/user = www-data/user = rta/g" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/group = www-data/group = rta/g" /usr/local/etc/php-fpm.d/www.conf

USER rta
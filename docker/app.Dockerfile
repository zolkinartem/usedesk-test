FROM php:7.4-fpm-alpine

RUN apk --no-cache add shadow sudo

ARG user_uid
RUN usermod -u ${user_uid? invalid argument} www-data
RUN groupmod -g ${user_uid? invalid argument} www-data

RUN apk update && apk add --no-cache \
    $PHPIZE_DEPS \
    bash \
    git \
    libmcrypt-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    openssl \
    postgresql-dev \
    sqlite \
    sqlite-dev \
    unzip \
    vim \
    wget \
    zip

RUN docker-php-ext-install \
    bcmath \
    gd \
    pdo \
    pdo_pgsql \
    tokenizer \
    zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# fix this issue https://ask.fedoraproject.org/t/sudo-setrlimit-rlimit-core-operation-not-permitted/4223
RUN echo "Set disable_coredump false" >> /etc/sudo.conf

# Clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/*

FROM php:8.1.32-cli-alpine3.21

COPY --from=composer:2.8.9 /usr/bin/composer /usr/local/bin/composer

ENV COMPOSER_HOME=/composer/common
ENV COMPOSER_HOME_SYMFONY_6_1=/composer/symfony-6-1

RUN \
    apk add --no-cache \
        bash \
        cloc \
        jq \
        git \
        linux-headers \
    # Install xdebug
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps \
    # Install symfony component for coverage
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_6_1} composer global require symfony/serializer:6.1.* \
    # Purge
    && rm -rf /tmp/*

WORKDIR /app

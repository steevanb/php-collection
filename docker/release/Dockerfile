FROM php:7.4.23-cli-alpine3.14

COPY --from=composer:2.1.6 /usr/bin/composer /usr/local/bin/composer

ARG DOCKER_UID
ARG DOCKER_GID

ENV COMPOSER_HOME=/composer/common
ENV COMPOSER_HOME_SYMFONY_5_3=/composer/symfony-5-3

RUN \
    apk add --no-cache \
        bash \
        cloc \
        jq \
        git \

    # Install xdebug \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug-3.0.4 \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps \

    # Create user app
    && addgroup -g ${DOCKER_GID} -S app \
    && adduser -u ${DOCKER_UID} -S app -G app \

    # Create composer directories
    && mkdir -p ${COMPOSER_HOME} \
    && chown app:app ${COMPOSER_HOME} \
    && mkdir -p ${COMPOSER_HOME_SYMFONY_5_3} \
    && chown app:app ${COMPOSER_HOME_SYMFONY_5_3} \

    # Purge
    && rm -rf /tmp/*

USER app

RUN \
    # Install symfony component for coverage
    COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_5_3} composer global require symfony/serializer:5.3.*

WORKDIR /app

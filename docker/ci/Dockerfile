FROM ubuntu:22.04

COPY --from=composer:2.4.4 /usr/bin/composer /usr/local/bin/composer

ENV COMPOSER_HOME=/composer/common
ENV COMPOSER_HOME_SYMFONY_6_1=/composer/symfony-6-1
ENV COMPOSER_HOME_SYMFONY_6_2=/composer/symfony-6-2

COPY docker/ci/composer.json ${COMPOSER_HOME}/composer.json

RUN \
    apt-get update \
    # To add add-apt-repository
    && apt-get install -y software-properties-common \
    && LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php \
    && apt-get install -y \
        bash \
        shellcheck \
        php8.1-cli \
        php8.1-simplexml \
        php8.2-cli \
        php8.2-simplexml \
        # For Composer
        curl zip php8.1-curl php8.1-zip \
        # For unused-scanner and phpunit
        php8.1-mbstring php8.2-mbstring \
        # For coverage
        php8.1-xdebug \

    # Install CI tools
    && cd ${COMPOSER_HOME} \
    && composer up \
    && ln -s ${COMPOSER_HOME}/vendor/bin/composer-require-checker /usr/local/bin/composer-require-checker \
    && ln -s ${COMPOSER_HOME}/vendor/bin/phpdd /usr/local/bin/phpdd \
    && ln -s ${COMPOSER_HOME}/vendor/bin/phpcs /usr/local/bin/phpcs \
    && ln -s ${COMPOSER_HOME}/vendor/bin/phpstan /usr/local/bin/phpstan \
    && ln -s ${COMPOSER_HOME}/vendor/bin/unused_scanner /usr/local/bin/unused-scanner \

    # Install Symfony components
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_6_1} composer global require symfony/serializer:6.1.* \
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_6_2} composer global require symfony/serializer:6.2.* \

    # Purge
    && apt-get purge -y software-properties-common \
    && apt-get autoremove -y \
    && apt-get clean \
    && apt-get autoclean \
    && rm -rf /tmp/*

WORKDIR /app

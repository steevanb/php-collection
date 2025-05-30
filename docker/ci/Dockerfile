FROM ubuntu:24.04

COPY --from=composer:2.8.9 /usr/bin/composer /usr/local/bin/composer

ENV COMPOSER_HOME=/composer/common
ENV COMPOSER_HOME_SYMFONY_6_1=/composer/symfony-6-1
ENV COMPOSER_HOME_SYMFONY_6_2=/composer/symfony-6-2
ENV COMPOSER_HOME_SYMFONY_6_3=/composer/symfony-6-3
ENV COMPOSER_HOME_SYMFONY_6_4=/composer/symfony-6-4
ENV COMPOSER_HOME_SYMFONY_7_0=/composer/symfony-7-0
ENV COMPOSER_HOME_SYMFONY_7_1=/composer/symfony-7-1
ENV COMPOSER_HOME_SYMFONY_7_2=/composer/symfony-7-2
ENV PHPSTAN_BIN_PATH=/usr/local/bin/phpstan

COPY composer.json ${COMPOSER_HOME}/composer.json

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
        php8.3-cli \
        php8.3-simplexml \
        php8.4-cli \
        php8.4-simplexml \
        # For Composer
        curl zip php8.1-curl php8.1-zip php8.2-curl php8.2-zip \
        # For unused-scanner and phpunit
        php8.1-mbstring php8.2-mbstring php8.3-mbstring php8.4-mbstring \
        # For coverage
        php8.2-xdebug \
    && update-alternatives --set php /usr/bin/php8.1 \
    # Install CI tools
    && composer global up \
    && ln -s ${COMPOSER_HOME}/vendor/bin/composer-require-checker /usr/local/bin/composer-require-checker \
    && ln -s ${COMPOSER_HOME}/vendor/bin/phpdd /usr/local/bin/phpdd \
    && ln -s ${COMPOSER_HOME}/vendor/bin/phpcs /usr/local/bin/phpcs \
    && ln -s ${COMPOSER_HOME}/vendor/bin/phpstan /usr/local/bin/phpstan \
    && ln -s ${COMPOSER_HOME}/vendor/bin/unused_scanner /usr/local/bin/unused-scanner \
    # Install Symfony components
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_6_1} composer global require symfony/serializer:6.1.* \
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_6_2} composer global require symfony/serializer:6.2.* \
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_6_3} composer global require symfony/serializer:6.3.* \
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_6_4} composer global require symfony/serializer:6.4.* \
    && update-alternatives --set php /usr/bin/php8.2 \
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_7_0} composer global require symfony/serializer:7.0.* \
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_7_1} composer global require symfony/serializer:7.1.* \
    && COMPOSER_HOME=${COMPOSER_HOME_SYMFONY_7_2} composer global require symfony/serializer:7.2.* \
    # Purge
    && apt-get purge -y software-properties-common \
    && apt-get autoremove -y \
    && apt-get clean \
    && apt-get autoclean \
    && rm -rf /tmp/*

WORKDIR /app

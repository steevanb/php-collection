FROM php:7.4.23-cli-alpine3.14

COPY --from=composer:2.1.6 /usr/bin/composer /usr/local/bin/composer

RUN \
    apk add libzip-dev zip \
    && docker-php-ext-install zip \
    # Install CI tools
    && composer global require \
        phpstan/phpstan:0.12.* \
        phpstan/phpstan-deprecation-rules:0.12.* \
        phpstan/phpstan-strict-rules:0.12.* \
    && ln -s /root/.composer/vendor/bin/phpstan /usr/local/bin/phpstan

WORKDIR /app

FROM php:7.4.19-cli-buster

COPY --from=composer:1.10.22 /usr/bin/composer /usr/local/bin/composer

RUN \
    apt-get update \
    && apt-get install -y libzip-dev zip \
    && docker-php-ext-install zip \
    # Install CI tools
    && composer global require \
        phpstan/phpstan:0.12.* \
        phpstan/phpstan-deprecation-rules:0.12.* \
        phpstan/phpstan-strict-rules:0.12.* \
    && ln -s /root/.composer/vendor/bin/phpstan /usr/local/bin/phpstan

WORKDIR /app

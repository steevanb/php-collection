FROM php:7.4.15-cli-buster

COPY --from=composer:1.10.20 /usr/bin/composer /usr/local/bin/composer

RUN \
    apt-get update \
    && apt-get install -y libzip-dev zip \
    && docker-php-ext-install zip \
    # Create cache for Composer to not download symfony/serializer at each test
    # If somebody knows how to add a dependency into Composer cache without installing it ;)
    && composer global require \
        symfony/serializer:4.4.19 \
        symfony/serializer:5.0.11 \
        symfony/serializer:5.1.11 \
        symfony/serializer:5.2.3 \
    && composer global remove symfony/serializer \
    # Install CI tools
    && composer global require \
        phpstan/phpstan:0.12.* \
        phpstan/phpstan-deprecation-rules:0.12.* \
        phpstan/phpstan-strict-rules:0.12.* \
    && ln -s /root/.composer/vendor/bin/phpstan /usr/local/bin/phpstan

# Copy source code into Docker image to be able to do composer require symfony/serializer without modifying files
COPY . /app

WORKDIR /app

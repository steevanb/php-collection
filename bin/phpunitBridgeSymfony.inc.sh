#!/usr/bin/env sh

set -eu

if [ -z "${SYMFONY_VERSION:-}" ]; then
    printf "\e[41m You must define readonly var \$SYMFONY_VERSION. \e[0m\n"
    exit 1
fi

if [ -z "${SYMFONY_VERSION_SHORT:-}" ]; then
    printf "\e[41m You must define readonly var \$SYMFONY_VERSION_SHORT. \e[0m\n"
    exit 1
fi

if [ $(which docker || false) ]; then
    docker \
        run \
            --rm \
            -it \
            -w /app \
            steevanb/php-typed-array-ci:1.0.1 \
            "bin/phpunitBridgeSymfony${SYMFONY_VERSION_SHORT}" \
            "${@}"
else
    composer require --dev --ansi "symfony/serializer:${SYMFONY_VERSION}"
    vendor/bin/phpunit --bootstrap vendor/autoload.php --colors=always tests/Bridge/Symfony "${@}"
fi

#!/usr/bin/env bash

set -eu

if type docker > /dev/null 2>&1; then
    readonly isInDocker=false
else
    readonly isInDocker=true
fi

if [ -z "${BIN_DIR-}" ]; then
    BIN_DIR="bin/ci"
fi

if [ -z "${DOCKER_IMAGE_NAME-}" ]; then
    DOCKER_IMAGE_NAME="${CI_DOCKER_IMAGE_NAME}"
fi

if ! ${isInDocker}; then
    set +e
    tty -s && isInteractiveShell=true || isInteractiveShell=false
    set -e

    if ${isInteractiveShell}; then
        interactiveParameter="--interactive"
    else
        interactiveParameter=
    fi

    docker \
        run \
            --rm \
            --tty \
            ${interactiveParameter} \
            --volume "${ROOT_DIR}":/app \
            --user "$(id -u)":"$(id -g)" \
            --entrypoint "${BIN_DIR}"/"$(basename "${0}")" \
            --workdir /app \
            "${DOCKER_IMAGE_NAME}" \
            "${@}"
    exit 0
fi

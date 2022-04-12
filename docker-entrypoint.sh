#!/bin/bash

set -e
check_error=true

if $check_error ; then
    sh -c "cp /app/docker/docker.env /app/.env"

    sh -c "php artisan key:generate"
    sh -c "php artisan migrate"
    sh -c "php artisan db:seed"

    sh -c "chmod 777 -R /app/storage"
    sh -c "chmod 777 -R /app/public"

    sh -c "php artisan storage:link"

    exec "$@"
else
    echo 'Exit'
fi

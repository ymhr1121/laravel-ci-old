#!/bin/bash

set -eux

cd ~/laravel
ln -fs ../shared/.env .env
php artisan migrate --force

#!/bin/bash

set -eux

cd ~/laravel
ln -fs ../shared/.env .env
chown laravel:laravel .env

sudo su - laravel
cd ~/laravel
php artisan migrate --force

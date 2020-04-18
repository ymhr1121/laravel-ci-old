#!/bin/bash

set -eux

cd ~/laravel
sudo ln -fs ../shared/.env .env
sudo chown laravel:laravel .env
php artisan migrate --force

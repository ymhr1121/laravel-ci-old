#!/bin/bash

set -eux

cd /home/laravel/laravel
ln -fs ../shared/.env .env
chown -h laravel:laravel .env
sudo -u laravel php artisan migrate --force

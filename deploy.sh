#!/bin/bash

set -eux

cd ~/laravel
php artisan migrate --force

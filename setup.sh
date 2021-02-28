#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

cd "${DIR}/backend"
composer install
cp .env.example .env
php artisan key:generate
echo > database/database.sqlite
php artisan migrate:fresh

cd "${DIR}/frontend"
npm install

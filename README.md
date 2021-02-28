# Valuto

Currency converter

## Setup

    $ ./setup.sh

    # Or manually:

    $ cd backend
    $ composer install
    $ cp .env.example .env
    $ php artisan key:generate
    $ echo > database/database.sqlite
    $ php artisan migrate:fresh

    $ cd frontend
    $ npm install

## Laravel Backend

The backend uses Laravel Sanctum for authentication. The backend requires an API
key for the free.currencyconverterapi.com API. This key needs to be set in
`/backend/.env` under `API_KEY_FCCA=[API_KEY_HERE]`.  

### Requirements:

* PHP ^7.4|^8.0  

### Run backend

    $ cd backend
    $ php artisan serve --host=localhost --port=8000

## Vue.js Frontend

The frontend uses Vuex for state management and the Axios HTTP client. The
frontend expects the backend to run at `http://localhost:8000`. Otherwise set
the `VUE_APP_API` value in `/frontend/.env`.  

## Run frontend

    $ cd frontend
    $ npm run serve

## Buid frontend for production

    $ npm run build

<img src="screenshot.png" alt="Converting screen">

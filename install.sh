#!/bin/bash

cp .env.example .env

touch database/database.sqlite

composer install

php artisan migrate

php artisan db:seed --class=PokemonSeeder

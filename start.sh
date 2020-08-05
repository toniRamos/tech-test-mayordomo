#!/bin/sh
php artisan key:generate
php artisan serve --host=0.0.0.0 --port=8000 &
sleep infinity 
#!/bin/sh
sleep 10
php artisan migrate
php artisan db:seed
apache2-foreground
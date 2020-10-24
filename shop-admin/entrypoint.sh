#!/bin/sh
set -e

php artisan migrate
php artisan db:seed
php artisan config:cache

supervisord -n -c /etc/supervisord.conf

# /usr/sbin/crond   -f  -L  /var/log/cron/cron.log


#exec redis-server --requirepass develop





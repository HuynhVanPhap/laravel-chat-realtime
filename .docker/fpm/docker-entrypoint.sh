#!/bin/sh
set -e

# Enable Laravel schedule
if [ ${ENABLE_CRONTAB} -eq 1 ]; then
  mv -f /etc/supervisor.d/cron.conf.default /etc/supervisor.d/cron.conf
  echo "* * * * * php /var/www/html/artisan schedule:run >> /dev/null 2>&1" >> /etc/crontabs/www-data
fi

# Enable Laravel queue workers
if [ ${ENABLE_WORKER} -eq 1 ]; then
  mv -f /etc/supervisor.d/worker.conf.default /etc/supervisor.d/worker.conf
else
  rm -f /etc/supervisor.d/worker.conf.default
fi

# Enable Laravel horizon
if [ ${ENABLE_HORIZON} -eq 1 ]; then
  mv -f /etc/supervisor.d/horizon.conf.default /etc/supervisor.d/horizon.conf
else
  rm -f /etc/supervisor.d/horizon.conf.default
fi

exec "$@"

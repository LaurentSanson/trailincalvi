#!/bin/bash
set -e

cd $(dirname $(dirname $0))

DOCKER_COMPOSE=${DOCKER_COMPOSE:-docker compose}

#Stop server
docker compose down --remove-orphans

if [ -d vendor ]; then
    sudo rm -rf vendor
fi
export APP_ENV=prod

$DOCKER_COMPOSE -f docker-compose.production.yml build
$DOCKER_COMPOSE -f docker-compose.production.yml run --rm --no-deps -e APP_ENV=prod php composer install --no-dev --optimize-autoloader --ansi --no-progress
$DOCKER_COMPOSE -f docker-compose.production.yml run --rm --no-deps php composer dump-env prod
$DOCKER_COMPOSE -f docker-compose.production.yml run --rm --no-deps php bash -c "yarn install && NODE_ENV=production yarn build"

#Start server
$DOCKER_COMPOSE -f docker-compose.production.yml up -d

APP_ENV=prod APP_DEBUG=0 ./php bin/console cache:clear

docker exec mysql-container bash -c 'until echo 2> /dev/null >/dev/tcp/127.0.0.1/3306; do sleep 2; done'

#Open directory rights
sudo chown -R debian .

#Create database if not exists
./php bin/console doctrine:database:create --if-not-exists
#Run migrations
./php bin/console doctrine:migrations:migrate -n --allow-no-migration

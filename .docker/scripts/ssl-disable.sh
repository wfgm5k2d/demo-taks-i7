#!/bin/bash
envvar() {
    VAR=$(grep $1 $2 | xargs)
    IFS="=" read -ra VAR <<< "$VAR"
    echo ${VAR[1]}
}

WEBROOT=$(envvar WEBROOT ../.env)
DOMAIN=$(envvar DOMAIN ../.env)
ADMIN_EMAIL=$(envvar ADMIN_EMAIL ../.env)

cd ../apache2/sites-enabled

echo "1. Apache SSL: trying to disable"
FILE=000-default-ssl.conf
if [ -f "$FILE" ]; then
    rm 000-default-ssl.conf
    echo "2. Apache SSL: Disabled"
else
    echo "2. Apache SSL: Disabled"
fi

CONTAINER=$(docker ps -qf "name=ubuntu")

echo "3. Apache: Restart"
docker exec -it ${CONTAINER} service apache2 restart


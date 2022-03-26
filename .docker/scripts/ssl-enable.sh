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

echo "4. Letsencrypt: fetching certificate"
docker exec -it ${CONTAINER} certbot certonly --cert-name ${DOMAIN} --webroot -w ${WEBROOT} -d ${DOMAIN} -m ${ADMIN_EMAIL} --agree-tos --no-eff-email --keep

echo "5. Apache SSL: trying to enable"
cp 000-default-ssl.conf.template "000-default-ssl.conf"
sed -i "s#WEBROOT#${WEBROOT}#g" "000-default-ssl.conf"
sed -i "s#DOMAIN#${DOMAIN}#g" "000-default-ssl.conf"
sed -i "s#ADMIN_EMAIL#${ADMIN_EMAIL}#g" "000-default-ssl.conf"

echo "6. Apache SSL: Enabled"

echo "7. Apache SSL: Restart"
docker exec -it ${CONTAINER} service apache2 restart





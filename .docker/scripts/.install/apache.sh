#!/bin/bash
envvar() {
    VAR=$(grep $1 $2 | xargs)
    IFS="=" read -ra VAR <<< "$VAR"
    echo ${VAR[1]}
}

WEBROOT=$(envvar WEBROOT ../../.env)
DOMAIN=$(envvar DOMAIN ../../.env)
ADMIN_EMAIL=$(envvar ADMIN_EMAIL ../../.env)

cd ../../apache2/sites-enabled

cp 000-default.conf.template "000-default.conf"
sed -i "s#WEBROOT#${WEBROOT}#g" "000-default.conf"
sed -i "s#DOMAIN#${DOMAIN}#g" "000-default.conf"
sed -i "s#ADMIN_EMAIL#${ADMIN_EMAIL}#g" "000-default.conf"

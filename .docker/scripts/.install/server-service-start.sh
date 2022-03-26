#!/bin/bash
envvar() {
    VAR=$(grep $1 $2 | xargs)
    IFS="=" read -ra VAR <<< "$VAR"
    echo ${VAR[1]}
}

COMPOSE_PROJECT_NAME=$(envvar COMPOSE_PROJECT_NAME ../../.env)
COMPOSE_PROJECT_DIR=$(envvar COMPOSE_PROJECT_DIR ../../.env)

cp docker-compose-app.service.example "docker-compose-${COMPOSE_PROJECT_NAME}.service"
sed -i "s/COMPOSE_PROJECT_NAME/${COMPOSE_PROJECT_NAME}/g" "docker-compose-${COMPOSE_PROJECT_NAME}.service"
sed -i "s#COMPOSE_PROJECT_DIR#${COMPOSE_PROJECT_DIR}#g" "docker-compose-${COMPOSE_PROJECT_NAME}.service"

cp "docker-compose-${COMPOSE_PROJECT_NAME}.service" "/etc/systemd/system/docker-compose-${COMPOSE_PROJECT_NAME}.service"
systemctl enable "docker-compose-${COMPOSE_PROJECT_NAME}"

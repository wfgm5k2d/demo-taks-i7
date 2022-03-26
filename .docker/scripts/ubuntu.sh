#!/bin/bash
CONTAINER=$(docker ps -qf "name=ubuntu")
docker exec -it ${CONTAINER} bash

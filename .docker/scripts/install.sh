#!/bin/bash
echo "1. Checking file .env exist"

FILE=../.env
if [ -f "$FILE" ]; then
    echo "2. $FILE exists."
else
    echo "2. $FILE does not exist."
    echo "3. exit."
    exit 1
fi

echo "3. Installing docker.io docker-compose"
apt-get update > /dev/null
apt-get install docker.io docker-compose -y > /dev/null

cd .install
echo "4. Configuring apache"
./apache.sh
echo "5. .docker/apache/sites-enabled/000-default.conf created"

echo "6. Create service for docker auto start"
sudo ./server-service-start.sh
echo "7. .docker/apache/sites-enabled/000-default.conf created"
echo "8. Starting containers"
cd ../..
docker-compose up -d --build
echo "9. Done"
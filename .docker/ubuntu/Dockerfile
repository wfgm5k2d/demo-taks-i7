FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -yq software-properties-common \
    && add-apt-repository universe \
    && add-apt-repository ppa:ondrej/php \
    && apt-get update \
    && apt-get install -yq --no-install-recommends \
    certbot \
    python3-certbot-apache \
    apt-utils \
    zip \
    unzip \
    curl \
    git \
    apache2 \
    libapache2-mod-php8.0 \
    php8.0-cli \
    php8.0-curl \
    php8.0-fpm \
    php8.0-gd \
    php8.0-ldap \
    php8.0-mbstring \
    php8.0-mysql \
    php8.0-soap \
    php8.0-sqlite3 \
    php8.0-xml \
    php8.0-zip \
    php8.0-intl \
    php8.0-bcmath \
    php8.0-dev \
    php-pear \
    php-imagick \
    openssl \
    nano \
    graphicsmagick \
    imagemagick \
    ghostscript \
    mysql-client \
    iputils-ping \
    locales \
    ca-certificates \
    wget \
    cron \
    gnupg \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set locales
RUN locale-gen en_US.UTF-8 en_GB.UTF-8 de_DE.UTF-8 es_ES.UTF-8 fr_FR.UTF-8 it_IT.UTF-8 km_KH sv_SE.UTF-8 fi_FI.UTF-8

RUN a2enmod rewrite expires deflate ssl

EXPOSE 80
EXPOSE 443

WORKDIR /var/www/html

RUN touch /var/log/cron.log
RUN chmod 0777 /var/log/cron.log

COPY cron /etc/cron.d/docker-cron
RUN chmod 0644 /etc/cron.d/docker-cron
RUN crontab /etc/cron.d/docker-cron

COPY entrypoint.sh /root/letsencrypt.sh
RUN chmod 777 /root/letsencrypt.sh

COPY entrypoint.sh /root/entrypoint.sh
RUN chmod 777 /root/entrypoint.sh
CMD /root/entrypoint.sh
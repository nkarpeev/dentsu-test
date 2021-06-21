
# main image
FROM php:7.4-fpm

# packages
RUN apt-get update \
    && apt-get install -y libpq-dev && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && apt-get install -y libyaml-dev && pecl install yaml && docker-php-ext-enable yaml \
    && rm -rf /var/lib/apt/lists/*

# user

# vars
ARG WORKUSER=apache
ARG WORKUSER_HOME=/home/${WORKUSER}
ARG WORKUSER_UID=1000
ARG WORKDIR=/var/www/app

# add user
RUN useradd -U -m -s /bin/bash -d ${WORKUSER_HOME} -b ${WORKDIR} -u ${WORKUSER_UID} ${WORKUSER}

# change default fpm user
RUN if [ -f /usr/local/etc/php-fpm.d/www.conf ]; then \
        sed -i s/'user = www-data'/"user = ${WORKUSER}"/g /usr/local/etc/php-fpm.d/www.conf; \
        sed -i s/'group = www-data'/"group = ${WORKUSER}"/g /usr/local/etc/php-fpm.d/www.conf; \
    fi

# pwd
# USER ${WORKUSER}
WORKDIR ${WORKDIR}

USER root

# composer & git
RUN apt-get update \
    && apt-get install -y git \
    && curl -s https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN apt-get install -y nano vim less

# change user back
USER ${WORKUSER}
FROM 922969856207.dkr.ecr.ap-southeast-1.amazonaws.com/giaingay-apache-php:1.0
MAINTAINER LienLQ <lienlq3@topica.edu.vn>

# Install basics
RUN apt-get -q update
RUN apt-get install -y software-properties-common && apt-add-repository ppa:ondrej/php
RUN apt-get install -y zip unzip --allow-unauthenticated php7.2-gmp php7.2-zip php7.2-mongo
RUN apt-get install -y php-pear php7.2-dev

WORKDIR /app/

COPY composer.json /app/composer.json
#COPY composer.lock /app/composer.lock

# Install dependencies and cache
RUN composer install --prefer-dist --no-scripts --no-autoloader --no-dev -vvv

COPY . /app/

#Dump
RUN composer dump-autoload --no-scripts --optimize --no-dev

ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

# Expose apache.
EXPOSE ${PORT}

# Update the default apache site with the config we created.
ADD docker/apache-config.conf /etc/apache2/sites-enabled/000-default.conf
ADD docker/apache2-port.conf /etc/apache2/ports.conf
ADD docker/apache2.conf /etc/apache2/apache2.conf

# By default start up apache in the foreground, override with /bin/bash for interative.
ENTRYPOINT [ "bash","/app/docker-entrypoint.sh" ]

CMD /usr/sbin/apache2ctl -D FOREGROUND





ARG PHP_VERSION='7.4'
# image à utiliser
FROM php:${PHP_VERSION}-apache
ARG APP_DIR='/data/www'
# On envoie le nom du serveur à apache, c'est avec ça que l'on appelera nos pages
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

#
## Environment valiables
ENV DEBIAN_FRONTEND=noninteractive

#
## Install packages
RUN apt update -yqq && \
    apt install -yqq \
        apt-utils apt-transport-https ca-certificates \
        software-properties-common build-essential \
        sudo make gnupg g++ zip vim nano curl wget git openssl nginx \
        libssl-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev libxslt1-dev libzip-dev icu-devtools && \
        rm -rf /var/lib/apt/lists/*

#
## Install php ext
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
        docker-php-ext-configure zip && \
        docker-php-ext-install -j$(nproc) xsl xml xmlrpc simplexml intl pdo_mysql zip bcmath gd soap sockets && \
        pecl install apcu-5.1.17 && \
        pecl clear-cache && \
        docker-php-ext-enable apcu opcache

#
## Install composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

#
## Install nodejs,npm ... and packages
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - >/dev/null 2>&1 && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - >/dev/null 2>&1 && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update -yqq && \
    apt-get install -yqq nodejs yarn && \
    npm install -g gulp sass && \
    rm -rf /var/lib/apt/lists/*

# On copie le php.ini du repertoire actuel dans le contenaire
COPY php.ini /usr/local/etc/php/php.ini
COPY --chown=www-data:www-data ./ $APP_DIR

RUN mkdir -p /var/www && \
    chown -R www-data /var/www && \
    mkdir -p $APP_DIR && \
    chown -R www-data:www-data $APP_DIR && \
    chmod +x /usr/local/bin/* && \
    echo 'alias ll="ls -l"'     >>  /etc/bash.bashrc && \
    echo 'alias lh="ls -hal"'   >>  /etc/bash.bashrc

# le repertoire qui contient vos sources (attention : dans le contenaire, donc le repertoire à droite du mapping du docker-compose)
WORKDIR $APP_DIR

FROM php:8.4.8-cli-alpine3.20

RUN apk add --no-cache \
        tzdata \
        linux-headers && \
    cp /usr/share/zoneinfo/Europe/Moscow /etc/localtime && \
    echo "Europe/Moscow" >  /etc/timezone

ENV TZ Europe/Moscow
ENV LANG ru_RU.UTF-8
ENV LANGUAGE ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions \
    intl \
    zip  \
    gd \
    pdo_pgsql \
    memcache \
    sockets\
    exif\
    pcntl

COPY conf.d/* /usr/local/etc/php/conf.d/

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
ENV PATH "$PATH:/app:/app/bin"

ARG USERNAME=www
ARG GROUPNAME=www
ARG UID=1000
ARG GID=1000
# Add user for application
RUN addgroup -g ${GID} -S ${GROUPNAME} && adduser -u ${UID} -S ${USERNAME} -G ${GROUPNAME}

RUN chown ${USERNAME}:${GROUPNAME} /app /usr/local/bin/composer

# Change current user to www
USER ${UID}:${GID}
ENV USERNAME ${USERNAME}

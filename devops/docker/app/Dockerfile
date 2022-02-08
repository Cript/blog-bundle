FROM php:8.1-cli

ARG USER_ID
ARG GROUP_ID

ENV TZ=Europe/Moscow

RUN apt-get update \
    && apt-get install -y libzip-dev \
    && docker-php-ext-install zip \
    && groupadd 1000 \
    && usermod -aG 1000 www-data

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

USER www-data
WORKDIR /var/www
COPY --chown=www-data:www-data . ./

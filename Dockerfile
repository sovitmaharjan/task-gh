FROM php:8.2 as php

RUN apt update -y
RUN apt install -y unzip libpq-dev
RUN docker-php-ext-install bcmath

WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
ENTRYPOINT ["Docker/entrypoint.sh"]
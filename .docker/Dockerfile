FROM php:8-cli-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1

ENV RUN_DEPS \
    zlib \
    libzip \
    postgresql-libs

ENV BUILD_DEPS \
    zlib-dev \
    libzip-dev \
    postgresql-dev

# Install basic dependencies and psgql driver for Postgres
RUN apk add --no-cache --virtual .build-deps $BUILD_DEPS \
    && docker-php-ext-install -j "$(nproc)" zip pgsql pdo_pgsql \
    && apk del .build-deps

RUN apk add --no-cache --virtual .run-deps $RUN_DEPS

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Cleanup
RUN rm -rf /usr/share/php \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

EXPOSE 8080

WORKDIR /usr/src/public

ENTRYPOINT ["php", "-S", "0.0.0.0:8080"]

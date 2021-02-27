FROM php:8-cli-alpine

ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Cleanup dependencies
RUN rm -rf /usr/share/php \
    && rm -rf /tmp/* \
    && rm -rf /var/cache/apk/*

EXPOSE 8080

WORKDIR /usr/src/public

ENTRYPOINT ["php", "-S", "0.0.0.0:8080"]

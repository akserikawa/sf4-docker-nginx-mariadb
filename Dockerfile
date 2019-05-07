FROM php:7.2.6-fpm-alpine3.7

# Since we are running on Mac we are not gonna bother with importing user and group IDs from host.
RUN addgroup app && adduser -s /bin/sh -DS -G app app

RUN apk --update add zlib-dev icu-dev
RUN docker-php-ext-install intl opcache pdo_mysql zip

# Download and install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# copy our app so that we can run it independently of the docker-compose settings
COPY . /app

RUN mkdir -p /app/var/cache /app/vendor

# this is necessary if we want to run our app as the app user
RUN chown app:app -R /app

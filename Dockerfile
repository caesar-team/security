# ---- Base Image ----
FROM php:7.4-fpm-alpine AS base
RUN mkdir -p /var/www/html && chown -R www-data /var/www/html
# Set working directory
WORKDIR /var/www/html

RUN apk --update add \
    build-base \
    autoconf \
    git \
    icu-dev \
    libzip-dev \
    zip

RUN docker-php-ext-install \
    intl \
    bcmath\
    opcache \
    zip \
    sockets

RUN pecl install redis \
    && docker-php-ext-enable redis

# Composer part
COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_MEMORY_LIMIT -1
# ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer global require hirak/prestissimo  --prefer-dist --no-progress --no-suggest --optimize-autoloader --no-interaction --no-plugins --no-scripts

# Run in production mode
ARG APP_ENV=prod
ENV APP_ENV=${APP_ENV}
# Copy project file
COPY composer.json .
COPY composer.lock .

# ---- Test ----
FROM base AS test
ENV APP_ENV=test
COPY . .
RUN composer install
RUN ./bin/phpunit
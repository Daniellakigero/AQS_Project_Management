FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev && \
    docker-php-ext-configure pgsql --with-pgsql && \
    docker-php-ext-install pgsql pdo_pgsql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY php.ini /usr/local/etc/php/conf.d/

COPY . /var/www/html

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]

FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nano \
    wget \
    dialog \
    libsqlite3-dev \
    libsqlite3-0 \
    default-mysql-client \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \
    apt-utils \
    build-essential \
    git \
    curl \
    libonig-dev \
    libcurl4 \
    libcurl4-openssl-dev \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    libz-dev  \
    libmemcached-dev \
    libmagickwand-dev \
    openssl

# Install latest Composer 1 version
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer  --version=1.10.22

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Other PHP7 Extensions
RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install pdo_sqlite && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install curl && \
    docker-php-ext-install tokenizer && \
    docker-php-ext-install pcntl && \
    docker-php-ext-install json && \
    docker-php-ext-install zip && \
    docker-php-ext-install -j$(nproc) intl && \
    docker-php-ext-install mbstring && \
    docker-php-ext-install exif && \
    docker-php-ext-install gettext

# Install redis
RUN pecl install redis-5.1.1 && \
    docker-php-ext-enable redis

# Install memcache
RUN pecl install memcached \
	&& docker-php-ext-enable memcached \
	&& true

# Install Freetype
RUN apt-get -y update && \
    apt-get --no-install-recommends install -y libfreetype6-dev \
            libjpeg62-turbo-dev \
            libpng-dev && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

# Install imagick
RUN pecl install imagick && \
    docker-php-ext-enable imagick

# Install xdebug
#RUN pecl install xdebug-2.8.0 && \
#    docker-php-ext-enable xdebug \

# Cleanup
RUN rm -rf /usr/src/*

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user

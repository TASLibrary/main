FROM php:8.1-apache

# 1. Install development packages and clean up apt cache.
RUN apt-get update && apt-get install -y \
    curl \
    g++ \
    git \
    libbz2-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    sudo \
    unzip \
    zip \
 && rm -rf /var/lib/apt/lists/*

# 2. Apache configs + document root.

#RUN a2enmod authnz_ldap

RUN echo "ServerName tas.local" >> /etc/apache2/apache2.conf

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

# 4. Start with base PHP config, then add extensions.
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install bz2
RUN docker-php-ext-install calendar
RUN docker-php-ext-install iconv
RUN docker-php-ext-install intl
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pdo_mysql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN echo "zend_extension=xdebug" >> "$PHP_INI_DIR/php.ini"
RUN echo "[xdebug]" >> "$PHP_INI_DIR/php.ini"
RUN echo "xdebug.mode=debug" >> "$PHP_INI_DIR/php.ini"
RUN echo "xdebug.client_host=host.docker.internal" >> "$PHP_INI_DIR/php.ini"
RUN echo "xdebug.start_with_request=yes" >> "$PHP_INI_DIR/php.ini"
RUN echo "xdebug.extended_info = 1" >> "$PHP_INI_DIR/php.ini"


# 5. Composer.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. We need a user with the same UID/GID as the host user
# so when we execute CLI commands, all the host file's permissions and ownership remain intact.
# Otherwise commands from inside the container would create root-owned files and directories.
ARG uid
RUN useradd -G www-data,root -u 1000 -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser

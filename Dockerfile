# Development build
FROM php:fpm-alpine as base

ENV WORKPATH "/var/www/snowtricks"
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev postgresql-dev gnupg graphviz make autoconf git zlib-dev curl chromium go \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install zip intl pdo_pgsql pdo_mysql opcache json pgsql mysqli \
    && pecl install apcu redis \
    && docker-php-ext-enable apcu mysqli redis

##xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

COPY docker/php/conf/php.ini /usr/local/etc/php/php.ini


# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Blackfire (Docker approach) & Blackfire Player
RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/alpine/amd64/$version \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
    && mv /tmp/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && mkdir -p /tmp/blackfire \
    && curl -A "Docker" -L https://blackfire.io/api/v1/releases/client/linux_static/amd64 | tar zxp -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire /usr/bin/blackfire \
    && rm -Rf /tmp/blackfire

# PHP-CS-FIXER & Deptrac
RUN wget http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -O php-cs-fixer \
    && chmod a+x php-cs-fixer \
    && mv php-cs-fixer /usr/local/bin/php-cs-fixer \
    && curl -LS http://get.sensiolabs.de/deptrac.phar -o deptrac.phar \
    && chmod +x deptrac.phar \
    && mv deptrac.phar /usr/local/bin/deptrac

RUN mkdir -p ${WORKPATH}

RUN rm -rf ${WORKDIR}/vendor \
    && ls -l ${WORKDIR}

RUN mkdir -p \
		${WORKDIR}/var/cache \
		${WORKDIR}/var/logs \
		${WORKDIR}/var/sessions \
	&& chown -R www-data ${WORKDIR}/var \
	&& chown -R www-data /tmp/

RUN chown www-data:www-data -R ${WORKPATH}

WORKDIR ${WORKPATH}

COPY . ./

EXPOSE 9000

CMD ["php-fpm"]

## Production build
FROM base

COPY docker/php/conf/production/php.ini /usr/local/etc/php/php.ini


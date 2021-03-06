FROM siutoba/docker-web:v1.8
MAINTAINER pmoltedo@uvq.edu.ar

RUN mkdir /var/local/autogestion_conf/
COPY var/autogestion/* /var/local/autogestion_conf/
RUN mkdir /var/local/preinscripcion_conf/
COPY var/preinscripcion/* /var/local/preinscripcion_conf/
RUN mkdir /var/local/gestion_conf/
COPY var/gestion/* /var/local/gestion_conf/
RUN echo 'pg:5432:*:postgres:postgres' > /root/.pgpass && chmod 700 /root/.pgpass
RUN pecl install apcu \
&& pecl install apcu_bc \
&& docker-php-ext-enable apc --ini-name 20-docker-php-ext-apc.ini \
&& mv /usr/local/etc/php/conf.d/ext-apcu.ini /usr/local/etc/php/conf.d/10-docker-php-ext-apcu.ini

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "display_errors = Off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.output_dir=/tmp/snapshots" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=172.17.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey = netbeans-xdebug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY var/gestion/entorno_toba.sh /var/local/gestion_conf/entorno_toba.sh
COPY entrypoint.sh /entrypoint.d/

ENV JASPER_HOST jasper
ENV JASPER_PORT 8081

RUN chmod +x /entrypoint.d/entrypoint.sh
COPY wait-for-postgres.sh /var/www/html/wait-for-postgres.sh
RUN chmod +x /var/www/html/wait-for-postgres.sh

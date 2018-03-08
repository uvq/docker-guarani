FROM siutoba/docker-web:v1.3
MAINTAINER ramiro@uvq.edu.ar

RUN mkdir /var/local/autogestion_conf/
COPY var/autogestion/* /var/local/autogestion_conf/
RUN mkdir /var/local/preinscripcion_conf/
COPY var/preinscripcion/* /var/local/preinscripcion_conf/
RUN mkdir /var/local/gestion_conf/
RUN apt-get update -y && apt-get install postgresql-client-9.4 -y && apt-get install fop -y && apt-get install libfreetype6 libfreetype6-dev -y && apt-get -y install php5-pgsql && apt-get install libpq-dev -y
RUN pear config-set php_suffix 5
RUN apt-get install -y php5-dev
RUN pecl install 'xdebug-2.5.5'
COPY conf/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
RUN mv /usr/lib/php5/20131226/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226/
RUN echo 'memory_limit = 1024M' >> /usr/local/etc/php/php.ini
RUN echo 'default_charset = ""' >> /usr/local/etc/php/php.ini
RUN echo 'pg:5432:*:postgres:postgres' > /root/.pgpass && chmod 700 /root/.pgpass
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/freetype2/  --enable-gd-native-ttf && docker-php-ext-install gd
RUN docker-php-ext-install exif
RUN docker-php-ext-install pgsql

COPY var/gestion/entorno_toba_2.6.sh /var/local/gestion_conf/entorno_toba_2.6.sh
COPY entrypoint.sh /entrypoint.d/

ENV JASPER_HOST jasper
ENV JASPER_PORT 8081

RUN chmod +x /entrypoint.d/entrypoint.sh
COPY wait-for-postgres.sh /var/www/html/wait-for-postgres.sh
RUN chmod +x /var/www/html/wait-for-postgres.sh

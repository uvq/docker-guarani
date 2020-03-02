FROM siutoba/docker-web:latest
MAINTAINER pmoltedo@uvq.edu.ar

RUN mkdir /var/local/gestion_conf/
COPY var/gestion/* /var/local/gestion_conf/

RUN echo 'pg:5432:*:postgres:postgres' > /root/.pgpass && chmod 700 /root/.pgpass

RUN apt-get update -q \
    && apt-get install -y python-pip \
    && pip install stellar \
    && pip install psycopg2-binary

COPY var/gestion/entorno_toba.sh /var/local/gestion_conf/entorno_toba.sh
COPY entrypoint.sh /entrypoint.d/

RUN chmod +x /entrypoint.d/entrypoint.sh
COPY wait-for-postgres.sh /var/www/html/wait-for-postgres.sh
RUN chmod +x /var/www/html/wait-for-postgres.sh

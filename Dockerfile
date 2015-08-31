FROM siutoba/docker-web:latest
MAINTAINER ablanco@siu.edu.ar

COPY gestion.sh /entrypoint.d/
COPY autogestion.sh /entrypoint.d/
COPY preinscripcion.sh /entrypoint.d/
RUN mkdir /var/local/autogestion_conf/
COPY var/autogestion/* /var/local/autogestion_conf/
RUN mkdir /var/local/preinscripcion_conf/
COPY var/preinscripcion/* /var/local/preinscripcion_conf/
RUN mkdir /var/local/gestion_conf/
COPY var/gestion/entorno_toba_2.6.sh /var/local/gestion_conf/entorno_toba_2.6.sh
RUN apt-get update -y && apt-get install postgresql-client-9.4 -y
RUN echo 'pg:5432:*:postgres:postgres' > /root/.pgpass && chmod 700 /root/.pgpass

ENV JASPER_HOST jasper
ENV JASPER_PORT 8081

RUN chmod +x /entrypoint.d/*.sh


#!/bin/bash

if [ -z "$TOBA_ID_DESARROLLADOR" ]; then
    TOBA_ID_DESARROLLADOR=0;
fi

if [ -z "$TOBA_PASS" ]; then
    echo "Se utiliza el password default de toba (OjO)";
    TOBA_PASS=toba;
fi


HOME_GESTION=/var/local/gestion
HOME_PREINSCRIPCION=/var/local/preinscripcion
HOME_TOBA=${HOME_GESTION}/lib/toba
# se hace un export para que lo tome el toba al momento de la instalación
export TOBA_INSTALACION_DIR=${HOME_GESTION}/docker-data/instalacion

BOBO_FILE=${TOBA_INSTALACION_DIR}/bobo.file
if [ ! -f ${BOBO_FILE} ]; then
    psql -h pg -U postgres -c "CREATE DATABASE preinscripcion WITH ENCODING='LATIN1' OWNER=postgres TEMPLATE=template0 LC_COLLATE='C' LC_CTYPE='C' CONNECTION LIMIT=-1 TABLESPACE=pg_default;"
    psql -h pg -U postgres -d preinscripcion -f ${HOME_PREINSCRIPCION}/BD/Creacion/creacion_preinscripcion3_postgresql.sql
    chown -R www-data:www-data ${HOME_PREINSCRIPCION}/instalacion/temp
    chown -R www-data:www-data ${HOME_PREINSCRIPCION}/instalacion/log
    chown -R www-data:www-data ${HOME_PREINSCRIPCION}/instalacion/cache
    chown -R www-data:www-data ${HOME_PREINSCRIPCION}/src/siu/www
    cp /var/local/preinscripcion_conf/* ${HOME_PREINSCRIPCION}/instalacion
    cp ${HOME_PREINSCRIPCION}/instalacion/login_template.php ${HOME_PREINSCRIPCION}/instalacion/login.php 
    ln -s ${HOME_PREINSCRIPCION}/instalacion/alias.conf /etc/apache2/sites-enabled/preinscripcion.conf

    echo -e '[desarrollo guarani preinscripcion]\nmotor = "postgres7"\nprofile = "pg"\npuerto = "5432"\nusuario = "postgres"\nclave = "postgres"\nbase = "preinscripcion"' >> ${TOBA_INSTALACION_DIR}/bases.ini
    psql -h pg -U postgres -d toba_guarani -c "INSERT INTO negocio.adm_bases_preinscripcion (fuente_de_datos, nombre) VALUES ('preinscripcion', 'Preinscripción');"

    touch ${BOBO_FILE}
fi


#!/bin/bash

HOME_GESTION=/var/local/gestion
HOME_TOBA=${HOME_GESTION}/vendor/siu-toba/framework
HOME_PREINSCRIPCION=/var/local/preinscripcion
HOME_3W=/var/local/autogestion

# se hace un export para que lo tome el toba al momento de la instalación
export TOBA_INSTALACION_DIR=${HOME_GESTION}/instalacion

if [ -z "$(ls -A "$TOBA_INSTALACION_DIR")" ]; then
    cd $HOME_GESTION
    composer install
    echo -n postgres > /tmp/clave_pg;
    echo -n ${TOBA_PASS} > /tmp/clave_toba;
    ${HOME_GESTION}/bin/toba instalacion instalar --no-interactive -n guarani -d ${TOBA_ID_DESARROLLADOR} -t 0 -h pg -p 5432 -u postgres -b toba_guarani -c /tmp/clave_pg -k /tmp/clave_toba;
    ${HOME_GESTION}/bin/guarani cargar -d ${HOME_GESTION} -p guarani -i desarrollo -a 1;

    # Instalar los juegos de dato de prueba
    printf "\n" | ${HOME_GESTION}/bin/guarani instalar -j;

    # Específico de Guaraní
    echo 'chequea_sincro_svn = 1' >> ${TOBA_INSTALACION_DIR}/instalacion.ini;
    echo 'fop = /var/local/gestion/php/3ros/fop/fop' >> ${TOBA_INSTALACION_DIR}/instalacion.ini;
	echo "menu = 2" > ${HOME_GESTION}/menu.ini;

    # Permite a Toba guardar los logs
	chown -R www-data ${TOBA_INSTALACION_DIR}/i__desarrollo;

    # Agrego también permisos a la carpeta temp
    chown -R www-data ${HOME_GESTION}/temp;

    # Agrego también permisos a la carpeta temp de TOBA
    chown -R www-data ${HOME_TOBA}/temp;

    # Permite al usuario HOST editar los archivos
	chmod -R a+w ${TOBA_INSTALACION_DIR};

    cp /var/local/gestion_conf/bases.ini ${TOBA_INSTALACION_DIR}/bases.ini;

fi



#Los muevo fuera de la instalacion por si tenemos ya todo instalado y borramos los containers
cp /var/local/gestion_conf/entorno_toba.sh ${HOME_TOBA}/bin/entorno_toba.sh
echo ". ${HOME_TOBA}/bin/entorno_toba.sh" > /root/.bashrc
echo "export TERM=xterm;" >> /root/.bashrc

ln -s ${TOBA_INSTALACION_DIR}/toba.conf /etc/apache2/sites-enabled/toba_guarani.conf;
ln -s ${TOBA_INSTALACION_DIR}/toba.conf /etc/apache2/sites-available/toba_guarani.conf;

#Se deja el ID del container dentro de la configuración de toba, para luego poder usarlo desde el Host
DOCKER_CONTAINER_ID=`cat /proc/self/cgroup | grep -o  -e "docker-.*.scope" | head -n 1 | sed "s/docker-\(.*\).scope/\\1/"`
echo "TOBA_DOCKER_ID=$DOCKER_CONTAINER_ID" > ${TOBA_INSTALACION_DIR}/toba_docker.env


if [ -z "$TOBA_ID_DESARROLLADOR" ]; then
    TOBA_ID_DESARROLLADOR=0;
fi

if [ -z "$TOBA_PASS" ]; then
    echo "Se utiliza el password default de toba (OjO)";
    TOBA_PASS=toba;
fi


exec "$@"

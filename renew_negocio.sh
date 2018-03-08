#!/bin/bash
timestamp=$(date '+%Y%m%d%H%M')
pg_ip=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' dockerguarani_pg_1)
server=192.168.10.36

echo "Poné tu user de $server"
read usuario

echo "Poné tu password de usuario \"$usuario\" para el servidor $server"
read -s user_pass
export PGPASSWORD=$user_pass

ver=$(psql -q -A -t -h $server -U $usuario -p 5432 -d guarani_test -c "SELECT version_app FROM negocio.app_versiones ORDER BY fecha_actualizacion DESC LIMIT 1;")
export PGPASSWORD=postgres

if [[ $(psql -q -A -t -h $pg_ip -U postgres -p 5432 -d toba_guarani -c "SELECT COUNT(*) FROM information_schema.schemata WHERE schema_name = 'negocio';") -eq 1 ]]; then
    psql -h $pg_ip -U postgres -p 5432 -d toba_guarani -c "ALTER SCHEMA negocio RENAME TO  \"negocio_${ver}_${timestamp}\";"
else
    echo "No existe el schema negocio"
fi

if [[ $(psql -q -A -t -h $pg_ip -U postgres -p 5432 -d toba_guarani -c " SELECT COUNT(*) FROM information_schema.schemata WHERE schema_name = 'negocio_pers';") -eq 1 ]]; then
    psql -h $pg_ip -U postgres -p 5432 -d toba_guarani -c "ALTER SCHEMA negocio_pers RENAME TO \"negocio_pers_${ver}_${timestamp}\";"
else
    echo "No existe el schema negocio_pers"
fi

echo "Continuar? (Ctrl+C para cancelar)"
read
docker run --rm -e PGPASSWORD=$user_pass postgres:9.6-alpine pg_dump -O -x -h $server -U $usuario -n negocio -n negocio_pers guarani_test | psql -h $pg_ip -U postgres -p 5432 toba_guarani

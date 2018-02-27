#!/bin/bash

HOME_3W=/var/local/autogestion

if [ ! -f "$HOME_3W/instalacion/config.php" ]; then
    cp /var/local/autogestion_conf/* $HOME_3W/instalacion
    cp $HOME_3W/instalacion/login_template.php $HOME_3W/instalacion/login.php
    cd $HOME_3W
    composer install
fi
chown www-data $HOME_3W/instalacion/log -R

ln -s $HOME_3W/instalacion/alias.conf /etc/apache2/sites-enabled/autogestion.conf

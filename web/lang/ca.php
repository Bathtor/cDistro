<?php
//List of string english
// lib/errors.php

// plug/menus/lang.menu.php
addS ('Catalan','Català');
addS ('English','Anglès');
addS ('Spanish','Castellà');
// lib/plug/controller/
addS ('Welcome!','Benvingut !');
addS ('Define language to: ', 'Idioma sel·leccionat: ');
addS ('Configure your system!','Configura el sistema!');
addS ('is already installed.','ja està instal·lat');
addS ("isn't installed.","no està instal·lat.");
addS ("Install","Instal·lar");
addS ("Uninstall","Desinstal·la");
addS ("Installed","Instal·lat");
addS ("Uninstalled","Desinstal·lat");
addS ("Home","Inici");
addS ("package, please wait!","paquet, si et plau espera!");

// plug/controllers/getinconf.php
addS ('Getinconf Server URL','URL del servidor Getinconf');
addS ('Network','Xarxa');
addS ('Network Password','Clau de la Xarxa');
addS ('Device of Community IP','Device de la IP de la comunitat');
addS ('Execute','Fes-ho');
addS ("Service UP","Servei ACTIU");
addS ("Service DOWN","Servei INACTIU");
addS ("Save it","Guarda't");
addS ("Now, service is loading. Please come back","Ara, el servei s'està activant, Si et plau torna enrere.");
addS ("previous page","pàgina anterior");
addS ("You can return to the previous","Pots tornar a la pàgina anterior");


// Cloudy: menús
//
// plug/menus/*.php
//
include 'ca.menus.php';


// Cloudy: actualitzacions
//
// plug/controllers/cloudyupdate.php
//
include 'ca.cloudyupdate.php';


// Clommunity: GeTinConf
//
// plug/controllers/getinconf.php
//
include 'ca.getinconf.php';


// Clommunity: Microcloud
//
// plug/controllers/microcloud.php
//
include 'ca.microcloud.php';


// Tahoe-LAFS
//
// plug/controllers/tahoe-lafs.php
//
include 'ca.tahoe-lafs.php';

// Guifi
//
// plug/controllers/guifi.php
//
include 'ca.guifi.php';

//Guifi
addS ('Server URL Base','URL del Servidor');
addS ('Guifi Proxy node number','Id del node Guifi Proxy');
addS ('Main Server Ldap','Principal servidor Ldap');
addS ('Main Server Ldap2','Principal servidor Ldap2');
addS ('Proxy Welcome Message','Missatge de Benvinguda del Proxy');
addS ('Contact email proxy server','Email de contacte del servidor proxy');
addS ('Choosemanager a language for error pages generated',"Escull l'idioma dels missatges d'error.");
addS ('Disk cache space (MB)','Espai de memòria cau (MB)');
addS ('Ram cache space (MB)','Espai de RAM de memòria cau (MB)');
addS ("This software provides a federated proxy service in the context of Guifi.net","Sistema Federa de Proxys a Guifi.net");
addS ("Guifi Proxy3","Guifi Proxy3");

addS ('Uninstall package','Desinstal·la el paquet');
addS ("This software provides graphing services in the context of Guifi.net","Aquest programarí genera el servei de gràfiques a guifi.net");
addS ('SNP Graph Server Id','Id del Servidor de grafiques SNP');
addS ("Guifi SNPServices","Guifi SNPServices");

addS ("This software provides DNS services in the context of Guifi.net","Aquest programarí genera el servei de DNS a guifi.net");
addS ('Select your DNS Server Id to share your domains','Id del Servei DNS per compartir el teu domini');
addS ('Url from DNSDataServer (without ending backslash)','Url de DNSDataServer (sense barra obliqua invertida al final)');
addS ("Guifi DNSServices","Servei de DNS a Guifi");

// lib/view.php
addS ('This package is not yet installed','Aquest paquet encara no està Instal·lat:');
addS ('Install','Instal·lar');
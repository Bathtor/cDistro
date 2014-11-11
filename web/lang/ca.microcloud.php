<?php
// plug/controllers/getinconf.php

//Getinconf client

addS ("getinconf_title","Client de Getinconf per a microclouds");
addS ("getinconf_subtitle","Un client de Getinconf per configurar una xarxa tinc-vpn per a microclouds");
addS ("getinconf_subtitle_interface_status","Estat de la interfície de xarxa VPN");
addS ("getinconf_description",'Getinconf és una eina que automatitza la configuració de xarxes VPN basades en <a href="http://www.tinc-vpn.org">tinc-vpn</a>. El client de Getinconf es connecta al servidor i rep la configuració de la VPN i les claus necessàries per connectar-se als altres nodes del microcloud, creant una xarxa virtual de microcloud de capa 2 segura.');
addS ("getinconf_form_server_url","URL del servidor Getinconf");
addS ("getinconf_form_server_url_help","L'adreça URL del servidor Getinconf. La URL per defecte a Guifi.net és <strong>http://10.139.40.84/index.php</strong>");
addS ("getinconf_form_microcloud_network","Xarxa del microcloud");
addS ("getinconf_form_microcloud_network_help","El nom de la xarxa del microcloud al qual pertany aquest node. El valor per defecte, <strong>demo</strong>, pot emprar-se per fer-hi proves");
addS ("getinconf_form_network_password","Contrasenya de la xarxa");
addS ("getinconf_form_network_password_help","La contrasenya de la xarxa del microcloud. La contrasenya de la xarxa del microcloud <strong>demo</strong> és <strong>demo</strong>");
addS ("getinconf_form_community_network_device","Dispositiu de xarxa");
addS ("getinconf_form_community_network_device_help","El dispositiu de xarxa d'aquest node que està connectada a la Xarxa Comunitària (els valors típics són  <strong>eth0</strong> o eth1). La interfície ha de tenir una adreça IP vàlida dins la Xarxa Comunitària");
addS ("getinconf_settings", "Configuració del client de Getinconf:");
addS ("getinconf_tinc_status", "Estat del client de Getinconf:");
addS ("getinconf_tinc_status_running","El client de Getinconf està en marxa");
addS ("getinconf_tinc_status_stopped","El client de Getinconf està aturat");
addS ("getinconf_button_save","Desa la configuració");
addS ("getinconf_button_stop","Atura el client de Getinconf");
addS ("getinconf_button_start","Engega el client de Getinconf");
addS ("getinconf_button_uninstall","Desinstal·la el client de Getinconf");
addS ("getinconf_button_interface","Mostra l'estat de la interfície de VPN");
addS ("getinconf_button_back","Torna al client de Getinconf");
addS ("getinconf_interface_command_output_pre","Sortida de l'ordre");
addS ("getinconf_interface_command_output_post"," :");
addS ("getinconf_alert_stopping","S'està aturant el client de Getinconf...");
addS ("getinconf_alert_starting","S'està engegant el client de Getinconf...");
addS ("getinconf_alert_uninstall","S'ha desinstal·lat el client de Getinconf");
addS ("getinconf_alert_saved","La configuració del client de Getinconf s'ha desat");
addS ("getinconf_click_button_back", "Feu clic al botó per tornar al client de Getinconf");
?>
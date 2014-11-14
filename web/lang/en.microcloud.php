<?php
// plug/controllers/microcloud.php

//Microcloud

addS ("microcloud_title","µCloud");
addS ("microcloud_subtitle","A tool for creating and joining microclouds");
addS ("microcloud_description_1",'Cloudy instances in a Community Network (CN) can be clustered together, creating a <strong>microcloud</strong>. Microclouds can be deployed by CN users in a vicinity, organizations with common interests, etc. to exchange data and information or share resources between instances and to federate services.');
addS ("microcloud_description_2",'In a microcloud, all the Cloudy instances participating are directly connected with a <strong>virtual layer 2 network</strong> based on <a href="http://tinc-vpn.org">tinc-vpn 🔗</a>. This allows to exchange data securely between nodes. <strong>µCloud</strong> (microCloud) is a tool for starting a microcloud or joining an existing one.');
addS ("microcloud_role_alert_none","This Cloudy instance does not belong to any microcloud");
addS ("microcloud_button_create","Create a new microcloud");
addS ("microcloud_button_join","Join an existing microcloud");
addS ("microcloud_role_alert_master_before","This Cloudy instance belongs to the microcloud");
addS ("microcloud_role_alert_master_after","");
addS ("microcloud_role_alert_client_before","This Cloudy instance belongs to the microcloud");
addS ("microcloud_role_alert_client_after","");
addS ("microcloud_create_description","This page allows you to create a new microcloud in your Community Network (CN). You can choose to make it public and announce it on your CN or to keep it private. Additionally, access to the microcloud can be restricted by means of a shared password.");
addS ("microcloud_create_form_name","Microcloud name");
addS ("microcloud_create_form_name_placeholder","Green Valley CN µCloud");
addS ("microcloud_create_form_name_help","The name of the microcloud (3 characters minimum). Use something to identify it and distinguish it from the others.");
addS ("microcloud_create_form_desc","Microcloud description");
addS ("microcloud_create_form_desc_help","An optional description for your microcloud, specifying your community, the purpose of the microcloud, etc.");
addS ("microcloud_create_form_desc_placeholder","The public microcloud of the Green Valley Community Network");
addS ("microcloud_create_form_network","Microcloud network");
addS ("microcloud_create_form_network_help",'<br> Cloudy instances in a microcloud are connected between them by a layer 2 virtual network based on <a href="http://tinc-vpn.org">tinc-vpn 🔗</a>. Nodes in this microcloud will get an IPv4 address in the selected network.');
addS ("microcloud_create_form_netmask","Microcloud netmask");
addS ("microcloud_create_form_netmask_help",'By default, microcloud networks have a /24 netmask (255.255.255.0), for up to 252 Cloudy instances.');



?>
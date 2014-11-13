<?php
//microcloud.php

$MICROCLOUD_CONF=load_conffile("/etc/cloudy/microcloud.conf");

function index(){

	global $MICROCLOUD_CONF;
	global $staticFile;

    $page = "";
	$buttons = "";

	$page .= hlc(t("microcloud_title"));
	$page .= hl(t("microcloud_subtitle"),4);
    $page .= par(t("microcloud_description_1"));
    $page .= par(t("microcloud_description_2"));

    switch ($MICROCLOUD_CONF['MICROCLOUD_ROLE']) {
        case "master":
            $page .= "<div class='alert alert-info text-center'>".t("microcloud_role_alert_master_before").' '.strong($MICROCLOUD_CONF['MICROCLOUD_NAME']).' '.t("microcloud_role_alert_master_after")."</div>\n";
        break;

        case "client":
            $page .= "<div class='alert alert-info text-center'>".t("microcloud_role_alert_client_before").' '.strong($MICROCLOUD_CONF['MICROCLOUD_NAME']).' '.t("microcloud_role_alert_client_after")."</div>\n";
        break;

        default:
            $page .= "<div class='alert alert-warning text-center'>".t("microcloud_role_alert_none")."</div>\n";
            $buttons .= addButton(array('label'=>t("microcloud_button_create"),'class'=>'btn btn-success', 'href'=>$staticFile.'/microcloud/createMicrocloud'));
            $buttons .= addButton(array('label'=>t("microcloud_button_join"),'class'=>'btn btn-success', 'href'=>$staticFile.'/microcloud/joinMicrocloud'));
        break;
    }

/*
    if (isUp($variables['NETWORK_NAME']))
        $disabled = "disabled";

    $page .= txt(t('getinconf_settings'));
	$page .= createForm(array('class'=>'form-horizontal'));
	$page .= addInput('GTC_SERVER_URL',t('getinconf_form_server_url'),$variables,array('type'=>'url', 'required'=>''),$disabled,t('getinconf_form_server_url_help'));
	$page .= addInput('NETWORK_NAME',t('getinconf_form_microcloud_network'),$variables,array('type'=>'text', 'required'=>''),$disabled,t('getinconf_form_microcloud_network_help'));
	$page .= addInput('NETWORK_KEY',t('getinconf_form_network_password'),$variables,array('type'=>'password', 'required'=>''),$disabled,t('getinconf_form_network_password_help'));
	$page .= addInput('INTERNAL_DEV',t('getinconf_form_community_network_device'),$variables,array('type'=>'text', 'required'=>''),$disabled,t('getinconf_form_community_network_device_help'));
	if (!isUp($variables['NETWORK_NAME']))
	   $submitButtons .= addSubmit(array('label'=>t('getinconf_button_save')));

    $page .= txt(t('getinconf_tinc_status'));
	if (isUp($variables['NETWORK_NAME'])){
		$page .= "<div class='alert alert-success text-center'>".t('getinconf_tinc_status_running')."</div>\n";
		$buttons .= addButton(array('label'=>t('getinconf_button_stop'),'class'=>'btn btn-danger','href'=>'getinconf/stop'));
		$buttons .= addButton(array('label'=>t('getinconf_button_interface'), 'href' => 'getinconf/interfaceStatus/'.$variables['NETWORK_NAME']));
	} else {
		$page .= "<div class='alert alert-error text-center'>".t('getinconf_tinc_status_stopped')."</div>\n";
		$buttons .= addButton(array('label'=>t('getinconf_button_start'),'class'=>'btn btn-success', 'href'=>'getinconf/start'));
		$buttons .= addButton(array('label'=>t('getinconf_button_uninstall'),'class'=>'btn btn-danger', 'href'=>'getinconf/uninstall'));
	}
    */
    $page .= $buttons;
	return(array('type' => 'render','page' => $page));
}

function createMicrocloud()
{
    global $MICROCLOUD_CONF;
	global $staticFile;
    $disabled = '';

    $page = "";
	$buttons = "";


	$page .= hlc(t("microcloud_title"));
	$page .= hl(t("microcloud_subtitle"),4);
	$page .= par(t("microcloud_create_description"));

	$page .= createForm(array('class'=>'form-horizontal'));
	$page .= addInput('MICROCLOUD_NAME', t('microcloud_create_form_name'), '', array('type'=>'text', 'required'=>'', 'placeholder'=>t("microcloud_create_form_desc_placeholder"), 'maxlength'=>"64", 'pattern'=>".{3,64}"), $disabled,t('microcloud_create_form_name_help'));
    $page .= addTextarea('MICROCLOUD_DESC',t('microcloud_create_form_desc'),$null,array('type'=>'text', 'placeholder'=>t("microcloud_create_form_desc_placeholder")),'',t('microcloud_create_form_desc_help'));

    for( $i=0; $i<=255; $i++) { $networks['192.168.'.$i.'.0'] = '192.168.'.$i.'.0'; };
	$page .= addSelect('MICROCLOUD_NETWORK',t('microcloud_create_form_network'),$networks,$disabled,'',t('microcloud_create_form_network_help'),'','192.168.'.rand(0,255).'.0');
	$page .= addInput('MICROCLOUD_NETMASK',t('microcloud_create_form_netmask'),null,array('type'=>'text', 'required'=>'', 'value'=>"255.255.255.0", 'disabled'=>''),'',t('microcloud_create_form_netmask_help'));


	$buttons .= addButton(array('label'=>t('microcloud_button_back_microcloud'),'class'=>'btn btn-default', 'href'=>$staticFile.'/tahoe-lafs'));
    $buttons .= addSubmit(array('label'=>t('microcloud_create_button_submit'),'class'=>'btn btn-success', 'href'=>$staticFile.'/microcloud/createMicrocloud'));

    $page .= $buttons;
	return(array('type' => 'render','page' => $page));
}

/*
function index_post(){
	global $getinconf_file;
	global $staticFile;

	$pre = "#!/bin/sh\n\n# Automatically generate file with cGuifi\n";
	$post = "# POST=665\n# GETINCONF_IGNORE=1\n";

	//Check info!!!
	$datesToSave = array();
	foreach ($_POST as $key => $value) {
		//check($key,$value);
		$datesToSave[$key] = $value;
	}
	write_conffile($getinconf_file,$datesToSave,$pre,$post);

	setFlash(t('getinconf_alert_saved'),"success");
	setFlash(t('getinconf_alert_saved'),"success");
	return(array('type'=> 'redirect', 'url' => $staticFile.'/'.'getinconf'));
}

function start(){
	global $staticFile;

	execute_bg_shell('getinconf-client install');
	$page = "";

	$page .= hlc(t("getinconf_title"));
	$page .= hl(t("getinconf_subtitle"),4);


	$page .= "<div class='alert alert-warning'>".t('getinconf_alert_starting');
    $page .= "</div>";
	$page .= txt(t('getinconf_click_button_back'));
	$page .= addButton(array('label'=>t('getinconf_button_back'),'class'=>'btn btn-default', 'href'=>$staticFile.'/getinconf'));
	return(array('type'=>'render', 'page'=> $page));
	exit();
}

function stop(){
	global $staticFile;

	$r = execute_program('getinconf-client uninstall');
	// this getinconf-client must do it.
	execute_program_detached('rm -r /var/run/getinconf-client.md5.*');

	if ($r['return'] == 0)
		setFlash(t('getinconf_alert_stopping'), "warning");

	return(array('type'=> 'redirect', 'url' => $staticFile.'/'.'getinconf'));
}

function interfaceStatus(){
	global $Parameters,$staticFile;

    $page = "";
	$page .= hlc(t("getinconf_title"));
	$page .= hl(t("getinconf_subtitle_interface_status"),4);

	if (isset($Parameters) && isset($Parameters[0])){
	    $page .= txt(t('getinconf_interface_command_output_pre')."<strong>ip addr show dev ".$Parameters[0]."</strong>".t('getinconf_interface_command_output_post'));
		$r = execute_program_shell('ip addr show dev '.$Parameters[0]);

		$page .= "<div class='alert alert-warning'>";
		$page .= "<pre>";
		$page .= $r['output'];
		$page .= "</pre></div>";
		$page .= addButton(array('label'=>t('getinconf_button_back'),'class'=>'btn btn-default', 'href'=>$staticFile.'/getinconf'));
		return(array('type'=>'render', 'page'=> $page));
	}

    return(array('type'=> 'redirect', 'url' => $staticFile.'/'.'getinconf'));
}

function isUp($dev){
	$r = execute_program('ip addr show dev '.$dev);
	return ($r['return']==0);
}

function saveThings(){
	//Check info!!!
	$datesToSave = array();
	foreach ($_POST as $key => $value) {
		//check($key,$value);
		$datesToSave[$key] = $value;
	}
	write_conffile($getinconf_file,$datesToSave,$pre,$post);
}


function uninstall(){
	global $staticFile;
    execute_program_detached('getinconf-client uninstall');

   	if ($r['return'] == 0)
    	setFlash(t('getinconf_alert_uninstall'), "info");

    return(array('type'=> 'redirect', 'url' => $staticFile.'/'.'getinconf'));
}
*/
?>
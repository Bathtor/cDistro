<?php
//tahoe-lafs.php

$CONFIGS_DIR="/usr/lib/cDistro/tahoe-lafs-manager/";
$TAHOELAFS_CONF="tahoe-lafs.conf.default";

function index_get(){

	global $CONFIGS_DIR;	
	global $TAHOELAFS_CONF;
	$tahoeVariables = load_conffile($CONFIGS_DIR.$TAHOELAFS_CONF);

	$page = "";

	$page .= hlc($tahoeVariables['PACKAGE_FULLNAME']);
	$page .= hl(t("A cloud storage system that distributes your data across multiple servers."),4);
	$page .= par(t("Tahoe-LAFS is a free and open cloud storage system. It distributes your data across multiple servers. Even if some of the servers fail or are taken over by an attacker, the entire filesystem continues to function correctly, preserving your privacy and security."));
		
	if ( ! isPackageInstall($tahoeVariables['PACKAGE_NAME']) ) {
		$page .= "<div class='alert alert-error text-center'>".t("Tahoe-LAFS is not installed on this machine")."</div>\n";
		$page .= par(t("To deploy a storage grid with Tahoe-LAFS you need one <strong>introducer</strong> and multiple <strong>nodes</strong> distributed by the network. Click on the button to install Tahoe-LAFS and start creating a storage grid or to join an existing one."));
		$page .= addButton(array('label'=>t("Install Tahoe-LAFS"),'class'=>'btn btn-success', 'href'=>'tahoe-lafs/install'));
	}
	
	else if( ! (introducerCreated($tahoeVariables['DAEMON_HOMEDIR']) || nodeCreated($tahoeVariables['DAEMON_HOMEDIR'])) ) {
		$page .= "<div class='alert alert-warning text-center'>".t("Tahoe-LAFS is installed on this machine but has not been configured yet")."</div>\n";
		$page .= par(t("To deploy a storage grid with Tahoe-LAFS you need one <strong>introducer</strong> and multiple <strong>nodes</strong> distributed by the network. Click on the buttons below to set up an introducer and start creating a storage grid or to add a storage node to an existing grid."));
		$page .= addButton(array('label'=>t("Create an introducer"),'class'=>'btn btn-success', 'href'=>'tahoe-lafs/introducer'));
		$page .= addButton(array('label'=>t("Create a storage node"),'class'=>'btn btn-success', 'href'=>'tahoe-lafs/node'));
		$page .= addButton(array('label'=>t("Uninstall Tahoe-LAFS"),'class'=>'btn btn-danger', 'href'=>'tahoe-lafs/purge'));	
	}

	else {	
	
	if ( introducerCreated($tahoeVariables['DAEMON_HOMEDIR']) )
		if ( introducerStarted($tahoeVariables['DAEMON_HOMEDIR'],$tahoeVariables['TAHOE_PID_FILE']) )
			$page .= "<div class='alert alert-success text-center'>".t("Tahoe-LAFS introducer running")."</div>\n";
		else
			$page .= "<div class='alert alert-warning text-center'>".t("Tahoe-LAFS introducer stopped")."</div>\n";
	
	if ( nodeCreated($tahoeVariables['DAEMON_HOMEDIR']) )
		if ( nodeStarted($tahoeVariables['DAEMON_HOMEDIR'],$tahoeVariables['TAHOE_PID_FILE']) )
			$page .= "<div class='alert alert-success text-center'>".t("Tahoe-LAFS node running")."</div>\n";
		else
			$page .= "<div class='alert alert-warning text-center'>".t("Tahoe-LAFS node stopped")."</div>\n";
	}
	
	return(array('type' => 'render','page' => $page));
}

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

	setFlash(t("Save it")."!","success");
	return(array('type'=> 'redirect', 'url' => $staticFile.'/'.'getinconf'));
}

function install(){
	global $CONFIGS_DIR;	
	global $TAHOELAFS_CONF;
	$tahoeVariables = load_conffile($CONFIGS_DIR.$TAHOELAFS_CONF);

	$page = "";
	
	$page .= hlc("Tahoe-LAFS");
	$page .= hl(t("Installation"),4);

	if (isPackageInstall("tahoe-lafs")){
 		$page .= "<div class='alert alert-success text-center'>".t("Tahoe-LAFS is already installed")."</div>\n";
		$page .= txt(t("Tahoe-LAFS installation information:"));
		$page .= ptxt(packageInstallationInfo("tahoe-lafs"));
 			$page .= addButton(array('label'=>t("Back to Tahoe-LAFS"),'class'=>'btn btn-default', 'href'=>'../tahoe-lafs'));
		}
 	else {
 		$pkgInstall = ptxt(installPackage("tahoe-lafs"));
	
		if (isPackageInstall("tahoe-lafs")) {
			$page .= "<div class='alert alert-success text-center'>".t("Tahoe-LAFS has been successfully installed")."</div>\n";
			$page .= txt(t("Installation process result:"));
			$page .= $pkgInstall;
			
			$page .= txt(t("Post-installation process:"));

			$postInstall = array();
			$postInstall[] = execute_program( 'cp -fv /usr/lib/cDistro/tahoe-lafs-manager/tahoe-lafs-init.d /etc/init.d/tahoe-lafs' )['output'][0];
			$postInstall[] = execute_program( 'cp -fv /usr/lib/cDistro/tahoe-lafs-manager/tahoe-lafs-etc.default /etc/default/tahoe-lafs' )['output'][0];
			foreach (execute_program( 'addgroup --system tahoe' )['output'] as $key => $value) { $postInstall[] = $value; }
			foreach (execute_program( 'adduser --system --ingroup tahoe --home /var/lib/tahoe-lafs --shell /sbin/nologin tahoe' )['output'] as $key => $value) { $postInstall[] = $value; }
			foreach (execute_program( 'chown -vR tahoe:tahoe /var/lib/tahoe-lafs' )['output'] as $key => $value) { $postInstall[] = $value; }

			$postInstallAll = "";
			foreach ($postInstall as $key => $value) { $postInstallAll .= $value.'<br/>'; }
			 
			$page .= ptxt($postInstallAll);
 			$page .= addButton(array('label'=>t("Back to Tahoe-LAFS"),'class'=>'btn btn-default', 'href'=>'../tahoe-lafs'));
			}
			
		else {
			$page .= "<div class='alert alert-error text-center'>".t("Tahoe-LAFS installation failed")."</div>\n";
			$page .= txt(t("Installation process result:"));
			$page .= $pkgInstall;
			$page .= addButton(array('label'=>t("Retry installation"),'class'=>'btn btn-warning', 'href'=>'install'));
		}
		
 	}
		
	return(array('type' => 'render','page' => $page));
}

function purge(){
	global $CONFIGS_DIR;	
	global $TAHOELAFS_CONF;
	$tahoeVariables = load_conffile($CONFIGS_DIR.$TAHOELAFS_CONF);

	$page = "";
	
	$page .= hlc("Tahoe-LAFS");
	$page .= hl(t("Uninstallation"),4);

	if ( ! isPackageInstall("tahoe-lafs" ) ) {
			$page .= "<div class='alert alert-warning text-center'>".t("Tahoe-LAFS is currently uninstalled")."</div>\n";
 			$page .= addButton(array('label'=>t("Back to Tahoe-LAFS"),'class'=>'btn btn-default', 'href'=>'../tahoe-lafs'));
		}
 	
 	else if ( introducerCreated($tahoeVariables['DAEMON_HOMEDIR']) || nodeCreated($tahoeVariables['DAEMON_HOMEDIR'])) {
		if ( introducerCreated($tahoeVariables['DAEMON_HOMEDIR']) ){
		$page .= "<div class='alert alert-warning text-center'>".t("A Tahoe-LAFS introducer is currently configured. Stop it and remove it before uninstalling Tahoe-LAFS.")."</div>\n";
		$page .= addButton(array('label'=>t("Remove Tahoe-LAFS introducer"),'class'=>'btn btn-danger', 'href'=>'introducer'));
		$page .= "<br/> <br/>";
		}
		if ( nodeCreated($tahoeVariables['DAEMON_HOMEDIR']) ){
		$page .= "<div class='alert alert-warning text-center'>".t("A Tahoe-LAFS node is currently configured. Stop it and remove it before uninstalling Tahoe-LAFS.")."</div>\n";
		$page .= addButton(array('label'=>t("Manage Tahoe-LAFS node"),'class'=>'btn btn-danger', 'href'=>'node'));
		$page .= "<br/> <br/>";
		}
	}
	
	else{
		$pkgUninstall = ptxt(uninstallPackage("tahoe-lafs"));
	
		if (isPackageInstall("tahoe-lafs")) {
			$page .= "<div class='alert alert-error text-center'>".t("Tahoe-LAFS uninstallation failed")."</div>\n";
			$page .= txt(t("Uninstallation process result:"));
			$page .= $pkgUninstall;
			$page .= addButton(array('label'=>t("Retry uninstallation"),'class'=>'btn btn-warning', 'href'=>'purge'));
			}
		else {
			$page .= "<div class='alert alert-success text-center'>".t("Tahoe-LAFS has been successfully uninstalled")."</div>\n";
			$page .= txt(t("Uninstallation process result:"));
			$page .= $pkgUninstall;

			
			$page .= txt(t("Post-uninstallation process:"));			
			
			$postUninstall = array();
			$postUninstall[] = execute_program( 'rm -fv /etc/init.d/tahoe-lafs' )['output'][0];
			$postUninstall[] = execute_program( 'rm -fv /etc/default/tahoe-lafs' )['output'][0];
			foreach (execute_program( 'deluser --system --remove-home tahoe' )['output'] as $key => $value) { $postUninstall[] = $value; }
			foreach (execute_program( 'delgroup --system tahoe' )['output'] as $key => $value) { $postUninstall[] = $value; }
			foreach (execute_program( 'rm -rvf /var/lib/tahoe-lafs' )['output'] as $key => $value) { $postUninstall[] = $value; }
			$postUninstallAll = "";
			foreach ($postUninstall as $key => $value) { $postUninstallAll .= $value.'<br/>'; }
			 
			$page .= ptxt($postUninstallAll);
			
 			$page .= addButton(array('label'=>t("Back to Tahoe-LAFS"),'class'=>'btn btn-default', 'href'=>'../tahoe-lafs'));
		}		
		
	
	}
	
		return(array('type' => 'render','page' => $page));
	
 		
 		

}

function upService(){
	global $staticFile;
/*
	No se per què el server es pensa que la pàgina encarà no s'ha acabat de carregar. :-?
	Revisar, per la parada si que funciona.
	Potser l'script a de fer un fork que no depengui del pare.
*/
	execute_bg_shell('getinconf-client install');
	$page = "";
	$page .= "<div class='alert alert-warning'>".t("Now, service is loading. Please come back")." <a href='".$staticFile.'/'.'getinconf'."'>".t("previous page")."</a>.</div>";
	return(array('type'=>'render', 'page'=> $page));
	exit();
}

function downService(){
	global $staticFile;

	$r = execute_program('getinconf-client uninstall');
	if ($r['return'] == 0) {
		setFlash(t('Service DOWN').'!');
	}

	return(array('type'=> 'redirect', 'url' => $staticFile.'/'.'getinconf'));	
}

function introducer(){
	
}

function viewDevice(){
	global $Parameters,$staticFile;

	if (isset($Parameters) && isset($Parameters[0])){
		$r = execute_program_shell('ip addr show dev '.$Parameters[0]);		
		$page = "";
		$page .= "<div class='alert alert-warning'>";
		$page .= "<pre>";
		$page .= $r['output'];
		$page .= "</pre>";
		$page .= t("You can return to the previous")." <a href='".$staticFile.'/'.'getinconf'."'>page</a>.</div>";
		return(array('type'=>'render', 'page'=> $page));
	}
	return(array('type'=> 'redirect', 'url' => $staticFile.'/'.'getinconf'));		
}

function nodeCreated($dir){
	if (is_dir("$dir/node"))
		return 1;
	else	
		return 0;
}

function introducerCreated($dir){
	if (is_dir("$dir/introducer"))
		return 1;
	else	
		return 0;
}

function introducerStarted($dir,$pidfile){
	if (is_file("$dir/introducer/$pidfile"))
		return 1;
	else	
		return 0;
}

function nodeStarted($dir,$pidfile){
	if (is_file("$dir/node/$pidfile"))
		return 1;
	else	
		return 0;
}

function nothing(){

		$page = "";
		$page .= "<div class='alert alert-warning'>";
		$page .= t("Nothing to do.");
		$page .= "</div>";
		return(array('type'=>'render', 'page'=> $page));

}

?>
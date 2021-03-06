<?php
//global.php
$cdistro_conf = "/etc/cdistro.conf";

$conf = parse_ini_file($cdistro_conf);
list($wi_ip, $wi_port) = explode(":", $_SERVER['HTTP_HOST']);
$protocol="http";

if (isset($conf['PORT_SSL'])) {
        if (($wi_port != $conf['PORT_SSL']) || ($_SERVER['REMOTE_ADDR'] != "127.0.0.1")){
                header('Location: https://'.$wi_ip.':'.$conf['PORT_SSL']);
        } else {
                $protocol="https";
        }
}

// You can change PATH files.
$staticFile=$_SERVER['SCRIPT_NAME'];
$staticPath=dirname($staticFile);

$documentPath=$_SERVER['DOCUMENT_ROOT'];

// App configure
$appCurrentYear = date('Y');
$appCopyright = "&copy; ".$appCurrentYear.", GPLv2";
$appHost = $_SERVER['HTTP_HOST'];
$appHostname = gethostname();
$appName = 'Cloudy';
$appURL=$protocol."://".$appHost;
$sysCPU=`grep -m1 "model name" /proc/cpuinfo | awk -F: '{print $2}'`;
$sysRAM=`free -h | grep Mem | awk '{print $2}'`."(".`grep -i "MemTotal" /proc/meminfo | awk -F: '{print $2}'`.")";
$sysStorage=`df -h | grep -m 1 -e '/$' | awk '{ print $2 " / " $4 }'`;
$communityURL="http://guifi.net";
$projectURL="http://clommunity-project.eu";
$LANG="en";

// Dir webapp
$plugs_controllers = "/plug/controllers/";
$plugs_menus = "/plug/menus/";
$plugs_avahi = "/plug/avahi/";
$lang_dir = "/lang/";

// Debug
$debug = false;

?>

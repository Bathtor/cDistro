<?php
//view.php

function hl($text=null,$kind=1){
	if (!is_null($text)){
		if ((!is_numeric($kind)) || (($kind < 0) && ($kind > 4)) ){
			$kind = 4;
		}
		return ("<h".$kind.">".$text."</h".$kind."><br/>");
	}
}

function hlc($text=null,$kind=1){
	if (!is_null($text)){
		if ((!is_numeric($kind)) || (($kind < 0) && ($kind > 4)) ){
			$kind = 4;
		}
		return ("<h".$kind.">".$text."</h".$kind.">");
	}
}

function par($text=null){
	if (!is_null($text)){
		return ("<div>".$text."</div><br/>");
	}
}

function spar($text=null){
	if (!is_null($text)){
		return ('<div><span style="font-size: smaller;">'.$text.'</span></div><br/>');
	}
}

function ptxt($text=null){
	if (!is_null($text)){
		return ("<div><pre>".$text."</pre></div>");
	}
}

function txt($text=null){
	if (!is_null($text)){
		return ("<div>".$text."</div>");
	}
}

function stxt($text=null){
	if (!is_null($text)){
		return ('<div><span style="font-size: smaller;">'.$text.'</span></div>');
	}
}

function strong($text=null){
    if (!is_null($text)){
        return ('<strong>'.$text.'</strong>');
    }
}

function package_not_install($pkg,$des){
	global $staticFile;

	$page = "";

	$page .= hl(t('This package is not yet installed'));
	$page .= hl($pkg, 2);
	$page .= "<p>".$des."</p>";
	$page .= addButton(array('label'=>t('Install'),'class'=>'btn btn-warning','href'=> $staticFile.'/default/install/'.$pkg));

	return($page);
}

function addTableHeader($values, $options=array()){

	$default = array('class'=>'table');
	$op = array_merge($default,$options);

	$page = "<table";
	foreach ($op as $key => $value) {
		$page .= " ".$key."='".$value."'";
	}
	$page .= ">\n<thead>\n<tr>\n";

	foreach($values as $v){
    	$page .= "<th>".$v."</th>\n";
  	}
    $page .= "</tr>\n</thead>\n<tbody>";

    return($page);
}

function addTableRow($values){
	$page = "<tr>";
	foreach($values as $v){
    	$page .= "<td>".$v."</td>\n";
  	}
  	$page .= "</tr>";
  	return ($page);
}

function addTableFooter(){
	$page = "</tbody>\n</table>\n";
	return($page);
}

function ajaxStr($div,$label){
	global $staticPath;

	$page = "<div id='".$div."'><img src='".$staticPath."images/ajax_loader.gif' width='40px' height='40px' /> ";
	$page .= $label."</div>";

	return($page);
}
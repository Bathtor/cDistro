<?php
//form.php

function createForm($options=null){

	$method = 'post';
	if (is_array($options)){
		if (isset($options['method'])) {
			$method = $options['method'];
			unset($options['method']);
		}
	}
	$str = "";
	$str .= "<div class='form'>\n";
	$str .= "<form method='".$method."' accept-charset='utf-8' ";
	foreach($options as $k=>$v){
		$str .= " $k='".$v."'";
	}
	$str .= ">\n";

	return $str;
}

function addInput($name=null, $label= null, $value = null, $options = null, $attributes = null, $tooltip = null, $nobr = null){

	if (!is_null($name)){
		$options['name'] = $name;
	}
	if (!is_null($value)){
		if(is_array($value)) {
			if (isset($value[$name])){
				$options['value'] = $value[$name];
			}
		} else {
			$options['value'] = $value;
		}
	}

	$str = "";
	$str .= "<div class='control-group'>\n";
	$str .="<label class='control-label'>$label:</label>\n";
	$str .="<div class='controls'>\n";
	$str .= "<input";
	if (is_array($options)){
		foreach($options as $k=>$v){
			$str .= " $k='".$v."'";
		}
	}

	if (!is_null($attributes))
		$str .= $attributes;
	$str .= ">\n";

	if (!is_null($tooltip))
		if (is_null($nobr))
			$str .= '<br/>';
		$str .= '<span style="font-size: smaller;"><span style="font-size: smaller;">'.$tooltip.'</span></span>';
	$str .="</div>\n";
	$str .="</div>\n";

	return $str;
}

function addCheckbox($name=null, $label= null, $value = null, $options = null, $attributes = null, $tooltip = null, $nobr = null){
	if (!is_null($name)){
		$options['name'] = $name;
	}

	$str = "";
	$str .= "<div class='control-group'>\n";
	$str .="<label class='control-label'>$label:</label>\n";
	$str .="<div class='controls'>\n";
	$str .= "<select ";
	if (is_array($options)){
		foreach($options as $k=>$v){
			$str .= " $k='".$v."'";
		}
	}
	if (!is_null($attributes))
		$str .= $attributes;
	$str .= ">\n";

	foreach ($value as $k => $v) {
		$str .= "<option value='".$k."'>".$v."</option>";
	}

	$str .= "</select>";

	if (!is_null($tooltip))
		if (is_null($nobr))
			$str .= '<br/>';
		$str .= '<span style="font-size: smaller;"><span style="font-size: smaller;">'.$tooltip.'</span></span>';
	$str .="</div>\n";
	$str .="</div>\n";

	return $str;
}

function addButton($options=null){

	$d = null;
	$default = array(
		'class' => "btn btn-primary",
		'divOptions' => array('class'=>'btn-group'));


	if (!is_array($options)){
		$options=array();
	}
	$o = array_merge($default,$options);
	if (isset($o['divOptions'])){
		$d = $o['divOptions'];
		unset($o['divOptions']);
	}
	$tag="button";
	if (isset($o['href'])){
		$tag="a";
	}

	$str = "";
	$str .="<div";
	if (is_array($d)){
		foreach($d as $k=>$v){
			$str .= " $k='".$v."'";
		}
	}
	$str .= ">";
	$str .="<$tag ";
	foreach($o as $k=>$v){
		$str .= " $k='".$v."'";
	}
	$str .= ">";
	$str .= $o['label'];
	$str .= "</$tag>";
	$str .= "</div>";
	return $str;
}

function addSelect($name=null, $label= null, $value = null, $options = null, $attributes = null, $tooltip = null, $nobr = null, $selected = null){
	if (!is_null($name)){
		$options['name'] = $name;
	}

	$str = "";
	$str .= "<div class='control-group'>\n";
	$str .="<label class='control-label'>$label:</label>\n";
	$str .="<div class='controls'>\n";
	$str .= "<select ";
	if (is_array($options)){
		foreach($options as $k=>$v){
			$str .= " $k='".$v."'";
		}
	}
	if (!is_null($attributes))
		$str .= $attributes;
	$str .= ">\n";

	foreach ($value as $k => $v) {
	    if (!is_null($selected) && $selected == $k)
            $str .= "<option value='".$k."' selected='selected'>".$v."</option>";
        else
            $str .= "<option value='".$k."'>".$v."</option>";
	}

	$str .= "</select>";

	if (!is_null($tooltip))
		if (is_null($nobr))
			$str .= '<br/>';
		$str .= '<span style="font-size: smaller;"><span style="font-size: smaller;">'.$tooltip.'</span></span>';
	$str .="</div>\n";
	$str .="</div>\n";

	return $str;
}

function addSubmit($options=null){

	$default = array(
		'label' => "Submit",
		'class' => "btn btn-submit",
		'type' => "submit");

	if (!is_array($options)){
		$options=array();
	}
	$o = array_merge($default,$options);

	$str = addButton($o);

	return $str;
}

function addTextarea($name=null, $label= null, $value = null, $options = null, $attributes = null, $tooltip = null, $nobr = null){
	if (!is_null($name)){
		$options['name'] = $name;
	}

	$str = "";
	$str .= "<div class='control-group'>\n";
	$str .="<label class='control-label'>$label:</label>\n";
	$str .="<div class='controls'>\n";
	$str .= "<textarea ";
	if (is_array($options)){
		foreach($options as $k=>$v){
			$str .= " $k='".$v."'";
		}
	}
	if (!is_null($attributes))
		$str .= $attributes;
	$str .= ">\n";

	foreach ($value as $k => $v) {
		$str .= "<option value='".$k."'>".$v."</option>";
	}

	$str .= "</textarea>";

	if (!is_null($tooltip))
		if (is_null($nobr))
			$str .= '<br/>';
		$str .= '<span style="font-size: smaller;"><span style="font-size: smaller;">'.$tooltip.'</span></span>';
	$str .="</div>\n";
	$str .="</div>\n";

	return $str;
}

function endForm($options=null){
	$str = "";
	$str .= "</form>\n</div>\n";

	return $str;

}

?>
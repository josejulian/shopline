<?php
function render_template($template, $parameters){
	$template_path = TEMPLATES_DIR . $template;
	if($parameters){
		$params = $parameters;
	}else{
		$params = array();
	}
	if(is_readable($template_path)){
		include_once $template_path;
	}else{
		echo "no se puede renderizar porque no existe el template";exit;
	}
}

function render_easyPHP_template($template, $e){
	$template_path = easyPHP_TEMPLATES_DIR . $template;
	$error = $e;
	if(is_readable($template_path)){
		include_once $template_path;
	}else{
		echo "no se puede renderizar porque no existe el template";exit;
	}
}
?>
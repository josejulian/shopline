<?php
function render_template($template, $parameters = null){
	$template_path = TEMPLATES_DIR . $template;
	if($parameters){
		$params = $parameters;
	}else{
		$params = array();
	}
	if(is_readable($template_path)){
		require $template_path;
	}else{
		echo "no se puede renderizar porque no existe el template";exit;
	}
}

function render_easyPHP_template($template, $e){
	$template_path = easyPHP_TEMPLATES_DIR . $template;
	$error = $e;
	if(is_readable($template_path)){
		require $template_path;
	}else{
		echo "no se puede renderizar porque no existe el template";exit;
	}
}

function redirect_to_url($url){
	header('Location: '.$url);
}
?>
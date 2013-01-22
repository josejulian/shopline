<?php
	error_reporting(E_ALL & ~E_NOTICE);
	ini_set("display_errors", 1);

	require_once 'settings.php';
	// echo CORE_PATH;
	require_once CORE_PATH . 'error.php';
	require_once CORE_PATH . 'session.php';
	require_once CORE_PATH . 'request.php';
	require_once CORE_PATH . 'config.php';
	require_once CORE_PATH . 'models.php';
	require_once CORE_PATH . 'views.php';
	require_once CORE_PATH . 'urls.php';
	// echo "hola";

	$urls = new Urls();
	$urls->url_parsing(new Request);
?>

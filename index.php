<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
    
	require_once 'settings.php';

    require_once CORE_PATH . 'error.php';
    require_once CORE_PATH . 'urls.php';
    require_once CORE_PATH . 'request.php';
    // require_once CORE_PATH . 'models.php';
	

	$urls = new Urls();
	$r = new Request();
	// echo $r->get_url();
	// print_r($r->get_args_GET());
	$urls->url_parsing($r);
?>

<?php
define('DS', DIRECTORY_SEPARATOR);
define('PROJECT_PATH', realpath(dirname(__file__)) . DS);
define('easyPHP_PATH', PROJECT_PATH . 'easyPHP'. DS);
define('CORE_PATH', easyPHP_PATH . 'core' . DS);
define('BASE_URL', 'http://localhost/sell4me/');


define('STATIC_DIR', BASE_URL . 'static' . DS);
define('easyPHP_STATIC_DIR', BASE_URL . 'easyPHP' . DS . 'default_static' . DS);

define('easyPHP_TEMPLATES_DIR', easyPHP_PATH . 'default_templates' . DS);
define('TEMPLATES_DIR', PROJECT_PATH . 'templates' . DS);

define('PROJECT_NAME', "Shopline");

$DATABASE = array(
	'engine' => 'mysql', //mysql, postgres, sqlite
	'user' => 'root',
	'password' => '1q2w3e4r'
	);

?>
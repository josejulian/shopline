<?php
function url_parsing($req){
	$main_urls_path = PROJECT_PATH . 'urls.php'; 
	if(is_readable($main_urls_path)){
		require_once $main_urls_path;
		if( isset($urls_array[$req->get_url()]) ){
			$app_view = $urls_array[$req->get_url()]['app'];
			$view_path = PROJECT_PATH.'apps'.DS.$app_view.DS.'views.php';
			$app_method = $urls_array[$req->get_url()]['method'];
			if(is_readable($view_path)){
				require_once $view_path;
				if(is_callable($app_method)){
					call_user_func($app_method, $req);
				}else{
					echo "el metodo no existe en el fichero views.php";
				}
			}else{
				echo "no existe el archivo views.php";
			}
		}else{
			$e = new Error();
			$e->set_url_error($req->get_url());
			$e->set_error_message('
				It is impossible to parse the url, 
				The URL that is inserted is not within urls.php
				');
			$e->set_file_error_path($main_urls_path);
			$e->set_help('
				Add code like this to urls.php:
				"url_to_parser" => array("app" => "name_of_app_to_use","method" => "name_of_method_will_control_this_url")
				');
			render_easyPHP_template('errors.html', $e);
			
		}
	}
	else{
		$e = new Error();
		$e->set_url_error($req->get_url());
		$e->set_error_message('
			No such file urls.php within the project root directory
			');
		$e->set_file_error_path($main_urls_path);
		$e->set_help('
			Create a file named urls.php within '. PROJECT_PATH . ' directory'
			);
		render_easyPHP_template('errors.html', $e);
	}
}
?>
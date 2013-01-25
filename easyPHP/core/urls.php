<?php
require_once "views.php";
class Urls
{
	private $main_urls_path;

	public function __construct()
	{
		$this->main_urls_path = PROJECT_PATH.'urls.php'; 
	}

	public function url_parsing($req){
		$ret = $this->match_url($this->main_urls_path, $req->get_url()); 
		if($ret){
			$app_view = $ret['app'];
			$view_path = PROJECT_PATH.'apps'.DS.$app_view.DS.'views.php';
			$app_method = $ret['method'];
			if(is_readable($view_path)){
				require_once $view_path;
				if(is_callable($app_method)){
					call_user_func($app_method, $req);
				}else{
					echo "el metodo no existe en el fichero views.php";
				}
			}
			else{

				echo "no existe el archivo views.php";
			}
		}else{
			$e = new Error();
			$e->set_url_error($req->get_url());
			$e->set_error_message('
				It is impossible to parse the url, 
				The URL that is inserted is not within urls.php
				');
			$e->set_file_error_path($this->main_urls_path);
			$e->set_help('
				Add code like this to urls.php:
				"url_to_parser" => array("app" => "name_of_app_to_use","method" => "name_of_method_will_control_this_url")
				');
			render_easyPHP_template('errors.html', $e);	
		}
	}

	public function match_url($file, $url, $url2 = null){
		$a = array();
		$first_url;
		if(is_readable($file)){
			require_once $file;
			if(isset($urls_array)){
				if($url2 == null){
					$exprs = array_keys($urls_array);
					foreach ($exprs as $value) {
						$expr = "/".$value."/";
						// echo $expr;
						if(preg_match($expr, $url)){
							// echo " si es la url";
							$a = $urls_array[$value];
							$first_url = $value;
							// print_r($a);
							break;
						}else{
							// echo " no es la url";
						}
					}	
				}else{
					$exprs = array_keys($urls_array);
					foreach ($exprs as $value) {
						$expr = "/".$url2.$value."/";
						if(preg_match($expr, $url)){
							// echo " si es la url";
							$a = $urls_array[$value];
							// print_r($a);
							break;
						}else{

						}
					}
				}
			}else{
				echo "No existe urls_array :(";
			}
		}else{
			$e = new Error();
			$e->set_url_error($url);
			$e->set_error_message('
				No such file urls.php within the project root directory
				');
			$e->set_file_error_path($file);
			$e->set_help('
				Create a file named urls.php within '. PROJECT_PATH . ' directory'
				);
			render_easyPHP_template('errors.html', $e);
		}
		
		if(isset($a)){
			if(isset($a['include'])){
				$file = $view_path = PROJECT_PATH.'apps'.DS.$a["app"].DS.$a["include"];
				return $this->match_url($file, $url, $first_url);
			}else{
				return $a;
			}
		}
	}
}

?>
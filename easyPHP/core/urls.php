<?php
require_once "views.php";

/*
Urls is the class that manages an url and checks if this is in the "urls.php" files of the apps and make the corresponding actions associated to this url, this class provides methods to manage url, POST, GET, also this class extends from Session class wich allow to manage the sessions in the request of navegator.
*/
class Urls
{
	private $main_urls_path;//Path of urls.php 

	public function __construct()
	{
		$this->main_urls_path = PROJECT_PATH.'urls.php'; 
	}

	/*
	This method takes a request object, parse the URL and see if that url are 
	declared in a file urls.php in all projects and executes the method associated 
	with the URL in question.
	*/  
	public function url_parsing($req){
		//It call the method "match_url" to search the url recursively
		$ret = $this->match_url($this->main_urls_path, $req->get_url()); 
		if($ret){
			$app_view = $ret['app'];
			$view_path = PROJECT_PATH.'apps'.DS.$app_view.DS.'views.php';
			$app_method = $ret['method'];
			//if exist the file views.php within the app
			if(is_readable($view_path)){
				require_once $view_path;
				//if exist the method and is possible call it 
				if(is_callable($app_method)){
					//execute the method and is passed the request object
					call_user_func($app_method, $req);
				}else{
					echo "";
					$e = new Error();
					$e->set_url_error($req->get_url());
					$e->set_error_message("
						The method '".$app_method."' doesn't exist in views.php
						");
					$e->set_file_error_path($this->main_urls_path);
					$e->set_help("
						Create the method '".$app_method."' in ".$view_path
					);
					Views::render_easyPHP_template('errors.html', $e);
					exit;
				}
			}
			else{

				$e = new Error();
				$e->set_url_error($req->get_url());
				$e->set_error_message("
					Doesn't exist the file => views.php
					");
				$e->set_file_error_path($this->main_urls_path);
				$e->set_help("
					Create the views.php file in =>" . PROJECT_PATH."apps".DS.$app_view.DS  
					);
				Views::render_easyPHP_template('errors.html', $e);
				exit;
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
			Views::render_easyPHP_template('errors.html', $e);
			exit;	
		}
	}

	/*
	This method searches a url recursively in some urls.php file in all the project
	*/
	public function match_url($file, $url, $url2 = null){
		$a = array();
		$first_url;
		//if is possible read the file
		if(is_readable($file)){
			require_once $file;
			//if exist the $urls_array in $file
			if(isset($urls_array)){
				//if $url2 is passed as a parameter
				if($url2 == null){
					$exprs = array_keys($urls_array);
					//compare the $url with all the urls within $file
					foreach ($exprs as $value) {
						$expr = "/".$value."/";
						if(preg_match($expr, $url)){
							$a = $urls_array[$value];
							$first_url = $value;
							break;
						}else{
							// echo " It's not the url";
						}
					}	
				}else{
					/*concat the $url2 with all the urls within $file and
					compare with the $url
					*/
					$exprs = array_keys($urls_array);
					foreach ($exprs as $value) {
						$expr = "/".$url2.$value."/";
						if(preg_match($expr, $url)){
							$a = $urls_array[$value];
							// print_r($a);
							break;
						}else{

						}
					}
				}
			}else{
				$e = new Error();
				$e->set_url_error($url);
				$e->set_error_message(
					"Doesn't exist the urls_array in ".$this->main_urls_path
					);
				$e->set_file_error_path($file);
				$e->set_help('
					Add this: $urls_array = array(); to'.$this->main_urls_path 
					);
				Views::render_easyPHP_template('errors.html', $e);
				exit;
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
			Views::render_easyPHP_template('errors.html', $e);
			exit;
		}
		
		/*
			if the $url comprise several urls, and these files are in different file urls.php
		*/
		if(isset($a['include'])){
			$file = $view_path = PROJECT_PATH.'apps'.DS.$a["app"].DS.$a["include"];
			return $this->match_url($file, $url, $first_url);
		}else{
			return $a;
		}
	}
}

?>
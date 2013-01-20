<?php

class Request extends Session 
{
	
	private $url;
	private $args_GET;
	private $args_POST;
	private $session;

	public function __construct()
	{
		parent::__construct();

		if($this->is_from_GET()){
			$parameters = $_GET;			
			if($parameters){
				if($parameters['url']){
					$url = strtolower($parameters['url']);
					unset($parameters['url']);	
				}else{
					$url = '/';
				}
				$this->url = filter_var($url, FILTER_SANITIZE_URL);
				$this->args_GET = $parameters;
			}
			else{
				$this->url = '/';
				$this->args_GET = array();
			}
		}else{
			if($this->is_from_POST()){
				$url = strtolower($_GET['url']);
				$this->url = filter_var($url, FILTER_SANITIZE_URL);
				$parameters = $_POST;
				if($parameters){
					$this->args_POST = $parameters;
				}
				else{
					$this->args_POST = array();
				}
			}else{
				echo "Si esta utilizando archivos espesificos en la url
				en ves de urls amigables debe pasar como minimo un parametro url via get";
			}
		}
	}

	public function get_url()
	{
		return $this->url;
	}

	public function get_args_GET()
	{
		return $this->args_GET;
	}

	public function get_args_POST()
	{
		return $this->args_POST;
	}

	// public function get_args_post()
	// {

	// }

	public function is_from_GET()
	{
		if($_GET){
			return true;
		}else{
			return false;
		}
	}

	public function is_from_POST()
	{
		if($_POST){
			return true;
		}else{
			return false;
		}
	}
}

?>
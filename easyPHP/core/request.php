<?php
require_once CORE_PATH . 'session.php';

/*
Request is the class that manage the request of the navegator, this class provides methods to manage url, POST, GET, also this class extends from Session class wich allow to manage the sessions in the request of navegator.
*/
class Request extends Session 
{
	
	private $url;//url of navegator
	private $args_GET;//POST parameters if they were sent
	private $args_POST;//GET parameters if they were sent
	

	/*
	The __construct method check if the url was sent as a parameter and saves that url in $url, also check if were sent parameters GET or POST and saves the parameters in $args_GET or $args_POST respectively.
	*/
	public function __construct()
	{
		parent::__construct();
		$url = strtolower($_SERVER['REQUEST_URI']);	
		$pos = strpos($url, '?');
		if($pos){
			$url = substr($url, 0, $pos);
		}
		$this->url = filter_var($url, FILTER_SANITIZE_URL);
		$this->args_GET = $_GET;
		$this->args_POST = $_POST;
	}

	#Returns the url that was sent from the navegator
	public function get_url()
	{
		return $this->url;
	}

	#Returns all arguments that were sent by POST method 
	public function get_args_GET()
	{
		return $this->args_GET;
	}

	#Returns all arguments that were sent by POST method 
	public function get_args_POST()
	{
		return $this->args_POST;
	}

	#Returns only one data from $args_POST which its has $value as its index
	public function get_POST($value){
		if(isset($this->args_POST[$value])){
			return $this->args_POST[$value];
		}else{
			return false;
		}
	}

	#Returns only one data from $args_GET which its has $value as its index
	public function get_GET($value){
		if(isset($this->$args_GET[$value])){
			return $this->args_GET[$value];
		}else{
			return false;
		}
	}
	
	#check if the method used for send the parameters was GET
	public function is_from_GET()
	{
		if($_SERVER["REQUEST_METHOD"]=="GET"){
			return true;
		}else{
			return false;
		}
	}

	#check if the method used for send the parameters was POST
	public function is_from_POST()
	{
		if(($_SERVER["REQUEST_METHOD"]=="POST")){
			return true;
		}else{
			return false;
		}
	}
}

?>
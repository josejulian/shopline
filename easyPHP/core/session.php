<?php
class Session
{

	public function __construct(){
		session_start();
	}

	public function get_session(){
		return $_SESSION;
	} 

	public function add_to_session($name, $var){
		$_SESSION[$name]=$var;
	}

	public function get_from_session($name){
		return $_SESSION[$name];
	}

	public function is_in_session($name){ 
		if(isset($_SESSION[$name])){
			return true;
		}else{
			return false;
		}
	}

	public function del_from_session($name){
		if($this->is_in_session($name)){
			unset($_SESSION[$name]);
		}
	} 
}
?>
<?php
class Session
{

	public function __construct(){
		session_start();
	}

	public function get_session(){
		return $_SESSION;
	} 

	public function add_var_to_session($name, $var){
		$_SESSION[$name]=$var;
	}

	public function get_var_from_session($name){
		return $_SESSION[$name];
	}

	public function is_in_session($name){
		echo $name; 
		// if(isset($_SESSION[$name])){
		// 	return true;
		// }else{
		// 	return false;
		// }
	}
}

?>
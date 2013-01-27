<?php
/*
Session is the class that provides methods to manage all sessions.
This class has methods to inspect all sessions, add data to the session, to remove session data, to update session data, etc. 
*/
class Session
{

	#Start the sesion
	public function __construct(){
		session_start();
	}

	#Get all the session
	public function get_session(){
		return $_SESSION;
	} 

	#Add a $var to the session with $name as its index
	public function add_to_session($name, $var){
		$_SESSION[$name]=$var;
	}

	#Get a data from the session with $name as its index
	public function get_from_session($name){
		return $_SESSION[$name];
	}

	#Verify if the index $name is in the session
	public function is_in_session($name){ 
		if(isset($_SESSION[$name])){
			return true;
		}else{
			return false;
		}
	}

	#Delete a data from the session whit $name as its index 
	public function del_from_session($name){
		if($this->is_in_session($name)){
			unset($_SESSION[$name]);
		}
	} 
}
?>
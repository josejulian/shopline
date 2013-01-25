<?php
require_once CORE_PATH . 'views.php';
require_once 'models.php';
function home($req){
	
	// $users = new Users();
	// $users->is_registered_email("pedroj.1822@gmail.com");

	if ($req->is_in_session("logged")) {
		render_template("home2.html");
	}else{
		render_template("home.html");
	}
}

function login($req){
	render_template("login.html");
}
function register($req){
    render_template("register.html");
}
function about_us($req){
    render_template("about_us.html");
}

function admin_panel($req){
	render_template("home2.html");
}

function notifications($req){
	render_template("html_pieces/notifications.html");
}

function new_login_user($req){
	$email = $req->get_POST("email");
	$password = $req->get_POST("password");
	if($email and $password){
		$user = new Users();
		if($user->is_registered_user($email, $password)){
			$req->add_to_session("logged", true);
			echo 'true';
		}else{
			echo 'false';
		}
	}
}

function close_session($req){
	$req->del_from_session("logged");
	redirect_to_url("/");
}

function test($req){
	$email = $req->get_POST("email");
	$users = new Users();
	if($users->is_registered_email($email)){
		// return json_encode(array("name"=>"pedro"));
		echo "true";
	}else{
		echo "false";
	}
}

?>
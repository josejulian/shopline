<?php
require_once CORE_PATH . 'views.php';
require_once 'models.php';
function home($req){
	
	// $users = new Users();
	// $users->is_registered_email("pedroj.1822@gmail.com");

	if ($req->is_in_session("logged")) {
		echo "ya esta una sesion iniciada";
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
			echo 'true';
		}else{
			echo 'false';
		}
	}
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
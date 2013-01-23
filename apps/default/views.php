<?php
function home($req){
	// if ($req->is_in_session("logged")) {
	// 	$req->del_from_session("logged");
	// 	echo "ya esta una sesion iniciada";
	// }else{
	// 	echo "No hay sesion iniciada";
	// 	$req->add_to_session("logged", true);
		render_template("home.html");
	// }
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

?>
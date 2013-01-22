<?php
function home($req){
	$a = array(
		'id' => 12345,
		'b' => array(
			'id2' => 12345
			)
		);
	render_template("home.html", $a);
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
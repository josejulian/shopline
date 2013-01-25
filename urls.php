<?php
$urls_array = array(
    "^\/$" => array(
        "app" => "default",
        "method" => "home"
        ),
    "^login$" => array(
        "app" => "default",
        "method" => "login"
        ),
    "^register$" => array(
        "app" => "default",
        "method" => "register"
        ),
    "^about_us$" => array(
        "app" => "default",
        "method" => "about_us"
        ),
    "^user" => array(
        "app" => "default",
        "include" => "urls.php"
        ),
    "^test$" => array(
        "app" => "default",
        "method" => "test"
        ),
    "^new_login$" => array(
        "app" => "default",
        "method" => "new_login_user"
        ),
    "^close_session$" => array(
        "app" => "default",
        "method" => "close_session"
        )
    );
?>
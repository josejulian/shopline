<?php 
class MySql{
    public function __construct(){

    }

    public static function connect($host, $user, $password, $db){
        $connection = new mysqli($host, $user, $password, $db);
        if ($mysqli->connect_errno) {
            echo "Fallo al contenctar a MySQL: " . $connection->connect_error;
        }else{
            return $connection;
        }
    }

    public static function disconect(){
        mysql_close();
    }    
}


?>
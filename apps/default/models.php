<?php 
require_once CORE_PATH . "models.php";
class Users extends Models{
    public function __construct(){
        parent::__construct();
    }

    public function is_registered_email($email){
        $connection = $this->connect();
        $consult = ("SELECT * FROM Users WHERE Users_email = '". $email ."'");
        $result = $connection->query($consult);
        if($rows = $result->fetch_assoc()){
            return true; 
        }else{
            return false;
        }
    }

    public function is_registered_user($email, $password){
        $password = $this->encrypt($password);
        $connection = $this->connect();
        $consult = ("SELECT * FROM Users WHERE Users_email = '". $email ."' AND Users_password = '".$password."'");
        $result = $connection->query($consult);
        // print_r($result);
        if($rows = $result->fetch_assoc()){
            return true; 
        }else{
            return false;
        }
    }

    public function save($email, $password){
        $pass = $this->encrypt($password);
        $connection = $this->connect();
        $consult = ("INSERT INTO Users (Users_email, Users_password) VALUES ('".$email."','".$pass."')");
        if(!$connection->query($consult)){
            echo "Falló la creación de la tabla: (" . $connection->errno . ") " . $connection->error;
        }
    }

    private function encrypt($password){
        $salt = "noloromperas:)";
        $hash = sha1($password.$salt);
        for($i=1;$i<=5;$i++){
            $hash2 = sha1($hash.$salt);
        }
        return $hash;
    }
}
?>
<?php 
require_once CORE_PATH . "models.php";
class Users extends Models{
    public function __construct(){
        parent::__construct();
    }

    public function is_registered_email($email){
        $connection = $this->connect();
        $consult = ("SELECT * FROM Users WHERE Users_email = '". $email ."'");
        // echo $consult;
        $result = $connection->query($consult);
        // print_r($result);
        if($rows = $result->fetch_assoc()){
            // echo json_encode($rows);
            return true; 
        }else{
            return false;
        }
    }

    public function is_registered_user($email, $password){
        $connection = $this->connect();
        $consult = ("SELECT * FROM Users WHERE Users_email = '". $email ."' AND Users_password = '".$password."'");
        // echo $consult;
        $result = $connection->query($consult);
        // print_r($result);
        if($rows = $result->fetch_assoc()){
            return true; 
        }else{
            return false;
        }
    }
}
?>
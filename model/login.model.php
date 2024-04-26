<?php

class LoginUser{

    //  --------------------------------class properties --------------------------------

    private $username;
    private $password;
    public $error;
    public $success;
    private $storage = "/var/www/html/projet/data.json";
    private $stored_users;

    //  --------------------------------class constructor --------------------------------

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $this->login();
    } 

    //  --------------------------------class methods --------------------------------

    public function login(){
        foreach($this->stored_users as $user){
            if($user['username'] == $this->username) {
                if(password_verify($this->password, $user['password'])){
                    session_start();
                    $_SESSION['username'] = $this->username;
                    header("Location: http://www.idrissawade.com:8080/promo?id=6");
                    exit;
                }
                
            }
        }
        return $this->error = "Email ou mot de passe incorrect";

    }


}
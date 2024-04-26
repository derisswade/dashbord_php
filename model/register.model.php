<?php

class RegisterUser{

    // class properties

    private $username;

    private $raw_password;

    private $hashed_password;

    public $error;

    public $success;

    private $storage =  "/var/www/html/projet/data.json";

    private $stored_users;

    private $new_user; // array


    public function __construct( $username, $password){
        $this->username = trim($this->username);
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);

        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->hashed_password = password_hash($this->raw_password, PASSWORD_DEFAULT);

        $this->stored_users = json_decode(file_get_contents($this->storage),true);

        $this->new_user = [
            "username" => $this->username,
            "password" => $this->hashed_password
        ];

        if ($this->checkFieldValues()){
            $this->insertUser();
        }
    }


    private function checkFieldValues(){
        if(empty($this->username) || empty($this->raw_password)){
            $this->error = "Veuillez remplir tous les champs";
            return false;
        }
        return true;
    }

    private function usernameExists(){
        foreach($this->stored_users as $user){
            if($user['username'] == $this->username){
                $this->error = "Ce nom d'utilisateur existe déjà";
                return true;
            }
    
    }
    return false;
    }

    private function insertUser(){
        if($this->usernameExists()==false){
            array_push($this->stored_users, $this->new_user);
            file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT));
            return $this->success = "Votre compte a été créé avec succès";
        }else{
            return $this->error = "Erreur d'enregistrement. Veuillez ressayer encore svp !!!";
        }
            
    
    }


}
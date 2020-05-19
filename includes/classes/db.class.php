<?php

include 'dbhelper.class.php';

class DB extends dbhelper{
    private $connected = false;
    private $results;

    // manage connection

    function __construct(){
        $this->link = @new mysqli(SERVER, USER, PASSWORD, DATABASE);
        if($this->link->connect_errno === 0){
            $this->connected = true;
            $this->prepare();
        }
    }

    function __destruct(){
        $this->link->close();
    }

    public function isConnected(){
        return $this->connected;
    }

    private function obj($SQL){
        return $SQL->get_result()->fetch_object();
    }

    private function userExists($username){
        $this->username = $username;
        $this->userExistsSQL->execute();
        $this->results = $this->obj($this->userExistsSQL);
        return $this->results->notValid == 1;
    }

    private function verifyPassword($password){
        
    }

    public function register($username, $email, $password, $gender, $firstname,
                            $lastname, $city, $postalCode,
                            $streetANDhouseNr, $profilePicType, $profilePic){ 

        if(!$this->connected) return;
        if($this->userExists($username)) return false;

        $this->$username = mysqli_real_escape_string($this->link, $username);
        $this->email = mysqli_real_escape_string($this->link, $email);
        $this->gender = mysqli_real_escape_string($this->link, $gender);
        $this->firstname = mysqli_real_escape_string($this->link, $firstname);
        $this->lastname = mysqli_real_escape_string($this->link, $lastname);
        $this->city = mysqli_real_escape_string($this->link, $city);
        $this->postalCode = mysqli_real_escape_string($this->link, $postalCode);
        $this->streetANDhouseNr = mysqli_real_escape_string($this->link, $streetANDhouseNr);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->profilePicType = $profilePicType;
        $this->profilePic = $profilePic;
        $this->isAdmin = false;
        
        $this->registerSQL->execute();
        return $this->registerSQL->errno == 0; // if errno is 0, return true
    }
    
    public function verify($username, $password){
        $username = mysqli_real_escape_string($this->link, $username);
        
        if(!$this->connected) return;
        if(!$this->userExists($username)) return false;
        
        $this->username = $username;
        $this->password = $password;
        $this->loginSQL->execute();
        $this->results = $this->obj($this->loginSQL);
        if(password_verify($password, $this->results->password)) return true;
            
        return false;
    }

     public function getUserInfo($username){
        if(!$this->connected) return;
        $this->username = $username;
        $this->getUserInfoSQL->execute();
        return ($this->obj($this->getUserInfoSQL));
    }

    public function updateProfile($email, $city, $postalCode, $streetANDhouseNr, $username)
    {
        if(!$this->connected) return;
        
        $this->email = mysqli_real_escape_string($this->link, $email);
        $this->username = mysqli_real_escape_string($this->link, $username);
        $this->postalCode = mysqli_real_escape_string($this->link, $postalCode);
        $this->streetANDhouseNr = mysqli_real_escape_string($this->link, $streetANDhouseNr);
        $this->city = mysqli_real_escape_string($this->link, $city);

        $this->updateProfileSQL->execute();
        return $this->registerSQL->errno == 0;
    }

    public function updatePassword($password, $username)
    {
        if(!$this->connected) return;
        $this->$username = mysqli_real_escape_string($this->link, $username);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        
        $this->updatePasswordSQL->execute();
        return $this->updatePasswordSQL->errno == 0;
    }

    public function updateProfilePic($imgType, $img, $username)
    {
        if(!$this->connected) return;
        $this->profilePic = mysqli_real_escape_string($this->link, $img);
        $this->profilePicType = mysqli_real_escape_string($this->link, $imgType);
        $this->$username = mysqli_real_escape_string($this->link, $username);

        $this->updateProfilePicSQL->execute();
        return $this->updateProfilePicSQL->errno == 0;

    } 
}

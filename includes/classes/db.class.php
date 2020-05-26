<?php

include 'base-classes/dbhelper.class.php';

class DB extends DBhelper{
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

    public function addPicture($path, $description ,$userID)
    {
        if(!$this->connected) return;
        $this->path = mysqli_real_escape_string($this->link, $path);
        $this->userID = mysqli_real_escape_string($this->link, $userID);
        $this->description = mysqli_real_escape_string($this->link, $description);

        $this->addPictureSQL->execute();
        return $this->addPictureSQL->errno == 0;
    }

    public function getPictures($userID = -1)
    {
        if(!$this->connected) return;

        $results = [];
        if($userID === -1){
            $this->getPicturesSQL->execute();
            $rows = $this->getPicturesSQL->get_result(); // store results in rows
        } else {
            $this->userID = $userID;
            $this->getUserPicturesSQL->execute();
            $rows = $this->getUserPicturesSQL->get_result();
        }

        while($row = $rows->fetch_object()){ 
            $tmp = ["description" => $row->description, 
            "path" => $row->path, "id" => $row->id, "tags" => $this->getTags($row->id)];
            array_push($results, $tmp);
        }
        return $results;
    }


    public function getPicId($path)
    {
        if(!$this->connected) return;

        $id = $this->link->query("SELECT id FROM pictures WHERE path = '$path'");
        $id = $id->fetch_object();
        return $id === null ? false : $id->id;

    }

    public function addTag($id, $tag)
    {
        if(!$this->connected) return;
        
        $this->picID = mysqli_real_escape_string($this->link, $id);
        $this->tag = mysqli_real_escape_string($this->link, $tag);

        $this->addTagSQL->execute();
        return $this->addTagSQL->errno == 0;
    }

    public function getTags($picID)
    {
        if(!$this->connected) return;

        $this->picID = mysqli_real_escape_string($this->link, $picID);
        $this->getTagsSQL->execute();
        $rows = $this->getTagsSQL->get_result();
        $results = [];
        while($row = $rows->fetch_object()){
            array_push($results, $row->tag);
        }
        return $results;
    }

    public function getUsers()
    {
        if(!$this->connected) return;

        $this->getUsersSQL->execute();
        $rows = $this->getUsersSQL->get_result();
        $results = [];
        while($row = $rows->fetch_object()){
            array_push($results, $row);
        }
        return $results;
    }

    public function getUserCart($userID)
    {
        if(!$this->connected) return;

        $this->userID = mysqli_real_escape_string($this->link, $userID);
        $this->getUserCartSQL->execute();
        $rows = $this->getUserCartSQL->get_result();
        $results = [];
        while($row = $rows->fetch_object()){
            $tmp = ["price" => $row->price, "path" => $row->path];
            array_push($results, $tmp);
        }
        return $results;
    }

    public function removePicture($path)
    {
        if(!$this->connected) return;

        $this->path = mysqli_real_escape_string($this->link, $path);
        $this->removePictureSQL->execute();
        return $this->removePictureSQL->errno == 0;
    }

    public function removeUser($username)
    {
        if(!$this->connected) return;

        $this->username = mysqli_real_escape_string($this->link, $username);
        $this->removeUserSQL->execute();
        return $this->removeUserSQL->errno == 0;
    }

    public function addToCart($userID, $picID, $price)
    {
        if(!$this->connected) return;

        $this->userID = mysqli_real_escape_string($this->link, $userID);
        $this->picID = mysqli_real_escape_string($this->link, $picID);
        $this->price = mysqli_real_escape_string($this->link, $price);
        $this->addToCartSQL->execute();
        return $this->addToCartSQL->errno == 0;
    }

    public function removeProduct($picID, $userID)
    {
        if(!$this->connected) return;

        $this->userID = mysqli_real_escape_string($this->link, $userID);
        $this->picID = mysqli_real_escape_string($this->link, $picID);

        $this->removeProductSQL->execute();
        return $this->removeProductSQL->errno == 0;
    }

}

<?php

class dbhelper {

    protected $link;

    // attributes to bind on the prepared statements
    protected $username;
    protected $password;
    protected $password2;
    protected $email;
    protected $gender;
    protected $firstname;
    protected $lastname;
    protected $city;
    protected $postalCode;
    protected $streetANDhouseNr;
    protected $isAdmin;
    protected $profilePicType;
    protected $profilePic;

    protected $loginSQL = "SELECT username, password FROM user WHERE username = ?";
    protected $userExistsSQL = "SELECT COUNT(*) AS notValid FROM user where username = ?";
    protected $registerSQL = "INSERT INTO user (username, email, password, gender, firstname, lastname, city,
        postal_code, street_housenr, is_admin, profile_pic_type ,profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    protected $getUserInfoSQL = "SELECT * FROM user WHERE username = ?";
    protected $updateProfileSQL = "UPDATE user SET email = ?, city = ?, postal_code = ?, street_housenr = ? 
        WHERE username = ?";
    protected $updatePasswordSQL = "UPDATE user SET password = ? WHERE username = ?";
    protected $updateProfilePicSQL = "UPDATE user SET profile_pic = ?, profile_pic_type = ? WHERE username = ?";

    protected function prepare(){
        $this->loginSQL = $this->link->prepare($this->loginSQL);
        $this->loginSQL->bind_param("s", $this->username);
        
        $this->userExistsSQL = $this->link->prepare($this->userExistsSQL);
        $this->userExistsSQL->bind_param("s", $this->username);

        $this->registerSQL = $this->link->prepare($this->registerSQL);
        $this->registerSQL->bind_param("sssssssisiss", $this->username, $this->email, $this->password,
        $this->gender, $this->firstname, $this->lastname, $this->city, $this->postalCode,
        $this->streetANDhouseNr,$this->isAdmin, $this->profilePicType,$this->profilePic);
        
        $this->getUserInfoSQL = $this->link->prepare($this->getUserInfoSQL);
        $this->getUserInfoSQL->bind_param("s", $this->username);

        $this->updateProfileSQL = $this->link->prepare($this->updateProfileSQL);
        $this->updateProfileSQL->bind_param("ssiss", $this->email, $this->city, $this->postalCode, 
        $this->streetANDhouseNr, $this->username);

        $this->updatePasswordSQL = $this->link->prepare($this->updatePasswordSQL);
        $this->updatePasswordSQL->bind_param("ss", $this->password, $this->username);

        $this->updateProfilePicSQL = $this->link->prepare($this->updateProfilePicSQL);
        $this->updateProfilePicSQL->bind_param("sss", $this->profilePic, $this->profilePicType, $this->username);

    }
}

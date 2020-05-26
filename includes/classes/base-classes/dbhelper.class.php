<?php

class DBhelper {

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
    protected $path;
    protected $userID;
    protected $picID;
    protected $tag;
    protected $description;
    protected $price;

    protected $loginSQL = "SELECT username, password FROM user WHERE username = ?";
    protected $userExistsSQL = "SELECT COUNT(*) AS notValid FROM user where username = ?";
    protected $registerSQL = "INSERT INTO user (username, email, password, gender, firstname, lastname, city,
        postal_code, street_housenr, is_admin, profile_pic_type ,profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    protected $getUserInfoSQL = "SELECT * FROM user WHERE username = ?";
    protected $updateProfileSQL = "UPDATE user SET email = ?, city = ?, postal_code = ?, street_housenr = ? 
        WHERE username = ?";
    protected $updatePasswordSQL = "UPDATE user SET password = ? WHERE username = ?";
    protected $updateProfilePicSQL = "UPDATE user SET profile_pic = ?, profile_pic_type = ? WHERE username = ?";
    protected $addPictureSQL = "INSERT INTO pictures (path, user_id, description) VALUES(?,?,?)";
    protected $getPicturesSQL = "SELECT path, id, description FROM pictures";
    protected $getUserPicturesSQL = "SELECT path, id, description FROM pictures where user_id = ?";
    protected $addTagSQL = "INSERT INTO tags (pic_id, tag) VALUES(?,?)";
    protected $getTagsSQL = "SELECT tag FROM tags where pic_id = ?";
    protected $getUsersSQL = "SELECT * FROM user";
    protected $removePictureSQL = "DELETE FROM pictures WHERE path = ?";
    protected $removeUserSQL = "DELETE FROM user WHERE username = ?";
    protected $addToCartSQL = "INSERT INTO cart (user_id, pic_id, price) VALUES (?,?,?)";
    protected $getUserCartSQL = "SELECT pictures.path, cart.price from pictures join cart
    on pictures.id = cart.pic_id WHERE cart.user_id = ?";
    protected $removeProductSQL = "DELETE FROM cart WHERE pic_id = ? AND user_id = ? LIMIT 1";

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

        $this->addPictureSQL = $this->link->prepare($this->addPictureSQL);
        $this->addPictureSQL->bind_param("sis", $this->path, $this->userID, $this->description);

        $this->getPicturesSQL = $this->link->prepare($this->getPicturesSQL);

        $this->getUserPicturesSQL = $this->link->prepare($this->getUserPicturesSQL);
        $this->getUserPicturesSQL->bind_param("i", $this->userID);

        $this->addTagSQL = $this->link->prepare($this->addTagSQL);
        $this->addTagSQL->bind_param("is", $this->picID, $this->tag);

        $this->getTagsSQL = $this->link->prepare($this->getTagsSQL);
        $this->getTagsSQL->bind_param("i", $this->picID);

        $this->getUsersSQL = $this->link->prepare($this->getUsersSQL);

        $this->removePictureSQL = $this->link->prepare($this->removePictureSQL);
        $this->removePictureSQL->bind_param("s", $this->path);

        $this->removeUserSQL = $this->link->prepare($this->removeUserSQL);
        $this->removeUserSQL->bind_param("s", $this->username);

        $this->addToCartSQL = $this->link->prepare($this->addToCartSQL);
        $this->addToCartSQL->bind_param("iid", $this->userID, $this->picID, $this->price);

        $this->getUserCartSQL = $this->link->prepare($this->getUserCartSQL);
        $this->getUserCartSQL->bind_param("i", $this->userID);

        $this->removeProductSQL = $this->link->prepare($this->removeProductSQL);
        $this->removeProductSQL->bind_param("ii", $this->picID, $this->userID);
    }
}

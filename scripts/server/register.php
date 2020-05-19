<?php

if(isset($_POST["register"]))
{
    if(count($_POST) > 0)
    {
        $img = null;
        $imgType = null;
        if(count($_FILES) > 0)
        {
            if($pic = $dealer->addProfilePic($_FILES["profile-picture"]))
            {
                $imgType = $pic["type"];
                $img = $pic["path"];       
            }
        }

        if($db->register($_POST["username"], $_POST["email"], $_POST["password"], $_POST["gender"], 
        $_POST["first-name"], $_POST["last-name"], $_POST["city"], $_POST["postal-code"],
        $_POST["street"], $imgType, $img)){
            $db->verify($_POST["username"], $_POST["password"]);
            $_SESSION["loggedIn"] = true;
            $_SESSION["user"] = $db->getUserInfo($_POST["username"]);      
        }
        reload();  
    }
}
    

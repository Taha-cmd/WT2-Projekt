<?php


if(isset($_POST["login"]))
{
    
    if($db->verify($_POST["username"], $_POST["password"])){
        $_SESSION["loggedIn"] = true;
        $_SESSION["user"] = $db->getUserInfo($_POST["username"]);
    }
    reload();
}

if(isset($_POST["logout"]))
{
    $_SESSION["loggedIn"] = false;
    unset($_SESSION["user"]);
    reload();
}

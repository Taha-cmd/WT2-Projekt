<?php


if(isset($_POST["delete_user"]))
{
    $username = $_POST["delete_user"];
    $user = $db->getUserInfo($username);
    $pics = $db->getPictures($user->id);
    foreach($pics as $pic)
    {
        $dealer->remove($pic["path"]);
    }
    if($user->profile_pic != ANONYMOUS)
    {
        $dealer->remove($user->profile_pic);
    }

    $db->removeUser($username);
    
    exit(0);
}

if(isset($_POST["delete_picture"]))
{
    $path = $_POST["delete_picture"];
    $path = str_replace(THUMBNAILS_FOLDER.'thumb.', ORIGINAL_PICTURES_FOLDER , $path);
    $dealer->remove($path);
    $db->removePicture($path);
    exit(0);
}

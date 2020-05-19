<?php
if(isset($_POST["verify"]))
{
    $response["response"] = $db->verify($_SESSION["user"]->username, $_POST["verify"]);
    echo json_encode($response);
    unset($_POST["verify"]);    
    exit(0); // need to exit, since an ajax request is excepting a response
            // else whole page will be sent back. all requests are sent to index.php
            // => only one database object
}

if(isset($_POST["edit"]))
{
    $x = $_POST;
    $x1 = $_SESSION["user"];
    if($x["email"] === $x1->email &&
       $x["city"] === $x1->city && 
       $x["postal-code"] === $x1->postal_code && 
       $x["street-housenr"] === $x1->street_housenr &&
        count($_FILES) < 1){
           reload();
       } 
    
    $db->updateProfile($x["email"], $x["city"], $x["postal-code"], $x["street-housenr"], $x["username"]);
    if($x["password"] !== ''){
        $db->updatePassword($x["password"], $x["username"]);
    }
    
    if(count($_FILES) > 0)
    {
        if($pic = $dealer->addProfilePic($_FILES["profile-picture"]))
        {
            if($x1->profile_pic != ANONYMOUS){
                $dealer->remove($x1->profile_pic);
            }
            $imgType = $pic["type"];
            $img = $pic["path"];
            $db->updateProfilePic($imgType, $img, $x1->username);
        }
    }

    $_SESSION["user"] = $db->getUserInfo($x["username"]);
    reload();
}

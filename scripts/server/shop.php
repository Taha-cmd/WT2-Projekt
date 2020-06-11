<?php

function updateCart($db)
{
    $cart = $db->getUserCart($_SESSION["user"]->id);
    $response["count"] = count($cart);
    if($response["count"] > 0){
        $response["price"] = count($cart) * $cart[0]["price"];
    } else {
        $response["price"] = 0;
    }

    return json_encode($response);
}


if(isset($_POST["buy"]))
{
    $obj = json_decode($_POST["buy"]);
    $path = str_replace(THUMBNAILS_FOLDER.'thumb.', ORIGINAL_PICTURES_FOLDER, $obj->image);
    $imgID = $db->getPicId($path);
    if($db->addToCart($_SESSION["user"]->id, $imgID, floatval($obj->price)))
    {
        echo updateCart($db);
    }
    
    exit(0);
}


if(isset($_POST["remove_product"]))
{

    $path = str_replace(THUMBNAILS_FOLDER.'thumb.', ORIGINAL_PICTURES_FOLDER, $_POST["remove_product"]);
    if($db->removeProduct($db->getPicId($path), $_SESSION["user"]->id))
    {
        echo updateCart($db);
    }

    exit(0);
}


if(isset($_POST["buy_all"]))
{
    echo ($db->buyProducts($_SESSION["user"]->id));
    exit(0);
}

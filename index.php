<?php
include 'includes/config.php';

if($_SERVER["REQUEST_SCHEME"] === 'http'){
    header("location: ".HOMEURL."");
}

session_start();

include 'includes/classes/db.class.php';
include 'includes/classes/filehandle.class.php';
$dealer = new Filehandle();
$db = new DB();

$_SESSION["pictures"] = $db->getPictures();

include 'scripts/server/register.php';
include 'scripts/server/login.php';
include 'scripts/server/edit.php';
include 'scripts/server/upload.php';
include 'scripts/server/filter.php';
include 'scripts/server/delete.php';
include 'scripts/server/shop.php';

if(isset($_SESSION["user"])){
    if($_SESSION["user"]->profile_pic == null){
        $_SESSION["user"]->profile_pic = ANONYMOUS;
    }
    $_SESSION["user"]->pics = $db->getPictures($_SESSION["user"]->id);
}

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
    if($_SESSION["user"]->is_admin == 1){
        $_SESSION["user"]->users = $db->getUsers();
    } else {
        $_SESSION["user"]->cart = $db->getUserCart($_SESSION["user"]->id);
    }
}




/*pictures[
    id =>
    path =>
    tags => [
        tag,
        tag,
        .....  
    ],
    ...
] */

//var_dump($_SESSION["pictures"]);
//var_dump($_SESSION["user"]->pics);
//var_dump($_SESSION["user"]->users[0]->username);
//var_dump($_SESSION["user"]);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="icon" href="pics/logo.png">
    </link>
    <link rel="stylesheet" href="css/lightbox.min.css">
    <title>wtf</title>
</head>

<body class="d-flex flex-column">
    <?php
        include 'includes/pages/header.php';
    ?>


    <main id="main" class="p-2 p-md-3 p-lg-4 p-xl-5 my-5 mx-2 mx-md-3 mx-lg-4 mx-xl-5">
        <?php 
            if(isset($_GET["page"]))
            {
                switch($_GET["page"])
                {
                    case 'register': include 'includes/pages/register.php';
                        break;
                    
                    case 'profile': include 'includes/pages/profile.php';
                        break;

                    case 'impressum': include 'includes/pages/impressum.html';
                        break;

                    case 'gallery': include 'includes/pages/gallery.php';
                        break;

                    case 'help': include 'includes/pages/help.html';
                        break;

                    case 'admin': include 'includes/pages/admin.php';
                        break;

                    case 'cart': include 'includes/pages/cart.php';
                        break;
                }
            }
            else
            {
                if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
                    include 'includes/pages/home.php';
                } else {
                    include 'includes/pages/help.html';
                }
            }
        ?>
    </main>


    <?php
        include 'includes/pages/footer.php';
        include 'includes/pages/login.html';
    ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="layout/js/layout.js"></script>
    <script src="scripts/client/user.js"></script>
    <script src="scripts/client/upload.js"></script>
    <script src="scripts/client/filter.js"></script>
    <script src="scripts/lightbox/lightbox.min.js"></script>
    <script src="scripts/client/shop.js"></script>
    <script src="scripts/client/download.js"></script>

    <script>
    lightbox.option({
        disableScrolling: true,
    });
    </script>
</body>

</html>

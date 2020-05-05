<?php
if($_SERVER["REQUEST_SCHEME"] === 'http'){
    $location = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    header("location: $location");
}
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="layout/css/login.css">
    <link rel="stylesheet" href="layout/css/footer.css">
    <link rel="stylesheet" href="layout/css/header.css">
    <link rel="stylesheet" href="layout/css/main.css">
    <link rel="icon" href="pics/logo.png"></link>
    <title>wtf</title>
</head>

<body class="d-flex flex-column">
    <?php
        include 'includes/pages/header.html';
    ?>

    
    <main id="main" class="p-2 p-md-3 p-lg-4 p-xl-5 my-5 mx-2 mx-md-3 mx-lg-4 mx-xl-5">
        <?php 
            if(isset($_GET["page"]))
            {
                switch($_GET["page"])
                {
                    case 'register': include 'includes/pages/register.html';
                        break;
                }
            }
        ?>
    </main>


    <?php
        include 'includes/pages/footer.html';
        include 'includes/pages/login.html';
    ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="layout/js/layout.js"></script>
    <script src="scripts/client/user.js"></script>

</body>

</html>

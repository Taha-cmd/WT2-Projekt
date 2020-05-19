<?php

define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', 'Taha');
define('DATABASE', 'bilddb');

define('PROFILEPICSFOLDER', 'profile-pictures/');
define('ORIGINALPICSFOLDER', 'uploads/original/');
define('THUMBNAILSFOLDER', 'uploads/thumbnails/');
define('WATERMARKFOLDER', 'uploads/watermark');

define('HOMEURL', 'https://localhost/wt2/Projekt/index.php');
define('ANONYMOUS', 'profile-pictures/anonymous.png');

function reload(){
    unset($_POST);
    header("location: ".HOMEURL."");
}

function redirectHome()
{ // redirect with java script, if header cannot be modified 
    echo 
    '<script>
        window.location.href = "'.HOMEURL.'";
    </script>';
}

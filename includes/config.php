<?php

define('SERVER', 'localhost');
define('USER', 'root');
define('PASSWORD', 'Taha');
define('DATABASE', 'bilddb');

define('PROFILE_PICTURES_FOLDER', 'profile-pictures/');
define('ORIGINAL_PICTURES_FOLDER', 'uploads/original/');
define('THUMBNAILS_FOLDER', 'uploads/thumbnails/');
define('WATERMARKS_FOLDER', 'uploads/watermark/');
define('WATERMARK', 'pics/watermark.png');

$homeUri = "https://localhost{$_SERVER['REQUEST_URI']}";

//define('HOMEURL', 'https://localhost/wt2/Projekt/index.php');
define('HOMEURL', $homeUri);
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

?>

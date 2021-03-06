<?php

define('SERVER', 'localhost');
define('USER', 'ImageDBUser');
define('PASSWORD', '123User!');
define('DATABASE', 'bilddb');

define('PROFILE_PICTURES_FOLDER', 'profile-pictures/');
define('ORIGINAL_PICTURES_FOLDER', 'uploads/original/');
define('THUMBNAILS_FOLDER', 'uploads/thumbnails/');
define('WATERMARKS_FOLDER', 'uploads/watermark/');
define('WATERMARK', 'pics/watermark.png');

$homeUri = "https://localhost{$_SERVER['PHP_SELF']}";

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

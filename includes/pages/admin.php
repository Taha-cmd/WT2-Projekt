<?php

if(!isset($_SESSION["user"]) || $_SESSION["user"]->is_admin != 1){
    redirecthome();
}

$users = $_SESSION["user"]->users;
?>

<div id="admin">
    <h1 class="text-center mb-5">Admin Tools <i class="fas fa-cogs"></i></h1>

    <div id="users" class="col-12">
        <h4 class="mb-5 ml-5 text-center">Users <i class="fas fa-users"></i></h4>
        <hr>

        <?php
        
        foreach($users as $user)
        {
            if($user->is_admin) continue;
            $profile_pic = $user->profile_pic != null ? $user->profile_pic : ANONYMOUS;
            $pics = $db->getPictures($user->id);
            echo
            '<div class="user my-5 d-flex flex-column justify-content-center align-items-center flex-md-row col-12">
                <div class="user-img mr-5">
                    <img class="rounded-circle" src="'.$profile_pic.'">
                </div>
                <div class="py-1 d-flex flex-wrap flex-row mr-5 mr-md-0">
                    <div class="d-flex flex-column mr-5">
                        <p>username: '.$user->username.' </p>
                        <p>email: '.$user->email.' </p>
                        <p>name: '.$user->firstname.' '.$user->lastname.' </p>
                    </div>
                    <div class="d-flex flex-column">
                        <p>uploaded images: '.count($pics).'</p>
                        <p>bla bla:  </p>
                        <p>whatever: </p>
                    </div>
                </div>
                <button class="ml-md-5 btn btn-danger user-delete">remove user <i class="fas fa-user-slash"></i></button>
                </div>';

            echo
            '<h5 class="text-center">Pictures <i class="fas fa-images"></i></h5>
            <div class="container pics-container p-5 d-flex flex-row flex-wrap">';
             
            foreach($pics as $pic)
            {
                echo
                '<div class="img-container mb-5 d-flex flex-column col-12 col-sm-6 col-md-4">
                    <div class="my-2">
                        <a><img src="'.$pic["path"].'" alt=""></a>
                    </div>
                    <div>
                        <button class="btn btn-danger picture-delete"><i class="far fa-times-circle"></i></button>
                    </div>
                </div>';
            }
            
            echo
            '</div><hr>'; 
        } 

        ?>

    </div>

    <div>

        <?php


            ?>
    </div>


</div>

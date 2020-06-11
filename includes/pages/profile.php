<?php
    if(isset($_SESSION["loggedIn"])){
        if(!$_SESSION["loggedIn"]){ 
            redirectHome();
        }
    }

    if(!isset($_SESSION["loggedIn"])){
        redirectHome();
    } 
?>


<div class="d-flex mt-5">

    <div class="col-12">
        <h1 class="text-center mb-5 mr-5"> <?php echo $_SESSION["user"]->username?>
        </h1>

        <form enctype="multipart/form-data" class="d-flex flex-row flex-wrap justify-content-center" name="edit-form"
            id="edit-form" method="POST" action="index.php">
            <input name="edit" type="text" value="edit" class="hidden"></input>
            <!--   <div class="form-group row">
                <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="firstname">Firstname</label>
                <input type="text" name="firstname" class="form-control offset-1 col-6"
                    value="<?php echo $_SESSION["user"]->firstname?>" disabled>
            </div>

            <div class="form-group row">
                <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="lastname">Lastname</label>
                <input type="text" name="lastname" class="form-control offset-1 col-6"
                    value="<?php echo $_SESSION["user"]->lastname?>" disabled>
            </div> -->

            <!-- <div class="form-group row">
                <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="username">Username</label>
                <input type="text" name="username" class="form-control offset-1 col-6"
                    value="<?php echo $_SESSION["user"]->username?>" disabled>
            </div> -->



            <input type="text" name="username" class="hidden" value="<?php echo $_SESSION["user"]->username?>">

            <div id="profile-pic" class="col-12 col-md-4">
                <img class="rounded-circle" src="<?php echo $_SESSION["user"]->profile_pic;?>">
                <input name="profile-picture" class="profile-picture-input" type="file" disabled>
                <?php echo '<p class="text-center pt-2">'.$_SESSION["user"]->firstname." ".$_SESSION["user"]->lastname.'</p>'; ?>
            </div>

            <div class="col-12 col-md-7 offset-lg-1">
                <div class="form-group row">
                    <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="email">Email</label>
                    <input type="text" name="email" class="form-control offset-1 col-6"
                        value="<?php echo $_SESSION["user"]->email?>" disabled>
                </div>

                <div class="form-group row">
                    <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="city">City</label>
                    <input type="text" name="city" class="form-control offset-1 col-6"
                        value="<?php echo $_SESSION["user"]->city?>" disabled>
                </div>

                <div class="form-group row">
                    <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="postal-code">Postal code</label>
                    <input type="text" name="postal-code" class="form-control offset-1 col-6"
                        value="<?php echo $_SESSION["user"]->postal_code?>" disabled>
                </div>

                <div class="form-group row">
                    <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="street-housenr">House.Nr</label>
                    <input type="text" name="street-housenr" class="form-control offset-1 col-6"
                        value="<?php echo $_SESSION["user"]->street_housenr?>" disabled>
                </div>

                <div class="form-group row">
                    <label class="mr-lg-5 col-5 col-sm-4 col-md-3 col-lg-2" for="password">Password </label>
                    <input type="password" name="password" class="form-control offset-1 col-6" disabled>
                </div>

                <div class="form-group row pr-4 pt-3">
                    <button id="edit-button" class="btn btn-dark offset-8 offset-md-9">edit
                        <i class="far fa-edit"></i></button>

                    <button type="submit" class="btn btn-dark offset-8 offset-md-9 d-none">send
                        <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

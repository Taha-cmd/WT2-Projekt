<?php
    if(isset($_SESSION["loggedIn"])){
        if($_SESSION["loggedIn"]){ 
            redirectHome();
        }
    } 
?>


<div class="col-md-8 container px-xs-1 px-sm-2 px-md-3 px-lg-4 px-xl-5">
    <h1 class="mb-5 text-center">Register</h1>

    <form name="register-form" id="register-form" action="index.php" method="post" enctype="multipart/form-data">
        <input name="register" type="text" value="register" class="hidden"></input>

        <div class="form-group row radios">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="m" checked>
                <label class="form-check-label" for="male">
                    Mr
                    <i class="pl-1 fas fa-male"></i>
                </label>
            </div>

            <div class="form-check offset-1">
                <input class="form-check-input" type="radio" name="gender" value="f">
                <label class="form-check-label" for="exampleRadios1">
                    Mrs
                    <i class="pl-1 fas fa-female"></i>
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-12">Username</label>

            <div class="col-6 col-md-7 form-group pr-0 pr-md-1">
                <span class="inline-symbol"><i class="fas fa-user"></i></span>
                <input name="username" type="text" class="form-control" required placeholder="username">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-12">Email</label>

            <div class="col-6 col-md-7 form-group pr-0 pr-md-1">
                <span class="inline-symbol"><i class="far fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" required placeholder="email@example.com">
            </div>
        </div>

        <div class="form-group row" id="profile-picture">
            <img src="" id="preview">
            <input class="profile-picture-input" type="file" name="profile-picture">
        </div>

        <div class="form-group row">
            <label class="col-12">Password</label>

            <div class="col-6 form-group pr-0 pr-md-1">
                <span class="inline-symbol"><i class="fas fa-lock"></i></span>
                <input name="password" type="password" class="form-control" required placeholder="password">
            </div>

            <div class="form-group col-6">
                <span class="inline-symbol"><i class="fas fa-lock"></i></span>
                <input name="confirm-password" type="password" class="form-control" required placeholder="password">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-12">Name</label>

            <div class="col-6 form-group pr-0 pr-md-1">
                <span class="inline-symbol"><i class="fas fa-address-card"></i></span>
                <input name="first-name" type="text" class="form-control" required placeholder="first name">
            </div>

            <div class="col-6 form-group">
                <span class="inline-symbol"><i class="fas fa-address-card"></i></span>
                <input name="last-name" type="text" class="form-control" required placeholder="last name">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-12">Address</label>

            <div class="col-4 form-group pr-0 pr-md-1">
                <span class="inline-symbol"><i class="fas fa-city"></i></span>
                <input name="city" type="text" class="form-control" required placeholder="City">
            </div>


            <div class="col-4 form-group pr-0 pr-md-1">
                <span class="inline-symbol"><i class="fas fa-address-book"></i></span>
                <input name="postal-code" type="text" class="form-control" required placeholder="Postal code">
            </div>

            <div class="col-4 form-group">
                <span class="inline-symbol"><i class="fas fa-home"></i></span>
                <input name="street" type="text" class="form-control" required placeholder="Street, Hs.Nr">
            </div>
        </div>

        <button type="submit" class="btn btn-dark">Register <i class="fas fa-sign-in-alt"></i></button>
    </form>
</div>

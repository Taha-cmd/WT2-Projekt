<header class="bg-dark row mx-0 py-0 px-5" id="header">

    <div id="logo" class="">
        <img class="rounded-circle" src="pics/logo.png">
    </div>

    <div id="cart"
        class="ml-auto pr-3 <?php if(!isset($_SESSION["loggedIn"]) ||!$_SESSION["loggedIn"]) echo 'd-none';?>">
        <div>
            <i id="cartIcon" class="fas fa-shopping-cart pr-1"></i>
            <span id="count">0</span>
            <span id="price">
                0
                <i class="fas fa-euro-sign"></i>
            </span>
        </div>
    </div>


    <div id="user-info"
        class="flex-column align-items-center <?php if(!isset($_SESSION["loggedIn"]) ||!$_SESSION["loggedIn"]) echo 'd-none';?>">
        <a href="index.php?page=profile" id="img-link">
            <img class="rounded-circle" src="<?php
                if($_SESSION['user']->profile_pic != null)
                    echo $_SESSION['user']->profile_pic;
                else
                    echo TARGETFOLDER."anonymous.png";
            ?>">
            <span><?php if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"])
             echo $_SESSION["user"]->username ?></span>
        </a>
    </div>

</header>

<i id="burger-icon" class="fas fa-bars bg-dark"></i>

<nav id="navbar" class="bg-dark">
    <ul>
        <li><a href="index.php">Home <i class="fas fa-house-user"></i></a></li>
        <li>blabla</li>
        <li>whatever</li>
        <?php
            if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"])
                echo '<li id="login-link">Login <i class="fas fa-sign-in-alt"></i></li>';
            else
            {
                echo '<li id="logout-button"><form class="d-inline" action="index.php" method="POST">';
                    echo '<input name="logout" type="text" value="logout" class="hidden"></input>';
                    echo '<button class="btn btn-danger" type="submit">Logout <i class="fas fa-sign-in-alt"></i></button>';
                echo '</li></form>';
            }
                
        ?>
    </ul>
</nav>

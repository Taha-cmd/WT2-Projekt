<?php
    function isActive($page)
    {
        if(isset($_GET["page"]))
        {
            if($_GET["page"] === $page)
                return 'active';
        }

        return '';
    }

?>

<header class="bg-dark row mx-0 py-0 px-5" id="header">

    <div id="logo" class="">
        <img class="rounded-circle" src="pics/logo.png">
    </div>

    <div id="cart" class="ml-auto pr-3 <?php if(!isset($_SESSION["loggedIn"])
         ||!$_SESSION["loggedIn"] || $_SESSION["user"]->is_admin == 1) echo 'd-none';?>">
        <div class="">
            <a href="index.php?page=cart"><i id="cartIcon" class="fas fa-shopping-cart pr-1"></i></a>
            <span id="count"><?php 
                if(isset($_SESSION["user"]->cart))
                echo count($_SESSION["user"]->cart);
            ?></span>
            <span id="price">
                <?php
                if(isset($_SESSION["user"]->cart))
                {
                    if(count($_SESSION["user"]->cart) > 0)
                    {
                        echo count($_SESSION["user"]->cart) * $_SESSION["user"]->cart[0]["price"];
                    }
                    else
                    {
                        echo '0';
                    }
                }
            ?>
            </span>
            <i class="fas fa-euro-sign"></i>
        </div>
    </div>

    <div id="admin-tools"
        class="ml-auto pr-3 <?php if(!isset($_SESSION["user"]) || $_SESSION["user"]->is_admin == 0) echo 'd-none';?>">
        <a href="index.php?page=admin" class="d-flex flex-column align-items-center justify-content-center">
            <p>Admin</p>
            <p> tools</p>
            <p><i class="fas fa-users-cog"></i></p>
        </a>
    </div>


    <div id="user-info"
        class="flex-column align-items-center <?php if(!isset($_SESSION["loggedIn"]) ||!$_SESSION["loggedIn"]) echo 'd-none';?>">
        <a href="index.php?page=profile" id="img-link">
            <img class="rounded-circle" src="<?php
                if(isset($_SESSION["user"]))
                { 
                    echo $_SESSION['user']->profile_pic;
                }
            ?>">
            <span><?php if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"])
             echo $_SESSION["user"]->username ?></span>
        </a>
    </div>



</header>

<i id="burger-icon" class="fas fa-bars bg-dark"></i>

<nav id="navbar" class="bg-dark">
    <ul>
        <li class=" <?php if(!isset($_GET["page"])) echo 'active'?>"><a href="index.php?">Home <i
                    class="fas fa-house-user"></i></a></li>
        <li class=" <?php echo isActive('news')?>"><a href="index.php?page=news">News <i
                    class="far fa-newspaper"></i></a></li>
        <li class=" <?php echo isActive('gallery')?>"><a href="index.php?page=gallery">Gallery <i
                    class="fas fa-photo-video"></i></a></li>
        <?php
            if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"])
                echo '<li class="login-link">Login <i class="fas fa-sign-in-alt"></i></li>';
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

<?php

if(!isset($_SESSION["user"]) || $_SESSION["user"]->is_admin != 0){
    redirecthome();
}

?>



<h1 class="text-center mb-5">Shopping Cart <i class="fas fa-shopping-cart"></i></h1>



<div id="cart-container">
    <?php

foreach($_SESSION["user"]->cart as $pic)
{
    $price = $pic["price"];
    $path  = str_replace(ORIGINAL_PICTURES_FOLDER, THUMBNAILS_FOLDER.'thumb.' , $pic["path"]);

    echo
        '<div class="product-container d-flex flex-row justify-content-center align-items-center">
            <div class="cart-img mr-5">
                <img src="'.$path.'"></img>
            </div>

            <div class="ml-5">
                <p>'.$price.' <i class="fas fa-euro-sign"></i></p>
                <p><button class="remove-product btn btn-outline-danger"><i class="fas fa-times-circle"></i></button></p>
            </div>
        </div>';

}

?>

    <div id="pay" class="d-flex justify-content-center">
        <h4>
            <?php
            if(count($_SESSION["user"]->cart) > 0)
            {
                echo 'total sum: <span id="sum"> '.
                count($_SESSION["user"]->cart) * $_SESSION["user"]->cart[0]["price"].
                ' <i class="fas fa-euro-sign"></i></span>';

                echo
                '<span class="ml-5">
                    <button class="btn rounded btn-outline-dark"><h6 class="mb-0">Buy now 
                        <i class="fab fa-shopify"></i>
                    </h6></button>
                </span>';
            }
            ?>
        </h4>
    </div>

    <div class="d-flex justify-content-end">
        <span><i class="fab fa-cc-visa payment"></i></span>
        <span><i class="fab fa-cc-mastercard payment"></i></span>
        <span><i class="fab fa-cc-amazon-pay payment"></i></span>
        <span><i class="fab fa-cc-apple-pay payment"></i></span>
        <span><i class="payment fab fa-cc-paypal"></i></span>
    </div>

</div>

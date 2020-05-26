<section>
    <h1 class="text-center mb-5">Gallery <i class="fas fa-photo-video"></i></h1>

    <div class="container d-flex justify-content-center filter-container">
        <div class="col-12 col-sm-9 col-lg-6 form-group d-flex flex-nowrap flex-row">
            <input name="filter" type="text" id="filter" class="form-control" placeholder="search">
            <span id="filter-icon"><i class="fas fa-search"></i></span>
            <span id="clear-icon"><i class="fas fa-times-circle"></i></span>
        </div>
    </div>
    <br>

    <div id="gallery" class="d-flex flex-wrap flex-row justify-content-start">
        <?php
            foreach($_SESSION["pictures"] as $pic) // pic is assoc array of path and id
            { 
                $thumb = str_replace(ORIGINAL_PICTURES_FOLDER, THUMBNAILS_FOLDER.'thumb.', $pic["path"]);
                $watermark = str_replace(ORIGINAL_PICTURES_FOLDER, WATERMARKS_FOLDER.'watermark.', $pic["path"]);
                
                echo
                '<div draggable="true" class="img-container mb-5 d-flex flex-column col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="my-2">
                        <a href="'.$watermark.'" data-lightbox="home"><img src="'.$thumb.'" alt=""></a>
                    </div>

                    <div>';

                        if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"])
                        {
                            if($_SESSION["user"]->is_admin == 0)
                            {
                                echo
                                '<div class="buy-image d-flex flex-row">
                                    <div class="mr-5"> Price: <span class="price">6.99</span> <i class="fas fa-euro-sign"></i></div>
                                    <button class="btn btn-sm btn-outline-dark"><h6 class="my-0">Buy <i class="fas fa-cart-plus"></h6></i></button>
                                </div>';
                            }
                        }

                    
                        echo
                        '<div class="img-description">
                        description <i class="far fa-keyboard"></i> : ';
                            if($pic["description"] != null) echo $pic["description"];
                        echo
                        '</div>
                        <div class="tags">
                            <span>tags <i class="fas fa-tag">: </i></span>';
                            foreach($pic["tags"] as $tag)
                            {
                                echo
                                '<span class="tag">#'.$tag.'</span>'; 
                            }
                            echo
                            '</div> 
                        </div>
                </div>'; 
            }
        ?>

    </div>

</section>

<section>
    <h1 class="text-center">Upload Zone <i class="fas fa-cloud-upload-alt"></i></h1>

    <div id="upload" class="pt-5 d-flex justify-content-center align-items-center align-baseline flex-wrap">

        <div id="dropbox" class="mb-5 d-flex justify-content-center align-items-center ">
            <strong>drop to upload <i class="fas fa-upload"></i></strong>
        </div>

        <form id="upload-form" class="mb-5 d-flex justify-content-center align-items-center offset-md-1">
            <div class="d-flex justify-content-center align-items-center">
                <strong>click to upload </strong><i class="pl-2 fas fa-upload"></i>
                <input type="file" name="upload">
            </div>
        </form>

    </div>

    <br>

    <!-- must add d-flex class when displayed. removed because d-flex overwrites display:none -->
    <div id="upload-preview" class="mb-5 offset-md-1 mr-md-5 pt-5 flex-row flex-wrap justify-content-center">

        <div class="mb-5 col-12 col-md-5 d-flex" id="upload-preview-img">
            <img src="" alt="">
        </div>

        <div class="offset-md-1 col-12 col-md-7 d-flex justify-content-center justify-content-md-start">
            <form class="col-12">
                <h3 class="text-center mb-5">Add tags <i class="fas fa-tags"></i></h3>

                <div class="form-group d-flex flex-row">
                    <i class="far fa-keyboard"></i>
                    <input name="description" type="text" class="form-control" placeholder="description">
                </div>

                <div class="form-group d-flex flex-row">
                    <i class="fas fa-tag tag"></i>
                    <input name="tag[]" type="text" class="form-control">
                </div>

                <div id="plus-sign" class="rounded-circle d-flex justify-content-end plus-sign">
                    <i class="fas fa-plus-circle"></i>
                </div>

                <br>
                <div class="d-flex justify-content-end">
                    <button class="ml-auto btn btn-dark" id="upload-button">upload <i
                            class="fas fa-upload"></i></button>
                </div>
            </form>

        </div>

    </div>

    <hr>

    <div id="my-uploads">
        <h1 class="text-center my-3">My Uploads <i class="far fa-images"></i></h1>

        <div id="my-gallery" class="d-flex flex-wrap flex-row justify-content-start pt-5">
            <?php
            foreach($_SESSION["user"]->pics as $pic) // $pic is an assoc array
            {
                $thumb = str_replace(ORIGINAL_PICTURES_FOLDER, THUMBNAILS_FOLDER.'thumb.', $pic["path"]);
                
                echo
                '<div class="img-container mb-5 d-flex flex-column col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="my-2">
                        <a href="'.$pic["path"].'" data-lightbox="home"><img src="'.$thumb.'" alt=""></a>
                    </div>
                    
                    <div class="not-relative">
                        <button class="btn btn-danger picture-delete"><i class="far fa-times-circle"></i></button>
                    </div>
                    
                    <div class="img-description">
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
                </div>'; 
            }
        ?>
        </div>
    </div>

</section>

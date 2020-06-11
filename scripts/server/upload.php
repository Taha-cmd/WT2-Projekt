<?php


if(isset($_FILES["file"]))
{
    $description = $_POST["description"];
    $tags = json_decode($_POST["tags"]);
    $path = $dealer->add($_FILES["file"]);
    if(!$path) exit(0);
    $db->addPicture($path, $description, $_SESSION["user"]->id);
    $id = $db->getPicId($path);
    if($id){
        if(isset($_POST["tags"])){
            foreach($tags as $tag){
                $db->addTag($id, $tag);
            }
        }
    }

    $thumb = str_replace(ORIGINAL_PICTURES_FOLDER, THUMBNAILS_FOLDER.'thumb.', $path);
    $response = 
    '<div class="img-container mb-5 d-flex flex-column col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="my-2">
            <a href="'.$path.'" data-lightbox="home"><img src="'.$thumb.'" alt=""></a>
        </div>

        <div class="not-relative">
            <button class="btn btn-danger picture-delete"><i class="far fa-times-circle"></i></button>
        </div>
        
        <div class="img-description">
        '.$description.'
        </div>

        <div class="tags">
            <span>tags <i class="fas fa-tag">: </i></span>';
            foreach($tags as $tag)
            {
                $response .= '<span class="tag">#'.$tag.'</span>'; 
            }
        $response .='</div></div>'; 
    

    echo $response;  

    
    exit(0); //exit after upload, don't need to run whole script
} 

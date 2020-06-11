<?php 

include 'base-classes/photoshop.class.php';


class Filehandle extends Photoshop {

    private $allowedFormats = array("jpg", "jpeg", "png", "JPG", "JPEG", "PNG");

    private function getExtension($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
    
    private function isOk($pic)
    {
        if(!in_array($this->getExtension($pic["name"]), $this->allowedFormats)) return false;
        if($pic["error"]) return false;
        if($pic["size"] <= 0) return false;
        if(!getimagesize($pic["tmp_name"])) return false;
        if(!$pic["tmp_name"]) return false;
        if(!is_uploaded_file($pic["tmp_name"])) return false;
        
        return true;
    }

    public function addProfilePic($pic)
    {
        if(!$this->isOk($pic)) return false;
        
        $tmp["type"] = $pic['type'];
        $tmp["path"] = PROFILE_PICTURES_FOLDER. uniqid() . '.' . $this->getExtension($pic["name"]);
        move_uploaded_file($pic["tmp_name"], $tmp["path"]); 

        return $tmp;
    }

    public function remove($pic)
    {
        if(file_exists($pic)){
            unlink($pic);
        }
        $pic = str_replace(ORIGINAL_PICTURES_FOLDER, WATERMARKS_FOLDER.'watermark.', $pic);
        
        if(file_exists($pic)){
            unlink($pic);
        }

        $pic = str_replace(WATERMARKS_FOLDER.'watermark.',THUMBNAILS_FOLDER.'thumb.' , $pic);
        
        if(file_exists($pic)){
            unlink($pic);
        }
    }

    public function add($pic)
    {
        if(!$this->isOk($pic)) return false;
        $newName = uniqid() . '.' . $this->getExtension($pic["name"]);
        move_uploaded_file($pic["tmp_name"], ORIGINAL_PICTURES_FOLDER.$newName);
        $this->makeWatermark(ORIGINAL_PICTURES_FOLDER.$newName);
        $this->makeThumbnail(ORIGINAL_PICTURES_FOLDER.$newName);

        return ORIGINAL_PICTURES_FOLDER.$newName;
    }
}

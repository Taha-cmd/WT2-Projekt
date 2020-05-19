<?php 



class Filehandle {
    
    private function isOk($pic)
    {
        if(!$pic["error"] &&
            $pic["size"] > 0 &&
            getimagesize($pic["tmp_name"]) &&
            $pic["tmp_name"] &&
            is_uploaded_file($pic["tmp_name"])){
                return true;
        }

        return false;
    }

    public function addProfilePic($pic)
    {
        if(!$this->isOk($pic)) return false;
        
        $tmp["type"] = getimageSize($pic['tmp_name']);
        $tmp["type"] = $tmp["type"]["mime"];
        $tmp["path"] = PROFILEPICSFOLDER.$pic["name"];
        move_uploaded_file($pic["tmp_name"], PROFILEPICSFOLDER.$pic["name"]); 

        return $tmp;
    }

    public function remove($pic)
    {
        if(file_exists($pic)){
            unlink($pic);
        } 
    }
    
}

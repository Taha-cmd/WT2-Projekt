<?php 



class Photoshop{

    protected function createImage($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        if($type === 'jpg' || $type === 'jpeg' || $type === 'JPG' || $type === 'jpeg'){
            $image = imagecreatefromjpeg($path);
        }
        if($type === 'png' || $type === 'PNG'){
            $image = imagecreatefrompng($path);
        }

        return $image;
    }

    protected function makeWatermark($path)
    {
        $name = pathinfo($path, PATHINFO_FILENAME).'.'.pathinfo($path, PATHINFO_EXTENSION);
        $watermark = imagecreatefrompng(WATERMARK);
        $image = $this->createImage($path);

        $width = imagesx($watermark);
        $height = imagesy($watermark);
        $watermark = imagescale($watermark, imagesx($image) * 0.2, imagesy($image) * 0.2);

        imagecopyresampled($image, $watermark, imagesx($image) * 0.6 , imagesy($image) *0.6,
        0,0, imagesx($watermark), imagesy($watermark), imagesx($watermark), imagesy($watermark));
        
        return imagepng($image, WATERMARKS_FOLDER.'watermark.'.$name);  
    }

    protected function makeThumbnail($path)
    {
        $name = pathinfo($path, PATHINFO_FILENAME).'.'.pathinfo($path, PATHINFO_EXTENSION);
        $image = $this->createImage($path);
        $thumb = imagescale($image, imagesx($image)*0.4, imagesy($image)*0.4);
        imagepng($thumb, THUMBNAILS_FOLDER.'thumb.'.$name); 
    }
    
}

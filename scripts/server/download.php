<?php
if(isset($_GET["path"]))
{
    $target = '../../'.$_GET["path"];
    
    if(file_exists($target)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($target).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($target));
        flush(); // Flush system output buffer
        readfile($target);
    }

}

if(isset($_GET["paths"]))
{
    if(!extension_loaded('zip')) exit(3);
    
    $zip = new ZipArchive();
    $name = uniqid().'.zip';

    if($zip->open($name, ZIPARCHIVE::CREATE ))
    {
        foreach($_POST["path"] as $path)
        {
            $path = '../../'.$path;
            if(file_exists($path))
            { 
                $newName = pathinfo($path, PATHINFO_FILENAME);
                $newName .= '.';
                $newName .= pathinfo($path, PATHINFO_EXTENSION);
                $zip->addFile($path, $newName);
            }
        }
    }
    $zip->close();

    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="'.basename($name).'"');
    header('Content-Length: ' . filesize($name));
    flush();
    readfile($name);
    unlink($name); 
}
?>

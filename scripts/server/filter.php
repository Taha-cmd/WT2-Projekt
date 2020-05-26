<?php


if(isset($_POST["search"]))
{
    $term = $_POST["search"];
    $results = [];
    foreach($_SESSION["pictures"] as $pic) // search through all pics
    {
        foreach($pic["tags"] as $tag) // search through all tags of a pic
        {
            if(strpos($tag, $term) !== false)
            {
                array_push($results, pathinfo($pic["path"], PATHINFO_FILENAME)); 
                // push matches to results array
            }
        }
    }

    echo json_encode($results);
    exit(0);
}

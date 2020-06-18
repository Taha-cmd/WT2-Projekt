<?php
include 'includes/config.php';

session_start();

include 'includes/classes/db.class.php';

$db = new DB();	
$newsPagePictures = $db->getPicturesForNewsPage();

echo "<rss version=\"2.0\">";
echo "<channel xmlns:media=\"http://wtf.dunno.what/mrss/\">";
echo "<title>WT2-Project</title>";
echo "<link>host/WTProjectSS2020/WT2-Projekt</link>";
echo "<description>Die neuesten und heissesten Bilder zum Kauf und Verkauf.</description>";
echo "<language>de-de</language>";


foreach($newsPagePictures as $picture)
{
	echo "<item>";
	echo "<guid>{$picture->id}</guid>";
	echo "<link></link>";
	echo "<title>Title here</title>";
	
	
	$SCHEISSPHP = $_SERVER["REQUEST_URI"];
	
	$projectDir = $_SERVER['HTTP_HOST'] . str_replace("generatenewsfeed.php", "", $SCHEISSPHP);
	$imagePath = $projectDir . $picture->path;
	echo "<description> <img style=\"float: right\" src=\"{$imagePath}\"/> {$picture->description}</description>";
	echo "<pubDate>{$picture->creation_date}</pubDate>";
	
	echo "</item>";
	
	/*
	echo "<div class=\"img-container mb-5 d-flex flex-column col-12 col-sm-6 col-md-4 col-lg-3\">
		<img src=\"{$thumb}\" >
		<input type=\"hidden\" value=\"{$picture->id}\">
	</div>";*/
}

echo "</channel>";
echo "</rss>";

header('Content-type: application/xml');

?>
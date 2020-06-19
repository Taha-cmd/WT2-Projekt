<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="scripts/client/news.js"></script>

<div id="newsImageContainer" class="container">
    <h1 class="text-center mb-5">Latest Images <i class="fas fa-photo-video"></i></h1>

    <div class="d-flex flex-wrap flex-row justify-content-start">
        <?php
			$newsPagePictures = $db->getPicturesForNewsPage();
			
			//var_dump($newsPagePictures);
			
			foreach($newsPagePictures as $picture)
			{
				$thumb = str_replace(ORIGINAL_PICTURES_FOLDER, THUMBNAILS_FOLDER.'thumb.', $picture->path);
				
				echo "<div class=\"img-container mb-5 d-flex flex-column col-12 col-sm-6 col-md-4 col-lg-3\">
					<img src=\"{$thumb}\" >
					<input type=\"hidden\" value=\"{$picture->id}\">
				</div>";
			}
		?>
    </div>

    <div class="d-flex m-5 justify-content-center">
        <form action="scripts/server/generatenewsfeed.php" method="post">

            <button class="btn btn-lg btn-primary" type="submit" name="submit">
                <i class="fas fa-rss"></i> News Feed <i class="fas fa-rss"></i>
            </button>
        </form>
    </div>
</div>

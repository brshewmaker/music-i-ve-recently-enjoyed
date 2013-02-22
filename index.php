<?php

/**
 * Return array of music files in given directory
 * @param  string $dir dir to search
 * @return array  $musicfiles found music files
 */
function getMusicFiles($dir) {
	$musicfiles = array();
	foreach (new DirectoryIterator(realpath($dir)) as $file) {
		$extension = pathinfo($file, PATHINFO_EXTENSION);
		if ($extension == 'mp3' || $extension == 'ogg') {
			$musicfiles[] = $file->getFilename();
		}
	}
	return $musicfiles;
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Music I've Recently Enjoyed</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="sm2/css/page-player.css" />
	<link rel="stylesheet" type="text/css" href="sm2/css/flashblock.css">
	<script src="jquery-1.8.2.min"></script>
	<script src="sm2/js/soundmanager2-nodebug-jsmin.js"></script>
	<script src="sm2/js/page-player.js"></script>

	<style type="text/css">
		body {
			width: 480px;
			margin: 40px auto;
			background: #F6F6F0;
		}
		header {
			text-align: center;
		}
		h1 {
			font-family: 'Open Sans', sans-serif;
			/*font-family: "Roboto", Helvetica,Arial;*/
			font-size: 30px;
			line-height: 1.7;
			font-weight: 100;
			color: #585858;
		}
	</style>
</head>
<body>
<header>
	<h1>music i've recently enjoyed</h1>
</header>


<br />
<div id="musicfiles">
	<ul class="playlist">
		<?php
			$musicfiles = getMusicFiles('music');
			natcasesort($musicfiles);
			foreach ($musicfiles as $link) {
				echo '<li><a href="music/' . $link . '">' . $link . '</a></li>'; 
			}
		?>
	</ul>
</div>

<div id="sm2-container"> </div>

<script type="text/javascript">
	soundManager.setup({
		url: 'sm2/swf',
		flashVersion: 9
	});
</script>
</body>
</html>

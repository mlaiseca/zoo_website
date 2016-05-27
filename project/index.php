<?php
ob_start();
require_once (__DIR__.'/scripts/config.php');
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/index_style.css">
	</head>
	<body>
		<h1>Welcome to the Zoo</h1>
	
	
	<div id="content">
				<div id="featured">
					<h2>Meet our Animals</h2>
					<ul>
						<li class="first">
							<a href="gallery.php"><img src="images/animals/button-view-gallery.jpg" alt=""/></a>
							<a href="gallery.php">Gallery</a>
						</li>
					</ul>
				</div>
				<?php
	$page_Content=ob_get_contents();
	ob_end_clean();
	$pagetitle="Home";
	include("master.php");
	?>
	
	</body>
</html>

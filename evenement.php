<?php
	if(isset($_GET['id']) && isset($_GET['city']))
	{
		$id = $_GET['id'];
		$city = $_GET['city'];;
		$url="http://build.uitdatabank.be/api/event/" .$id. "?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&format=json";
		$event = json_decode(file_get_contents($url));
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />

	<title>Cultuurnet</title>

	<link rel="stylesheet" href="css/clear.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="header">
		<div id="logo">
			<img src="images/logo.jpg" />
		</div>
		<div id="navtop">
			<ul>
				<li><a href="#">Eenvoudige modus</a></li>
				<li><a href="#">Contact</a></li>
        	</ul>
		</div>
	</div>
	<div id="container">
		<div id="navleft">
			<?php include("include_navigation.php") ?>
		</div>
		<div id="content">
			<h3><?php echo $event->event->eventdetails->eventdetail->title; ?> <small>in <?php echo($city) ?></small></h3>
      		<p><?php echo $event->event->eventdetails->eventdetail->shortdescription; ?></p>
      			
			<?php 

			$images = $event->event->eventdetails->eventdetail->media->file; 
			foreach($images as $image)
			{
				if($image->mediatype == "photo")
				{
					echo "<img src='" . $image->hlink . "' />";	
				}
			}

			?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
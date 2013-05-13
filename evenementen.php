<?php
	if(isset($_GET['city']) && isset($_GET['category']))
	{
		$category = $_GET['category'];
		$categorie = $_GET['category'];
		$city = $_GET['city'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city ."&heading=" . $category . "&format=json";
	 	$events = json_decode(file_get_contents($url));
	}
	else if(isset($_GET['city'])) {
		$city = $_GET['city'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city . "&format=json";
		$events = json_decode(file_get_contents($url));
		$categorie = "Alle Evenementen";
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
			<ul>
				<?php
				foreach($events as $e)
				{
					echo "<li><a href='evenement.php?city=" . $city . "&id=" . $e->cdbid . "'>" . $e->title . "</a></li>";
				}
				?>
			</ul>
		</div>
	</div>
	<div id="footer">
	</div>
</body>
</html>
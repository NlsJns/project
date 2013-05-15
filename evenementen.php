<?php
	if(isset($_GET['city']) && isset($_GET['age']) && isset($_GET['category']))
	{
		$category = $_GET['category'];
		include("include_headings.php");
		$city = $_GET['city'];
		$age = $_GET['age'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city ."&heading=" . $category . "&agebetween" . $age . "&format=json";
	 	$events = json_decode(file_get_contents($url));
	}
	else if(isset($_GET['city']) && isset($_GET['age'])) {
		$city = $_GET['city'];
		$age = $_GET['age'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city . "&agebetween" . $age . "&format=json";
		$events = json_decode(file_get_contents($url));
		$categorie = "Alle Evenementen";
		$category = "0";
	}
	else if(isset($_GET['city']))
	{
		$city = $_GET['city'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city . "&format=json";
	 	$events = json_decode(file_get_contents($url));
		$categorie = "Alle Evenementen";
		$category = "0";
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
	<div class="top">
	<div id="header">
		<div id="logo">
		</div>
		<div id="navtop">
			<ul>
				<li><a href="#">Eenvoudige modus</a></li>
				<li><a href="#">Contact</a></li>
        	</ul>
		</div>
	</div>
	</div>
	<div id="container">
		<div id="navleft">
			<ul>
				<?php include("include_navigation.php") ?>
			</ul>
		</div>
		<div id="content">
			<h3><?php echo($categorie);?>&nbsp;<small>in <?php echo($city) ?></small></h3>
			<ul>
				<?php
				foreach($events as $e)
				{
					echo "<li><a href='evenement.php?city=" . $city . "&age=" . $age . "&category=" . $category . "&id=" . $e->cdbid . "'>" . $e->title . "</a></li>";
				}
				?>
			</ul>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
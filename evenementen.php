<?php
	if(isset($_POST['Steden'])) {
		$city = $_POST['Steden'];
		$age = $_POST['Leeftijd'];
		if($age == "0") {
		header('Location: evenementen.php?city=' . $city );
		}
		else {
		header('Location: evenementen.php?city=' . $city . '&age=' . $age );
		}
	}

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
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label class="label onpage">Wijzig locatie</label>
			<input class="onpage stad" type="text" name="Steden" placeholder="vb. Haacht">
			<label class="label onpage">Wijzig leeftijd</label>
			<select class="onpage" name="Leeftijd">
				<option value="0-120">Alle leeftijden</option>
				<option value="0-4"
				<?php 
					if($_GET['age'] == "0-4"){ 
						echo('selected');
					}
				?>
				>0 tot 4 jaar</option>
				<option value="4-8"
				<?php 
					if($_GET['age'] == "4-18"){ 
						echo('selected');
					}
				?>
				>4 tot 8 jaar</option>
				<option value="8-12"
				<?php 
					if($_GET['age'] == "8-12"){ 
						echo('selected');
					}
				?>
				>8 tot 12 jaar</option>
				<option value="12-16"
				<?php 
					if($_GET['age'] == "12-16"){ 
						echo('selected');
					}
				?>
				>12 tot 16 jaar</option>
				<option value="16-120"
				<?php 
					if($_GET['age'] == "16-120"){ 
						echo('selected');
					}
				?>
				>Ouder dan 16 jaar</option>
			</select>
			<input id="submitonpage" value="Ok!" type="submit" />
        </form>
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
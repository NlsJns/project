<?php
					include_once("classes/Pictos.class.php");

	
/////////////    SET NEW CITY or AGE    /////////////

		$nocity = "<div id='stadtest'> </div>";

		if(isset($_POST['submitonpage'])) {
			if(!empty($_POST['Steden'])) {
				$city = $_POST['Steden'];
				$age = $_POST['Leeftijd'];
				header('Location: evenementen.php?city=' . $city . '&age=' . $age );
			}
			else {
				$city = $_GET['city'];
				$age = $_POST['Leeftijd'];
				header('Location: evenementen.php?city=' . $city . '&age=' . $age );
			}
		}

/////////////    MAKE REQUEST (GET EVENTS -> ALL)    /////////////
	else if(isset($_GET['city']) && isset($_GET['age']) && isset($_GET['category']))
	{
		$category = $_GET['category'];
		include("include_headings.php");
		$city = $_GET['city'];
		$age = $_GET['age'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city ."&heading=" . $category . "&agebetween" . $age . "&format=json";
	 	$events = json_decode(file_get_contents($url));
	}

/////////////    MAKE REQUEST (GET EVENTS -> WITHOUT CATEGORY)    /////////////

	else if(isset($_GET['city']) && isset($_GET['age'])) {
		$city = $_GET['city'];
		$age = $_GET['age'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city . "&agebetween" . $age . "&format=json";
		$events = json_decode(file_get_contents($url));
		$categorie = "Alle Evenementen";
		$category = "0";
	}

/////////////    MAKE REQUEST (GET EVENTS -> WITHOUT CATEGORY AND AGE)    /////////////

	else if(isset($_GET['city']))
	{
		$city = $_GET['city'];
		$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city . "&format=json";
	 	$events = json_decode(file_get_contents($url));
		$categorie = "Alle Evenementen";
		$category = "0";
	}
?>

<!-- /////////         END PHP      ///////// -->    

<!-- /////////         START HTML      ///////// -->    

<!doctype html>
<html lang="en">

<!-- /////////         START HEAD      ///////// -->    

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />

	<title>Cultuurnet</title>

	<link rel="stylesheet" href="css/clear.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/sticky.css">
</head>

<!-- /////////         END HEAD      ///////// -->    

<!-- /////////         START BODY      ///////// -->    

<body>
	<div id="wrap">
<!-- /////////         START TOP HEADER      ///////// -->    

	<div class="top">
	<div id="header">
		<div id="logo">
		</div>

		<!-- /////////         START TOP FORM      ///////// -->    
		
		<div id="navtop">

		 <?php 
			 if(isset($nocity)) {
				 echo($nocity);
		    }
	    ?>

		<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
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
			<input name="submitonpage" id="submitonpage" value="Ok!" type="submit" />
        </form>
		</div>

	</div>
	
	<!-- /////////         END TOP FORM      ///////// -->    

	</div>
	
<!-- /////////         END TOP HEADER      ///////// -->    

<!-- /////////         START CONTAINER      ///////// -->    

	<div id="container">
	
<!-- /////////         START NAVIGATION      ///////// -->  

  	<nav>
 		<div class="navleft">
			<ul>
			<?php include("include_ownnavigation.php") ?>
			</ul>
		</div>
 
		<div class="navleft">
			<ul>
				<?php include("include_navigation.php") ?>
			</ul>
		</div>
  	</nav>

<!-- /////////         END NAVIGATION      ///////// -->    

<!-- /////////         START CONTENT      ///////// -->    

		<div id="content">
		<?php
			if(isset($_GET['lengte'])) {
					$eventLengte = $_GET['lengte'];
					$p = new Picto();
					$pictos = $p->GetAllFromLengte($eventLengte);
					foreach($events as $e)
					{
						if(in_array($e->cdbid,  $pictos)) {
							echo "<li><a href='evenement.php?city=" . $city . "&amp;age=" . $age . "&amp;category=" . $category . "&amp;id=" . $e->cdbid . "'>" . $e->title . "</a></li>";
						}
					}
			}
			else if(isset($_GET['emotie'])) {
					$eventEmotie = $_GET['emotie'];
					$p = new Picto();
					$pictos = $p->GetAllFromEmotie($eventEmotie);
										
					foreach($events as $e)
					{
						if(in_array($e->cdbid,  $pictos)) {
							echo "<li><a href='evenement.php?city=" . $city . "&amp;age=" . $age . "&amp;category=" . $category . "&amp;id=" . $e->cdbid . "'>" . $e->title . "</a></li>";
						}
					}
			}
			else {
				echo("<h3>" . $categorie . "&nbsp;<small>in " . $city . "</small></h3>");
				echo("<ul>");
				foreach($events as $e)
				{
				echo("<li><a href='evenement.php?city=" . $city . "&amp;age=" . $age . "&amp;category=" . $category . "&amp;id=" . $e->cdbid . "'>" . $e->title . "</a></li>");
				}
				echo("</ul>");
			}
		
		?>
		</div>
	</div>
	</div>
		<div id="footer">
		</div>

<!-- /////////         END CONTENT      ///////// -->    

</body>

<!-- /////////         END BODY      ///////// -->    

</html>

<!-- /////////         END HTML      ///////// -->    
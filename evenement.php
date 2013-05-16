<?php
/////////////    INCLUDE PICTOS CLASS    /////////////
	include_once("classes/Pictos.class.php");

/////////////    GET PICTOSFROM ID    /////////////

	$eventId = $_GET['id'];
	$p = new Picto();
	$pictos = $p->GetAllFromId($eventId);

/////////////    IF PICTOS-READY    /////////////

	if(isset($_POST['SendPictos'])) {
		$id = $_GET['id'];
		$eventId = $_GET['id'];
		
		/////////////    CHECK INPUTS. IF- EMPTY -> FILL WITH 'ERROR'    /////////////
		$lengte = '';
		if(isset($_POST['lengte'])) {
			$lengte = $_POST['lengte'];
		}
		else {
			$lengte = "error";
		}
		if(isset($_POST['emotie'])) {
		$emoties ='';
		foreach($_POST['emotie'] as $check) {
			$emoties.= $check.';';
		}
		$emotie = substr($emoties,0,-1);
		}
		else {
			$emotie = "error";
		}
		if(isset($_POST['genre'])) {
			$genre = $_POST['genre'];
		}
		else {
			$genre = "error";
		}
		
/////////////    TRY INSERT IN DATABASE    /////////////

		try {
		$p = new Picto();
		$p->Save($eventId, $lengte, $emotie, $genre);
		$Hid = $_GET['id'];
		$Hcity = $_GET['city'];;
		$Hage = $_GET['age'];;
		$Hcategory = $_GET['age'];;
		header('Location: evenement.php?city=' . $Hcity . '&age='. $Hage . '&category=' . $Hcategory . '&id=' . $Hid );
		}
		
/////////////    CATCH ERROR IF- TRY FAILS    /////////////

		catch(Exception $e) {
			$feedback = $e->getMessage();
			$emotieAr = explode(";", $emotie);			
		}
	}
	
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
	
/////////////    MAKE REQUEST (GET EVENTS)    /////////////

	if(isset($_GET['id']) && isset($_GET['age']) && isset($_GET['city']))
	{
		$id = $_GET['id'];
		$city = $_GET['city'];;
		$age = $_GET['age'];;
		$url="http://build.uitdatabank.be/api/event/" .$id. "?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&format=json";
		$event = json_decode(file_get_contents($url));
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
</head>

<!-- /////////         END HEAD      ///////// -->    

<!-- /////////         START BODY      ///////// -->    

<body>

<!-- /////////         START TOP HEADER      ///////// -->    

	<div class="top">
	<div id="header">
		<div id="logo">
		</div>
		
		<!-- /////////         START FORM TOP      ///////// -->    

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
		
		<!-- /////////         END FORM TOP      ///////// -->    

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
			<h3><?php echo $event->event->eventdetails->eventdetail->title; ?> <small>in <?php echo($city) ?></small></h3>
      		<p><?php echo $event->event->eventdetails->eventdetail->shortdescription; ?></p>
			<?php 

			$images = $event->event->eventdetails->eventdetail->media->file; 
			foreach($images as $image)
			{
				if($image->mediatype == "photo")
				{
					echo "<img src='" . $image->hlink . "' alt='" . $event->event->eventdetails->eventdetail->title . "'  />";	
				}
			}

			?>
			
			<?php

 /////////         CHECK FOR PICTOS      ///////// 

				if(count($pictos) > 0) {
					foreach($pictos as $p){
						echo $p['cdbid'];
						echo htmlspecialchars($p['lengte']);
					}
				}

 /////////         GENERATE PICTOS-FORM IF- COMPOSE-BUTTON.CLICK      ///////// 


				else if(isset($_POST['verzendknop']) || isset($feedback)) {
					echo "
						<form action='"?> <?php echo $_SERVER['REQUEST_URI']; ?> <?php echo "' method='post'>
	<div class='formgrootblok'>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_1.png' alt='lengte_1'>
			<input class='input' type='radio' name='lengte' value='lengte_1'
			"?> <?php
			if(isset($feedback) && ($lengte == 'lengte_1') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_2.png' alt='lengte_2'>
			<input class='input' type='radio' name='lengte' value='lengte_2'
			"?> <?php
			if(isset($feedback) && ($lengte == 'lengte_2') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_3.png' alt='lengte_3'>
			<input class='input' type='radio' name='lengte' value='lengte_3'
			"?> <?php
			if(isset($feedback) && ($lengte == 'lengte_3') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_5.png' alt='lengte_5'>
			<input class='input' type='radio' name='lengte' value='lengte_5'
			"?> <?php
			if(isset($feedback) && ($lengte == 'lengte_5') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_10.png' alt='lengte_10'>
			<input class='input' type='radio' name='lengte' value='lengte_10'
			"?> <?php
			if(isset($feedback) && ($lengte == 'lengte_10') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
	</div>
	<div class='formgrootblok'>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_blij.png' alt='emotie_blij'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_blij'
			"?> <?php
			if(isset($feedback) && in_array("emotie_blij", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_bang.png' alt='emotie_bang'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_bang'
			"?> <?php
			if(isset($feedback) && in_array("emotie_bang", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_boos.png' alt='emotie_boos'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_boos'
			"?> <?php
			if(isset($feedback) && in_array("emotie_boos", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_genieten.png' alt='emotie_genieten'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_genieten'
			"?> <?php
			if(isset($feedback) && in_array("emotie_genieten", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_spannend.png' alt='emotie_spannend'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_spannend'
			"?> <?php
			if(isset($feedback) && in_array("emotie_spannend", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_verdrietig.png' alt='emotie_verdrietig'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_verdrietig'
			"?> <?php
			if(isset($feedback) && in_array("emotie_verdrietig", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
	</div>
	<div class='formgrootblok'>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_dans.png' alt='genre_dans'>
			<input class='input' type='checkbox' name='genre' value='genre_dans'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_feest.png' alt='genre_feest'>
			<input class='input' type='checkbox' name='genre' value='genre_feest'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_film.png' alt='genre_film'>
			<input class='input' type='checkbox' name='genre' value='genre_film'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_humor.png' alt='genre_humor'>
			<input class='input' type='checkbox' name='genre' value='genre_humor'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_kunst.png' alt='genre_kunst'>
			<input class='input' type='checkbox' name='genre' value='genre_kunst'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_muziek.png' alt='genre_muziek'>
			<input class='input' type='checkbox' name='genre' value='genre_muziek'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_sport.png' alt='genre_sport'>
			<input class='input' type='checkbox' name='genre' value='genre_sport'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/genre_uitstap.png' alt='genre_uitstap'>
			<input class='input' type='checkbox' name='genre' value='genre_uitstap'>
		</div>
	</div>
	<input name='SendPictos' id='verzendknop' value='Ok!' type='submit' />
	</form>					

					";
				}

 /////////         GENERATE COMPOSE-BUTTON IF- NO PICTOS      ///////// 

				else {
					echo "			
						<form action='"?> <?php echo $_SERVER['REQUEST_URI']; ?> <?php echo "' method='post'>
						<label>Voor dit evenement bestaat nog geen picto-samenvatting.</label>
						<input name='verzendknop' id='verzendknop' value='Ok!' type='submit' />
						</form>
					";
				}
			
			
			?>

<!-- /////////         GET FEEDBACK FROM CLICK      ///////// -->

			<?php if(isset($feedback)){echo($feedback);}?>
		</div>
		
		<!-- /////////         END CONTENT      ///////// -->  
		  
		<!-- /////////         START FOOTER      ///////// -->    

		<div id="footer">
		</div>

		<!-- /////////         END FOOTER      ///////// -->    

	</div>

	<!-- /////////         END CONTAINER      ///////// -->    

</body>

<!-- /////////         END BODY      ///////// -->    

</html>

<!-- /////////         END HTML      ///////// -->    
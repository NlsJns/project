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
			<div class="inhoudevent">
			<h3><?php echo $event->event->eventdetails->eventdetail->title; ?> <small>in <?php echo($city) ?></small></h3>
      		<p><?php echo $event->event->eventdetails->eventdetail->shortdescription; ?></p>
			</div>
			<div class="fotoevent">
			<?php 
			$images = $event->event->eventdetails->eventdetail->media->file; 
			foreach($images as $image)
			{
				if($image->mediatype == "photo")
				{
					echo "<div class='returnimg'><img src='" . $image->hlink . "' alt='" . $event->event->eventdetails->eventdetail->title . "'  /></div>";	
				}
			}

			?>
			</div>
			<?php

 /////////         CHECK FOR PICTOS      ///////// 

				if(count($pictos) > 0) {
					foreach($pictos as $p){
					$emo = $p['emotie'];
					$emoAr = explode(";", $emo);			
					$gen = $p['genre'];
					$genAr = explode(";", $gen);
					echo "<div class='samenvatting'><h2>Samenvatting in Pictos:</h2>";			
				echo "<div class='samenvattinglengte'><p>Lengte:</p><div class='formblok'><img src='images/lengte/" . $p['lengte'] . ".png' /></div></div>";
				echo "<div class='samenvattingemotie'><p>Emotie:</p>";
						foreach($emoAr as $e){
				echo "<div class='formblok'><img src='images/emotie/" . $e . ".png' /></div>";
						}
				echo "</div>";
				echo "<div class='samenvattinggenre'><p>Genre:</p>";
						foreach($genAr as $g){
				echo "<div class='formblok'><img src='images/genre/" . $g . ".png' /></div>";
						}
				echo "</div>";

					}
				}
 /////////         GENERATE PICTOS-FORM IF- COMPOSE-BUTTON.CLICK      ///////// 


				else if(isset($_POST['verzendknop']) || isset($feedback)) {
					echo "
						<form action='"?> <?php echo $_SERVER['REQUEST_URI']; ?> <?php echo "' method='post'>
	<div class='formgrootblok'>
		<p>Lengte:</p>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/1.png' alt='lengte_1'>
			<input class='input' type='radio' name='lengte' value='1'
			"?> <?php
			if(isset($feedback) && ($lengte == '1') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/2.png' alt='lengte2'>
			<input class='input' type='radio' name='lengte' value='2'
			"?> <?php
			if(isset($feedback) && ($lengte == '2') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/3.png' alt='lengte_3'>
			<input class='input' type='radio' name='lengte' value='3'
			"?> <?php
			if(isset($feedback) && ($lengte == '3') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/5.png' alt='lengte_5'>
			<input class='input' type='radio' name='lengte' value='5'
			"?> <?php
			if(isset($feedback) && ($lengte == '5') ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/10.png' alt='lengte_10'>
			<input class='input' type='radio' name='lengte' value='10'
			"?> <?php
			if(isset($feedback) && ($lengte == '10') ){ 
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
		<p>Emoties:</p>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/blij.png' alt='emotie_blij'>
			<input class='input' type='checkbox' name='emotie[]' value='blij'
			"?> <?php
			if(isset($feedback) && in_array("blij", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/bang.png' alt='emotie_bang'>
			<input class='input' type='checkbox' name='emotie[]' value='bang'
			"?> <?php
			if(isset($feedback) && in_array("bang", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/boos.png' alt='emotie_boos'>
			<input class='input' type='checkbox' name='emotie[]' value='boos'
			"?> <?php
			if(isset($feedback) && in_array("boos", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/genieten.png' alt='emotie_genieten'>
			<input class='input' type='checkbox' name='emotie[]' value='genieten'
			"?> <?php
			if(isset($feedback) && in_array("genieten", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/spannend.png' alt='emotie_spannend'>
			<input class='input' type='checkbox' name='emotie[]' value='spannend'
			"?> <?php
			if(isset($feedback) && in_array("spannend", $emotieAr) ){ 
			echo "checked='checked'"; 
			} 
			else 
			{echo '';}
			?> <?php echo 
			"
			>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/verdrietig.png' alt='emotie_verdrietig'>
			<input class='input' type='checkbox' name='emotie[]' value='verdrietig'
			"?> <?php
			if(isset($feedback) && in_array("verdrietig", $emotieAr) ){ 
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
		<p>Genres:</p>
		<div class='formblok'>
			<img class='formimg' src='images/genre/dans.png' alt='genre_dans'>
			<input class='input' type='checkbox' name='genre' value='dans'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/feest.png' alt='genre_feest'>
			<input class='input' type='checkbox' name='genre' value='feest'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/film.png' alt='genre_film'>
			<input class='input' type='checkbox' name='genre' value='film'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/humor.png' alt='genre_humor'>
			<input class='input' type='checkbox' name='genre' value='humor'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/kunst.png' alt='genre_kunst'>
			<input class='input' type='checkbox' name='genre' value='kunst'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/muziek.png' alt='genre_muziek'>
			<input class='input' type='checkbox' name='genre' value='muziek'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/sport.png' alt='genre_sport'>
			<input class='input' type='checkbox' name='genre' value='sport'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/genre/uitstap.png' alt='genre_uitstap'>
			<input class='input' type='checkbox' name='genre' value='uitstap'>
		</div>
	</div>
	<input name='SendPictos' id='submitnewpicto' value='Ok!' type='submit' />
	</form>					

					";
				}

 /////////         GENERATE COMPOSE-BUTTON IF- NO PICTOS      ///////// 

				else {
					echo "	
						<div class='formuliernopicto'>		
						<form action='"?> <?php echo $_SERVER['REQUEST_URI']; ?> <?php echo "' method='post'>
						<h2>Voor dit evenement bestaat nog geen picto-samenvatting. Wil jij ons helpen door nu een samenvatting te maken?</h2>
						<input name='verzendknop' id='submitnopicto' value='Ja, graag!' type='submit' />
						</form>
						</div
					";
				}
			
			
			?>

<!-- /////////         GET FEEDBACK FROM CLICK      ///////// -->

			<?php if(isset($feedback)){echo($feedback);}?>
		</div>
		
		<!-- /////////         END CONTENT      ///////// -->  
		  

	</div>
	</div>
	<!-- /////////         END CONTAINER      ///////// -->    
		
		<!-- /////////         START FOOTER      ///////// -->    

		<div id="footer">
		</div>

		<!-- /////////         END FOOTER      ///////// -->    
</body>

<!-- /////////         END BODY      ///////// -->    

</html>

<!-- /////////         END HTML      ///////// -->    
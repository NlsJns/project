<?php
	include_once("classes/Pictos.class.php");
	$eventId = $_GET['id'];
	$p = new Picto();
	$pictos = $p->GetAllFromId($eventId);
	if(isset($_POST['SendPictos'])) {
		$id = $_GET['id'];
		$eventId = $_GET['id'];
		if(isset($_POST['lengte'])) {
			$lengte = $_POST['lengte'];
		}
		else {
			$lengte = "leeg";
		}
		$emoties ='';
		foreach($_POST['emotie'] as $check) {
			$emoties.= $check.';';
		}
		$emotie = substr($emoties,0,-1);
		
		$genre = $_POST['genre'];
		try {
		$p = new Picto();
		$p->Save($eventId, $lengte, $emotie, $genre);
		$Hid = $_GET['id'];
		$Hcity = $_GET['city'];;
		$Hage = $_GET['age'];;
		$Hcategory = $_GET['age'];;
		header('Location: evenement.php?city=' . $Hcity . '&age='. $Hage . '&category=' . $Hcategory . '&id=' . $Hid );
		}
		catch(Exception $e) {
			$feedback = $e->getMessage();			
		}
	}
	if(isset($_POST['Steden'])) {
		$city = $_GET['city'];
		$age = $_POST['Leeftijd'];
		$category = $_GET['category'];
		header('Location: evenementen.php?city=' . $city . '&age=' . $age );
	}
	if(isset($_GET['id']) && isset($_GET['age']) && isset($_GET['city']))
	{
		$id = $_GET['id'];
		$city = $_GET['city'];;
		$age = $_GET['age'];;
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
	<div class="top">
	<div id="header">
		<div id="logo">
		</div>
		<div id="navtop">
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
				if(count($pictos) > 0) {
					foreach($pictos as $p){
						echo $p['cdbid'];
						echo htmlspecialchars($p['lengte']);
					}
				}
				else if(isset($_POST['verzendknop']) || isset($feedback)) {
					echo "
						<form action='"?> <?php echo $_SERVER['REQUEST_URI']; ?> <?php echo "' method='post'>
	<div class='formgrootblok'>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_1.png' alt='lengte_1'>
			<input class='input' type='radio' name='lengte' value='lengte_1'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_2.png' alt='lengte_2'>
			<input class='input' type='radio' name='lengte' value='lengte_2'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_3.png' alt='lengte_3'>
			<input class='input' type='radio' name='lengte' value='lengte_3'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_5.png' alt='lengte_5'>
			<input class='input' type='radio' name='lengte' value='lengte_5'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/lengte/lengte_10.png' alt='lengte_10'>
			<input class='input' type='radio' name='lengte' value='lengte_10'>
		</div>
	</div>
	<div class='formgrootblok'>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_blij.png' alt='emotie_blij'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_blij'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_bang.png' alt='emotie_bang'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_bang'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_boos.png' alt='emotie_boos'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_boos'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_genieten.png' alt='emotie_genieten'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_genieten'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_spannend.png' alt='emotie_spannend'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_spannend'>
		</div>
		<div class='formblok'>
			<img class='formimg' src='images/emotie/emotie_verdrietig.png' alt='emotie_verdrietig'>
			<input class='input' type='checkbox' name='emotie[]' value='emotie_verdrietig'>
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
				else {
					echo "			
						<form action='"?> <?php echo $_SERVER['REQUEST_URI']; ?> <?php echo "' method='post'>
						<label>Voor dit evenement bestaat nog geen picto-samenvatting.</label>
						<input name='verzendknop' id='verzendknop' value='Ok!' type='submit' />
						</form>
					";
				}
			
			
			?>
			
			<?php if(isset($feedback)){echo($feedback);}?>
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
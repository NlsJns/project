<?php
	include_once("classes/Pictos.class.php");
	$eventId = $_GET['id'];
	$p = new Picto();
	$pictos = $p->GetAllFromId($eventId);
	if(isset($_POST['SendPictos'])) {
		$eventId = $_GET['id'];
		$lengte = $_POST['lengte'];
		$emotie = $_POST['emotie'];
		$genre = $_POST['genre'];
		$p = new Picto();
		$p->Save($eventId, $lengte, $emotie, $genre);
		$Hid = $_GET['id'];
		$Hcity = $_GET['city'];;
		$Hage = $_GET['age'];;
		$Hcategory = $_GET['age'];;
		header('Location: evenement.php?city=' . $Hcity . '&age='. $Hage . '&category=' . $Hcategory . '&id=' . $Hid );
	}
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
			
			<?php
				if(count($pictos) > 0) {
					foreach($pictos as $p){
						echo $p['cdbid'];
						echo htmlspecialchars($p['lengte']);
					}
				}
				else if(isset($_POST['verzendknop'])) {
					echo "
						<form action='' method='post'>
						<label>Voor dit evenement bestaat nog geen picto-samenvatting.</label>
						<select class='field' name='lengte'>
							<option value='1'>Alle leeftijden</option>
							<option value='2'>Alle leeftijden</option>
							<option value='3'>Alle leeftijden</option>
						</select>
						<select class='field' name='emotie'>
							<option value='1'>Alle leeftijden</option>
							<option value='2'>Alle leeftijden</option>
							<option value='3'>Alle leeftijden</option>
						</select>
						<select class='field' name='genre'>
							<option value='1'>Alle leeftijden</option>
							<option value='2'>Alle leeftijden</option>
							<option value='3'>Alle leeftijden</option>
						</select>
						<input name='SendPictos' id='verzendknop' value='Ok!' type='submit' />
						</form>					
					";
				}
				else {
					echo "			
						<form action='' method='post'>
						<label>Voor dit evenement bestaat nog geen picto-samenvatting.</label>
						<input name='verzendknop' id='verzendknop' value='Ok!' type='submit' />
						</form>
					";
				}
			
			
			?>
			
			
		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>
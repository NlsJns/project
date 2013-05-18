<?php
	if(isset($_POST['submitindex'])) {
		if(!empty($_POST['Steden'])) {
			$city = $_POST['Steden'];
			$age = $_POST['Leeftijd'];
			$url = "http://build.uitdatabank.be/api/events/search?key=AEBA59E1-F80E-4EE2-AE7E-CEDD6A589CA9&city=" . $city . "&format=json";
			$events = json_decode(file_get_contents($url));
			$eventen = "";
			foreach($events as $e)
			{
				$eventen = "input";
			}
			if($eventen == "input") {
				header('Location: evenementen.php?city=' . $city .'&age=' . $age);
			}
			else {
				$errorcity = "Ben je zeker dat je een juiste stad of gemeente invude? <br><br>We vinden er geen evenementen terug!";
			}
		}
		else {
			$nocity = "Oeps, je hebt nog geen stad of gemeente ingevuld.<br><br> Doe je dat even?";
		}
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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
</head>

<!-- /////////         END HEAD      ///////// --> 

   
<!-- /////////         START BODY      ///////// -->    
<body>
<!-- /////////         START TOP ATHUR      ///////// -->    

	<div class="top">
		<div id="tekstarthur">
		
		
			<div id="tekstballon">
			<?php
			if(isset($nocity)) {
				echo($nocity);
			}
			else if(isset($errorcity)) {
				echo($errorcity);
			}
			else {
				echo("
			Hoi, Ik ben Arthuur.<br> Ik help je zoeken naar cultuur!<br><br>
			Begin met een gemeente of een stad in te vullen!
				");
			}
			?>
			</div>
			
			
			
		</div>
		<div id="arthur"></div>
		<div id="arthurcontainer">
			<div id="arthurside"></div>
		</div>
	</div>

<!-- /////////         END TOP ATHUR      ///////// -->    

<!-- /////////         START BOTTOM FORM      ///////// -->    

	<div id="form">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label id="labelzoek">Waar wil je op zoek naar een evenement?</label>
			<input class="field steden" type="text" name="Steden" placeholder="vb. Haacht">
			<label id="labelleeftijd">Voor welke leeftijden zoek je een evenement?</label>
			<select class="field option" name="Leeftijd">
				<option value="0-120">Alle leeftijden</option>
				<option value="0-4">0 tot 4 jaar</option>
				<option value="4-8">4 tot 8 jaar</option>
				<option value="8-12">8 tot 12 jaar</option>
				<option value="12-16">12 tot 16 jaar</option>
				<option value="16-120">Ouder dan 16 jaar</option>
			</select>
			<input name="submitindex" id="verzendknop" value="Ok!" type="submit" />
        </form>
    </div>    
<!-- /////////         END BOTTOM FORM      ///////// -->    

</body>

<!-- /////////         END BODY      ///////// --> 

</html>

<!-- /////////         END HTML      ///////// --> 
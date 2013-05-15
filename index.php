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

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />

	<title>Cultuurnet</title>

	<link rel="stylesheet" href="css/clear.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="top">
		<div id="tekstarthur">
			<div id="tekstballon">Hoi, Ik ben Arthur, en ik help je zoeken naar cultuur!<br><br>
				Begin met een gemeente of een stad in te vullen!
			</div>
		</div>
		<div id="arthur"></div>
		<div id="arthurcontainer">
			<div id="arthurside"></div>
		</div>
	</div>
	<div id="form">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label id="labelzoek">Waar wil je op zoek naar een evenement?</label>
			<input class="field steden" type="text" name="Steden" placeholder="vb. Haacht">
			<label id="labelleeftijd">Voor welke leeftijden zoek je een evenement?</label>
			<select class="field" name="Leeftijd">
				<option value="0-120">Alle leeftijden</option>
				<option value="0-4">0 tot 4 jaar</option>
				<option value="4-8">4 tot 8 jaar</option>
				<option value="8-12">8 tot 12 jaar</option>
				<option value="12-16">12 tot 16 jaar</option>
				<option value="16-120">Ouder dan 16 jaar</option>s
			</select>
			<input id="verzendknop" value="Ok!" type="submit" />
        </form>
    </div>
	
</body>
</html>
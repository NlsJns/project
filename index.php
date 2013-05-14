<?php
	if(isset($_POST['Steden'])) {
		$city = $_POST['Steden'];
		header('Location: evenementen.php?city=' . $city );
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
	<p> test 2 3 </p>
	<div id="form">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label id="labelzoek">Waar wil je op zoek naar een evenement?</label>
			<input id="steden" type="text" name="Steden" placeholder="vb. Haacht"><input id="verzendknop" value="Ok!" type="submit" />
        </form>
    </div>
	
</body>
</html>
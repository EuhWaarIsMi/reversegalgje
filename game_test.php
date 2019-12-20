<?php
	require "init.php";
	require "variables.php";
	if(isset($_GET['beurten'])) {
		$beurten = $_GET['beurten']; 
	}
	//$beurten = $_GET['beurten'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>test input</title>
</head>

<body>
	<?php
		if(isset($_GET['vraag'])) {
			$vorigeVraag = $_GET['vraag'];
			echo $vorigeVraag;
		}

		// hier komt vraag functie te staan
		KansBerekening($sessie, $kansSessie, $db);
		KiesVraag($sessie, $kansSessie, $db);
		

		if(isset($_GET['antwoord'])) {
			StreepVragenWeg($db, $_GET['antwoord'], $vorigeVraag, $sessie);
			$beurten--;
		}

		if(isset($_GET['zetTerug'])) {
			echo $_GET['zetTerug'];
			$beurten++;
		}
		echo $beurten;


		Stelvraag($vraag);
		echo "<h1>$vraagVolledig</h1>";
	?>

	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
		<input type="hidden" name="beurten" value="<?php echo $beurten ?>"></input>
		<input type="hidden" name="vraag" value="<?php echo $vraag ?>"></input>
		<input type="submit" name="antwoord" value="ja"></input>
		<input type="submit" name="antwoord" value="nee"></input>
		<input type="submit" name="zetTerug" value="ga een zet terug"></input>
	</form>
</body>
</html>

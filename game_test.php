<?php
	require "init.php";
	require "variables.php";
	if(isset($_GET['beurten'])) {
		$beurten = $_GET['beurten']; 
	}
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
		}
		else{
			$vorigeVraag = NULL;
		}
		// hier komt vraag functie te staan
		if(isset($_GET['antwoord'])) {
			StreepVragenWeg($db, $_GET['antwoord'], $vorigeVraag, $sessie);
			$beurten--;
		}

		/*if(isset($_GET['zetTerug'])) {
			echo $_GET['zetTerug'];
			$beurten++;
		}*/ 

		KansBerekening($sessie, $kansSessie, $db);
		KiesVraag($sessie, $kansSessie, $db, $beurten);
		if(isset($vraag)){	
			Stelvraag($vraag);
		}

		if ($beurten == 0 || ((is_numeric(substr($vorigeVraag, 1, 1)) == False && strlen($vorigeVraag) > 1) && $_GET['antwoord'] == 'ja') || isset($vraag) == False ) {
			header('location:spelResultaat.php?antwoord='. $_GET['antwoord']."&woord='". $vorigeVraag. "'");
		}
		echo "<h1>$vraagVolledig</h1>";
	?>

	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
		<input type="hidden" name="beurten" value="<?php echo $beurten ?>"></input>
		<input type="hidden" name="vraag" value="<?php echo $vraag ?>"></input>
		<input type="submit" name="antwoord" value="ja"></input>
		<input type="submit" name="antwoord" value="nee"></input>
		<!-- <input type="submit" name="zetTerug" value="ga een zet terug"></input> -->
	</form>

	<p>beurten: <?php echo $beurten; ?></p>
</body>
</html>

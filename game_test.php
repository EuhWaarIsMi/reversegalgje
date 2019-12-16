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
	<?php
		KansBerekening($sessie, $kansSessie, $db);
		KiesVraag($sessie, $kansSessie, $db);
		Stelvraag($vraag);
	?>
</head>

<body>
	<?php
		// hier komt vraag functie te staan
		echo "<h1>$vraagVolledig</h1>";
		

		if(isset($_GET['antwoord'])) {
			StreepVragenWeg($db, $_GET['antwoord'], $vraag, $sessie);
			$beurten--;
		}

		if(isset($_GET['zetTerug'])) {
			echo $_GET['zetTerug'];
			$beurten++;
		}
		echo $beurten;
	?>

	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
		<input type="hidden" name="beurten" value="<?php echo $beurten ?>"></input>
		<input type="submit" name="antwoord" value="ja"></input>
		<input type="submit" name="antwoord" value="nee"></input>
		<input type="submit" name="zetTerug" value="ga een zet terug"></input>
	</form>
</body>
</html>

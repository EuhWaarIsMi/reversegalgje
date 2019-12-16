<?php
	require 'core/init.php';
	session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<link rel="shortcut icon" href="images/rope.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" > 
	<title>Persoonlijke pagina</title>
</head>

<body>

<nav id="groter">
  <a class="nietGeel" href="uitloggen.php">Uitloggen</a>
  <a class="geel" href="#">Reversegalgje</a>
  <a class="nietGeel" href="#">Woorden toevoegen</a>
  <?php
  if($_SESSION['gebruiker']=="admin"){
	  echo "<a href=''>Woordencontroleren</a>";
  }
  ?>
</nav>

<section>
    <a class="speciaalGeel" href="index.php">Home</a>
    <?php
    echo "<h1>".$_SESSION['gebruiker']."</h1>";
    echo "<h2>Mail: ".$_SESSION['mail']."</h2>";
    echo "<h2>Aantal keer gespeeld: ".$_SESSION['galgjeCount']."</h2>";
    ?>
    <a href="pasGegevensAan.php" id="aanpas">Pas gegevens aan</a>
</section>

<img id="img2" src="./images/download.jpeg">

</body>
</html>
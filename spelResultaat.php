<?php
require "init.php";
require "variables.php";
session_start();

$sql= "DROP TABLE ".$sessie;
$db->query($sql);
$sql= "DROP TABLE ".$kansSessie;
$db->query($sql);
?>

<!doctype html>
<html>
<head>
	<link rel="shortcut icon" href="images/rope.png">
	<meta charset="utf-8">
	<title>Reversegalgje</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<nav id="groter">
  <a class="nietGeel" href="uitloggen.php">Uitloggen</a>
  <a class="geel" href="persoonlijkePagina.php">Eigen pagina</a>
  <a class="nietGeel"><?php echo $_SESSION['gebruiker']; ?></a>
</nav>	

<body>
    <section>
        <?php
        $antwoord = $_GET['antwoord'];
        if ($antwoord == 'ja') {
            echo "<div class='margin midden'>
                <a type='submit' name='zetTerug' class='terug' href=''><i class='fa fa-arrow-left'></i>  Terug</a>
                <h1>Je woord is geraden!</h1>
            </div>";
            
        }
        else {
            echo "<div class='margin midden'>
                <a type='submit' name='zetTerug' class='terug' href=''><i class='fa fa-arrow-left'></i>  Terug</a>
                <h1>Je woord is niet geraden!</h1>
            </div>";
            
            echo "<p style='font-size:20px;'>Deze woorden bleven nog over:</p>";
            echo "<div class='padding'>";
            $sql = "SELECT woord FROM woorden WHERE id IN (SELECT id FROM ". $sessie. " WHERE weg = 'False')";
            $nietGeradenWoordenArray = $db->query($sql);
            foreach ($nietGeradenWoordenArray as $row) {
                $nietGeradenWoorden[] = $row[0];
            }
            echo "<p>Deze woorden bleven nog over:</p>";
            echo join("<br>", $nietGeradenWoorden);

            echo "</div>";
        }
        ?>
        <p class="keuze margin midden">Zat je woord er niet tussen?<p>
        <a id="honderd" class="geel midden" href="woordenToevoegen">Woorden toevoegen</a>
        <form action="sessie_start.php">
            <p class="keuze margin midden">Niet genoeg gehad?</p>
            <input id="honderd" class="geel" type="submit" name="nieuwSpel" value="Nog een keer">
        </form>
        
    </section>

    <div class="foto">
      <img src="./images/galg.png">
    </div>

</body>

</html>
<?php
  require 'core/init.php';
  session_start();
?>

<!DOCTYPE html>
<html lang="nl">

  <head>
    <meta charset="utf-8">
	<link rel="shortcut icon" href="images/rope.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css" >
    <title>Reversegalgje</title>  
  </head>
  <body>	
    <header>
      <nav class="main">
        <?php
          if(isset($_SESSION['gebruiker'])){
            echo "<a class='nietGeel' href='uitloggen.php'>Uitloggen</a><a class='geel' href='persoonlijkePagina.php'>Eigen</a>";
          } else {
            echo "<a class='nietGeel' href='login.php'>Login</a>
            <a class='geel' href='aanmelden.php'>Aanmelden</a>";
          }
        ?>
      </nav>
    </header>

    <section>
      <div>
        <h1>Reversegalgje</h1>
        <h3>Bedenk jij een woord voor de computer?</h3>
        <div>
          <?php
            if(isset($_SESSION['gebruiker'])){
              echo "<a class='geel' href='persoonlijkePagina.php'>Start</a>";
            } else {
              echo "<a class='geel' href='login.php'>Start</a>";
            }
          ?>
        </div>   
      </div>
    </section>
    
    <div class="foto">
      <img src="./images/galg.png">
    </div>
  </body>
</html> 


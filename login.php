<?php
require 'core/init.php';

?>

<!doctype html>
<html>
<head>
	<link rel="shortcut icon" href="images/rope.png">
	<meta charset="utf-8">
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
      <nav class="main">
        <a class="nietGeel" href="index.php">Home</a>
      </nav>
    </header>
	
	<section>
      <div>
        <h1 class="midden">Login</h1>
		<?php
		if(isset($_GET['error'])){
			if($_GET['error']=='legeVelden'){
				echo "Vul alle velden in!";
			} else if($_GET['error']=='foutLogin'){
				echo "Gebruikersnaam of wachtwoord bestaat niet!";
			}
		}
		  
		?>
        <form name="aanmelden" method="post" action="logincode.php">
		<input type="text" name="mailuid" placeholder="Gebruikersnaam">
		<input type="password" name="ww" placeholder="Wachtwoord">
        <div>
          <input class="geel" type="submit" name="submit" value="Start">
        </div>
		</form>
      </div>
    </section>
    
    <div class="foto">
      <img src="./images/galg.png">
    </div>

</body>
</html>
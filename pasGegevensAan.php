<?php
	include 'core/init.php';
	session_start();
?>


<!doctype html>
<html>
<head>
	<link rel="shortcut icon" href="images/rope.png">
	<meta charset="utf-8">
	<title>Aanmelden</title>
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
        <h1 class="midden">Aanmelden</h1>
		<?php
		if (isset($_GET['error'])){
			switch($_GET['error']){
				case 'legeVelden':
					echo "Vul alle velden in!";
					break;
				case 'foutEmailGebruikersnaam':
					echo "Vul een bestaande email en een goede gebruikersnaam in!";
					break;
				case 'foutEmail':
					echo "Vul een bestaande email in!";
					break;
				case 'foutGebruikersnaam':
					echo "Gebruik een gebruikersnaam met alleen de letters a-z en getallen!";
					break;
				case 'wachtwoordenVerkeerd':
					echo "De wachtwoorden komen niet overeen!";
					break;
				case 'gebruikerBestaatAl':
					echo "Deze gebruiker bestaat al.";
					break;
				case 'emailBestaatAl':
					echo "Dit emailadres bestaat al.";
					break;
			}
		}  
		  
		?>
        <form name="pasGegevensAan" method="post" action="pasGegevensAanCode.php">
		<input type="text" name="ww" placeholder="Wachtwoord" value="<?php echo $_SESSION['mail'];?>">
		<input type="text" name="mail" placeholder="E-mail" value="<?php echo $_SESSION['mail'];?>">
		<p>Welke mode wil je?</p>
		<select name="dlm">
			<option value="dark">Dark mode</option>
			<option value="light">Light mode</option>
		</select>
		<input type="file" name="file">
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
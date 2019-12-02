<?php 
require 'core/init.php';

if (isset($_POST['submit'])){

    if (isset($_POST['mailuid'])) {
        $gebruikersnaam = $_POST['mailuid'];
    } else {
        $gebruikersnaam = NULL;
    }

    if (isset($_POST['ww'])) {
        $wachtwoord = $_POST['ww'];
    } else {
        $wachtwoord = NULL;
    }
	
    if (empty($gebruikersnaam) || empty($wachtwoord)){
		header("Location: ../login.php?error=legeVelden");
		exit();
    }
	if($login->bestaatAl($gebruikersnaam)){
		$sql = "SELECT ww FROM accounts WHERE gebruikersnaam='$gebruikersnaam'";
		$resultaat = $db->query($sql);
		foreach($resultaat as $row) {
			$wwg = $row['ww'].'';
		}
	} else {
		header("Location: ../login.php?error=foutLogin");
		exit();
	}

    if($login->login($gebruikersnaam, $wachtwoord, $wwg)){
        session_start();
        $_SESSION['gebruiker'] = $gebruikersnaam;
		header("Location: ../persoonlijkePagina.php");
    } else { 
        header("Location: ../login.php?error=foutLogin");
        exit();
    }

} else {
    header("Location: ../login.php");
    exit();
}

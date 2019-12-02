<?php 
require 'core/init.php';

if (isset($_POST['submit'])) {

    if (isset($_POST['uid'])) {
        $gebruikersnaam = $_POST['uid'];
    } else {
        $gebruikersnaam = NULL;
    }

    if (isset($_POST['mail'])) {
        $email = $_POST['mail'];
    } else {
        $email = NULL;
    }

    if (isset($_POST['ww'])) {
        $wachtwoord = $_POST['ww'];
    } else {
        $wachtwoord = NULL;
    }

    if (isset($_POST['wwh'])) {
        $wachtwoordherhaal = $_POST['wwh'];
    } else {
        $wachtwoordherhaal = NULL;
    }    

    $darkOfLight = $_POST['dlm'];

    if (empty($gebruikersnaam) || empty($email) || empty($wachtwoord) || empty($wachtwoordherhaal)) {
		header("Location: ../aanmelden.php?error=legeVelden&uid=".$gebruikersnaam."&mail=".$email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $gebruikersnaam)){
		header("Location: ../aanmelden.php?error=foutEmailGebruikersnaam&uid=".$gebruikersnaam."&mail".$email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../aanmelden.php?error=foutEmail");
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $gebruikersnaam)) {
		header("Location: ../aanmelden.php?error=foutGebruikersnaam");
        exit();
    } else if ($wachtwoordherhaal !== $wachtwoord) {
        header("Location: ../aanmelden.php?error=wachtwoordenVerkeerd");
        exit();
    } else {
        if ($login->gebruikerBestaatAl($gebruikersnaam)) {
            header("Location: ../aanmelden.php?error=gebruikerBestaatAl");
            exit();
		} else if ($login->emailBestaatAl($wachtwoord)) {
			header("Location: ../aanmelden.php?error=emailBestaatAl");
			exit();
        } else {
            $login->aanmelden($gebruikersnaam, $wachtwoord, $email, $darkOfLight);
            header("Location: ../persoonlijkePagina.php");
            exit();
        }
    }
} else {
    header("Location: ../aanmelden.php");
    exit();
}
?>

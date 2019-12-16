<?php
include 'core/init.php';
session_start();

if (isset($_POST['submit'])) {

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

    if (empty($email) || empty($wachtwoord)) {
		header("Location: ../pasGegevensAan.php?error=legeVelden&mail=".$email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../pasGegevensAan.php?error=foutEmail");
        exit();
	} else if ($login->emailBestaatAl($email) && ($email != $_SESSION['mail'])){
		header("Location: ../pasGegevensAan.php?error=emailBestaatAl");
        exit();
    } else {
			$login->insert($email, $wachtwoord, $_SESSION['gebruiker']);
			$_SESSION['mail'] = $email;
			$_SESSION['ww'] = $wachtwoord;
            header("Location: ../persoonlijkePagina.php");
            exit();
    }
} else {
    header("Location: ../aanmelden.php");
    exit();
}
?>
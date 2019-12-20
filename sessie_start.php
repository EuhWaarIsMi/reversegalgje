<?php
$db = new PDO("sqlite:D:/school/Informatica/PHP/root/phplite/reversegalgjeWOORDENVRAGEN.sqlite");	//maak verbinding met de database
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//zorgt voor duidelijkere errors

require "variables.php";	//zorgt dat we de variabelen van variables.php ook hier kunnen gebruiken
$beurten = 12;	//geeft de variabele beurten een waarde van 10
$db->beginTransaction();
$sql= "DROP TABLE ".$sessie;
$db->query($sql);
$sql= "DROP TABLE ".$kansSessie;
$db->query($sql);
$sql = "CREATE TABLE ".$sessie." AS SELECT id FROM woorden";	//maakt de tabe $sessieen neemt de kollom id over van woorden
$db->query($sql);
$sql = "ALTER TABLE ".$sessie." ADD weg BOOL DEFAULT False";	//voegt de kollom weg toe en zet alle waardes op false
$db->query($sql);
$sql = "ALTER TABLE ".$sessie." ADD laatstWeg BOOL DEFAULT False";	//voegt de kollom laatstWeg toe en zet alle waardes op false
$db->query($sql);
$sql = "CREATE TABLE ".$kansSessie." AS SELECT * FROM vragen";
$db->query($sql);
$db->commit();
header('location:game_test.php?beurten='. $beurten);	//verwijst naar game_test.php en geeft beurten via het url mee
exit()	//stopt het script
?>

<?php
	$db = new PDO("sqlite:R:/root/reversegalgjeWOORDENVRAGEN.sqlite");
  	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	require "variables.php";
	echo $_POST['10'];
	$sql= "DROP TABLE ".$sessie;
	$db->query($sql);
	$sql= "DROP TABLE ".$kansSessie;
	$db->query($sql);
	$sql = "CREATE TABLE ".$sessie." AS SELECT id FROM woorden";
	$db->query($sql);
	$sql = "ALTER TABLE ".$sessie." ADD weg BOOL DEFAULT False";
	$db->query($sql);
	$sql = "ALTER TABLE ".$sessie." ADD laatstWeg BOOL DEFAULT False";
	$db->query($sql);
	$sql = "CREATE TABLE ".$kansSessie." AS SELECT * FROM vragen";
	$db->query($sql);

	header('location: game_test.php');
	exit()
?> 

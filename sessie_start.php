<?php
	include "test.php";
	include "functies.php";
	
	
	$sessie = "test1";
	$sql= "DROP TABLE ".$sessie;
	$db->query($sql);
	$sql = "CREATE TABLE ".$sessie." AS SELECT id FROM woorden";
	$db->query($sql);
	$sql = "ALTER TABLE ".$sessie." ADD weg BOOL DEFAULT False";
	$db->query($sql);
	$sql = "ALTER TABLE ".$sessie." ADD laatstWeg BOOL DEFAULT False";
	$db->query($sql);
	
	KansBerekening($sessie);
?>

<?php
	$beurten = 10;
	$sessie = "test1";
	$kansSessie = "test1". "kans";
	
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
?>

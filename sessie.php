<?php
  $db = new PDO("sqlite:R:/root/phplite/reversegalgjeWOORDENVRAGEN.sqlite");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sessie = "test11";

	$sql = "CREATE TABLE ".$sessie." AS SELECT id FROM woorden";
	$db->query($sql);
	$sql = "ALTER TABLE ".$sessie." ADD weg BOOL DEFAULT False";
	$db->query($sql);
	$sql = "ALTER TABLE ".$sessie." ADD laatstWeg BOOL DEFAULT False";
	$db->query($sql);
?>

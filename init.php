<?php
  $db = new PDO("sqlite:R:/root/reversegalgjeWOORDENVRAGEN.sqlite");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  require "sessie_start.php";
  require "functies.php";
?>

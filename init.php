<?php
  $db = new PDO("sqlite:R:/root/reversegalgjeWOORDENVRAGEN.sqlite");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  ini_set('max_execution_time', 300);

  require "functies.php";
?>

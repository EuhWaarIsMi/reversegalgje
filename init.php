<?php
  $db = new PDO("sqlite:D:/school/Informatica/PHP/root/phplite/reversegalgjeWOORDENVRAGEN.sqlite");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  ini_set('max_execution_time', 300);

  require "sessie_start.php";
  require "functies.php";
?>

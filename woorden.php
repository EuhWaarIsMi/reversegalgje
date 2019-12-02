<?php
  $db = new PDO("sqlite:D:/school/Informatica/PHP/root/phplite/reversegalgjeWOORDENCOMPLEET.sqlite");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $sql = 'SELECT woord FROM woorden';
    // $woordenLijst = $db->query($sql);
    foreach(range('a','z') as $letter){
         for($i = 2; $i<18; $i++){
            $sql = 'INSERT INTO vragen("vraag") VALUES("'.$letter.$getal'")';
            $db->query($sql);
            echo $sql;
            echo"<br>";
         }
    }
echo "einde";
	$db = NULL;
?>

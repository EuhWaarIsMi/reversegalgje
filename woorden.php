<?php
  $db = new PDO("sqlite:R:/root/reversegalgjeWOORDENCOMPLEET.sqlite");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql =  "DELETE FROM vragen WHERE LEN(vraag) = 2"
    // $sql = 'SELECT woord FROM woorden';
    // $woordenLijst = $db->query($sql);
    foreach(range('a','z') as $letter){
         for($i = 1; $i<18; $i++){
            $sql = 'INSERT INTO vragen("vraag") VALUES("'.$letter.$i'")';
            $db->query($sql);
            echo $sql;
            echo"<br>";
         }
    }
echo "einde";
	$db = NULL;
?>

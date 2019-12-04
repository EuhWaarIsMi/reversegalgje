<?php
  $db = new PDO("sqlite:R:/root/phplite/reversegalgjeWOORDENVRAGEN.sqlite");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT woord FROM woorden';
    $woordenLijst = $db->query($sql);
    $id = 1;
     foreach($woordenLijst as $woord) {
//         echo $woord[0]."\t".strlen($woord[0])."\t".$id."<br>";
         	 $sql = 'UPDATE woorden SET "aantalLetters" = '.strlen($woord[0]).' WHERE "id" = '.$id;
              $db->query($sql);
//              echo $sql."<br>";
             // echo $id;
            $id++;
     }
echo "einde";
	$db = NULL;
?>

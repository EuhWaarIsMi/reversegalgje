<?php
	function KansBerekening($sessie, $kansSessie, $db) {


		for($i = 1; $i <= 17; $i++) {
			//aantal letters
			$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (aantalLetters = " .$i.") AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = ". $i;
			$db->query($sql);
			// echo $sql. "<br>";

			foreach(range('a','z') as $letter){
				//a1, b1, ... , a2, etc.
				$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (woord LIKE '".str_repeat("_",$i-1).$letter."%')AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = '".$letter.$i."'";
							// echo $sql."<br>";
							$db->query($sql);
			}
		}

		foreach(range('a','z') as $letter){
			//a, b, etc.
			$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (woord LIKE '%".$letter."%')AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = '".$letter."'";
			$db->query($sql);
		}

		//bepaal hoevaak iets relatief voorkomt
		$sql = "UPDATE test1kans SET percentage = CAST(aantal AS REAL) / (SELECT COUNT(*) FROM vragen)";
		$db->query($sql);
	}



?>

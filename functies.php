<?php
	function KansBerekening($sessie, $kansSessie, $db) {
		$sql = "SELECT woord FROM woorden WHERE id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False')";
		$woordenLijst = $db->query($sql);
		//vul aantal letters rijen in
		for($i = 2; $i <= 17; $i++) {
			$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE aantalLetters = " .$i.") WHERE vraag = ". $i;
			$db->query($sql);
			//echo $sql. "<br>";
			foreach(range('a','z') as $letter){
				$sql = "";
			}
  			
		}
		
//		foreach($woordenLijst as $woord){
//			echo $woord[0]."<br>";
//		}
	}
?>
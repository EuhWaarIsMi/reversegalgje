<?php
	function KansBerekening($sessie, $kansSessie, $db) {
		$sql = "SELECT woord FROM woorden WHERE id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False')";
		$woordenLijst = $db->query($sql);
		//vul aantal letters rijen in
		for($i = 2; $i <= 17; $i++) {
			$sql = "INSERT INTO ". $kansSessie. "() VALUES ((SELECT COUNT(*) FROM woorden WHERE aantalLetters = " .$i."))";
			//$db->query($sql);
			echo $sql;
		}
		
//		foreach($woordenLijst as $woord){
//			echo $woord[0]."<br>";
//		}
	}
?>
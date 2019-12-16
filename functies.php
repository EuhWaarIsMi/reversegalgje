<?php
	function KansBerekening($sessie, $kansSessie, $db) {
		for($i = 1; $i <= 17; $i++) {
			//aantal letters
			$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (aantalLetters = " .$i.") AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = ". $i;
			 $db->query($sql);
			foreach(range('a','z') as $letter){
				//a1, b1, ... , a2, etc.
				$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (woord LIKE '".str_repeat("_",$i-1).$letter."%')AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = '".$letter.$i."'";
//							 $db->query($sql);
			}
		}
		foreach(range('a','z') as $letter){
			//a, b, etc.
			$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (woord LIKE '%".$letter."%')AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = '".$letter."'";
//			$db->query($sql);
		}
		//bepaal hoevaak iets relatief voorkomt
		$sql = "UPDATE test1kans SET percentage = aantal * 100 / (SELECT COUNT(*) FROM woorden WHERE id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))";
		$db->query($sql);
	}

	function KiesVraag($sessie, $kansSessie, $db){
		$minPerc = 50;
		$maxPerc = 50;
		do {
			$maxPerc += 10;
			$minPerc -= 10;
			//zet query getal om in int
			$aantalInPercQuery = $db->query("SELECT COUNT(*) FROM ". $kansSessie ." WHERE percentage >= ". $minPerc. " AND percentage <= ". $maxPerc);
			$aantalInPerc_row = $aantalInPercQuery->fetch(PDO::FETCH_ASSOC);
			$aantalInPerc = $aantalInPerc_row['COUNT(*)'];
			//het werkt nu, alleen nog ff bepalen uit hoeveel hij kan kiezen
			//aight het werkt nu nog beter
		} while($aantalInPerc < 5);

		$sql = "SELECT vraag FROM ". $kansSessie. " WHERE percentage >= ". $minPerc. " AND percentage <=". $maxPerc ." ORDER BY RANDOM() LIMIT 1 ";
		$vraagArray = $db->query($sql);
		foreach ($vraagArray as $row) {
			$GLOBALS['vraag'] = $row[0];	//globals zorgt ervoor $vraag in de global scope van game_test kan worden gebruikt
		}
	}

	function Stelvraag($vraag){
		if (is_numeric($vraag)){	//1,2,3,...
			$GLOBALS['vraagVolledig'] = "Heeft het woord ".$vraag." letters?";
		}
		else if(strlen($vraag)==2){		//a1,a2,a3,...,b1,...
			$GLOBALS['vraagVolledig'] = "Heeft het woord een ".strtoupper(substr($vraag,0,1))." op de ".substr($vraag,1)."e plek?";
		}
		else{	//a,b,c,...
			$GLOBALS['vraagVolledig'] = "Heeft het woord een ".strtoupper($vraag)."?";
		}
	}

	function StreepVragenWeg($db, $antwoord, $vraag, $sessie){
		if (is_numeric($vraag)){	//1,2,3
			if ($antwoord == 'ja'){
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE aantalLetters != ".$vraag." AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) ";
				$db->query($sql);
				
				//streept lengte + 1 weg, wtf??
			}
			else{
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE aantalLetters = ".$vraag." AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) ";
				$db->query($sql);
			}
		}
		else if(strlen($vraag)==2){	//a1,a2,a3,...,b1....
			if ($antwoord == 'ja'){
				
			}
			else{
				
			}
		}
		else{	//a,b,c,...
			if ($antwoord == 'ja'){
				
			}
			else{
				
			}
		}
		
	}
?>

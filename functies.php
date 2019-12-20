<?php
	function KansBerekening($sessie, $kansSessie, $db) { //rekent voor elke vraag uit hoeveel procent van de woorden kunnen worden weggestreept
		//maakt de funcite KansBerekening met sessie, kanssessie en db als parameters worden gebruikt
		//de funcite kan door de include in game_test.php worden gebruikt.
		$db->beginTransaction();	//van af hier worden alle queries als het ware verzamelt om ze latet in een keer uit te voeren
		for($i = 1; $i <= 17; $i++) {	//maakt $1 eerst 1 en maakt $i elke keer een groter tot $i 17 is. Gaat tot en met 17, omdat er maximaal 17 letters zijn
			//aantal letters vraag, dus $vraag wordt 1, 2, 3, etc.
			$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (aantalLetters = " .$i.") AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = ". $i;
			//telt hoeveel woorden $i letters hebben en nog meedoen en zet dit aantal in de database
			$db->query($sql);	//voert de query nog niet uit, maar voegt hem toe aan de 'verzameling'
			foreach(range('a','z') as $letter){		//loopt van a tot en met z
				//$letter op $i plek vraag, dus $vraag is bv a1, a2, ..., b1 etc.
				$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (woord LIKE '".str_repeat("_",$i-1).$letter."%') AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = '".$letter.$i."'";
				//telt hoeveel woorden aan een voorwaarde zoals een a op de tweede plek (a2) voldoen. Dit gebeurt met LIKE en str_repeat. LIKE omdat het maar om één letter gaat en str_repeat om de
				//hoeveelheid underscores aan te passen zodat de juiste locatie kan worden gekozen.
				$db->query($sql);
			}
		}
		foreach(range('a','z') as $letter){
			//zit $letter in het woord vraag, dus bv a, b, c etc.
			$sql = "UPDATE ". $kansSessie. " SET aantal = (SELECT COUNT(*) FROM woorden WHERE (woord LIKE '%".$letter."%')AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) WHERE vraag = '".$letter."'";	//gebruikt weer LIIKE om te kijjken of een letter er in zit. De plaats maakt niet uit, dus aan beide kanten %
			$db->query($sql);
		}
		//bepaal hoevaak iets relatief voorkomt
		$sql = "UPDATE test1kans SET percentage = aantal * 100 / (SELECT COUNT(*) FROM woorden WHERE id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))";
		//rekent uit hoeveel procent van de woorden met elke vraag kan worden weggestreept door aantal te delen door het totaal aantal medoende woorden
		$db->query($sql);
		$db->commit();	//De 'verzameling'queries wordt uitgevoerd
	}
	function KiesVraag($sessie, $kansSessie, $db, $beurten){	//deze functie kiest van de percentages een vraag uit
		$minPerc = 50;	//minimale en maximale percentage waar de vraag tussen moet zitten
		$maxPerc = 50;
		$sql = "SELECT COUNT(*) FROM ". $sessie." WHERE weg = 'False'";	//telt hoeveel woorden nog meedoen
		$woordenArray = $db->query($sql);
		foreach ($woordenArray as $row) {	//het resultaat van de query is een multidimentionale array, maar we hebben maar één getal nodig.
											//er wordt door $woordenArray geloopt en elke loop wordt de volgende waarde gepakt. Dit gebeurt hier maar één keer.
			$aantalWoorden = $row[0];		//$woordenArray is een multimentionale array, dus is $aantalWoorden ook een array dus moet index 0 worden gebruikt
		}
		$db->beginTransaction();
		if ($beurten == 1 || $aantalWoorden <= 2)  {	//als het de laatste beurt is of er twee of minder woorden mee doen, wordt een woord geraden
			$sql = "SELECT woord FROM woorden WHERE id = (SELECT id FROM ". $sessie. " WHERE weg = 'False' ORDER BY RANDOM() LIMIT 1)";	//selecteert een willekeurig woord voor het geval er twee zijn
			$vraagArray = $db->query($sql);
			foreach ($vraagArray as $row) {
				$GLOBALS['vraag'] = $row[0];	//$GLOBALS zorgt ervoor dat ook in de global scope van bv game_test de variabele gebruikt kan worden
			}
		}
		else {	//geen woord vragen, maar een gewone vraag stellen
			do {	//wordt in ieder geval 1 keer uitgevoerd en wordt verder geloopt tot er aan de voorwaarde in while wordt voldaan
				$maxPerc += 10;	//zorgt dat de vraag de eerste keer 40% tot 60% moet wegstrepen, daarna 30% tot 70% etc. voor als er te weinig geschikte vragen zijn
				$minPerc -= 10;
				//zet query getal om in int
				$aantalInPercQuery = $db->query("SELECT COUNT(*) FROM ". $kansSessie ." WHERE percentage >= ". $minPerc. " AND percentage <= ". $maxPerc);
				$aantalInPerc_row = $aantalInPercQuery->fetch(PDO::FETCH_ASSOC);
				$aantalInPerc = $aantalInPerc_row['COUNT(*)'];
				//het werkt nu, alleen nog ff bepalen uit hoeveel hij kan kiezen
				//aight het werkt nu nog beter
			} while($aantalInPerc < 2);	//de loop wordt herhaalt
			$sql = "SELECT vraag FROM ". $kansSessie. " WHERE percentage >= ". $minPerc. " AND percentage <=". $maxPerc ." ORDER BY RANDOM() LIMIT 1 ";
			//kiest een willekeurige vraag die aan de voorwaarden voldoet
			$vraagArray = $db->query($sql);
			foreach ($vraagArray as $row) {
				$GLOBALS['vraag'] = $row[0];	//globals zorgt ervoor $vraag in de global scope van game_test kan worden gebruikt
			}
		}
		$db->commit();
	}
	function Stelvraag($vraag){	//maakt van $vraag een vraag in gewone taal die als vraagVolledig in game_test.php wordt gebruikt
		if (is_numeric($vraag)){	//1,2,3,...
			$GLOBALS['vraagVolledig'] = "Heeft het woord ".$vraag." letters?";
		}
		else if (is_numeric(substr($vraag, 1, 1)) == False && strlen($vraag) > 1){	//kijkt of de vraag een mogelijk woord is
			$GLOBALS['vraagVolledig'] = "Is je woord ". $vraag. "?";
		}
		else if (strlen($vraag) >= 2){		//a1,a2,a3,...,b1,...
			$GLOBALS['vraagVolledig'] = "Heeft het woord een ".strtoupper(substr($vraag,0,1))." op de ".substr($vraag,1)."e plek?";
		}
		else{	//a,b,c,...
			$GLOBALS['vraagVolledig'] = "Heeft het woord een ".strtoupper($vraag)."?";
		}
	}
	function StreepVragenWeg($db, $antwoord, $vraag, $sessie){	//verwerkt het antwoord door wooren weg te strepen
		if (is_numeric($vraag)){	//1,2,3
			if ($antwoord == 'ja'){
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE aantalLetters != ".$vraag." AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) ";
				$db->query($sql);
			}
			else {
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE aantalLetters = ".$vraag." AND (id IN (SELECT id FROM ".$sessie. " WHERE weg = 'False'))) ";
				$db->query($sql);
			}
		}
		else if(is_numeric(substr($vraag, 1, 1)) == False && strlen($vraag) > 1) {	//heel woord
			$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE woord = '". $vraag. "')";
			$db->query($sql);
		}
		else if(strlen($vraag) >= 2){	//a1,a2,a3,...,b1....
			$letter = substr($vraag, 0, 1);
			$letterPositie = substr($vraag, 1);
			if ($antwoord == 'ja'){
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE woord NOT LIKE '".str_repeat("_",$letterPositie-1).$letter."%') ";
				$db->query($sql);
			}
			else {
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE woord LIKE '".str_repeat("_",$letterPositie-1).$letter."%') ";
				$db->query($sql);
			}
		}
		else {	//a,b,c,...
			if ($antwoord == 'ja'){
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id NOT IN (SELECT id FROM woorden WHERE woord LIKE '%".$vraag."%')";
				$db->query($sql);
			}
			else{
				$sql = "UPDATE ".$sessie." SET weg = 'True', laatstWeg = 'True' WHERE id IN (SELECT id FROM woorden WHERE woord LIKE '%".$vraag."%')";
                $db->query($sql);
			}
		}
	}
?>
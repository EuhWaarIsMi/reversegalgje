<?php
	include "test.php";
	
	
	function KansBerekening($sessie) {
		$sql = "SELECT id FROM ".$sessie. " WHERE weg = 'False'";
		
	}
?>
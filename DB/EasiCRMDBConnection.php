<?php

	require_once('easiCRMDB.php');

	$easiDB = easiCRMDB::getInstance();
	$easiDB->connect();
	
	/***** RETRIEVE LIST OF CLIENTS *****/
	
	// $sql = "SELECT * FROM IFR_LST_PRODUITS";
	// $stmt = $conn->query($sql);
	
	// echo "<br />Below, the list of all the retrieved products : <br />";
	
	// while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// echo utf8_decode($row['NAME']) . "<br />";
	// }
	
?>
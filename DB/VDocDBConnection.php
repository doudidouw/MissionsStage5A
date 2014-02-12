<?php

	function connect(){
		$serverName = "SRVVDOCGED";
		$database = "vdocopen";
		$username = "vdoc";
		$password = "vdocadmin";
		$conn = null;
		
		try{
			$conn = new PDO("sqlsrv:Server=$serverName;Database=" .$database, $username, $password);
			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			echo "You're now connected to ". $serverName ." SQL Server.<br />";
		}
		catch(Exception $e)     {
			die( print_r( $e->getMessage() ) ); 
		}
		
		/***** RETRIEVE LIST OF CLIENTS *****/
		
		$sql = "SELECT * FROM IFR_LST_PRODUITS";
		$stmt = $conn->query($sql);
		
		echo "<br />Below, the list of all the retrieved products : <br />";
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo utf8_decode($row['NAME']) . "<br />";
		}
	}
	
?>
<?php
    $action = $_REQUEST['action']; 
	
	// Decode JSON object into readable array
	$userData = array();
	parse_str($_REQUEST['formData'], $userData);

	
	// Get data from object
    $username = $userData['username']; 
    $password = $userData['password']; 
	
	echo $username;
?>
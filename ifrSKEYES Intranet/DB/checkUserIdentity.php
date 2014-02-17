<?php
    $action = $_REQUEST['action']; 
	
	// Decode JSON object into readable array
	$userData = array();
	parse_str($_REQUEST['formData'], $userData);

	
	// Get data from object
    $login = $userData['login']; 
    $password = $userData['password']; 
	
	echo json_encode(1);
?>
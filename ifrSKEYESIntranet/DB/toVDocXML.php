<?php

require_once('../xmlRequests/VDocXML.php');

if (isset($_REQUEST['method'])) {
    
    if (($_REQUEST['method'] == 'authenticate') && (isset($_REQUEST['formData']))){
        $xmlRequests = new xmlRequests();
        $userData = array();
        parse_str($_REQUEST['formData'], $userData);
        echo json_encode($xmlRequests->authenticate($userData['login'], $userData['password']));
    } else if(($_REQUEST['method'] == 'getProtocolURIs') && (isset($_REQUEST['sessionKey']))){
        $xmlRequests = new xmlRequests();
        echo json_encode($xmlRequests->getProtocolURIs($_REQUEST['sessionKey']));
    } else if(($_REQUEST['method'] == 'getNotesDeFrais') && (isset($_REQUEST['sessionKey']))){
        $xmlRequests = new xmlRequests();
        echo json_encode($xmlRequests->getNotesDeFrais($_REQUEST['sessionKey']));
    } else if(($_REQUEST['method'] == 'getOM') && (isset($_REQUEST['sessionKey']))){
        $xmlRequests = new xmlRequests();
        echo json_encode($xmlRequests->getOM($_REQUEST['sessionKey']));
    }
    
}

?>
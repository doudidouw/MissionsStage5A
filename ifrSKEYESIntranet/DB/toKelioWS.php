<?php

require_once('../WS/KelioWS.php');

if (isset($_REQUEST['method'])) {

    if (($_REQUEST['method'] == 'getEmployeePrivateDataFromUser') && (isset($_REQUEST['firstname'])) && (isset($_REQUEST['lastname']))){
        $kelioWS = new KelioWS();
        echo json_encode($kelioWS->getEmployeePrivateDataFromUser($_REQUEST['firstname'], $_REQUEST['lastname']));
    } 
}
?>

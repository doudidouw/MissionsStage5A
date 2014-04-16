<?php

require_once('../WS/KelioWS.php');

if (isset($_REQUEST['method'])) {

    if (($_REQUEST['method'] == 'getEmployeePrivateDataFromUser') && (isset($_REQUEST['firstname'])) && (isset($_REQUEST['lastname']))){
        $kelioWS = new KelioWS();
        echo json_encode($kelioWS->getEmployeePrivateDataFromUser($_REQUEST['firstname'], $_REQUEST['lastname']));
    } else if (($_REQUEST['method'] == 'importClocking') && (isset($_REQUEST['firstname'])) && (isset($_REQUEST['lastname'])) && (isset($_REQUEST['inOut']))) {
        $kelioWS = new KelioWS();
        echo json_encode($kelioWS->importClocking($_REQUEST['firstname'], $_REQUEST['lastname'], $_REQUEST['inOut']));
    } else if (($_REQUEST['method'] == 'getEmployeeProfessionalDataFromUser') && (isset($_REQUEST['firstname'])) && (isset($_REQUEST['lastname']))){
        $kelioWS = new KelioWS();
        echo json_encode($kelioWS->getEmployeeProfessionalDataFromUser($_REQUEST['firstname'], $_REQUEST['lastname']));
    }
}
?>

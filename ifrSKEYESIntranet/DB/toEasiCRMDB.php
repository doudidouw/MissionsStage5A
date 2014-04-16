<?php

if (isset($_REQUEST['method'])) {

    ini_set('soap.wsdl_cache_enabled', 0);

    $service = new SoapClient("http://localhost/MissionsStage5A/ifrSKEYESIntranet/WS/EasiCRMWS.wsdl");

    if (($_REQUEST['method'] == 'getOnGoingOpportunities') && (isset($_REQUEST['firstname'], $_REQUEST['lastname']))) {
        $res = $service->getOnGoingOpportunities($_REQUEST['firstname'], $_REQUEST['lastname']);
        echo json_encode($res);
    } else if(($_REQUEST['method'] == 'getCompaniesForUser')&& (isset($_REQUEST['firstname'], $_REQUEST['lastname']))){
        $res = $service->getCompaniesForUser($_REQUEST['firstname'], $_REQUEST['lastname']);
        echo json_encode($res);
    } else if($_REQUEST['method'] == 'getContacts'){
        $res = $service->getContacts();
        echo json_encode($res);
    } else if(($_REQUEST['method'] == 'getMesRelances') && (isset($_REQUEST['firstname'], $_REQUEST['lastname']))){
        $res = $service->getMesRelances($_REQUEST['firstname'], $_REQUEST['lastname']);
        echo json_encode($res);
    } 
}
?>
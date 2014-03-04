<?php

if (isset($_REQUEST['method'])) {

    ini_set('soap.wsdl_cache_enabled', 0);

    $service = new SoapClient("http://localhost/MissionsStage5A/ifrSKEYESIntranet/WS/EasiCRMWS.wsdl");

    if ($_REQUEST['method'] == 'getOnGoingOpportunities' /*&& isset($_REQUEST['username'], $_REQUEST['password'])*/) {
        $res = $service->getOnGoingOpportunities();
        echo json_encode($res);
    } else if($_REQUEST['method'] == 'getCompaniesForUser'){
        $res = $service->getCompaniesForUser();
        echo json_encode($res);
    }
}
?>
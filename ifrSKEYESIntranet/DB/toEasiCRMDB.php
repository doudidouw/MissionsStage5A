<?php

if (isset($_REQUEST['method'])) {

    ini_set('soap.wsdl_cache_enabled', 0);

    $service = new SoapClient("http://localhost/MissionsStage5A/ifrSKEYESIntranet/WS/EasiCRMWS.wsdl");

    if ($_REQUEST['method'] == 'login' && isset($_REQUEST['username'], $_REQUEST['password'])) {
        $res = $service->login($_REQUEST['username'], $_REQUEST['password']);
        echo json_encode($res);
        
    } 
}
?>
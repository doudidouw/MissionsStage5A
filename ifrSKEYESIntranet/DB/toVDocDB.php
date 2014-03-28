<?php

if (isset($_REQUEST['method'])) {

    ini_set('soap.wsdl_cache_enabled', 0);

    $service = new SoapClient("http://localhost/MissionsStage5A/ifrSKEYESIntranet/WS/VDocWS.wsdl");

    if ($_REQUEST['method'] == 'getNewsTitles') {
        $res = $service->getNewsTitles();
        echo json_encode($res);
    } else if($_REQUEST['method'] == 'getContacts'){
        $res = $service->getContacts();
        echo json_encode($res);
    } else if(($_REQUEST['method'] == 'getUserProfile') && isset($_REQUEST['login'])){
        $res = $service->getUserProfile($_REQUEST['login']);
        echo json_encode($res);
    } 
}
?>

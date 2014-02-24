<?php

    require_once('../DB/VDocDB.php');

    class VDocWS {

        function getNewsTitles(){
            $vdocDB = VDocDB::getInstance();

            $sql = "SELECT * FROM NWS2_JDO_NEWS WHERE DIGEST LIKE 'Voici la trame 2014 des entretiens annuels !'";
            $stmt = $vdocDB->select($sql);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;

        }

    }

    /* * ** Serveur SOAP *** */


    ini_set('soap.wsdl_cache_enabled', 0);

    $serversoap = new SoapServer("http://localhost/MissionsStage5A/ifrSKEYESIntranet/WS/VDocWS.wsdl");
    $serversoap->setClass('VDocWS');
    $serversoap->handle();

//    $vdocWS = new VDocWS();
//    var_dump($vdocWS->getNewsTitles());
	
?>
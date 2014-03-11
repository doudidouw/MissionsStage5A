<?php

    require_once('../DB/VDocDB.php');

    class VDocWS {

        function getNewsTitles(){
            $vdocDB = VDocDB::getInstance();

            $sql = "SELECT DIGEST, PUBLISHING_DATE, CONVERT(char(10), PUBLISHING_DATE, 103) AS PUBLISHING_DATE_CONVERTED, CONTENT FROM         NWS2_JDO_NEWS ORDER BY PUBLISHING_DATE DESC";
            $stmt = $vdocDB->select($sql);

            $i = 0;
            $newsList = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $newsList[$i] = $row;
                $i++;
            }
            
            foreach($newsList as &$news){
                $news['CONTENT'] = preg_replace('/src="(.*?)"/', 'src="http://srvvdocged.ifrfrance.com/vdoc/\1"', $news['CONTENT']);
            }
            unset($news);
            
            return $newsList;

        }
        
        function getContacts(){
            $vdocDB = VDocDB::getInstance();

            $sql = "SELECT login, first_name, last_name, email FROM vdp_users";   
            $stmt = $vdocDB->select($sql);

            $contacts = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $row;
            }

            return $contacts;

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
<?php

    require_once('../DB/VDocDB.php');

    class VDocWS {

        function getNewsTitles(){
            $vdocDB = VDocDB::getInstance();

            $sql = "SELECT DIGEST, PUBLISHING_DATE, CONVERT(char(10), PUBLISHING_DATE, 103) AS PUBLISHING_DATE_CONVERTED, CONTENT FROM         NWS2_JDO_NEWS WHERE STATE=4 ORDER BY PUBLISHING_DATE DESC";
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

            $sql = "SELECT DISTINCT EMAIL, FIRSTNAME, LASTNAME, LOGIN, MOBILE_PHONE_NUMBER, DIR_USER_ID 
            FROM DIR_USER 
            WHERE (IS_CONNECTION_ALLOWED = 'True') AND (FIRSTNAME NOT LIKE '%prd%') AND (FIRSTNAME NOT LIKE '%unknown%') AND (FIRSTNAME NOT LIKE '%test%') AND (FIRSTNAME NOT LIKE '%ystem%') AND (FIRSTNAME NOT LIKE '%ext%') AND (FIRSTNAME NOT LIKE '%Anonymous%') AND (FIRSTNAME NOT LIKE '%tomcat%') AND (FIRSTNAME NOT LIKE '%tlm%') AND (FIRSTNAME NOT LIKE '%pcg%') AND (FIRSTNAME NOT LIKE '%vdoc%') AND (FIRSTNAME NOT LIKE '%nom%') AND (FIRSTNAME NOT LIKE '%migread%') AND (FIRSTNAME NOT LIKE '%nemis%') AND (FIRSTNAME NOT LIKE '%ifr%') AND (FIRSTNAME NOT LIKE '%demo%') AND (FIRSTNAME NOT LIKE '%Client%') AND (FIRSTNAME NOT LIKE '%marilyn%') AND (FIRSTNAME NOT LIKE '%kelio%') AND (FIRSTNAME NOT LIKE '%hudson%')";   
            $stmt = $vdocDB->select($sql);

            $contacts = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $row;
            }

            return $contacts;

        }
        
        function getUserProfile($login){
            $url = "http://srvvdocged.ifrfrance.com/vdoc/portal/action/SimpleDownloadActionEvent/oid/";
            $vdocDB = VDocDB::getInstance();

            $sql = "SELECT LASTNAME, FIRSTNAME, LOGIN, PHOTO, CONVERT(char(10), ACTIVATION_DATE, 103) AS ACTIVATION_DATE_CONVERTED, CITY, COUNTRY, CONTRACT_TYPE, EMAIL, CONVERT(char(10), LAST_VISITE, 103) AS LAST_VISIT_CONVERTED FROM DIR_USER 
            WHERE LOGIN LIKE '" .$login. "'";   
            $stmt = $vdocDB->select($sql);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['PHOTO'] != null){
                $row['PHOTO'] = $url.$row['PHOTO'];
            } 

            return $row;
            
        }

    }

    /* * ** Serveur SOAP *** */


    ini_set('soap.wsdl_cache_enabled', 0);

    $serversoap = new SoapServer("http://localhost/MissionsStage5A/ifrSKEYESIntranet/WS/VDocWS.wsdl");
    $serversoap->setClass('VDocWS');
    $serversoap->handle();

//    $vdocWS = new VDocWS();
//    var_dump($vdocWS->getUserProfile("fdu"));
	
?>
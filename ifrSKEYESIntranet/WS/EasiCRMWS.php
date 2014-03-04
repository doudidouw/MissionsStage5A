<?php

	require_once('../DB/EasiCRMDB.php');

    class EasiCRMWS {
        
        function getCompanies(){
            $easiDB = EasiCRMDB::getInstance();
            
            $sql = "SELECT Id, XSocit FROM S_CRM_Socitscl ORDER BY XSocit";
            
            $stmt = $easiDB->select($sql);
            
            $companies = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }
            
            $stmt->closeCursor();

            return $companies;
        }
        
        function getCompanyNameFromId($companies, $id){
            foreach($companies as $company){
             if(strcmp($company['Id'], $id) == 0){
              return $company['XSocit'];   
             }
            }
        }
        
        function getContacts(){
            $easiDB = EasiCRMDB::getInstance();
            
            $sql = "SELECT Id, XNom, XPrnom, XTitre, XMail, XTl, XContact, XActif, XClientC FROM S_CRM_Contacts";
            
            $stmt = $easiDB->select($sql);
            
            $contacts = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $row;
            }
            
            $stmt->closeCursor();

            return $contacts;
        }
        
        function getContactFromId($contacts, $id){
            foreach($contacts as $contact){
                if(strcmp($contact['Id'], $id) == 0){
                    return ($contact['XNom']. " " .$contact['XPrnom']);   
                }
            }
        }
        
        function getProgici(){
            $easiDB = EasiCRMDB::getInstance();
            
            $sql = "SELECT XCode, XParamtr FROM S_CRM_Configu2";
            
            $stmt = $easiDB->select($sql);
            
            $progicis = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $progicis[] = $row;
            }
            
            $stmt->closeCursor();

            return $progicis;
        }              
                      
        function getProgiciFromXCode($progicis, $xCode){
            foreach($progicis as $progici){
             if(strcmp($progici['XCode'], $xCode) == 0){
              return ($progici['XParamtr']) ;   
             }
            }
        }
                      
        function getProjets(){
            $easiDB = EasiCRMDB::getInstance();
            
            $sql = "SELECT XCode, XParamtr FROM S_CRM_Configu4";
            
            $stmt = $easiDB->select($sql);
            
            $projets = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $projets[] = $row;
            }
            
            $stmt->closeCursor();

            return $projets;
        }   
        
        function getProjectFromXCode($projets, $xCode){
            foreach($projets as $projet){
             if(strcmp($projet['XCode'], $xCode) == 0){
              return ($projet['XParamtr']) ;   
             }
            }
        }

        function getOnGoingOpportunities(){
            $companies = $this->getCompanies();
            $contacts = $this->getContacts();
            $progici = $this->getProgici();
            $projets = $this->getProjets();
            
            $easiDB = EasiCRMDB::getInstance();

            $sql = "SELECT XCode, XIddelas, XIdConta, XLibell, XProgici, XProjet, XTotalHT, XCAresta, XRestefa, XRestant FROM S_CRM_Opportun                          WHERE XCrpar = 'Florian DUSSOULIER' AND XStatut=0";
            $stmt = $easiDB->select($sql);

            $opportunList = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // check each column if it has numeric value, to cenvert it from "string"
                foreach($row AS $k=>$v) {
                    if(is_numeric($v)) $row[$k] = $v + 0.0;
                }
                $opportunList[] = $row;
            }
            
            $stmt->closeCursor();
            
            foreach($opportunList as &$opportun){
                $opportun['XIddelas'] = $this->getCompanyNameFromId($companies, $opportun['XIddelas']);
                $opportun['XIdConta'] = $this->getContactFromId($contacts, $opportun['XIdConta']);
                $opportun['XProgici'] = $this->getProgiciFromXCode($progici, $opportun['XProgici']);
                $opportun['XProjet'] = $this->getProjectFromXCode($projets, $opportun['XProjet']);
            }
            unset($opportun);

            return $opportunList;

        }
        
        function getOrigins(){
            $easiDB = EasiCRMDB::getInstance();
            
            $sql = "SELECT XCode, XParamtr FROM S_CRM_Origined";
            
            $stmt = $easiDB->select($sql);

            $origins = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $origins[] = $row;
            }
            
            $stmt->closeCursor();
            
            return $origins;
            
        }
        
        function getOriginForCompany($origins, $xCode){
            foreach($origins as $origin){
             if(strcmp($origin['XCode'], $xCode) == 0){
              return ($origin['XParamtr']) ;   
             }
            }
        }
        
        function getLocalisations(){
            $easiDB = EasiCRMDB::getInstance();
            
            $sql = "SELECT Id, NaFR FROM S_CRM_Gographi";
            
            $stmt = $easiDB->select($sql);

            $localisations = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $localisations[] = $row;
            }
            
            $stmt->closeCursor();
            
            return $localisations;
        }
        
        function getLocalisationForCompany($localisations, $Id){
            foreach($localisations as $localisation){
             if(strcmp($localisation['Id'], $Id) == 0){
              return ($localisation['NaFR']) ;   
             }
            }
        }
        
        function getCompaniesForUser(){
            $localisations = $this->getLocalisations();
            $origins = $this->getOrigins();
            $easiDB = EasiCRMDB::getInstance();

            $sql = "SELECT XSocit, XTrigram, XTrigra2, XPays, XContine, XDevisep, XOrigine FROM S_CRM_Socitscl WHERE
                (XRespons = 'Florian DUSSOULIER')";
            $stmt = $easiDB->select($sql);

            $companies = array();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $companies[] = $row;
            }
            
            $stmt->closeCursor();
            
            foreach($companies as &$company){
                $company['XPays'] = $this->getLocalisationForCompany($localisations, $company['XPays']);
                $company['XContine'] = $this->getLocalisationForCompany($localisations, $company['XContine']);
                $company['XOrigine'] = $this->getOriginForCompany($origins, $company['XOrigine']);
            }
            unset($company);
            
            return $companies;
        }

    }

    /* * ** Serveur SOAP *** */


    ini_set('soap.wsdl_cache_enabled', 0);

    $serversoap = new SoapServer("http://localhost/MissionsStage5A/ifrSKEYESIntranet/WS/EasiCRMWS.wsdl");
    $serversoap->setClass('EasiCRMWS');
    $serversoap->handle();

//    $easiCrm = new EasiCRMWS();
//    var_dump($easiCrm->getCompaniesForUser());
    
	
?>
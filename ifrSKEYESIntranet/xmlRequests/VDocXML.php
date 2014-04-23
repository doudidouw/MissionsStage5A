<?php


class xmlRequests {
    
    private $authURL = "http://srvvdocged/vdoc/navigation/sdk?Controller=com.axemble.vdoc.sdk.flow.Dispatcher&module=portal&cmd=authenticate";
    
    private $getTODOURL = "http://srvvdocged/vdoc/navigation/sdk?Controller=com.axemble.vdoc.sdk.flow.Dispatcher&module=workflow&cmd=view&_AuthenticationKey=";      

    function makeRequest($url, $request){
        $server = $url;
        $headers = array
            ("Content-type: text/xml",
            "Content-length: ".strlen($request),
            "Connection: close"
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $data = curl_exec($ch);
        
        if(curl_errno($ch)){
            print curl_error($ch);
            echo("Une erreur s'est produite lors de la requete XML");
        } else {
            curl_close($ch);
        }
        
        return $data;
    }

    function authenticate($login, $pwd) {
        $authXML = new SimpleXMLElement(file_get_contents('authenticate.xml'));
        $authXML->header->addAttribute('login', $login);
        $authXML->header->addAttribute('password', $pwd);
        return $this->makeRequest($this->authURL, $authXML->asXML());
        $response = new SimpleXMLElement($this->makeRequest($this->authURL, $authXML->asXML()));
        if(strcmp($response['status'], "error") == 0){
            return -1;   
        } else {
            return (string)$response->body->token['key'];
        }
    }
    
    function getProtocolURIs($key){
        $tmpCatalogs = array();
        $processesXMLString = file_get_contents('getProtocolURIs.xml', true);
        $response = new SimpleXMLElement($this->makeRequest($this->getTODOURL.$key, $processesXMLString));
        $counter = 0;
        foreach ($response->body->catalog as $catalog) {
            if((strcmp((string)$catalog['label'], "Hot Line Test") == 0) || (strcmp((string)$catalog['label'], "Test") == 0)){
            } else {
                if(strcmp((string)$catalog['label'], "Catalog:Comptabilite:label/fr") == 0){
                    $tmpCatalogs[$counter]['Categorie'] = "Comptabilité";
                } else {
                    $tmpCatalogs[$counter]['Categorie'] = (string)$catalog['label'];
                }
                $tmpCatalogs[$counter]['uri'] = (string)$catalog['protocol-uri'];
                $processArray = array();
                $processCounter = 0;
                foreach ($catalog->workflowcontainer as $wfContainer){
                    if(strcmp((string)$wfContainer['label'], "TheIdeaBox:VersionGroup:IdeaBox:label/fr") == 0){
                        $processArray[$processCounter]['labelProcess'] = "The Idea Box";
                    } else if(strcmp((string)$wfContainer['label'], "Comptabilite:VersionGroup:BonAPayer:label/fr") == 0){
                        $processArray[$processCounter]['labelProcess'] = "Bon à payer";
                    } else {
                        $processArray[$processCounter]['labelProcess'] = (string)$wfContainer['label'];
                    }
                    foreach ($wfContainer->view as $view){
                        if(strcmp((string)$view['name'], "TODO") == 0){
                            $processArray[$processCounter]['uri'] = (string)$view['protocol-uri'];
                        }
                    }
                    $todoListForProcess = $this->getTODOListForProcessAndUser($key, $tmpCatalogs[$counter]['uri'], $processArray[$processCounter]['uri']);
                    $todoArray = array();
                    $todoCounter = 0;
                    foreach ($todoListForProcess->body->resource as $resource){
                        $todoArray[$todoCounter]['ref'] = (string)$resource->header['reference'];
                        $todoArray[$todoCounter]['titre'] = (string)$resource->body->string[1]['value'];
                        $todoArray[$todoCounter]['creator'] = (string)$resource->body->user['first-name']." ".(string)$resource->body->user['last-name'];
                        $todoArray[$todoCounter]['creationDate'] = substr((string)$resource->header['created-date'], 0, 10);
                        $todoCounter++;
                    }
                    
                    $processArray[$processCounter]['todo'] = $todoArray;
                    $processCounter++;
                }
                $tmpCatalogs[$counter]['process'] = $processArray;
                $counter++;
                
            } 
        }
        return $tmpCatalogs;
    }
    
    function getTODOListForProcessAndUser($key, $catalogURI, $processURI){
        $todoXML = new SimpleXMLElement(file_get_contents('getTODOListForProcess.xml', true));
        $todoXML->header->addAttribute('protocol-uri', $processURI);
        $todoXML->header->scopes->catalog->addAttribute('protocol-uri', $catalogURI);
        $response = new SimpleXMLElement($this->makeRequest($this->getTODOURL.$key, $todoXML->asXML()));
        return $response;
    }
    
    function getNotesDeFrais($key){
        $noteDeFrais = array();
        $todoXML = new SimpleXMLElement(file_get_contents('getTODOListForProcess.xml', true));
        $todoXML->header->addAttribute('protocol-uri', 'resource:/process/views/d6w3h3k052iubp4nrr40a');
        $todoXML->header->scopes->catalog->addAttribute('protocol-uri', 'resource:/process/catalogs/jj2zyry9fmqj0x5iscq9');
        $response = new SimpleXMLElement($this->makeRequest($this->getTODOURL.$key, $todoXML->asXML()));
        $counter = 0;
        foreach ($response->body->resource as $resource){
            $noteDeFrais[$counter]['modifie'] = substr((string)$resource->header['created-date'], 0, 10);
            $noteDeFrais[$counter]['ref'] = (string)$resource->header['reference'];
            
            foreach ($resource->body->string as $string){
                switch($string['name']){
                    case "sys_Title" :
                        $noteDeFrais[$counter]['titre'] = (string)$string['value'];
                        break;
                    case "sys_CurrentActors" :
                        $noteDeFrais[$counter]['intervenants'] = (string)$string['value'];
                        break;
                    case "sys_CurrentSteps" :
                        $noteDeFrais[$counter]['etape'] = (string)$string['value'];
                        break;
                    case "DocumentState" :
                        $noteDeFrais[$counter]['etat'] = (string)$string['value'];
                        break;
                    default :
                        break;
                }

            }
            $counter++;
        }
        return $noteDeFrais;
    }
    
    function getOM($key){
        $OM = array();
        $todoXML = new SimpleXMLElement(file_get_contents('getTODOListForProcess.xml', true));
        $todoXML->header->addAttribute('protocol-uri', 'resource:/process/views/d6w3h3k052iubp4nrr5b3');
        $todoXML->header->scopes->catalog->addAttribute('protocol-uri', 'resource:/process/catalogs/km07fsi7qmn558mvasyg');
        $response = new SimpleXMLElement($this->makeRequest($this->getTODOURL.$key, $todoXML->asXML()));
        $counter = 0;
        foreach ($response->body->resource as $resource){
            $OM[$counter]['modifie'] = substr((string)$resource->header['created-date'], 0, 10);
            $OM[$counter]['ref'] = (string)$resource->header['reference'];
            
            foreach ($resource->body->string as $string){
                switch($string['name']){
                    case "sys_Title" :
                        $OM[$counter]['titre'] = (string)$string['value'];
                        break;
                    case "sys_CurrentActors" :
                        $OM[$counter]['intervenants'] = (string)$string['value'];
                        break;
                    case "sys_CurrentSteps" :
                        $OM[$counter]['etape'] = (string)$string['value'];
                        break;
                    case "DocumentState" :
                        $OM[$counter]['etat'] = (string)$string['value'];
                        break;
                    default :
                        break;
                }
            }
            $counter++;
        }
        return $OM;
    }
    

}


$requestsClass = new xmlRequests();
echo($requestsClass->authenticate('doc', 'documentqire'));
////echo($requestsClass->getTODOListForProcessAndUser('fdu'));
////var_dump($requestsClass->getProtocolURIs());
//echo($requestsClass->getTODOListForProcessAndUser('-48fa588f%3A14564d5e090%3A-4b9d','resource:/process/catalogs/km07fsi7qmn558mvasyg', 'resource:/process/views/d6w3h3k052iubp4nrr5b3')->asXML());

?>
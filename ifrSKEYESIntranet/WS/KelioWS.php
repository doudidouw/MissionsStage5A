<?php
 
class KelioWS {

	function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(array($this, 'objectToArray'), $d);
		} else {
			// Return array
			return $d;
		}
	}

    /********** CLOCKINGS BY DATE *********/
    
    function exportClockingsByDate($startDate, $endDate){
        $xmlRequest = "<exportClockingsByDate>
                <populationFilter></populationFilter>
                <groupFilter></groupFilter>
                <startDate>" .$startDate. "</startDate>
                <endDate>" .$endDate. "</endDate>
                </exportClockingsByDate>";

        ini_set('soap.wsdl_cache_enabled', 0);
        $service = new SoapClient("http://srvkelio:8089/open/services/ClockingService?wsdl", 
                                 array( 'trace' => 1,
                                    'use' => SOAP_LITERAL,
                                    'location' => "http://srvkelio:8089/open/services/ClockingService",
                                    'login'     => "wsuser",
                                    'password' => "wsbodet"));
        $params = new SoapVar($xmlRequest, XSD_ANYXML);
        $res = $service->exportClockingsByDate($params);
        $resToArray = $this->objectToArray($res);
        return($resToArray['exportedClockings']);
    }
    
    
    /********** CLOCKINGS BY DATE FOR EMPLOYEE *********/
    
    function exportClockingsByDateForEmployeeList($startDate, $endDate, $firstName, $lastName){
        $xmlRequest = '<exportClockingsByDateForEmployeeList>
                <employeeList>
                <technicalString></technicalString> 
                <employeeKey></employeeKey>
                <employeeBadgeCode></employeeBadgeCode>
                <startDate>' .$startDate. '</startDate>
                <endDate>' .$endDate. '</endDate>
                <employeeIdentificationNumber>B11</employeeIdentificationNumber>
                <errorMessage></errorMessage>
                <employeeSurname></employeeSurname>
                <employeeFirstName></employeeFirstName>
                </employeeList>
                </exportClockingsByDateForEmployeeList>';

        ini_set('soap.wsdl_cache_enabled', 0);
        $service = new SoapClient("http://srvkelio:8089/open/services/ClockingService?wsdl", 
                                 array( 'trace' => 1,
                                    'use' => SOAP_LITERAL,
                                    'location' => "http://srvkelio:8089/open/services/ClockingService",
                                    'login'     => "wsuser",
                                    'password' => "wsbodet"));
        $params = new SoapVar($xmlRequest, XSD_ANYXML);
        $res = $service->exportClockingsByDateForEmployeeList($params);
        $resToArray = $this->objectToArray($res);
        return($resToArray);
    }

    /********** EMPLOYEES PRIVATE DATA *********/

    function exportEmployeesPrivateData(){
        ini_set('soap.wsdl_cache_enabled', 0);
        $service = new SoapClient("http://srvkelio:8089/open/services/EmployeePrivateDataService?wsdl", 
                                    array( 'login'     => "wsuser",
                                                'password' => "wsbodet"));
        $res = $service->exportEmployeePrivateData(array("", ""));
        $resToArray = $this->objectToArray($res);
        return ($resToArray['exportedEmployeePrivateData']['EmployeePrivateData']);
    }
    
    
    /********** EMPLOYEES PROFESSIONAL DATA *********/

    function exportEmployeesProfessionalData(){
        ini_set('soap.wsdl_cache_enabled', 0);
        $service = new SoapClient("http://srvkelio:8089/open/services/EmployeeProfessionalDataService?wsdl", 
                                    array( 'login'     => "wsuser",
                                                'password' => "wsbodet"));
        $res = $service->exportEmployeeProfessionalData(array("", ""));
        $resToArray = $this->objectToArray($res);
        return ($resToArray['exportedEmployeeProfessionalData']['EmployeeProfessionalData']);
    }
	

    /********** SPECIFIC EMPLOYEE PRIVATE DATA *********/

    function getEmployeePrivateDataFromUser($employeeFirstname, $employeeLastname){
        $employeesData = $this->exportEmployeesPrivateData();
        foreach($employeesData as $employee){
            if(($employee['employeeFirstName'] == $employeeFirstname) && ($employee['employeeSurname'] == $employeeLastname)){
                return $employee;
            }
        }
    }
    
    /********** SPECIFIC EMPLOYEE PROFESSIONAL DATA *********/

    function getEmployeeProfessionalDataFromUser($employeeFirstname, $employeeLastname){
        $employeesData = $this->exportEmployeesProfessionalData();
        foreach($employeesData as $employee){
            if(($employee['employeeFirstName'] == $employeeFirstname) && ($employee['employeeSurname'] == $employeeLastname)){
                return $employee;
            }
        }
    }
	
    /********** POPULATION DESCRIPTION *********/

    function exportPopulationDescriptions(){
        ini_set('soap.wsdl_cache_enabled', 0);
        $service = new SoapClient("http://srvkelio:8089/open/services/PopulationService?wsdl", 
                                 array('login'     => "wsuser",
                                             'password' => "wsbodet"));
        $res = $service->exportPopulationDescriptions();
        $resToArray = $this->objectToArray($res);
        return ($resToArray['exportedPopulationDescriptions']);
    }
	

    /********** ORGANIZATION CHART LEVELS *********/
	
    function exportOrganizationChartLevels(){
         ini_set('soap.wsdl_cache_enabled', 0);
         $service = new SoapClient("http://srvkelio:8089/open/services/OrganizationChartLevelService?wsdl", 
                                     array( 'login'     => "wsuser",
                                                 'password' => "wsbodet"));
         $res = $service->exportOrganizationChartLevels();
         $resToArray = $this->objectToArray($res);
         return($resToArray['exportedOrganizationChartLevels']);
    }

    /********** ORGANIZATION CHART LEVEL DESCRIPTIONS *********/
	
    function exportOrganizationChartLevelDescriptions(){
         ini_set('soap.wsdl_cache_enabled', 0);
         $service = new SoapClient("http://srvkelio:8089/open/services/OrganizationChartLevelDescriptionService?wsdl", 
                                     array( 'login'     => "wsuser",
                                                 'password' => "wsbodet"));
         $res = $service->exportOrganizationChartLevelDescriptions();
         $resToArray = $this->objectToArray($res);
         return($resToArray['exportedOrganizationChartLevelDescriptions']);
    }
    
    /********** IMPORT CLOCKINGS FOR EMPLOYEE *********/
    
    function importClocking($firstName, $lastName, $inOut){
        //Entree : 1, Sortie : 2
        $xmlRequest = '<importPhysicalClockings>
                <clockingsToImport>
                    <absenceTypeAbbreviation></absenceTypeAbbreviation> 
                    <overtimeTypeAbbreviation></overtimeTypeAbbreviation>
                    <automatic></automatic>
                    <technicalString></technicalString>
                    <clockingKey></clockingKey> 
                    <readerKey></readerKey>
                    <absenceTypeKey></absenceTypeKey>
                    <overtimeTypeKey></overtimeTypeKey>
                    <employeeKey></employeeKey>
                    <terminalKey></terminalKey>
                    <employeeBadgeCode></employeeBadgeCode>
                    <date>' .date("Y-m-d"). '</date>
                    <inOutIndicator>' .$inOut. '</inOutIndicator>
                    <geolocationStatus></geolocationStatus>
                    <time>' .date("H:i:s"). '</time>
                    <clockingTypeIndicator></clockingTypeIndicator>
                    <latitude></latitude>
                    <readerDescription></readerDescription>
                    <absenceTypeDescription></absenceTypeDescription>
                    <overtimeTypeDescription></overtimeTypeDescription>
                    <terminalDescription></terminalDescription>
                    <longitude></longitude>
                    <employeeIdentificationNumber></employeeIdentificationNumber>
                    <errorMessage></errorMessage>
                    <obtainingMode></obtainingMode>
                    <employeeSurname>' .$lastName. '</employeeSurname>
                    <timePosition></timePosition>
                    <geolocationPrecision></geolocationPrecision>
                    <employeeFirstName>' .$firstName. '</employeeFirstName>
                </clockingsToImport>
                </importPhysicalClockings>';
        
        ini_set('soap.wsdl_cache_enabled', 0);
        $service = new SoapClient("http://srvkelio:8089/open/services/ClockingService?wsdl", 
                                 array( 'trace' => 1,
                                    'use' => SOAP_LITERAL,
                                    'location' => "http://srvkelio:8089/open/services/ClockingService",
                                    'login'     => "wsuser",
                                    'password' => "wsbodet"));
        $params = new SoapVar($xmlRequest, XSD_ANYXML);
        //$service->importPhysicalClockings($params);
        return 1;
    }
	
}
	

$kelioWS = new KelioWS();
//var_dump($kelioWS->exportClockingsByDateForEmployeeList('2014-02-01', '2014-02-30', 'Mauricio', 'ARTEAGA'));
//var_dump($kelioWS->exportClockingsByDate('2014-03-10', '2014-03-20'));
//var_dump($kelioWS->exportEmployeesPrivateData());
//$kelioWS->exportPopulationDescriptions();
//var_dump($kelioWS->exportEmployeesProfessionalData());
//var_dump($kelioWS->getEmployeePrivateDataFromUser("Florian","DUSSOULIER"));
//var_dump($kelioWS->exportClockingsByDateForEmployeeList("Florian","DUSSOULIER"));




?>
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
	

    /********** SPECIFIC EMPLOYEE PRIVATE DATA *********/

    function getEmployeePrivateDataFromUser($employeeFirstname, $employeeLastname){
        $employeesData = $this->exportEmployeesPrivateData();
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
                                     array( 'login'     => "wsuser",
                                                 'password' => "wsbodet"));
         $res = $service->exportPopulationDescriptions();
         $resToArray = $this->objectToArray($res);
         var_dump($resToArray['exportedPopulationDescriptions']);
    }
	

    /********** ORGANIZATION CHART LEVELS *********/
	
    function exportOrganizationChartLevels(){
         ini_set('soap.wsdl_cache_enabled', 0);
         $service = new SoapClient("http://srvkelio:8089/open/services/OrganizationChartLevelService?wsdl", 
                                     array( 'login'     => "wsuser",
                                                 'password' => "wsbodet"));
         $res = $service->exportOrganizationChartLevels();
         $resToArray = $this->objectToArray($res);
         var_dump($resToArray['exportedOrganizationChartLevels']);
    }

    /********** ORGANIZATION CHART LEVEL DESCRIPTIONS *********/
	
    function exportOrganizationChartLevelDescriptions(){
         ini_set('soap.wsdl_cache_enabled', 0);
         $service = new SoapClient("http://srvkelio:8089/open/services/OrganizationChartLevelDescriptionService?wsdl", 
                                     array( 'login'     => "wsuser",
                                                 'password' => "wsbodet"));
         $res = $service->exportOrganizationChartLevelDescriptions();
         $resToArray = $this->objectToArray($res);
         var_dump($resToArray['exportedOrganizationChartLevelDescriptions']);
    }
	
	
}
	

//$kelioWS = new KelioWS();
////var_dump($kelioWS->exportEmployeesPrivateData());
//var_dump($kelioWS->getEmployeePrivateDataFromUser("Florian","DUSSOULIER"));
	
	
?>
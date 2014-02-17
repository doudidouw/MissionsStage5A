<?php


class easiCRMDB {

	private static $instance = null;
	
    private $CONN;
    private $DBHOST = 'SRVEASICRM';
    private $DBUSER = 'fdu';
    private $DBPWD = 'beneditro';
    private $easiCRMDB = 'ifr';

    private function __construct(){ 
    }
    
    function connect() {
        try {
           $this->CONN = new PDO("sqlsrv:Server=" .$this->DBHOST. ";Database=" .$this->easiCRMDB, $this->DBUSER, $this->DBPWD, array(
    			PDO::ATTR_PERSISTENT => true));
           $this->CONN->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   echo "You're now connected to ". $this->DBHOST ." SQL Server.<br />";
        }
        catch(Exception $e) {
            echo 'Error while connecting to ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
    }
   

    function disconnect() {
        $this->CONN = null;
    }

    function insert($sqlInsert) {
        try {
        	$this->connect();
            $stmt = $this->CONN->query($sqlInsert);
        } catch (Exception $e) {
            echo 'Error while inserting into ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function select($sqlSelect) {
        try {
        	$this->connect();
            $stmt = $this->CONN->query($sqlSelect);
        } catch (Exception $e) {
            echo 'Error while selecting from ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function delete($sqlDelete){
        try {
        	$this->connect();
            $stmt = $this->CONN->query($sqlDelete);
        } catch (Exception $e) {
            echo 'Error while deleting from ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function update($sqlUpdate){
        try {
            $this->connect();
            $stmt = $this->CONN->query($sqlUpdate);
        } catch (Exception $e) {
            echo 'Error while updating ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    public static function getInstance(){
    	if(is_null(self::$instance)){
    		self::$instance = new easiCRMDB();
    	}
    	return self::$instance;
    }
    
}

?>

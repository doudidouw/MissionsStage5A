<?php


class EasiCRMDB {

	private static $instance = null;
	
    
    /*      PARTIE A CHANGER     */
    
    private $conn;
    private $dbHost = 'SRVEASICRM';
    private $dbUser = 'fdu';
    private $dbPwd = 'beneditro';
    private $easiCRMDB = 'ifr';
    
    /*      FIN PARTIE A CHANGER     */

    private function __construct(){ 
    }
    
    function connect() {
        try {
           $this->conn = new PDO("sqlsrv:Server=" .$this->dbHost. ";Database=" .$this->easiCRMDB, $this->dbUser, $this->dbPwd);
           $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e) {
            echo 'Error while connecting to ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
    }
   

    function disconnect() {
        $this->conn = null;
    }

    function insert($sqlInsert) {
        try {
        	$this->connect();
            $stmt = $this->conn->query($sqlInsert);
        } catch (Exception $e) {
            echo 'Error while inserting into ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function select($sqlSelect) {
        try {
        	$this->connect();
            $stmt = $this->conn->query($sqlSelect);
        } catch (Exception $e) {
            echo 'Error while selecting from ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function delete($sqlDelete){
        try {
        	$this->connect();
            $stmt = $this->conn->query($sqlDelete);
        } catch (Exception $e) {
            echo 'Error while deleting from ' .$this->easiCRMDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function update($sqlUpdate){
        try {
            $this->connect();
            $stmt = $this->conn->query($sqlUpdate);
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

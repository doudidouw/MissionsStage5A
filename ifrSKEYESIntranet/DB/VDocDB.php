<?php


class VDocDB {

	private static $instance = null;
	
    private $conn;
    private $dbHost = 'SRVVDOCGED';
    private $dbUser = 'vdoc';
    private $dbPwd = 'vdocadmin';
    private $vdocDB = 'vdoc';

    private function __construct(){ 
    }
    
    function connect() {
        try {
           $this->conn = new PDO("sqlsrv:Server=" .$this->dbHost. ";Database=" .$this->vdocDB, $this->dbUser, $this->dbPwd, array(
    			PDO::ATTR_PERSISTENT => true));
           $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   //echo "You're now connected to ". $this->dbHost ." SQL Server.<br />";
        }
        catch(Exception $e) {
            echo 'Error while connecting to ' .$this->vdocDB. ' database : ' . $e->getMessage();
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
            echo 'Error while inserting into ' .$this->vdocDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function select($sqlSelect) {
        try {
        	$this->connect();
            $stmt = $this->conn->query($sqlSelect);
        } catch (Exception $e) {
            echo 'Error while selecting from ' .$this->vdocDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function delete($sqlDelete){
        try {
        	$this->connect();
            $stmt = $this->conn->query($sqlDelete);
        } catch (Exception $e) {
            echo 'Error while deleting from ' .$this->vdocDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    function update($sqlUpdate){
        try {
            $this->connect();
            $stmt = $this->conn->query($sqlUpdate);
        } catch (Exception $e) {
            echo 'Error while updating ' .$this->vdocDB. ' database : ' . $e->getMessage();
            die();
        }
        return $stmt;
    }

    public static function getInstance(){
    	if(is_null(self::$instance)){
    		self::$instance = new vdocDB();
    	}
    	return self::$instance;
    }
    
}

?>

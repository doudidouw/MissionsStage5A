<?php
require_once 'PLdap/Connector/abstract.php';
require_once 'PLdap/Connector/exception.php';
require_once 'PLdap/log.php';
/**
 *  PLDAP
 *
 * (c)2006 Copyrights by Liber Chen, All rights reserved.
 *
 * @category PLDAP
 * @package PLDAP
 * @since 2007/4/1
 * @copyright (c)2006 Copyrights by Liber Chen(liberchen@gmail.com), All rights reserved.
 */

/**
 * Ldap Connect Handler Direct
 * 
 * @throws PLdap_Connector_Exception
 */
class PLdap_Connector_Direct extends PLdap_Connector_Abstract {
	
	protected $_connectKeeper = null ;
	
	/**
	 * Connect to ldap
	 *
	 * @param string $host
	 * @param int $port
	 * @return resource Returns ldap connect resource
	 * @throws PLdap_Connector_Exception
	 */
	public function connect ( $host , $port ) {
		if (is_null ( $this->_connectKeeper )) {
			/**
			 * Testing connection before connect directly
			 */
			$errno = 0 ;
			$errstr = '' ;
			$fs = @fsockopen ( $host, $port, $errno, $errstr, 2 ) ;
			if (! $fs) {
				throw new PLdap_Connector_Exception ( "LDAP Service on $host(Port:$port) not opened or blocked by firewall." ) ;
			}
			fclose ( $fs ) ;
			$connect = @ldap_connect ( $host, $port ) ;
			if ($connect) {
				$this->host = $host ;
				$this->port = $port ;
				$this->_connectKeeper = $connect ;
				@ldap_Set_Option ( $connect, LDAP_OPT_PROTOCOL_VERSION, 3 ) ;
				@ldap_Set_Option ( $connect, LDAP_OPT_REFERRALS, 0 ) ;
			} else {
				throw new PLdap_Connector_Exception ( "Can not connect to ldap server " . $this->host . " through port " . $this->port ) ;
			}
		}
		return $this->_connectKeeper ;
	}
	
	/**
	 * Bind to ldap
	 *
	 * @param string $dn
	 * @param string $password
	 * @return boolean
	 * @throws PLdap_Connector_Exception
	 */
	public function bind ( $dn = "" , $password = "" ) {
		if (is_null ( $this->_connectKeeper )) {
			throw new PLdap_Connector_Exception ( "Error operation." ) ;
		}
		if (empty ( $dn )) {
			$bind = @ldap_bind ( $this->_connectKeeper ) ;
		} else {
			$bind = @ldap_bind ( $this->_connectKeeper, $dn, $password ) ;
		}
		if ($bind) {
			return true ;
		}
		$error = @ldap_error ( $this->_connectKeeper ) ;
		$number = @ldap_errno ( $this->_connectKeeper ) ;
		throw new PLdap_Connector_Exception ( $error, $number ) ;
	}
	
	/**
	 * Search
	 *
	 * @param string $baseDN
	 * @param string $query
	 * @param array $fieldArray
	 * @param boolean $limit
	 * @param boolean $oneLevel Perform an ONE-LEVEL search
	 * @return resource
	 * @throws PLdap_Connector_Exception
	 */
	public function search ( $baseDN , $query , $fieldArray , $limit = true , $oneLevel = false ) {
		if (is_null ( $this->_connectKeeper )) {
			throw new PLdap_Connector_Exception ( "Error operation." ) ;
		}
		if ($limit) {
			if ($oneLevel) {
				$result = @ldap_list ( $this->_connectKeeper, $baseDN, $query, $fieldArray, 0, $this->size, $this->timeout ) ;
			} else {
				$result = @ldap_search ( $this->_connectKeeper, $baseDN, $query, $fieldArray, 0, $this->size, $this->timeout ) ;
			}
		} else {
			if ($oneLevel) {
				$result = @ldap_list ( $this->_connectKeeper, $baseDN, $query, $fieldArray, 0, 0, 0 ) ;
			} else {
				$result = @ldap_search ( $this->_connectKeeper, $baseDN, $query, $fieldArray, 0, 0, 0 ) ;
			}
		}
		if ($result) {
			return $result ;
		}
		PLDAP_Log::logDebug ( "Query: $query, BaseDN: $baseDN, FieldArray: " . var_export ( $fieldArray, true ) . ", Limit: " . ($limit ? "TRUE" : "FALSE") ) ;
		PLDAP_Log::logDebug ( "Result:" . var_export ( $result, true ) ) ;
		$error = @ldap_error ( $this->_connectKeeper ) ;
		$number = @ldap_errno ( $this->_connectKeeper ) ;
		throw new PLdap_Connector_Exception ( $error, $number ) ;
	}
	
	/**
	 * Read result
	 *
	 * @param resource $resultId
	 * @return array
	 * @throws PLdap_Connector_Exception
	 */
	public function read ( $resultId ) {
		if (is_null ( $this->_connectKeeper )) {
			throw new PLdap_Connector_Exception ( "Error operation." ) ;
		}
		$records = @ldap_get_entries ( $this->_connectKeeper, $resultId ) ;
		if ($records) {
			return $records ;
		}
		$error = @ldap_error ( $this->_connectKeeper ) ;
		$number = @ldap_errno ( $this->_connectKeeper ) ;
		throw new PLdap_Connector_Exception ( $error, $number ) ;
	}
}
?>
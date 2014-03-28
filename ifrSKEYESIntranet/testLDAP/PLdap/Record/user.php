<?php
require_once 'PLdap/domain.php';
require_once 'PLdap/Record/User/exception.php';
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
 * Ldap User Record
 *
 */
class PLdap_Record_User {
	public $dn ;
	public $account ;
	public $mail ;
	public $displayName ;
	public $department ;
	
	/**
	 * Domain Object
	 *
	 * @var PLdap_Domain
	 */
	protected $_domain ;
	
	const USER_CLASS_ACTIVEDIRECTORY = 'user' ;
	const USER_CLASS_DOMINO = 'dominoPerson' ;
	const USER_CLASS_NOVELL = 'inetOrgPerson' ;
	
	function __construct ( PLdap_Domain $domain , $account , $mail , $displayName , $department = '' , $dn = '' )
	{
		$this->dn = $dn ;
		$this->account = $account ;
		$this->mail = $mail ;
		$this->displayName = $displayName ;
		$this->department = $department ;
		
		$this->_domain = $domain ;
	}
	
	/**
	 * Get user domain
	 *
	 * @return PLdap_Domain
	 */
	public function getDomain ()
	{
		return $this->_domain ;
	}
	
	/**
	 * Get the record
	 *
	 * @param PLdap_Domain $domain
	 * @param array $record
	 * @return PLdap_Record_User
	 */
	public static function readRecord ( PLdap_Domain $domain , $record )
	{
		if (! is_array ( $record )) {
			return false ;
		}
		
		$displayName = '' ;
		foreach ( $domain->fieldDisplayNameArray as $fieldDisplayName ) {
			if (! empty ( $fieldDisplayName )) {
				$delimiter = empty ( $displayName ) ? '' : '/' ;
				$displayName .= (isset ( $record [ $fieldDisplayName ] [ 0 ] ) ? $delimiter . $record [ $fieldDisplayName ] [ 0 ] : '') ;
			}
		}
		if (! empty ( $domain->fieldDepartment )) {
			$department = isset ( $record [ $domain->fieldDepartment ] [ 0 ] ) ? $record [ $domain->fieldDepartment ] [ 0 ] : '' ;
		} else {
			$department = '' ;
		}
		
		$ldapRecord = new PLdap_Record_User ( $domain, $record [ 'cn' ] [ 0 ], $record [ $domain->fieldMail ] [ 0 ], $displayName, $department, $record [ 'dn' ] ) ;
		return $ldapRecord ;
	}
	
	/**
	 * Search keyword
	 *
	 * @param PLdap_Domain $domain
	 * @param string $keyword
	 * @return array array includes PLdap_Record_User
	 */
	public static function searchKeyword ( PLdap_Domain $domain , $keyword )
	{
		$ldapRecords = array () ;
		
		$connector = $domain->getConnector () ;
		try {
			$connector->bind ( $domain->ldapUser, $domain->ldapPassword ) ;
		} catch ( PLdap_Connector_Exception $e ) {
			$error = $e->getMessage () ;
			PLDAP_Log::logError ( $error ) ;
		}
		$query = PLdap_Record_User::makeSearchKeywordQuery ( $domain, $keyword ) ;
		$fields = $domain->makeFieldArray () ;
		
		try {
			PLDAP_Log::logDebug ( "SearchKeyword:$query" ) ;
			$result = $connector->search ( $domain->ldapBaseDN, $query, $fields, true ) ;
		} catch ( PLdap_Connector_Exception $e ) {
			$error = $e->getMessage () ;
			PLDAP_Log::logError ( $error ) ;
		}
		
		if ($result) {
			try {
				$records = $connector->read ( $result ) ;
				if (isset ( $records [ 'count' ] ) and $records [ 'count' ] > 0) {
					$size = $records [ 'count' ] ;
					unset ( $records [ 'count' ] ) ;
					for ( $i = 0 ; $i < $size ; $i ++ ) {
						$ldapRecord = PLdap_Record_User::readRecord ( $domain, $records [ $i ] ) ;
						if ($ldapRecord) {
							$ldapRecords [] = $ldapRecord ;
						}
					}
				}
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
		}
		return $ldapRecords ;
	}
	
	/**
	 * Search User
	 *
	 * @param PLdap_Domain $domain
	 * @param string $account User account
	 * @return PLdap_Record_User return false on fail
	 */
	public static function searchUser ( PLdap_Domain $domain , $account )
	{
		$connector = $domain->getConnector () ;
		try {
			$connector->bind ( $domain->ldapUser, $domain->ldapPassword ) ;
		} catch ( PLdap_Connector_Exception $e ) {
			$error = $e->getMessage () ;
			PLDAP_Log::logError ( $error ) ;
		}
		
		$query = PLdap_Record_User::makeSearchUserQuery ( $domain, $account ) ;
		$fields = $domain->makeFieldArray () ;
		try {
			$result = $connector->search ( $domain->ldapBaseDN, $query, $fields, true ) ;
		} catch ( PLdap_Connector_Exception $e ) {
			$error = $e->getMessage () ;
			PLDAP_Log::logError ( $error ) ;
		}
		if ($result) {
			try {
				$records = $connector->read ( $result ) ;
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
			
			if (isset ( $records [ 'count' ] ) and $records [ 'count' ] > 0) {
				unset ( $records [ 'count' ] ) ;
				$ldapRecord = PLdap_Record_User::readRecord ( $domain, $records [ 0 ] ) ;
				return $ldapRecord ;
			}
		}
		return false ;
	}
	
	/**
	 * Make LDAP Query Command for User Searching
	 *
	 * @param PLdap_Domain $domain
	 * @param string $account
	 * @return string
	 */
	public static function makeSearchUserQuery ( PLdap_Domain $domain , $account )
	{
		$query = '' ;
		
		if ($domain->ldapType == PLdap_Domain::TYPE_ACTIVEDIRECTORY) {
			$field = 0 ;
			foreach ( $domain->fieldAccountArray as $fieldAccount ) {
				$field ++ ;
				$query .= "($fieldAccount=$account)" ;
			}
			$query = ($field > 1) ? "(|$query)" : $query ;
			$query = "(&(objectClass=" . self::USER_CLASS_ACTIVEDIRECTORY . ")" . $query . ")" ;
		} elseif ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
			$field = 0 ;
			foreach ( $domain->fieldAccountArray as $fieldAccount ) {
				$field ++ ;
				$query .= "($fieldAccount=$account)" ;
			}
			$query = ($field > 1) ? "(|$query)" : $query ;
			$query = "(&(objectClass=" . self::USER_CLASS_DOMINO . ")" . $query . ")" ;
		} elseif ($domain->ldapType == PLdap_Domain::TYPE_NOVELL) {
			$field = 0 ;
			foreach ( $domain->fieldAccountArray as $fieldAccount ) {
				$field ++ ;
				$query .= "($fieldAccount=$account)" ;
			}
			$query = ($field > 1) ? "(|$query)" : $query ;
			$query = "(&(objectclass=" . self::USER_CLASS_NOVELL . ")" . $query . ")" ;
		} else {
			$field = 0 ;
			foreach ( $domain->fieldAccountArray as $fieldAccount ) {
				$field ++ ;
				$query .= "($fieldAccount=$account)" ;
			}
			$query = ($field > 1) ? "(|$query)" : $query ;
		}
		return $query ;
	}
	
	/**
	 * Make LDAP Query Command for Keywords Searching
	 *
	 * @param PLdap_Domain $domain
	 * @param string $keyword
	 * @return string
	 * @throws PLdap_User_Exception
	 */
	public static function makeSearchKeywordQuery ( PLdap_Domain $domain , $keyword )
	{
		$query = '' ;
		$field = 0 ;
		$minLength = $domain->getMinSearchLength () ;
		if (mb_strlen ( $keyword, "UTF-8" ) < $minLength) {
			PLDAP_Log::logError ( "Search keywords must be longer than $minLength." ) ;
			throw new PLdap_Record_User_Exception ( "Search keywords must be longer than $minLength." ) ;
		}
		
		// Strip the '*' character		$keyword = str_replace ( '*', '', $keyword ) ;
		
		foreach ( $domain->fieldSearchArray as $fieldAccount ) {
			$field ++ ;
			$query .= "(" . $fieldAccount . "=*" . $keyword . "*)" ;
		}
		$query = ($field > 1) ? "(|$query)" : $query ;
		
		if ($domain->ldapType == PLdap_Domain::TYPE_ACTIVEDIRECTORY) {
			$query = "(&(objectClass=" . self::USER_CLASS_ACTIVEDIRECTORY . ")" . $query . ")" ;
		} elseif ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
			$query = "(&(objectClass=" . self::USER_CLASS_DOMINO . ")" . $query . ")" ;
		} elseif ($domain->ldapType == PLdap_Domain::TYPE_NOVELL) {
			$query = "(&(objectclass=" . self::USER_CLASS_NOVELL . ")" . $query . ")" ;
		}
		return $query ;
	}
}

?>
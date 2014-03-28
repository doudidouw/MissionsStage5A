<?php
/**
 *  PLDAP
 *
 * (c)2006 Copyrights by Liber Chen, All rights reserved.
 *
 * @category PLDAP
 * @package PLDAP
 * @since 2007/4/1
 * @version 1.0
 * @copyright (c)2006 Copyrights by Liber Chen(liberchen@gmail.com), All rights reserved.
 */

require_once 'PLdap/log.php';
include_once 'Record/user.php';
include_once 'Connector/proxy.php';
include_once 'Record/group.php';
include_once 'Connector/direct.php';
require_once ("Domain/exception.php") ;

/**
 * Ldap Domain Info Keeper
 *
 */
class PLdap_Domain {
	public $ldapHostArray = array ( '127.0.0.1' ) ;
	public $ldapGroupAllowArray = array ( ) ;
	public $ldapGroupDenyArray = array ( ) ;
	public $ldapBaseDN = '' ;
	public $ldapGroupBaseDN = '' ;
	public $ldapDomain = '' ;
	public $ldapUser = '' ;
	public $ldapPassword = '' ;
	public $ldapType = '' ;
	public $ldapProxy = '' ;
	public $keyConnector = '' ;
	public $keyAgent = '' ;
	
	public $fieldAccountArray = array ( 'cn,mail' ) ;
	public $fieldSearchArray = array ( 'cn,mail' ) ;
	public $fieldDisplayNameArray = array ( 'displayname' ) ;
	public $fieldMail = 'mail' ;
	public $fieldDepartment = 'department' ;
	public $fieldGroupDisplayName = 'name' ;
	
	protected $_isConnected = false ;
	/**
	 * Keep PLdap_Connector_Abstract
	 *
	 * @var PLdap_Connector_Abstract
	 */
	protected $_connector = null ;
	
	protected $_minSearchLength = 2 ;
	protected $_queryLimitSize = 20 ;
	protected $_queryLimitTime = 5 ;
	
	const DEBUG = true ;
	
	const TYPE_ACTIVEDIRECTORY = "0" ;
	const TYPE_DOMINO = "1" ;
	const TYPE_NOVELL = "2" ;
	
	const LDAP_PORT = 389 ;
	const LDAP_TLS_PORT = 636 ;
	
	const LDAP_NOVELL_ACCESS_FIELD = "acl" ;
	
	/**
	 * PLdap_Domain
	 *
	 * @param string $host LDAP server(s), separate by comma
	 * @param integer $type LDAP server type
	 * @param string $baseDN LDAP domain base DN
	 * @param string $domain Default mailbox domain.
	 * @param string $user LDAP access account, read only permission is fine.
	 * @param string $password LDAP access password
	 * @param string $account Field of login account, separate by comma
	 * @param string $search Field of search target
	 * @param string $displayName Field of user display name, separate by comma
	 * @param string $mail Field of mailbox
	 * @param string $department Field of user department
	 * @param string $proxy PLDAP Agent access URI
	 * @param string $keyConnector PLDAP private key file
	 * @param string $keyAgent PLDAP Agent public key file
	 * @param string $groupAllow Group DN(s) would like to allow login, separate by semicolon.
	 * @param string $groupDeny Group DN(s) would like to deny login, separate by semicolon.
	 */
	public function __construct ( $host , $type , $baseDN , $domain , $user , $password , $account = 'cn,mail' , $search = 'cn,mail' , $displayName = 'displayname' , $mail = 'mail' , $department = 'department' , $proxy = '' , $keyConnector = '' , $keyAgent = '' , $groupAllow = '' , $groupDeny = '' ) {
		
		$this->ldapBaseDN = $baseDN ;
		$this->ldapDomain = $domain ;
		$this->ldapUser = $user ;
		$this->ldapPassword = $password ;
		$this->ldapProxy = $proxy ;
		$this->keyAgent = $keyAgent ;
		$this->keyConnector = $keyConnector ;
		
		$this->ldapHostArray = explode ( ",", $host ) ;
		$this->ldapGroupAllowArray = (! empty ( $groupAllow ) ? explode ( ";", $groupAllow ) : array ( )) ;
		$this->ldapGroupDenyArray = (! empty ( $groupDeny ) ? explode ( ";", $groupDeny ) : array ( )) ;
		
		$this->fieldAccountArray = empty ( $account ) ? $this->fieldAccountArray : explode ( ",", $account ) ;
		$this->fieldSearchArray = empty ( $search ) ? $this->fieldSearchArray : explode ( ",", $search ) ;
		/* Make sure there has 'cn' field */
		$cnArray [] = "cn" ;
		$this->fieldAccountArray = $this->_join ( $this->fieldAccountArray, $cnArray ) ;
		$this->fieldSearchArray = $this->_join ( $this->fieldSearchArray, $cnArray ) ;
		
		$this->fieldDisplayNameArray = explode ( ",", $displayName ) ;
		$this->fieldMail = $mail ;
		$this->fieldDepartment = $department ;
		
		switch ( $type) {
			case self::TYPE_DOMINO :
				$this->ldapType = self::TYPE_DOMINO ;
				$this->fieldGroupDisplayName = "cn" ;
			break ;
			
			case self::TYPE_NOVELL :
				$this->ldapType = self::TYPE_NOVELL ;
			break ;
			
			default :
				$this->ldapType = self::TYPE_ACTIVEDIRECTORY ;
				$this->fieldGroupDisplayName = "name" ;
			break ;
		}
	}
	
	/**
	 * Set group field of display name
	 *
	 * @param string $name
	 */
	public function setGroupDisplayName ( $name ) {
		if (strlen ( $name ) > 0) {
			$this->fieldGroupDisplayName = trim ( $name ) ;
		}
	}
	
	/**
	 * Set Seconds of Query Time Limited
	 *
	 * @param int $seconds
	 */
	public function setQueryLimitTime ( $seconds ) {
		if (is_numeric ( $seconds ) and $seconds > 0) {
			$this->_queryLimitTime = $seconds ;
			if ($this->isConnected ()) {
				$this->_connector->timeout = $this->_queryLimitTime ;
			}
		}
	}
	
	/**
	 * Set Size of Query Limited
	 *
	 * @param int $sizes
	 */
	public function setQueryLimitSize ( $sizes ) {
		if (is_numeric ( $sizes ) and $sizes > 0) {
			$this->_queryLimitSize = $sizes ;
			if ($this->isConnected ()) {
				$this->_connector->size = $this->_queryLimitSize ;
			}
		}
	}
	
	/**
	 * Set group base DN
	 * If the group list you want to retrieve has different base DN with
	 * the domain base DN, you can set a different base DN here. 
	 *
	 * @param string $baseDN Group(s) base DN
	 */
	public function setGroupBaseDN ( $baseDN ) {
		$this->ldapGroupBaseDN = $baseDN ;
	}
	
	public function getGroupBaseDN () {
		return $this->ldapGroupBaseDN ;
	}
	
	/**
	 * Set minimum length of search words
	 *
	 * @param integer $length
	 */
	public function setMinSearchLength ( $length = 2 ) {
		if (is_numeric ( $length )) {
			$this->_minSearchLength = $length ;
			PLDAP_Log::logDebug ( "Set LDAP minimal search length to $length." ) ;
		}
	}
	
	public function getMinSearchLength () {
		return $this->_minSearchLength ;
	}
	
	/**
	 * Return the connector
	 *
	 * @return PLdap_Connector_Direct
	 */
	public function getConnector () {
		return $this->_connector ;
	}
	
	/**
	 * Try to connect to all of domain ldap servers
	 *
	 * @return boolean Returns fail if no any available ldap server
	 */
	public function connect () {
		$result = false ;
		if (is_array ( $this->ldapHostArray ) and count ( $this->ldapHostArray ) > 0) {
			if (! empty ( $this->ldapProxy )) {
				$connector = new PLdap_Connector_Proxy ( $this->_queryLimitTime, $this->_queryLimitSize ) ;
				$connector->setProxy ( $this->ldapProxy ) ;
				$connector->setKey ( $this->keyConnector, $this->keyAgent ) ;
			} else {
				$connector = new PLdap_Connector_Direct ( $this->_queryLimitTime, $this->_queryLimitSize ) ;
			}
			foreach ( $this->ldapHostArray as $host ) {
				try {
					$connector->connect ( $host, self::LDAP_PORT ) ;
					$this->_connector = $connector ;
					$this->_isConnected = true ;
					$result = true ;
				} catch ( PLdap_Connector_Exception $e ) {
					$error = $e->getMessage () ;
					PLDAP_Log::logError ( $error ) ;
				}
				if ($result) {
					break;
				}
				
			}
		}
		return $result ;
	}
	
	/**
	 * Is any available ldap server connected
	 *
	 * @return boolean
	 */
	public function isConnected () {
		return $this->_isConnected ;
	}
	
	/**
	 * Authenticate user password
	 * ATTENTION: You should not use this method directly, 
	 * only if you want to login a single domain only.
	 * Otherwise you should use PLDAP_Control::authenticate() instead.
	 *
	 * @param PLdap_Record_User $ldapRecord
	 * @param string $password
	 * @return boolean
	 */
	public function authenticate ( PLdap_Record_User $ldapRecord , $password ) {
		if ($ldapRecord instanceof PLdap_Record_User) {
			/* @var $ldapRecord PLdap_Record_User */
			
			/* Check if group limited */
			$groupAllow = $this->ldapGroupAllowArray ;
			$groupDeny = $this->ldapGroupDenyArray ;
			if (is_array ( $groupAllow ) and count ( $groupAllow ) > 0) {
				$groupMemberList = array ( ) ;
				foreach ( $groupAllow as $groupDN ) {
					$group = PLdap_Record_Group::getGroup ( $this, $groupDN ) ;
					$memberList = $group->getMemberList ( true ) ;
					/* @var $group PLdap_Record_Group */
					$groupMemberList = array_merge ( $groupMemberList, $memberList ) ;
				}
				$groupMemberList = array_unique ( $groupMemberList ) ;
				PLDAP_Log::logDebug ( "LDAP Permit Member List:" . var_export ( $groupMemberList, true ) ) ;
				$permitLogin = false ;
				foreach ( $groupMemberList as $ldapUser ) {
					/* @var $ldapUser PLdap_Record_User */
					if ($ldapUser->dn == $ldapRecord->dn) {
						$permitLogin = true ;
						break ;
					}
				}
				if (! $permitLogin) {
					PLDAP_Log::logDebug ( "User not in allow group list" ) ;
					return false ;
				}
			} elseif (is_array ( $groupDeny ) and count ( $groupDeny ) > 0) {
				$groupMemberList = array ( ) ;
				foreach ( $groupDeny as $groupDN ) {
					$group = PLdap_Record_Group::getGroup ( $this, $groupDN ) ;
					$memberList = $group->getMemberList ( true ) ;
					/* @var $group PLdap_Record_Group */
					$groupMemberList = array_merge ( $groupMemberList, $memberList ) ;
				}
				$groupMemberList = array_unique ( $groupMemberList ) ;
				$permitLogin = true ;
				
				foreach ( $groupMemberList as $ldapUser ) {
					/* @var $ldapUser PLdap_Record_User */
					if ($ldapUser->dn == $ldapRecord->dn) {
						$permitLogin = false ;
						break ;
					}
				}
				
				if (! $permitLogin) {
					PLDAP_Log::logDebug ( "User in deny group list" ) ;
					return false ;
				}
			}
			
			try {
				$result = $this->_connector->bind ( $ldapRecord->dn, $password ) ;
				if ($result) {
					return true ;
				}
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
		
		}
		return false ;
	}
	
	/**
	 * Retrieve the CN string from the given string
	 *
	 * @param string $string EX:CN=83100,OU=Company Group,DC=cybertan,DC=com,DC=tw
	 * @return string EX:CN=83100
	 */
	public function getCN ( $string ) {
		$CN = '' ;
		$match = '' ;
		if (preg_match ( "/CN=([^,]+)/i", $string, $match )) {
			$CN = $match [ 0 ] ;
		}
		return $CN ;
	}
	
	/**
	 * Get the part of DN except CN string
	 *
	 * @param string $string
	 * @return string
	 */
	public function getBaseDN ( $string ) {
		$base = '' ;
		$match = '' ;
		if (preg_match ( "/^CN=[^,]+,(.+)$/i", $string, $match )) {
			$base = $match [ 1 ] ;
		}
		return $base ;
	}
	
	/**
	 * Retrieve the DC string from the given string
	 *
	 * @param string $string EX:CN=83100,OU=Company Group,DC=cybertan,DC=com,DC=tw
	 * @return string EX:DC=cybertan,DC=com,DC=tw
	 */
	public function getDC ( $string ) {
		$DC = '' ;
		$match = '' ;
		if (preg_match_all ( '/DC=([\w]+)/i', $string, $match )) {
			$DC = implode ( ",", $match [ 0 ] ) ;
		}
		return $DC ;
	}
	/**
	 * Retrieve the O string from the given string
	 *
	 * @param string $string EX:CN=liber,OU=IT,O=mxic
	 * @return string EX:O=mxic
	 */
	public function getO ( $string ) {
		$O = '' ;
		$match = '' ;
		if (preg_match_all ( '/O=([\w]+)/i', $string, $match )) {
			$O = implode ( ",", $match [ 0 ] ) ;
		}
		return $O ;
	}
	
	public function makeFieldArray () {
		$fields [] = $this->fieldMail ;
		if (! empty ( $this->fieldDepartment )) {
			$fields [] = $this->fieldDepartment ;
		}
		// Do not support acl object anymore */		/*if ($this->ldapType==self::TYPE_NOVELL) {
			$fields[] = self::LDAP_NOVELL_ACCESS_FIELD;
		}*/
		
		$fields = $this->_join ( $fields, $this->fieldAccountArray ) ;
		$fields = $this->_join ( $fields, $this->fieldDisplayNameArray ) ;
		
		return $fields ;
	}
	
	public static function isValidEmail ( $email ) {
		return (preg_match ( '/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i', $email )) ;
	}
	
	protected function _join ( $array1 , $array2 ) {
		$array = array_merge ( $array1, $array2 ) ;
		$array = array_unique ( $array ) ;
		return $array ;
	}
}

?>
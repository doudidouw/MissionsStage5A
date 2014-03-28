<?php
require_once 'PLdap/domain.php';
require_once 'PLdap/log.php';
require_once 'PLdap/Record/user.php';
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
 * Ldap Record Group
 *
 */
class PLdap_Record_Group {
	public $dn ;
	public $name ;
	public $whenChanged ;
	public $whenCreated ;
	public $memberDNList ;
	
	/**
	 * Domain keeper
	 *
	 * @var PLdap_Domain
	 */
	protected $_domain ;
	protected $_memberList = null ;
	
	protected static $groupList = null ;
	
	const GROUP_CLASS_ACTIVEDIRECTORY = 'group' ;
	const GROUP_CLASS_DOMINO = 'dominoGroup' ;
	const GROUP_CLASS_NOVELL = 'groupOfNames' ;
	function __construct ( PLdap_Domain $domain , $dn , $name , $whenCreated , $whenChanged , $memberDNList )
	{
		$this->_domain = $domain ;
		$this->dn = $dn ;
		$this->name = $name ;
		$this->whenCreated = $whenCreated ;
		if (empty ( $whenChanged )) {
			$whenChanged = time () ;
		}
		$this->whenChanged = $whenChanged ;
		$this->memberDNList = $memberDNList ;
	}
	
	/**
	 * Get domain group list
	 *
	 * @param PLdap_Domain $domain
	 * @param string[optional] $search Search group matched
	 * @param string[optional] $baseDN Assign a special base DN instead of domain base DN
	 * @return array
	 */
	public static function getGroupList ( PLdap_Domain $domain , $search = '' , $baseDN = '' )
	{
		if (is_array ( self::$groupList )) {
			PLDAP_Log::logDebug ( "Use cache to return group list." ) ;
			return self::$groupList ;
		}
		
		/* Check Group Base DN */
		$baseDN = empty ( $baseDN ) ? $domain->getGroupBaseDN () : $baseDN ;
		
		$groupList = array () ;
		if ($domain instanceof PLdap_Domain) {
			$connector = $domain->getConnector () ;
			try {
				$connector->bind ( $domain->ldapUser, $domain->ldapPassword ) ;
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
			if ($domain->ldapType == PLdap_Domain::TYPE_ACTIVEDIRECTORY) {
				if (empty ( $search )) {
					$query = "objectclass=" . self::GROUP_CLASS_ACTIVEDIRECTORY ;
				} else {
					$query = "(&(objectclass=" . self::GROUP_CLASS_ACTIVEDIRECTORY . ")(" . $domain->fieldGroupDisplayName . "=*" . self::addslash ( $search ) . "*))" ;
				}
				$fields = array ( 
						$domain->fieldGroupDisplayName , 
						"whencreated" , 
						"whenchanged" , 
						"member" ) ;
			} elseif ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
				if (empty ( $search )) {
					$query = "objectclass=" . self::GROUP_CLASS_DOMINO ;
				} else {
					$query = "(&(objectclass=" . self::GROUP_CLASS_DOMINO . ")(" . $domain->fieldGroupDisplayName . "=*" . self::addslash ( $search ) . "*))" ;
				}
				$fields = array ( 
						$domain->fieldGroupDisplayName , 
						"originalmodtime" , 
						"member" ) ;
			} elseif ($domain->ldapType == PLdap_Domain::TYPE_NOVELL) {
				if (empty ( $search )) {
					$query = "objectclass=" . self::GROUP_CLASS_NOVELL ;
				} else {
					$query = "(&(objectclass=" . self::GROUP_CLASS_NOVELL . ")(" . $domain->fieldGroupDisplayName . "=*" . self::addslash ( $search ) . "*))" ;
				}
				$fields = array ( 
						$domain->fieldGroupDisplayName , 
						"member" ) ;
			}
			
			//			$result = @ldap_search($domain->ldapConnect, $domain->ldapBaseDN, $query, $fields, 0, PLdap_Domain::LDAP_QUERY_LIMIT_SIZE , PLdap_Domain::LDAP_QUERY_LIMIT_TIME );
			try {
				if ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
					$setBaseDN = (empty ( $baseDN ) ? '' : $baseDN) ;
					$result = $connector->search ( $setBaseDN, $query, $fields, false ) ;
				} else {
					$setBaseDN = (empty ( $baseDN ) ? $domain->ldapBaseDN : $baseDN) ;
					$result = $connector->search ( $setBaseDN, $query, $fields, false ) ;
				}
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
			
			if ($result) {
				try {
					$record = $connector->read ( $result ) ;
				} catch ( PLdap_Connector_Exception $e ) {
					$error = $e->getMessage () ;
					PLDAP_Log::logError ( $error ) ;
				}
				if (isset ( $record [ 'count' ] ) and $record [ 'count' ] > 0) {
					unset ( $record [ 'count' ] ) ;
					foreach ( $record as $group ) {
						unset ( $group [ 'member' ] [ 'count' ] ) ;
						$member = isset ( $group [ 'member' ] ) ? $group [ 'member' ] : array () ;
						if ($domain->ldapType == PLdap_Domain::TYPE_ACTIVEDIRECTORY) {
							$groupList [] = new PLdap_Record_Group ( $domain, $group [ 'dn' ], $group [ $domain->fieldGroupDisplayName ] [ 0 ], $group [ 'whencreated' ] [ 0 ], $group [ 'whenchanged' ] [ 0 ], $member ) ;
						} elseif ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
							$groupList [] = new PLdap_Record_Group ( $domain, $group [ 'dn' ], $group [ $domain->fieldGroupDisplayName ] [ 0 ], $group [ 'originalmodtime' ] [ 0 ], $group [ 'originalmodtime' ] [ 0 ], $member ) ;
						} elseif ($domain->ldapType == PLdap_Domain::TYPE_NOVELL) {
							$groupList [] = new PLdap_Record_Group ( $domain, $group [ 'dn' ], $group [ $domain->fieldGroupDisplayName ] [ 0 ], time (), time (), $member ) ;
						}
					}
				}
			} else {
				PLDAP_Log::logDebug ( "Can't get group list." ) ;
			}
		}
		return $groupList ;
	}
	
	public static function addslash ( $string )
	{
		$searchArray = array ( 
				"(" , 
				")" ) ;
		$replaceArray = array ( 
				'\(' , 
				'\)' ) ;
		return str_replace ( $searchArray, $replaceArray, $string ) ;
	}
	
	/**
	 * Get or Search Group
	 * Available: ActiveDirectory, Domino
	 *
	 * @param PLdap_Domain $domain
	 * @param string[optional] $dn
	 * @param string[optional] $search
	 * @param string[optional] $baseDN Assign a special Group Base DN
	 * @return PLdap_Record_Group
	 */
	public static function getGroup ( PLdap_Domain $domain , $dn = '' , $search = '' , $baseDN = '' )
	{
		/* Check Group Base DN */
		$baseDN = empty ( $baseDN ) ? $domain->getGroupBaseDN () : $baseDN ;
		
		if ($domain instanceof PLdap_Domain) {
			$connector = $domain->getConnector () ;
			try {
				$connector->bind ( $domain->ldapUser, $domain->ldapPassword ) ;
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
			
			/**
			 * Active Directory
			 */
			if ($domain->ldapType == PLdap_Domain::TYPE_ACTIVEDIRECTORY) {
				if (empty ( $search )) {
					$query = self::addslash ( $domain->getCN ( $dn ) ) ;
				} else {
					$query = "(&(objectclass=" . self::GROUP_CLASS_ACTIVEDIRECTORY . ")(" . $domain->fieldGroupDisplayName . "=*" . self::addslash ( $search ) . "*))" ;
				}
				$fields = array ( 
						$domain->fieldGroupDisplayName , 
						"whencreated" , 
						"whenchanged" , 
						"member" ) ;
			
			/**
			 * IBM Domino
			 */
			} elseif ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
				if (empty ( $search )) {
					$query = "(&(objectclass=" . self::GROUP_CLASS_DOMINO . ")(" . self::addslash ( $domain->getCN ( $dn ) ) . "))" ;
				} else {
					$query = "(&(objectclass=" . self::GROUP_CLASS_DOMINO . ")(" . $domain->fieldGroupDisplayName . "=*" . self::addslash ( $search ) . "*))" ;
				}
				$fields = array ( 
						$domain->fieldGroupDisplayName , 
						"originalmodtime" , 
						"member" ) ;
			} elseif ($domain->ldapType == PLdap_Domain::TYPE_NOVELL) {
				if (empty ( $search )) {
					$query = "(&(objectclass=" . self::GROUP_CLASS_NOVELL . ")(" . self::addslash ( $domain->getCN ( $dn ) ) . "))" ;
				} else {
					$query = "(&(objectclass=" . self::GROUP_CLASS_NOVELL . ")(" . $domain->fieldGroupDisplayName . "=*" . self::addslash ( $search ) . "*))" ;
				}
				$fields = array ( 
						$domain->fieldGroupDisplayName , 
						"member" ) ;
			}
			try {
				if ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
					$setBaseDN = (empty ( $baseDN ) ? '' : $baseDN) ;
					$result = $connector->search ( $setBaseDN, $query, $fields, false ) ;
				} else {
					$setBaseDN = (empty ( $baseDN ) ? $domain->ldapBaseDN : $baseDN) ;
					$result = $connector->search ( $setBaseDN, $query, $fields, false ) ;
				}
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
			if ($result) {
				try {
					$record = $connector->read ( $result ) ;
				} catch ( PLdap_Connector_Exception $e ) {
					$error = $e->getMessage () ;
					PLDAP_Log::logError ( $error ) ;
				}
				if (isset ( $record [ 'count' ] ) and $record [ 'count' ] > 0) {
					unset ( $record [ 'count' ] ) ;
					unset ( $record [ 0 ] [ 'member' ] [ 'count' ] ) ;
					$member = isset ( $record [ 0 ] [ 'member' ] ) ? $record [ 0 ] [ 'member' ] : array () ;
					if ($domain->ldapType == PLdap_Domain::TYPE_ACTIVEDIRECTORY) {
						$ldapGroup = new PLdap_Record_Group ( $domain, $record [ 0 ] [ 'dn' ], $record [ 0 ] [ $domain->fieldGroupDisplayName ] [ 0 ], $record [ 0 ] [ 'whencreated' ] [ 0 ], $record [ 0 ] [ 'whenchanged' ] [ 0 ], $member ) ;
					} elseif ($domain->ldapType == PLdap_Domain::TYPE_DOMINO) {
						$ldapGroup = new PLdap_Record_Group ( $domain, $record [ 0 ] [ 'dn' ], $record [ 0 ] [ $domain->fieldGroupDisplayName ] [ 0 ], $record [ 0 ] [ 'originalmodtime' ] [ 0 ], $record [ 0 ] [ 'originalmodtime' ] [ 0 ], $member ) ;
					} elseif ($domain->ldapType == PLdap_Domain::TYPE_NOVELL) {
						$ldapGroup = new PLdap_Record_Group ( $domain, $record [ 0 ] [ 'dn' ], $record [ 0 ] [ $domain->fieldGroupDisplayName ] [ 0 ], time (), time (), $member ) ;
					}
					return $ldapGroup ;
				}
			}
		}
		return false ;
	}
	
	/**
	 * Search matched group from LDAP servers
	 * Available: ActiveDirectory, Domino, Novell
	 *
	 * @param boolean $refresh enforce to refresh list
	 * @return array
	 */
	public Function getMemberList ( $refresh = false )
	{
		if (! $refresh and $this->_memberList !== null) {
			return $this->_memberList ;
		}
		
		$contactList = array () ;
		
		$fields = $this->_domain->makeFieldArray () ;
		
		/* Get the groupMemberDNList */
		$groupMemberDNList = $this->memberDNList ;
		
		$allMemberCN = '' ;
		$member = 0 ;
		if (is_array ( $groupMemberDNList ) and count ( $groupMemberDNList ) > 0) {
			foreach ( $groupMemberDNList as $memberDN ) {
				$member ++ ;
				$allMemberCN .= "(" . self::addslash ( $this->_domain->getCN ( $memberDN ) ) . ")" ;
			}
		}
		if (strlen ( $allMemberCN ) > 0) {
			$matchedMember = ($member > 1) ? "(|$allMemberCN)" : $allMemberCN ;
			//			$query = "(&" . $matchedMember . "(objectClass=user)(objectCategory=person)(mail=*@*))";
			/* Don't limit type to get group data */
			$query = $matchedMember ;
			/*
			 * Appends "member" to determine if is a group, and retrieves the member list
			 * ATTENTION: Do not use fields[] = "member", because of some reason
			 * it will cause array key does not continue, and make ldap_search function error
			*/
			$fieldString = implode ( ",", $fields ) ;
			$fields = explode ( ",", $fieldString . ",member" ) ;
			
			$connector = $this->_domain->getConnector () ;
			/* @var $connector PLdap_Connector_Direct */
			try {
				$connector->bind ( $this->_domain->ldapUser, $this->_domain->ldapPassword ) ;
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
			try {
				PLDAP_Log::logDebug ( "getMemberList: BaseDN: " . $this->_domain->ldapBaseDN . ", Query: $query, Fields: " . implode ( ";", $fields ) ) ;
				$result = $connector->search ( $this->_domain->ldapBaseDN, $query, $fields, false ) ;
			} catch ( PLdap_Connector_Exception $e ) {
				$error = $e->getMessage () ;
				PLDAP_Log::logError ( $error ) ;
			}
			
			if ($result) {
				try {
					$record = $connector->read ( $result ) ;
				} catch ( PLdap_Connector_Exception $e ) {
					$error = $e->getMessage () ;
					PLDAP_Log::logError ( $error ) ;
				}
				
				if (isset ( $record [ 'count' ] ) and $record [ 'count' ] > 0) {
					$size = $record [ 'count' ] ;
					for ( $i = 0 ; $i < $size ; $i ++ ) {
						/* Search inner groups, excepts Novell which default returns all members list */
						if (($this->_domain->ldapType != PLdap_Domain::TYPE_NOVELL) and isset ( $record [ $i ] [ 'member' ] )) {
							$childGroup = PLdap_Record_Group::getGroup ( $this->_domain, $record [ $i ] [ 'dn' ] ) ;
							$childGroupContactList = $childGroup->getMemberList () ;
							if (count ( $childGroupContactList ) > 0) {
								$contactList = array_merge ( $contactList, $childGroupContactList ) ;
							}
							unset ( $record [ $i ] ) ;
						} else {
							//							$contactList[] = PLdap_Record_User::readRecord($this->domain, $record[$i]);
							/* Prevent duplicate */
							$contactList [ $record [ $i ] [ 'dn' ] ] = PLdap_Record_User::readRecord ( $this->_domain, $record [ $i ] ) ;
						}
					}
				}
			}
		}
		$this->_memberList = $contactList ;
		return $contactList ;
	}

}

?>
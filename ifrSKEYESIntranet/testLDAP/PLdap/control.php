<?php
require_once 'PLdap/log.php';
include_once 'Record/user.php';
include_once 'domain.php';
include_once 'Record/group.php';
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

class PLdap_Control {
	
	protected $_domains = array ( ) ;
	
	/**
	 * Append a domain to controller
	 *
	 * @param PLdap_Domain $domain
	 */
	public function addDomain ( PLdap_Domain $domain ) {
		$this->_domains [] = $domain ;
	}
	
	/**
	 * Connect all domains
	 *
	 * @return boolean
	 */
	public function connectAll () {
		foreach ( $this->_domains as $domain ) {
			/* @var $domain PLdap_Domain */
			$result = $domain->connect () ;
			if (! $result) {
				PLDAP_Log::logError ( "No any ldap server in " . $domain->ldapDomain ) ;
			}
		}
		return true ;
	}
	
	/**
	 * Authenticate User
	 *
	 * @param PLdap_Record_User $user
	 * @param string $password
	 * @return boolean
	 */
	public function authenticate ( PLdap_Record_User $user , $password ) {
		foreach ( $this->_domains as $domain ) {
			/* @var $domain PLdap_Domain */
			if ($domain->isConnected ()) {
				$result = $domain->authenticate ( $user, $password ) ;
				if ($result) {
					return true ;
				}
			}
		}
		return false ;
	}
	
	/**
	 * Search a user record
	 * PLDAP will search all fields of account that set in the PLDAP_Domain.
	 *
	 * @param string $account
	 * @return PLdap_Record_User
	 */
	public function searchUser ( $account ) {
		foreach ( $this->_domains as $domain ) {
			if ($domain->isConnected ()) {
				$result = PLdap_Record_User::searchUser ( $domain, $account ) ;
				if ($result) {
					return $result ;
				}
			}
		}
		return false ;
	}
	
	/**
	 * Search keyword in all domain
	 * PLDAP will search all fields of search that set in the PLDAP_Domain.
	 *
	 * @param string $keyword
	 * @return array
	 */
	public function searchKeyword ( $keyword ) {
		$allRecords = array ( ) ;
		foreach ( $this->_domains as $domain ) {
			if ($domain->isConnected ()) {
				try {
					$records = PLdap_Record_User::searchKeyword ( $domain, $keyword ) ;
					$allRecords = array_merge ( $allRecords, $records ) ;
				} catch ( PLdap_Record_User_Exception $e ) {
					$error = $e->getMessage () ;
					PLDAP_Log::logError ( $error ) ;
				}
			}
		}
		return $allRecords ;
	}
	
	/**
	 * Get all group list of all domain
	 *
	 * @return array
	 */
	public function getGroupList () {
		$allGroupList = array ( ) ;
		foreach ( $this->_domains as $domain ) {
			if ($domain->isConnected ()) {
				$groupList = PLdap_Record_Group::getGroupList ( $domain ) ;
				$allGroupList = array_merge ( $allGroupList, $groupList ) ;
			}
		}
		return $allGroupList ;
	}
	
	/**
	 * Get Group by DN
	 *
	 * @param string $dn
	 * @return PLdap_Record_Group return false on fails
	 */
	public function getGroupByDN ( $dn ) {
		foreach ( $this->_domains as $domain ) {
			if ($domain->isConnected ()) {
				$group = PLdap_Record_Group::getGroup ( $domain, $dn ) ;
				if ($group) {
					return $group ;
				}
			}
		}
		return false ;
	}
	
	/**
	 * Search Group
	 *
	 * @param string $name
	 * @return PLdap_Record_Group
	 */
	public function getGroupByKeyword ( $name ) {
		foreach ( $this->_domains as $domain ) {
			if ($domain->isConnected ()) {
				$group = PLdap_Record_Group::getGroup ( $domain, '', $name ) ;
				if ($group) {
					return $group ;
				}
			}
		}
		return false ;
	}
	
	/**
	 * Executes a raw query for all ldap servers
	 *
	 * @param string $query
	 * @param array $fields
	 * @param string $baseDN
	 * @param boolean $limit
	 * @param boolean $oneLevel
	 * @return array
	 */
	public function rawQuery ( $query , $fields , $baseDN = '' , $limit = false , $oneLevel = false ) {
		$records = array ( ) ;
		foreach ( $this->_domains as $domain ) {
			/* @var $domain PLdap_Domain */
			if ($domain->isConnected ()) {
				$connector = $domain->getConnector () ;
				try {
					$connector->bind ( $domain->ldapUser, $domain->ldapPassword ) ;
				} catch ( PLdap_Connector_Exception $e ) {
					$error = $e->getMessage () ;
					PLDAP_Log::logError ( $error ) ;
				}
				$setBaseDN = (empty ( $baseDN ) ? $domain->ldapBaseDN : $baseDN) ;
				
				$result = $connector->search ( $setBaseDN, $query, $fields, $limit, $oneLevel ) ;
				if ($result) {
					$record = $connector->read ( $result ) ;
					if ($record) {
						unset ( $record [ 'count' ] ) ;
						$records = array_merge ( $records, $record ) ;
					}
				}
			}
		}
		return $records ;
	}

}
?>
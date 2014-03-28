<?php
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
 * Ldap Connector Handler Interface
 *
 */
interface PLdap_Connector_Interface {
	public function connect($host, $port);
	public function bind($dn = "", $password = "");
	public function search($baseDN, $query, $fieldArray, $limit = true);
	public function read($resultId);
}
?>
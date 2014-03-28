<?php
require_once 'PLdap/Connector/interface.php';
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
 * Ldap Connector Handler Abstract
 *
 */
abstract class PLdap_Connector_Abstract implements PLdap_Connector_Interface {
	public $host;
	public $port;
	
	public $timeout = 8;
	public $size = 20;
	
	public function __construct($timeout = 8, $size = 20)
	{
		$this->timeout = $timeout;
		$this->size = $size;
		
	}
}
?>
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

class PLdap_Agent_Parameter {
	public $host;
	public $port;
	
	public $dn;
	public $password;
	
	public $baseDN;
	public $query;
	public $fields;
	public $size = 0;
	public $timeout = 0;
	public $oneLevel = false;
}

?>
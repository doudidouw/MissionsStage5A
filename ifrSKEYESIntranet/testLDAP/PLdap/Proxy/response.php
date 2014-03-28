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

class PLdap_Proxy_Response {
	public $header = null;
	public $content = null;
	public $errNumber = 0;
	public $errMessage = '';
	
	public function __toString()
	{
		return $this->content;
	}
}

?>
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

class PLdap_Tool {
	/**
	 * Test if is in Windows
	 *
	 * @return boolean
	 */
	public static function isWindows ()
	{
		$os = php_uname ( "s" ) ;
		if (preg_match ( '/^Windows.*/', $os )) {
			return true ;
		}
		return false ;
	}
}

?>
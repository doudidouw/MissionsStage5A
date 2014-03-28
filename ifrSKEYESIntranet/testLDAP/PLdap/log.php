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

class PLDAP_Log {
	static $_log = array();
	
	static public function logDebug($message) {
		self::_log('DEBUG', $message);
	}
	static public function logInfo($message) {
		self::_log('INFO', $message);
	}
	static public function logWarn($message) {
		self::_log('WARN', $message);
	}
	static public function logError($message) {
		self::_log('ERROR', $message);
	}
	static protected function _log($tag, $message) {
		self::$_log[] = array($tag, $message);
	}
}

?>
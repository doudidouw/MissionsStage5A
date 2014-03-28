<?php
require_once 'PLdap/encryptor.php';
require_once 'PLdap/tool.php';
require_once 'PLdap/log.php';
include_once 'Agent/parameter.php' ;
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

class PLdap_Agent {
	
	const DEBUG = false ;
	const SESSION_IDENTITY = "PLdap_agent" ;
	
	protected $_keyConnector = null ;
	protected $_keyAgent = null ;
	/**
	 * Encryptor
	 *
	 * @var PLdap_Encrypt_Openssl
	 */
	protected $_encryptor = null ;
	protected $_useSSL = false ;
	
	public function setKey ( $keyAgent , $keyConnector )
	{
		if (! file_exists ( $keyAgent ) or ! file_exists ( $keyConnector )) {
			$this->_useSSL = false ;
			return false ;
		}
		$this->_keyConnector = $keyConnector ;
		$this->_keyAgent = $keyAgent ;
		$this->_encryptor = new PLdap_Encryptor ( ) ;
		
		/* Load Agent Public Key */
		try {
			$this->_encryptor->loadCert ( $this->_keyConnector ) ;
		} catch ( PLdap_Encrypt_Openssl_Exception $e ) {
			return false ;
		}
		
		/* Load Connector Private Key */
		try {
			$this->_encryptor->loadPrivateKey ( $this->_keyAgent ) ;
		} catch ( PLdap_Encrypt_Openssl_Exception $e ) {
			PLDAP_Log::logError ( $e->getMessage () ) ;
			return false ;
		}
		
		PLDAP_Log::logDebug ( "Agent: SSL Enabled" ) ;
		$this->_useSSL = true ;
		return true ;
	}
	
	protected function _useSSL ()
	{
		return $this->_useSSL ;
	}
	
	protected function _prepare ( $data )
	{
		$old = strlen ( $data ) ;
		$data = gzdeflate ( $data ) ;
		$new = strlen ( $data ) ;
		PLDAP_Log::logDebug ( "Agent use zlib: Old $old, New $new" ) ;
		if ($this->_useSSL ()) {
			$data = $this->_encryptor->encryptByPublicKey ( $data ) ;
		}
		return $data ;
	}
	
	protected function _decode ( $data )
	{
		if ($this->_useSSL ()) {
			$dataDecoded = $this->_encryptor->decryptByPrivateKey ( $data ) ;
			$data = $dataDecoded ;
		}
		return $data ;
	}
	
	/**
	 * Parse the request and return data
	 *
	 * @return string Data in XML
	 */
	public function parse ()
	{
		$result = "fail" ;
		$data = "Unknow request command." ;
		$requestXml = false ;
		if (isset ( $_REQUEST [ 'request' ] )) {
			PLDAP_Log::logDebug ( "Agent Request: " . $_REQUEST [ 'request' ] ) ;
			$requestXml = base64_decode ( rawurldecode ( $_REQUEST [ 'request' ] ) ) ;
		} elseif (isset ( $_REQUEST [ 'requestSSL' ] )) {
			PLDAP_Log::logDebug ( "Agent Request: " . $_REQUEST [ 'requestSSL' ] ) ;
			$requestXml = $this->_decode ( base64_decode ( rawurldecode ( $_REQUEST [ 'requestSSL' ] ) ) ) ;
		}
		//		PLDAP_Log::logDebug("Agent Request Decoded: $requestXml");
		if (preg_match ( '/^<\?xml.*/i', $requestXml )) {
			$requests = new SimpleXMLElement ( $requestXml ) ;
			$request = $requests->request ;
			$command = $request->command ;
			PLDAP_Log::logDebug ( "Command: $command" ) ;
			switch ( $command) {
				case "connect" :
					$connect = false ;
					$parameter = new PLdap_Agent_Parameter ( ) ;
					$parameter->host = ( string ) $command->host ;
					$parameter->port = ( string ) $command->port ;
					if (self::DEBUG) {
						$connect = true ;
					} else {
						$errno = 0 ;
						$errstr = '' ;
						$fs = fsockopen ( $parameter->host, $parameter->port, $errno, $errstr, 2 ) ;
						if ($fs) {
							fclose ( $fs ) ;
							$connect = @ldap_connect ( $parameter->host, $parameter->port ) ;
						}
					}
					if ($connect) {
						$identity = uniqid ( self::SESSION_IDENTITY ) ;
						$this->_write ( $identity, serialize ( $parameter ) ) ;
						PLDAP_Log::logDebug ( "Set Identity:" . $identity ) ;
						$result = "ok" ;
						$data = $identity ;
					} else {
						$result = "fail" ;
						$data = "Can't connect to server" ;
					}
				break ;
				
				case "bind" :
					$identity = $command->identity ;
					PLDAP_Log::logDebug ( "Request Identity:" . $identity ) ;
					if ($this->_isExist ( $identity )) {
						$connect = false ;
						$parameter = unserialize ( $this->_read ( $identity ) ) ;
						/* @var $parameter PLdap_Agent_Parameter */
						$parameter->dn = rawurldecode ( $command->dn ) ;
						$parameter->password = rawurldecode ( $command->password ) ;
						$this->_write ( $identity, serialize ( $parameter ) ) ;
						if (self::DEBUG) {
							$connect = true ;
						} else {
							$errno = 0 ;
							$errstr = '' ;
							$fs = fsockopen ( $parameter->host, $parameter->port, $errno, $errstr, 2 ) ;
							if ($fs) {
								fclose ( $fs ) ;
								$connect = @ldap_connect ( $parameter->host, $parameter->port ) ;
							}
						}
						if ($connect) {
							if (! self::DEBUG) {
								@ldap_Set_Option ( $connect, LDAP_OPT_PROTOCOL_VERSION, 3 ) ;
								@ldap_Set_Option ( $connect, LDAP_OPT_REFERRALS, 0 ) ;
							}
							if (self::DEBUG) {
								$bind = true ;
							} else {
								$bind = @ldap_bind ( $connect, $parameter->dn, $parameter->password ) ;
							}
							if ($bind) {
								$result = "ok" ;
								$data = "bind ok" ;
							} else {
								$result = "fail" ;
								$data = "bind fail" ;
							}
						} else {
							$result = "fail" ;
							$data = "connect fail" ;
						}
					} else {
						$result = "fail" ;
						$data = "Can't find identity." ;
					}
				break ;
				case "search" :
					$identity = $command->identity ;
					PLDAP_Log::logDebug ( "Request Identity:" . $identity ) ;
					if ($this->_isExist ( $identity )) {
						$parameter = unserialize ( $this->_read ( $identity ) ) ;
						/* @var $parameter PLdap_Agent_Parameter */
						$parameter->baseDN = rawurldecode ( $command->baseDN ) ;
						$parameter->query = rawurldecode ( $command->query ) ;
						$parameter->fields = explode ( ",", ( string ) $command->fields ) ;
						if (isset ( $command->size )) {
							$parameter->size = ( string ) $command->size ;
						} else {
							$parameter->size = 0 ;
						}
						if (isset ( $command->timeout )) {
							$parameter->timeout = ( string ) $command->timeout ;
						} else {
							$parameter->timeout = 0 ;
						}
						if (isset ( $command->oneLevel ) and $command->oneLevel == "1") {
							$parameter->oneLevel = true ;
						}
						$this->_write ( $identity, serialize ( $parameter ) ) ;
						$result = "ok" ;
						$data = "search ok" ;
					} else {
						$result = "fail" ;
						$data = "Can't find identity." ;
					}
				break ;
				case "read" :
					$identity = $command->identity ;
					PLDAP_Log::logDebug ( "Request Identity:" . $identity ) ;
					if ($this->_isExist ( $identity )) {
						$connect = false ;
						$parameter = unserialize ( $this->_read ( $identity ) ) ;
						/* @var $parameter PLdap_Agent_Parameter */
						
						if (self::DEBUG) {
							$connect = true ;
						} else {
							$errno = 0 ;
							$errstr = '' ;
							$fs = fsockopen ( $parameter->host, $parameter->port, $errno, $errstr, 2 ) ;
							if ($fs) {
								fclose ( $fs ) ;
								$connect = @ldap_connect ( $parameter->host, $parameter->port ) ;
							}
						}
						if ($connect) {
							if (! self::DEBUG) {
								@ldap_Set_Option ( $connect, LDAP_OPT_PROTOCOL_VERSION, 3 ) ;
								@ldap_Set_Option ( $connect, LDAP_OPT_REFERRALS, 0 ) ;
							}
							if (self::DEBUG) {
								$bind = true ;
							} else {
								if (! empty ( $parameter->dn )) {
									$bind = @ldap_bind ( $connect, $parameter->dn, $parameter->password ) ;
								} else {
									$bind = @ldap_bind ( $connect ) ;
								}
							}
							if (! self::DEBUG) {
								if ($bind) {
									/* Do Search */
									if ($parameter->size > 0) {
										if ($parameter->oneLevel) {
											$search = @ldap_list ( $connect, $parameter->baseDN, $parameter->query, $parameter->fields, 0, $parameter->size, $parameter->timeout ) ;
										} else {
											$search = @ldap_search ( $connect, $parameter->baseDN, $parameter->query, $parameter->fields, 0, $parameter->size, $parameter->timeout ) ;
										}
									} else {
										if ($parameter->oneLevel) {
											$search = @ldap_list ( $connect, $parameter->baseDN, $parameter->query, $parameter->fields, 0 ) ;
										} else {
											$search = @ldap_search ( $connect, $parameter->baseDN, $parameter->query, $parameter->fields, 0 ) ;
										}
									}
									if ($search) {
										$records = @ldap_get_entries ( $connect, $search ) ;
										if ($records) {
											$result = "ok" ;
											$data = serialize ( $records ) ;
										} else {
											$result = "fail" ;
											$data = "can not read entries." ;
										}
									} else {
										$result = "fail" ;
										$data = "search fail" ;
									}
								} else {
									$result = "fail" ;
									$data = "bind fail" ;
								}
							} else {
								$result = "ok" ;
								$data = array () ;
							}
						} else {
							$result = "fail" ;
							$data = "connect fail" ;
						}
					} else {
						$result = "fail" ;
						$data = "Can't find identity." ;
					}
				break ;
				default :
					$result = "fail" ;
					$data = "Unknow request command." ;
				break ;
			}
		} else {
			$result = "fail" ;
			$data = "Error XML format." ;
		}
		$responses = $this->_getBaseResponseXml () ;
		$this->_setResponse ( $responses, $result, $data ) ;
		$myResponses = new SimpleXMLElement ( $responses ) ;
		//PLDAP_Log::logDebug("Agent Result:$result, Data:$data");
		return $this->_prepare ( $myResponses->asXML () ) ;
	}
	
	protected function _isExist ( $identity )
	{
		$tmpDir = (! PLdap_Tool::isWindows () ? "/tmp" : $_ENV [ 'TEMP' ]) ;
		$file = $tmpDir . DIRECTORY_SEPARATOR . $identity . ".txt" ;
		return file_exists ( $file ) ;
	}
	protected function _write ( $identity , $data )
	{
		
		$tmpDir = (! PLdap_Tool::isWindows () ? "/tmp" : $_ENV [ 'TEMP' ]) ;
		$file = $tmpDir . DIRECTORY_SEPARATOR . $identity . ".txt" ;
		//		PLDAP_Log::logDebug("Write session data to $file, data: $data");
		file_put_contents ( $file, $data ) ;
	}
	
	protected function _read ( $identity )
	{
		$tmpDir = (! PLdap_Tool::isWindows () ? "/tmp" : $_ENV [ 'TEMP' ]) ;
		$file = $tmpDir . DIRECTORY_SEPARATOR . $identity . ".txt" ;
		$data = file_get_contents ( $file ) ;
		//		PLDAP_Log::logDebug("Read session data from $file, data: $data");
		return $data ;
	}
	
	protected function _setResponse ( &$responses , $result , $data )
	{
		$myResult = "<result>$result</result>" ;
		$myData = "<data>" . htmlentities ( base64_encode ( $data ) ) . "</data>" ;
		$responses = sprintf ( $responses, $myResult . $myData ) ;
	}
	
	/**
	 * get base request xml
	 *
	 * @return SimpleXMLElement
	 */
	protected function _getBaseResponseXml ()
	{
		$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<responses>
%s
</responses>
XML;
		return $xmlstr ;
	}

}
?>
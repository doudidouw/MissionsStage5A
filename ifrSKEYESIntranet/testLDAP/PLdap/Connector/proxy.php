<?php
require_once 'PLdap/log.php';
include_once 'exception.php';
include_once '../encryptor.php';
include_once 'abstract.php';
include_once '../Proxy/response.php';
include_once '../proxy.php';
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
 * Ldap Connect Handler Proxy
 * 
 * @throws PLdap_Connector_Exception
 */
class PLdap_Connector_Proxy extends PLdap_Connector_Abstract {

	/**
	 * This is a identity string for proxy agent
	 * It is not a resource as Direct connect object keep.
	 *
	 * @var string
	 */
	protected $_connectKeeper = null;
	protected $_proxyURL = '';
	protected $_keyConnector = '';
	protected $_keyAgent = '';
	protected $_useSSL = false;
	/**
	 * Encryptor
	 *
	 * @var PLdap_Encrypt_Openssl
	 */
	protected $_encryptor = null;

	public function setKey($keyConnector, $keyAgent)
	{
		if (!file_exists($keyConnector) or !file_exists($keyAgent)) {
			PLDAP_Log::logDebug("Connector Proxy: key not found. Connector $keyConnector, Agent $keyAgent");
			$this->_useSSL = false;
			return false;
		}
		$this->_keyConnector = $keyConnector;
		$this->_keyAgent = $keyAgent;
		$this->_encryptor = new PLdap_Encryptor();

		/* Load Agent Public Key */
		try {
			$this->_encryptor->loadCert($this->_keyAgent);
		} catch (PLdap_Encrypt_Openssl_Exception $e){
			PLDAP_Log::logDebug("Connector Proxy:".$e->getMessage());
			return false;
		}

		/* Load Connector Private Key */
		try {
			$this->_encryptor->loadPrivateKey($this->_keyConnector);
		} catch (PLdap_Encrypt_Openssl_Exception $e){
			PLDAP_Log::logDebug("Connector Proxy:".$e->getMessage());
			return false;
		}

		PLDAP_Log::logDebug("Connector Proxy: SSL Enabled");
		$this->_useSSL = true;
		return true;
	}

	protected function _useSSL()
	{
		return $this->_useSSL;
	}

	/**
	 * get request code name
	 *
	 * @return string
	 */
	protected function _getRequestCode()
	{
		return ($this->_useSSL() ? "requestSSL" : "request");
	}

	protected function _prepare($data)
	{
		if ($this->_useSSL()) {
			try {
				$data = $this->_encryptor->encryptByPublicKey($data);
			} catch (PLdap_Encrypt_Openssl_Exception $e){
				$error = $e->getMessage();
				PLDAP_Log::logError("Connector Proxy:".$error);
			}

		}
		return $data;
	}

	/**
	 * Decode
	 *
	 * @param string $data
	 * @return string
	 */
	protected function _decode($data)
	{
		if (strlen($data) > 0 and $this->_useSSL() and !preg_match('/^<\?xml.*/i', $data)) {
			$dataDecoded = $this->_encryptor->decryptByPrivateKey($data);
			$data = $dataDecoded;
		}
		if (strlen($data) > 0) {
			$data = gzinflate($data);
		}
		return $data;
	}

	public function setProxy($url)
	{
		$this->_proxyURL = $url;
	}

	/**
	 * Connect to ldap
	 *
	 * @param string $host
	 * @param int $port
	 * @return boolean Returns true when success
	 * @throws PLdap_Connector_Exception
	 */
	public function connect($host, $port)
	{
		$xml = $this->_getBaseXml();
		$request = $xml->addChild('request');
		$command = $request->addChild('command', 'connect');
		$command->addChild("host", $host);
		$command->addChild("port", $port);

		$xmlRequest = $xml->asXML();
		PLDAP_Log::logDebug("XML Request: $xmlRequest");

		$xmlRequest = $this->_prepare($xmlRequest);
		$xmlEncode = rawurlencode(base64_encode($xmlRequest));

		$data = "Error in connect to ldap proxy agent.";
		$url = $this->_proxyURL . "?" . $this->_getRequestCode() . "=$xmlEncode";
		PLDAP_Log::logDebug("Connect Request: $url");
		/* Use Proxy */
		$proxy = PLdap_Proxy::getInstance();
		try {
			$response = $proxy->request($url);
		} catch (PLdap_Proxy_Exception $e){
			$error = $e->getMessage();
			PLDAP_Log::logError($error);
		}
		if ($response instanceof PLdap_Proxy_Response) {
			$response = $this->_decode($response);
			if (preg_match('/^<\?xml.*/i', $response)) {
				PLDAP_Log::logDebug("Response:$response");
				$responseXml = new SimpleXMLElement($response);
				$result = (string) $responseXml->result;
				$data = (string) $responseXml->data;
				PLDAP_Log::logDebug("LDAP Proxy return data: ".base64_decode($data));
				if (preg_match('/ok/i', $result)) {
					$this->host = $host;
					$this->port = $port;
					$this->_connectKeeper = base64_decode($data);

					return true;
				}
			}
		}
		throw new PLdap_Connector_Exception($data);
	}

	/**
	 * Bind to ldap
	 *
	 * @param string $dn
	 * @param string $password
	 * @return boolean
	 * @throws PLdap_Connector_Exception
	 */
	public function bind($dn = "", $password = "")
	{
		if (is_null($this->_connectKeeper)) {
			throw new PLdap_Connector_Exception("Error operation.");
		}
		$xml = $this->_getBaseXml();
		$request = $xml->addChild('request');
		$command = $request->addChild('command', 'bind');
		$command->addChild("identity", $this->_connectKeeper);
		$command->addChild("dn", rawurlencode($dn));
		$command->addChild("password", rawurlencode($password));

		$xmlRequest = $xml->asXML();

		$xmlRequest = $this->_prepare($xmlRequest);
		$xmlEncode = rawurlencode(base64_encode($xmlRequest));

		$data = "Error in connect to ldap proxy agent.";
		$url = $this->_proxyURL . "?" . $this->_getRequestCode() . "=$xmlEncode";
		PLDAP_Log::logDebug("Bind Request: $url");

		/* Use Proxy */
		$proxy = PLdap_Proxy::getInstance();
		try {
			$response = $proxy->request($url);
		} catch (PLdap_Proxy_Exception $e){
			$error = $e->getMessage();
			PLDAP_Log::logError($error);
		}
		if ($response instanceof PLdap_Proxy_Response) {
			$response = $this->_decode($response);
			if (preg_match('/^<\?xml.*/i', $response)) {
				$responseXml = new SimpleXMLElement($response);
				$result = (string) $responseXml->result;
				$data = (string) $responseXml->data;
				PLDAP_Log::logDebug("LDAP Proxy return data: ".base64_decode($data));
				if (preg_match('/ok/i', $result)) {
					return true;
				}
			}
		}
		throw new PLdap_Connector_Exception($data);
	}

	/**
	 * Search
	 *
	 * @param string $baseDN
	 * @param string $query
	 * @param array $fieldArray
	 * @param boolean $limit
	 * @param boolean $oneLevel Perform an One-Level Search
	 * @return resource
	 * @throws PLdap_Connector_Exception
	 */
	public function search($baseDN, $query, $fieldArray, $limit = true, $oneLevel = false)
	{
		if (is_null($this->_connectKeeper)) {
			throw new PLdap_Connector_Exception("Error operation.");
		}

		PLDAP_Log::logDebug("Query: $query");

		$xml = $this->_getBaseXml();
		$request = $xml->addChild('request');
		$command = $request->addChild('command', 'search');
		$command->addChild("identity", $this->_connectKeeper);
		$command->addChild("baseDN", $baseDN);
		$command->addChild("query", rawurlencode($query));
		$command->addChild("fields", implode(",", $fieldArray));
		if ($limit) {
			$command->addChild("size", $this->size);
			$command->addChild("timeout", $this->timeout);
		}
		if ($oneLevel) {
			$command->addChild("oneLevel", "1");
		}

		$xmlRequest = $xml->asXML();

		$xmlRequest = $this->_prepare($xmlRequest);
		$xmlEncode = rawurlencode(base64_encode($xmlRequest));

		$data = "Error in connect to ldap proxy agent.";
		$url = $this->_proxyURL . "?" . $this->_getRequestCode() . "=$xmlEncode";
		PLDAP_Log::logDebug("Search Request: $url");

		/* Use Proxy */
		$proxy = PLdap_Proxy::getInstance();
		try {
			$response = $proxy->request($url);
		} catch (PLdap_Proxy_Exception $e){
			$error = $e->getMessage();
			PLDAP_Log::logError($error);
		}
		if ($response instanceof PLdap_Proxy_Response) {
			$response = $this->_decode($response);
			if (preg_match('/^<\?xml.*/i', $response)) {
				$responseXml = new SimpleXMLElement($response);
				$result = (string) $responseXml->result;
				$data = (string) $responseXml->data;
				PLDAP_Log::logDebug("LDAP Proxy return data: ".base64_decode($data));
				if (preg_match('/ok/i', $result)) {
					return true;
				}
			}
		}
		throw new PLdap_Connector_Exception($data);
	}

	/**
	 * Read result
	 *
	 * @param resource $resultId
	 * @return array
	 * @throws PLdap_Connector_Exception
	 */
	public function read($resultId)
	{
		if (is_null($this->_connectKeeper)) {
			throw new PLdap_Connector_Exception("Error operation.");
		}
		$xml = $this->_getBaseXml();
		$request = $xml->addChild('request');
		$command = $request->addChild('command', 'read');
		$command->addChild("identity", $this->_connectKeeper);

		$xmlRequest = $xml->asXML();

		$xmlRequest = $this->_prepare($xmlRequest);
		$xmlEncode = rawurlencode(base64_encode($xmlRequest));

		$data = "Error in connect to ldap proxy agent.";
		$url = $this->_proxyURL . "?" . $this->_getRequestCode() . "=$xmlEncode";
		PLDAP_Log::logDebug("Read Request: $url");

		/* Use Proxy */
		$proxy = PLdap_Proxy::getInstance();
		try {
			$response = $proxy->request($url);
		} catch (PLdap_Proxy_Exception $e){
			$error = $e->getMessage();
			PLDAP_Log::logError($error);
		}
		if ($response instanceof PLdap_Proxy_Response) {
			$response = $this->_decode($response);
			if (preg_match('/^<\?xml.*/i', $response)) {
				PLDAP_Log::logDebug("Response:$response");
				$responseXml = new SimpleXMLElement($response);
				$result = (string) $responseXml->result;
				$data = (string) $responseXml->data;
				$data = base64_decode($data);
				PLDAP_Log::logDebug("LDAP Proxy return data: ".$data);
				if (preg_match('/ok/i', $result)) {
					return unserialize($data);
				}
				$error = $data;
			}
		}
		throw new PLdap_Connector_Exception($error);
	}

	/**
	 * get base request xml
	 *
	 * @return SimpleXMLElement
	 */
	protected function _getBaseXml()
	{
		$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<requests>
</requests>
XML;
		return new SimpleXMLElement($xmlstr);
	}
}
?>
<?php
require_once 'PLdap/Proxy/exception.php';
require_once 'PLdap/Proxy/response.php';
require_once 'PLdap/log.php';
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

/**
 * PLdap Proxy
 *
 */
class PLdap_Proxy {
	const DEBUG = false;

	public $host;
	public $port;
	public $user;
	public $password;
	public $timeout = 8;

	protected static $_instance = null;

	protected function __construct($host, $port, $timeout = 8, $user = '', $password = '') {
		$this->host = $host;
		$this->port = $port;
		$this->timeout = $timeout;
		$this->user = $user;
		$this->password = $password;

	}

	/**
	 * Get Proxy Instance
	 *
	 * @param string $host
	 * @param int $port
	 * @param int $timeout
	 * @param string $user
	 * @param string $password
	 * @return PLdap_Proxy
	 */
	public static function getInstance($host = '', $port = 0, $timeout = 8, $user = '', $password = '')
	{
		$host = strtolower(trim($host));

		if (self::$_instance==null) {
			if (self::DEBUG ) {
				echo "Proxy: create new instance.\n";
			}
			self::$_instance = new PLdap_Proxy($host, $port, $timeout, $user, $password);
		} elseif (!empty($host)) {
			$instance = &self::$_instance;
			/* @var $instance PLdap_Proxy */
			if ( ($instance instanceof PLdap_Proxy) and ($instance->host!==$host)) {
				$instance->host = $host;
				$instance->port = $port;
				$instance->timeout = $timeout;
				$instance->user = $user;
				$instance->password = $password;
			}
		}
		if (self::DEBUG ) {
			echo "Proxy: return instance.\n";
		}
		return self::$_instance;
	}

	/**
	 * request to url
	 *
	 * @param string $url
	 * @throws PLdap_Proxy_Exception
	 * @return PLdap_Proxy_Response
	 */
	public function request($url)
	{
		$response = new PLdap_Proxy_Response();

		if (!empty($this->host)) {
			$fs = @fsockopen($this->host, $this->port, $response->errNumber, $response->errMessage, $this->timeout);
			if( !$fs )
			{
				throw new PLdap_Proxy_Exception($response->errMessage, $response->errNumber);
			} else {
				$command = "GET $url HTTP/1.0\n";
				PLDAP_Log::logDebug("Proxy: Use Proxy ".$this->host.", request:".$command);

				fputs($fs, $command);

				/* Provide authentication info */
				if ($this->user !== '')
				{
					fputs($fs, 'Proxy-Authorization: Basic '.base64_encode($this->user.":".$this->password)."\n");
				}
				fputs($fs, "\n\n");

				/* Read response */
				$content = '';
				while (!feof($fs))
				{
					$content .= fread($fs, 4096);
				}
			}
			fclose($fs);

			/* get header */
			$response->header = substr($content, 0, strpos($content, "\r\n\r\n") );

			/* get body */
			$response->content = substr($content, strpos($content, "\r\n\r\n")+4);
		} else {
			PLDAP_Log::logDebug("Proxy: directly connect, request:".$url);
			$fp = @fopen($url, "rb");
			if ($fp) {
				$content = '';
				while (!feof($fp)) {
					$content .= fread($fp, 4096);
				}
				fclose($fp);
				$response->header = '';
				$response->content = $content;
			} else {
				throw new PLdap_Proxy_Exception("Can not connect to $url directly.");
			}
		}

		return $response;
	}
}

?>
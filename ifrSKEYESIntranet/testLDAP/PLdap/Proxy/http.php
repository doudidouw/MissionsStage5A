<?php

require_once 'PLdap/Proxy/xhttp/http.php';
require_once 'PLdap/Proxy/Http/exception.php';
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

class PLdap_Proxy_Http {
	const DEBUG = false ;
	
	public $user = '' ;
	public $password = '' ;
	public $realm = '' ;
	public $workstation = '' ;
	
	public $arguments = null ;
	public $statusCode = 0 ;
	
	/**
	 * keep http
	 *
	 * @var http_class
	 */
	protected $_http = null ;
	protected $_isPrepare = false ;
	protected $_isConnected = false ;
	protected $_rawResponse = '' ;
	
	public function __construct ( $user = '' , $password = '' ) {
		$this->user = $user ;
		$this->password = $password ;
		
		set_time_limit ( 0 ) ;
		$http = new http_class ( ) ;
		
		/* Connection timeout */
		$http->timeout = 0 ;
		
		/* Data transfer timeout */
		$http->data_timeout = 0 ;
		
		/* Output debugging information about the progress of the connection */
		if (self::DEBUG) {
			$http->debug = 1 ;
		} else {
			$http->debug = 0 ;
		}
		$http->debug_response_body = 0 ;
		
		/* Format dubug output to display with HTML pages */
		$http->html_debug = 0 ;
		
		/*
		*  Need to emulate a certain browser user agent?
		*  Set the user agent this way:
		*/
		$http->user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)" ;
		
		/*
		*  If you want to the class to follow the URL of redirect responses
		*  set this variable to 1.
		*/
		$http->follow_redirect = 1 ;
		
		/*
		*  How many consecutive redirected requests the class should follow.
		*/
		$http->redirection_limit = 5 ;
		
		/*
		*  If your DNS always resolves non-existing domains to a default IP
		*  address to force the redirection to a given page, specify the
		*  default IP address in this variable to make the class handle it
		*  as when domain resolution fails.
		*/
		$http->exclude_address = "" ;
		
		$this->_http = $http ;
	
	}
	
	/**
	 * Check prepare
	 *
	 * @return boolean
	 */
	public function isPrepared () {
		return $this->_isPrepare ;
	}
	
	/**
	 * Prepare before connect
	 * ATTENTION: This will clear the arguments
	 *
	 * @param string $url
	 */
	public function prepare ( $url ) {
		//	$user="";
		//	$password="";
		//	$realm="";       /* Authentication realm or domain      */
		//	$workstation=""; /* Workstation for NTLM authentication */
		$authentication = (strlen ( $this->user ) ? UrlEncode ( $this->user ) . ":" . UrlEncode ( $this->password ) . "@" : "") ;
		
		if (! empty ( $authentication )) {
			$urlArray = parse_url ( $url ) ;
			$scheme = $urlArray [ 'scheme' ] ;
			$pattern = '/^' . $scheme . ':\/\/(.*)$/i' ;
			$match = null ;
			preg_match ( $pattern, $url, $match ) ;
			$url = $scheme . "://" . $authentication . $match [ 1 ] ;
		}
		
		/*
		*  Generate a list of arguments for opening a connection and make an
		*  HTTP request from a given URL.
		*/
		$arguments = null ;
		$error = $this->_http->GetRequestArguments ( $url, $arguments ) ;
		if ($error !== '') {
			throw new PLdap_Proxy_Http_Exception ( "Error in get arguments" ) ;
		}
		
		if (strlen ( $this->realm )) {
			$arguments [ "AuthRealm" ] = $this->realm ;
		}
		if (strlen ( $this->workstation )) {
			$arguments [ "AuthWorkstation" ] = $this->workstation ;
		}
		$this->_http->authentication_mechanism = "" ; // force a given authentication mechanism;
		

		/*
		*  If you need to access a site using a proxy server, use these
		*  arguments to set the proxy host and authentication credentials if
		*  necessary.
		*/
		/*
		$arguments["ProxyHostName"]="127.0.0.1";
		$arguments["ProxyHostPort"]=3128;
		$arguments["ProxyUser"]="proxyuser";
		$arguments["ProxyPassword"]="proxypassword";
		$arguments["ProxyRealm"]="proxyrealm";  // Proxy authentication realm or domain
		$arguments["ProxyWorkstation"]="proxyrealm"; // Workstation for NTLM proxy authentication
		$http->proxy_authentication_mechanism=""; // force a given proxy authentication mechanism;
		*/
		
		/* Set additional request headers */
		$arguments [ "Headers" ] [ "Pragma" ] = "nocache" ;
		/*
		Is it necessary to specify a certificate to access a page via SSL?
		Specify the certificate file this way.
		$arguments["SSLCertificateFile"]="my_certificate_file.pem";
		$arguments["SSLCertificatePassword"]="some certificate password";
		*/
		
		/*
		Is it necessary to preset some cookies?
		Just use the SetCookie function to set each cookie this way:

		$cookie_name="LAST_LANG";
		$cookie_value="de";
		$cookie_expires="2010-01-01 00:00:00"; // "" for session cookies
		$cookie_uri_path="/";
		$cookie_domain=".php.net";
		$cookie_secure=0; // 1 for SSL only cookies
		$http->SetCookie($cookie_name, $cookie_value, $cookie_expiry, $cookie_uri_path, $cookie_domain, $cookie_secure);
		*/
		$this->arguments = $arguments ;
		$this->_isPrepare = true ;
	}
	
	public function getCookies () {
		return $this->_http->cookies ;
	}
	
	public function setAcceptLanguage ( $lang = "zh-tw" ) {
		$this->addHeader ( "Accept-Language", $lang ) ;
	}
	
	public function setRequestMethod ( $method = "GET" ) {
		$this->arguments [ "RequestMethod" ] = $method ;
	}
	
	/**
	 * Add parameter to header
	 *
	 * @param string $field
	 * @param string $value
	 */
	public function addHeader ( $field , $value ) {
		$this->arguments [ "Headers" ] [ $field ] = ( string ) $value ;
	}
	
	/**
	 * Add post data
	 *
	 * @param string $field
	 * @param string $value
	 */
	public function addPostData ( $field , $value ) {
		$this->arguments [ "PostValues" ] [ $field ] = ( string ) $value ;
	}
	
	public function cleanPostData () {
		$this->arguments [ "PostValues" ] = '' ;
	}
	
	/**
	 * Add post datas
	 *
	 * @param array $array
	 */
	public function addPostDatas ( $array ) {
		foreach ( $array as $key => $value ) {
			$this->arguments [ "PostValues" ] [ $key ] = ( string ) $value ;
		}
	}
	
	public function getRawData () {
		return $this->_rawResponse ;
	}
	
	/**
	 * Connect
	 *
	 * @return boolean
	 */
	public function connect () {
		if (! $this->isPrepared ()) {
			return false ;
		}
		$http = &$this->_http ;
		/* @var $http http_class */
		$error = $http->Open ( $this->arguments ) ;
		if ($error == '') {
			$this->_isConnected = true ;
			return true ;
		}
		return false ;
	}
	
	/**
	 * Send Request
	 *
	 * @return string Return false on fails
	 */
	public function sendRequest () {
		if (! $this->_isConnected) {
			return false ;
		}
		$http = &$this->_http ;
		/* @var $http http_class */
		$error = $http->SendRequest ( $this->arguments ) ;
		if ($error == '') {
			$headers = null ;
			$error = $http->ReadReplyHeaders ( $headers ) ;
			if ($error == "") {
				$this->statusCode = $http->response_status ;
				$data = $this->readResponse () ;
				$this->_rawResponse = $data ;
				return $data ;
			}
		}
		if (self::DEBUG) {
			echo "Send Request Error, Code: $this->statusCode, Result: $error" ;
		}
		return false ;
	}
	
	/**
	 * Read response
	 *
	 * @return string
	 */
	public function readResponse () {
		$content = '' ;
		if (! $this->_isConnected) {
			return $content ;
		}
		$http = &$this->_http ;
		/* @var $http http_class */
		$body = '' ;
		for ( ; ; ) {
			$error = $http->ReadReplyBody ( $body, 1000 ) ;
			if ($error != "" or strlen ( $body ) == 0) {
				break ;
			}
			$content .= $body ;
		}
		return $content ;
	}
	
	/**
	 * Close
	 *
	 */
	public function close () {
		$http = &$this->_http ;
		/* @var $http http_class */
		$http->Close () ;
		$this->_isConnected = false ;
	}
}

?>
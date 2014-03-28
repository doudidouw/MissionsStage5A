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

/* Load Exception */
require_once 'PLdap/log.php';
require_once ("Openssl/exception.php") ;

/**
 * Openssl
 *
 * @category PLdap
 * @package PLdap_Encrypt
 * @throws PLdap_Encrypt_Openssl_Exception
 */
class PLdap_Encryptor {
	
	protected $_myCert ;
	protected $_myPrivateKey ;
	protected $_myPublicKey ;
	
	/**
	 * Load the private key
	 *
	 * @param string $fileOfPrivateKey The file of private key with full path
	 * @param string[Optional] $passPhrase The needed pass phrase to load the private key.
	 */
	public function loadPrivateKey ( $fileOfPrivateKey , $passPhrase = null ) {
		/* check if private key exist */
		if (! is_null ( $fileOfPrivateKey ) and file_exists ( $fileOfPrivateKey )) {
			/* Load It */
			$privateKeyX509 = file_get_contents ( $fileOfPrivateKey ) ;
			if (is_null ( $passPhrase )) {
				PLDAP_Log::logDebug ( "Load $fileOfPrivateKey without passphrase." ) ;
				$this->_myPrivateKey = openssl_get_privatekey ( $privateKeyX509 ) ;
			} else {
				PLDAP_Log::logDebug ( "Load $fileOfPrivateKey with $passPhrase." ) ;
				$this->_myPrivateKey = openssl_get_privatekey ( $privateKeyX509, $passPhrase ) ;
			}
			/* check if private key is resource */
			if (! is_resource ( $this->_myPrivateKey )) {
				throw new PLdap_Encrypt_Openssl_Exception ( "Can not load private key." ) ;
			}
		}
	}
	
	/**
	 * Load the certification
	 *
	 * @param string $fileOfCert The file of the cert with full path
	 */
	public function loadCert ( $fileOfCert ) {
		/* Check if cert exist */
		if (! is_null ( $fileOfCert ) and file_exists ( $fileOfCert )) {
			/* Load it */
			$certX509 = file_get_contents ( $fileOfCert ) ;
			PLDAP_Log::logDebug ( "Load X509 $fileOfCert." ) ;
			$this->_myCert = openssl_x509_read ( $certX509 ) ;
			/* Check if Cert is resource */
			if (! is_resource ( $this->_myCert )) {
				throw new PLdap_Encrypt_Openssl_Exception ( "Can not load cert." ) ;
			}
			
			/* Retrieve the public key */
			$this->_myPublicKey = openssl_get_publickey ( $certX509 ) ;
			/* check if Public key is resource */
			if (! is_resource ( $this->_myPublicKey )) {
				throw new PLdap_Encrypt_Openssl_Exception ( "Can not retrieve the public key from cert." ) ;
			}
		}
	}
	
	/**
	 * Encrypt data by private key
	 *
	 * @param string $data
	 * @return string
	 */
	public function encryptByPrivateKey ( $data ) {
		if (empty ( $this->_myPrivateKey )) {
			throw new PLdap_Encrypt_Openssl_Exception ( "Load the private key before encrypt." ) ;
		}
		
		$maxlength = 117 ;
		$encrypted = '' ;
		$output = '' ;
		while ( $data ) {
			$input = substr ( $data, 0, $maxlength ) ;
			$data = substr ( $data, $maxlength ) ;
			$result = openssl_private_encrypt ( $input, $encrypted, $this->_myPrivateKey ) ;
			if (! $result) {
				throw new PLdap_Encrypt_Openssl_Exception ( "Encrypt data '$input' by private key error." ) ;
			}
			$output .= $encrypted ;
		}
		
		return $output ;
	}
	
	/**
	 * Encrypt data by public key
	 *
	 * @param string $data
	 * @return string
	 */
	public function encryptByPublicKey ( $data ) {
		if (empty ( $this->_myPublicKey )) {
			throw new PLdap_Encrypt_Openssl_Exception ( "Load the cert before encrypt." ) ;
		}
		$maxlength = 117 ;
		$encrypted = '' ;
		$output = '' ;
		while ( $data ) {
			$input = substr ( $data, 0, $maxlength ) ;
			$data = substr ( $data, $maxlength ) ;
			$result = openssl_public_encrypt ( $input, $encrypted, $this->_myPublicKey ) ;
			if (! $result) {
				throw new PLdap_Encrypt_Openssl_Exception ( "Encrypt data '$input' by public key error." ) ;
			}
			$output .= $encrypted ;
		}
		
		return $output ;
	}
	
	/**
	 * Decrypt data by public key
	 *
	 * @param string $dataEncrypted
	 * @return string
	 */
	public function decryptByPublicKey ( $dataEncrypted ) {
		if (empty ( $this->_myPublicKey )) {
			throw new PLdap_Encrypt_Openssl_Exception ( "Load the cert before decrypt." ) ;
		}
		
		$maxlength = 128 ;
		$output = '' ;
		while ( $dataEncrypted ) {
			$input = substr ( $dataEncrypted, 0, $maxlength ) ;
			$dataEncrypted = substr ( $dataEncrypted, $maxlength ) ;
			$decrypted = '' ;
			$result = openssl_public_decrypt ( $input, $decrypted, $this->_myPublicKey ) ;
			if (! $result) {
				throw new PLdap_Encrypt_Openssl_Exception ( "Decrypt data '$input' by public key error." ) ;
			}
			$output .= $decrypted ;
		}
		
		return $output ;
	
	}
	
	/**
	 * Decrypt data by private key
	 *
	 * @param string $dataEncrypted
	 * @return string
	 */
	public function decryptByPrivateKey ( $dataEncrypted ) {
		if (empty ( $this->_myPrivateKey )) {
			throw new PLdap_Encrypt_Openssl_Exception ( "Load the private key before decrypt." ) ;
		}
		$maxlength = 128 ;
		$output = '' ;
		while ( $dataEncrypted ) {
			$input = substr ( $dataEncrypted, 0, $maxlength ) ;
			$dataEncrypted = substr ( $dataEncrypted, $maxlength ) ;
			$decrypted = '' ;
			$result = openssl_private_decrypt ( $input, $decrypted, $this->_myPrivateKey ) ;
			if (! $result) {
				throw new PLdap_Encrypt_Openssl_Exception ( "Decrypt data '$input' by private key error." ) ;
			}
			$output .= $decrypted ;
		}
		
		return $output ;
	}
	
	/**
	 * Export the cert
	 *
	 * @return string
	 */
	public function exportCert () {
		if (empty ( $this->_myCert )) {
			throw new PLdap_Encrypt_Openssl_Exception ( "Load the cert before export." ) ;
		}
		$certX509 = '' ;
		$result = openssl_x509_export ( $this->_myCert, $certX509 ) ;
		if ($result) {
			return $certX509 ;
		}
		throw new PLdap_Encrypt_Openssl_Exception ( "Could not export cert." ) ;
	}
}
?>
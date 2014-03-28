<?php
require_once 'PLdap/control.php';
require_once 'PLdap/domain.php';

/*
 * Create new domains instance
 * Every domain can use different type of LDAP server.
 */
// Add an AD domain
$domainTW = new PLdap_Domain('ad1.liber.com.tw,ad2.liber.com.tw', PLdap_Domain::TYPE_ACTIVEDIRECTORY, 'DC=liber,DC=com,DC=tw', 'liber.com.tw', 'pldap@liber.com.tw', '12345');
// Add a Domino domain
$domainUSA = new PLdap_Domain('ad1.liber.com,ad2.liber.com', PLdap_Domain::TYPE_DOMINO, 'DC=liber,DC=com', 'liber.com', 'pldap@liber.com', '12345');

/*
 * Create a new control, and add a domain to control
 */
$control = new PLdap_Control();
$control->addDomain($domainTW);
$control->addDomain($domainUSA);

/*
 * Login by email
 */
$account = 'user1@liber.com';
$user = $control->searchUser($account);
if (!$user) {
	die('Could not find user '.$account);
}

$valid = $control->authenticate($user, 'mypassword');
if ($valid) {
	$login = true;
} else {
	$login = false;
}

/*
 * Login by CN
 */
$account = 'user1';
$user = $control->searchUser($account);
if (!$user) {
	die('Could not find user '.$account);
}

$valid = $control->authenticate($user, 'mypassword');
if ($valid) {
	$login = true;
} else {
	$login = false;
}


?>
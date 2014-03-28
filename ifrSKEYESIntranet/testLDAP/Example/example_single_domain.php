<?php
require_once 'PLdap/control.php';
require_once 'PLdap/domain.php';

/*
 * Create a new domain instance
 * You can use more than one ldap server
 */
$domain1 = new PLdap_Domain('srvad', PLdap_Domain::TYPE_ACTIVEDIRECTORY, 'DC=liber,DC=com', 'liber.com', 'pldap@liber.com', '12345');

/*
 * Create a new control, and add a domain to control
 */
$control = new PLdap_Control();
$control->addDomain($domain1);

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
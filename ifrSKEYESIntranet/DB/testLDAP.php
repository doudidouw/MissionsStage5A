<?php

// LDAP variables
$ldaphost = "srvad";
//$ldaphost = "192.168.168.204";  
$ldapport = 389;                 
$dn = "o=ifrskeyes, c intra"; 
$baseDN = "dc=ifrskeyes, dc=intra";
$ldapconn = null;

// Connecting to LDAP
try {
    $ldapconn = ldap_connect($ldaphost, $ldapport);
    echo 'You are now connected to ' .$ldaphost .'.<br />';
} catch(Exception $e) {
    echo $e->getMessage() . ' : Could not connect to ' .$ldaphost;
    die();
}

// Binding 
try {
    $bindServerLDAP = ldap_bind($ldapconn, $dn);
    echo 'Bind successful. <p />';
}
catch(Exception $e) {
    echo $e->getMessage() . ' : Bind unsuccessful';
    die();
}


$query = "sn=dussoulier";

echo "Recherche suivant le filtre " .$query. "<br />";

$result = ldap_search($ldapconn, $baseDN, $query);
//
//echo "Le resultat de la recherche est ". $result. "<br />";
//
//echo "Le nombre d'entrees retournees est ".ldap_count_entries($ldapconn,$result)."<p />";
//
//echo "Lecture de ces entrees ....<p />";
//
//$info = ldap_get_entries($ldapconn, $result);
//
//echo "Donnees pour ".$info['count']." entrees:<p />";
//
//for ($i=0; $i<$info['count']; $i++) {
//        echo "givenName est : ". $info[$i]['givenName'] ."<br />";
//        echo "premiere entree cn : ". $info[$i]['cn'][0] ."<br />";
//        echo "premier email : ". $info[$i]['mail'][0] ."<p />";
//}

/* 4ème étape : cloture de la session  */
echo "Fermeture de la connexion";

ldap_close($ldapconn);


?>
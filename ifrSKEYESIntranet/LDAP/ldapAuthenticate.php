<?php


error_reporting(E_ERROR | E_PARSE);

if (($_REQUEST['method'] == 'authenticate') && (isset($_REQUEST['formData']))){
    $userData = array();
    parse_str($_REQUEST['formData'], $userData);

    $baseDN = "OU=Utilisateurs,OU=siege,DC=ifrskeyes,DC=intra";
    $ldapServer = "srvad";
    $ldapServerPort = 389;
    $mdpVDoc="vdocadmin";
    $mdpKelio = "ifrkeliousr";
    $dnVDoc = "CN=Compte VDOC,OU=Services,OU=Systeme,OU=Utilisateurs,OU=siege,DC=ifrskeyes,DC=intra";

    //connection to LDAP server
    $conn=ldap_connect($ldapServer);
    ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        
    $bindVDocToServerLDAP = ldap_bind($conn,$dnVDoc,$mdpVDoc);    

    //if connection successfull
    if ($bindVDocToServerLDAP) {
        // Find the user's DN
        $query = "sAMAccountName=" .$$userData['login'];
        $search_status = ldap_search($conn, $baseDN, $query, array('dn'));
        if ($search_status === FALSE) {
            echo json_encode("Search on LDAP failed");
            return -1;
        }

        // Pull the search results
        $result = ldap_get_entries($conn, $search_status);
        if ($result === FALSE) {
            echo json_encode("Couldn't pull search results from LDAP");
            return -1;
        }

        if (((int) @$result['count'] > 0) && ((int) @$result['count'] == 1)) {
            $userdn = $result[0]['dn'];
        }

        if (trim((string) $userdn) == '') {
            echo json_encode("Empty DN. Something is wrong.");
            return -1;
        }

        // Authenticate with the newly found DN and user-provided password
        $auth_status = ldap_bind($conn, $userdn, $$userData['password']);
        if ($auth_status === FALSE) {
            echo json_encode("Couldn't bind to LDAP as user!");
            return -1;
        }

        ldap_close($conn);
    }  else {
            echo json_encode("Couldn't bind with server");
            return -1;
    }
    
    
    
    echo json_encode("Success");
    
}

?>



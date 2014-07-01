<?php

//error_reporting(E_ERROR | E_PARSE);

//if (($_REQUEST['method'] == 'contactSI') && (isset($_REQUEST['formData']))){
//    $emailData = array();
//    parse_str($_REQUEST['formData'], $emailData);
//    //ini_set('SMTP','smtp.gnet.tn');
//    $login = $emailData['loginForProblemStatement'];
//    $email = $emailData['emailForProblemStatement'];
//    $message = wordwrap($emailData['message'], 70);
//    
//    mail("cherifidounia@hotmail.fr", "Connexion Portail Intranet", $message, "From: ".$email."\n");
//    
//    echo json_encode("Success");
//}


    ini_set('SMTP', 'smtp..com');
    $login = 'niah';
    $email = 'google@bouh.fr';
    $message = 'badaaaaaaaaaaaaaaa';
    
    mail("cherifidounia@hotmail.fr", "Connexion Portail Intranet", $message, "From: ".$email."\n");
    
    echo json_encode("Success");

?>
    
    
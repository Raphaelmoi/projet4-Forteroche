<?php

function sendAMail($name, $mail, $tel, $msg){
    $name = 'nom : ' . $name;
    $tel = 'telephone : ' . $tel ;

    ini_set( 'display_errors', 1 );
 
    error_reporting( E_ALL );
 
    $from = $mail;
 
    $to = "raphael.mouly@free.fr";
 
    $subject =  "message depuis le site de Jean Forteroche";
    
    $message = $name . $tel . $msg;
     
    $headers = "From:" . $from;
 
    mail($to,$subject,$message, $headers);

    echo " <script> alert('message envoyé')</script>" ;
}

?>
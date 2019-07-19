<?php

	$name = 'nom : ' . htmlspecialchars($_POST['name']) . '<br>';
	$tel = 'telephone : ' . htmlspecialchars($_POST['tel']) . '<br>';
 
    ini_set( 'display_errors', 1 );
 
    error_reporting( E_ALL );
 
    $from = htmlspecialchars($_POST['mail']);
 
    $to = "raphael.mouly@free.fr";
 
    $subject =  "message depuis le site de Jean Forteroche";
 	
    $message = $name . $tel . htmlspecialchars($_POST['msg']);
	 
    $headers = "From:" . $from;
 
    mail($to,$subject,$message, $headers);
 
	echo "<script> alert('message envoyé');</script>" ;
?>
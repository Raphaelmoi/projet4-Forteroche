<?php

/**
 * 
 */
class UtiController {
	
	function __construct(argument)
	{
		# code...
	}

	//recupere url actuel et la met au bon format pour pouvoir y ajouter identifiant
	//sert uniquement au systeme de page de aside
	function getUrl() {
		$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']) , 'https') === false ? 'http' : 'https';

		$host = $_SERVER['HTTP_HOST'];
		$script = $_SERVER['SCRIPT_NAME'];
		$params = $_SERVER['QUERY_STRING'];

		$currentUrl = $protocol . '://' . $host . $script . '?' . $params;

		if (preg_match("#\?page=[0-9]#", $currentUrl)) {
			$currentUrl = preg_replace("#\?page=[0-9]#", '?', $currentUrl);
		}
		elseif (preg_match("#page=[0-9]#", $currentUrl)) {
			$currentUrl = preg_replace("#page=[0-9]#", '', $currentUrl);
		}
		elseif (preg_match("#&page=[0-9]#", $currentUrl)) {
			$currentUrl = preg_replace("#&page=[0-9]#", '&', $currentUrl);
		}
		else {
			$currentUrl = $currentUrl . '&';
		}
		return $currentUrl;
	}

	//fait disparaitre image et video des extraits
	//plus donne une longueur max a l'extrait de 600 caracteres
	function formateArticle($ContenuBillet){

	    if(preg_match("/<img[^>]+\>/i", $ContenuBillet)) {
	        $ContenuBillet = preg_replace("/<img[^>]+\>/i", "", $ContenuBillet); 
	    }
	    if(preg_match("/<iframe[^>]+\>/i", $ContenuBillet)) {
	         $ContenuBillet = preg_replace("/<iframe[^>]+\>/i", "", $ContenuBillet); 
	    }
	    $ContenuBillet = substr($ContenuBillet, 0, 520).'...'; 
	    return $ContenuBillet;
	}


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
}
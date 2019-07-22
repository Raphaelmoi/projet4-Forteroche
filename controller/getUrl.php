<?php
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
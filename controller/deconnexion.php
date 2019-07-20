
<?php 
session_start();

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Suppression du fichier cookie
setcookie('login', '', time() - 3600, '/');
// Suppression de la valeur du cookie en mémoire dans $_COOKIE
unset($_COOKIE['login']);

header('Location: /projet4/index.php');
?>
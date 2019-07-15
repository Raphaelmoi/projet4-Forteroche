
<?php 
session_start();


echo $_SESSION['pseudo'];
// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();



// Suppression des cookies de connexion automatique
setcookie('login', '');
setcookie('pass_hache', '');

header('Location: /projet4/index.php');
?>
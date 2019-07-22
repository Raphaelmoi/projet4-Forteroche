<?php
require_once("Manager.php"); 

class ConnexionManager extends Manager
{
    //get user data, needed when try to connect
    public function getUser($pseudo)
    {
    	$bdd = $this->dbConnect();
    	$nRows = $bdd->query("SELECT count(pseudo) FROM membres WHERE pseudo = '$pseudo'")->fetchColumn(); 
		if ($nRows ==0) {
				header('Location: accueil.php?action=connect&erreur=a');
			}
		$req = $bdd->prepare('SELECT id, pseudo, pass, email FROM membres WHERE pseudo = ?');
		$req->execute(array($pseudo));
		return $req;
    }
    //when user want to change password
    public function updateUserPw($pass, $pseudo){
    	$bdd = $this->dbConnect();
    	$req = $bdd->query("UPDATE membres SET pass = '$pass' WHERE pseudo = '$pseudo';");
        return $req;
    }
}

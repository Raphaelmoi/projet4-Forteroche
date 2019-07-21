<?php
require_once("Manager.php"); 

class ConnexionManager extends Manager
{

    public function getUser($pseudo)
    {
    	$bdd = $this->dbConnect();
    	$nRows = $bdd->query("SELECT count(pseudo) FROM membres WHERE pseudo = '$pseudo'")->fetchColumn(); 
		if ($nRows ==0) {
				header('Location: accueil.php?action=connect&erreur=a');
			}

		$req = $bdd->prepare('SELECT id, pseudo, pass FROM membres WHERE pseudo = ?');
		$req->execute(array($pseudo));

		return $req;
    }

    public function updateUserPw($pass, $pseudo){
    	$bdd = $this->dbConnect();
    	$req = $bdd->query("UPDATE membres SET pass = '$pass' WHERE pseudo = '$pseudo';");
    	echo "string";

        return $req;
    }
}

<?php
class Connect{
	public function connexion()
	{
		require_once("model/ConnexionManager.php"); 
		/*verifie la bonne recuperation des donnees d'un connexion en cours*/
		$connexionIsOn = false;
		//si pseudo et mot de passe sont passé via post
		if (isset($_POST['connexion_pseudo']) AND isset($_POST['connexion_motdepasse']) )
		{
			$pseudo = htmlspecialchars($_POST['connexion_pseudo']);
			$motdepasse = htmlspecialchars($_POST['connexion_motdepasse']);
			$connexionIsOn = true;
		}
	   	if ($connexionIsOn == true) {
		    $connexionManager = new ConnexionManager();
		    $req = $connexionManager -> getUser($pseudo);
			while ($donnees = $req->fetch())
			{
				if ( empty($_SESSION['pseudo'])) {
					if (password_verify($motdepasse, $donnees['pass'])) {
				    	$_SESSION['pseudo'] = $donnees['pseudo'];
				    	header('Location: /projet4/index.php?action=homeControl');
				    }
				    else {
						header('Location: accueil.php?action=connect&erreur=b');
					}				
				}else {
						header('Location: accueil.php?action=connect&erreur=b');
				}	
			}
			$req->closeCursor(); 
		}
	}
	public function deconnexion()
	{
		session_start();
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();
		header('Location: /projet4/index.php');
	}

	public function newPass()
	{
		if (isset($_POST['pseudo']) AND isset($_POST['old_password']) AND isset($_POST['new_password'])) {

	   		$pseudo = htmlspecialchars($_POST['pseudo']);
			$old_password = htmlspecialchars($_POST['old_password']);
			$new_password = htmlspecialchars($_POST['new_password']);
			
			require_once("model/ConnexionManager.php"); 
			$connexionManager = new ConnexionManager();
			$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
			$req = $connexionManager -> updateUserPw($hashed_password, $pseudo);				
			} 	   			
		else { 
			echo 'isset bug';
	   	}
	}
}


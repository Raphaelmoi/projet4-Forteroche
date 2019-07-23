<?php
/*
*USER LOGIN, LOGOUT AND PASWWORD CHANGING FUNCTIONS
*logIN() -> connect 
*logOut() -> disconnect
*newPass() -> change password
*newMail() -> change mail
*newPseudo() -> change pseudo
*/
class UserController{
	public function logIn()
	{
		require_once("model/UserManager.php"); 
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

		    $connexionManager = new UserManager();
		    $count = $connexionManager -> count($pseudo);
			if ($count !=0) {
		    	$req = $connexionManager -> getUser($pseudo);
				while ($donnees = $req->fetch())
				{
					if ( empty($_SESSION['pseudo'])) {
						if (password_verify($motdepasse, $donnees['pass'])) {
					    	$_SESSION['pseudo'] = $donnees['pseudo'];
					    	header('Location: /projet4/index.php?action=homeControl&success=connexion&pseudo='.$donnees['pseudo']);
					    }
					    else {
							header('Location: index.php?action=connect&erreur=identifiant');
						}				
					}else {
						header('Location: index.php?action=connect&erreur=identifiant');
					}	
				}
				$req->closeCursor(); 
			}
			else
				header('Location: index.php?action=connect&erreur=identifiant');
		}
	}
	public function logOut()
	{
		session_start();
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();
		header('Location: /projet4/index.php');
	}

	public function newPass($oldPass, $newPass, $pseudo)
	{
		require_once("model/UserManager.php"); 
		$connexionManager = new UserManager();
		$count = $connexionManager -> count($pseudo);
			if ($count !=0) {
				$test = $connexionManager -> getUser($pseudo);
				while ($donnees = $test->fetch())
				{
				if (password_verify($oldPass, $donnees['pass'])) {
					if ($oldPass != $newPass) {
						$hashed_password = password_hash($newPass, PASSWORD_DEFAULT);
						$req = $connexionManager -> updateUserPw($hashed_password, $pseudo);
						header('Location: index.php?action=homeControl&success=updatepass');  
					}
					 else
					 	header('Location: index.php?action=settings&erreur=samepw');   
				}
				else
					header('Location: index.php?action=settings&erreur=passpseudo');   
			}
		}
		else
			header('Location: index.php?action=settings&erreur=passpseudo');	
	}

	public function newMail($pseudo, $oldmail, $newmail, $pass){
		require_once("model/UserManager.php"); 
		$connexionManager = new UserManager();
		$count = $connexionManager -> count($pseudo);
		if ($count !=0) {
			$test = $connexionManager -> getUser($pseudo);
			while ($donnees = $test->fetch())
			{
				if (password_verify($pass, $donnees['pass'])) {
					if ($oldmail == $donnees['email']) {

						if (preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $newmail )) {
							$req = $connexionManager -> updateUserMail($newmail, $pseudo);
							header('Location: index.php?action=homeControl&success=updatemail');  
						}
						else 
							header('Location: index.php?action=settings&change=mail&erreur=mailbadsyntax');
					}
					else			
					header('Location: index.php?action=settings&change=mail&erreur=badmailfrombbd');   
				}
				else
					header('Location: index.php?action=settings&change=mail&erreur=passpseudo');   
			}
		}
		else
			header('Location: index.php?action=settings&change=mail&erreur=passpseudo');		
	}

	public function newPseudo($newpseudo, $pseudo, $pass)
	{
		require_once("model/UserManager.php"); 
		$connexionManager = new UserManager();
		$count = $connexionManager -> count($pseudo);

		if ($count != 0) {
			$user = $connexionManager -> getUser($pseudo);
			while ($donnees = $user->fetch())
			{
			if (password_verify($pass, $donnees['pass'])) {
				if ($pseudo != $newpseudo) {
					$req = $connexionManager -> updateUserPseudo($pseudo, $newpseudo);
					header('Location: index.php?action=homeControl&success=updatepseudo');  
				}
				 else
				 	header('Location: index.php?action=settings&change=pseudo&erreur=diffpseudo'); 
				}
			else
				header('Location: index.php?action=settings&change=pseudo&erreur=passpseudo');   
			}		
		}else
		header('Location: index.php?action=settings&change=pseudo&erreur=passpseudo'); 
	}
}


<?php
	session_start();
	require_once("../model/ConnexionManager.php"); 

		/*verifie la bonne recuperation des donnees d'un connexion en cours*/
		$connexionIsOn = false;

		if (!empty($_SESSION['pseudo']) ) {
			$pseudo = htmlspecialchars($_SESSION['pseudo']);
			$connexionIsOn = true;
		}	
		elseif (isset($_COOKIE['login'])) {
			$connexionIsOn =  true;
		}

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

				if (!isset($_COOKIE['login']) || empty($_SESSION['pseudo'])) {

					if (password_verify($motdepasse, $donnees['pass'])) {
			    	
				    	$_SESSION['pseudo'] = $donnees['pseudo'];


				    	//si on coche case connexion auto
				    	if (isset($_POST['connexionAuto'])) {
				    		setcookie('login', $donnees['pseudo'], time() + 365*24*3600,'/',null,false,true);

				    	}

				    	header('Location: /projet4/index.php?action=homeControl');

				    }
				    else {
						header('Location: accueil.php?action=connect&erreur=b');
					}				
				}

				?>

			<?php
			}
			$req->closeCursor(); // Termine le traitement de la requête
		}
?>

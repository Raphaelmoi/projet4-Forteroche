<?php
	session_start();
	require_once("../model/ConnexionManager.php"); 

		/*verifie la bonne recuperation des donnees d'un connexion en cours*/
		$connexionIsOn = false;
		if (!empty($_SESSION['pseudo']) AND !empty($_SESSION['id'])) {
			$pseudo = htmlspecialchars($_SESSION['pseudo']);
			$motdepasse = htmlspecialchars($_SESSION['id']);
			$connexionIsOn = true;
		};	

		if (isset($_POST['connexion_pseudo']) AND isset($_POST['connexion_motdepasse']) )
		{
			$pseudo = htmlspecialchars($_POST['connexion_pseudo']);
			$motdepasse = htmlspecialchars($_POST['connexion_motdepasse']);
			$connexionIsOn = true;
		}
		elseif (!empty($_COOKIE['login']) && !empty($_COOKIE['pass_hache'])) {
			$pseudo = htmlspecialchars($_COOKIE['login']);
			$motdepasse = htmlspecialchars($_COOKIE['pass_hache']);
			$connexionIsOn =  true;
		}

	   	if ($connexionIsOn == true) {
		    $ConnexionManager = new ConnexionManager(); // Création d'un objet
		    $bdd = $ConnexionManager -> dbConnect();

			//verifie si pseudo est présent dans la bdd
			$nRows = $bdd->query("SELECT count(pseudo) FROM membres WHERE pseudo = '$pseudo'")->fetchColumn(); 
			if ($nRows ==0) {
				header('Location: accueil.php?erreur=a');
			}

			$req = $bdd->prepare('SELECT id, pseudo, pass FROM membres WHERE pseudo = ?');
			$req->execute(array($pseudo));
			
			while ($donnees = $req->fetch())
			{
				if (password_verify($motdepasse, $donnees['pass'])) {
		    	
			    	$_SESSION['id']= $donnees['pass'];
			    	$_SESSION['pseudo'] = $donnees['pseudo'];

			    	header('Location: /projet4/index.php?action=homeControl');

/*			    	header('Location: /projet4/view/connectedViews/connectedIndex.php');
*/			    	//si on coche case connexion auto
			    	if (isset($_POST['connexionAuto'])) {
			    		setcookie('login', $donnees['pseudo'], time() + 365*24*3600, null, null, false, true);
						setcookie('pass_hache', $motdepasse, time() + 365*24*3600, null, null, false, true);
			    	}
			    	
				} else {
					header('Location: accueil.php?erreur=a');
			}
			?>

			<?php
			}
			$req->closeCursor(); // Termine le traitement de la requête
		}
?>

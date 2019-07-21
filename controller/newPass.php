<?php
				
	   	if (isset($_POST['pseudo']) AND isset($_POST['old_password']) AND isset($_POST['new_password'])) {

	   		$pseudo = htmlspecialchars($_POST['pseudo']);
			$old_password = htmlspecialchars($_POST['old_password']);
			$new_password = htmlspecialchars($_POST['new_password']);
/*			$email = htmlspecialchars($_POST['adressmail']);
*/
/*			if ($old_password != $new_password) {
				header('Location: accueil.php?erreur=motdepasse');
			}*/

/*			$nRows = $bdd->query("SELECT count(pseudo) FROM membres WHERE pseudo = '$pseudo'")->fetchColumn(); 
			if ($nRows !=0) {
				header('Location: accueil.php?erreur=pseudoexiste');
			}*/				
				echo $new_password;
				$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
				echo $hashed_password;
				$req = $connexionManager -> updateUserPw($hashed_password, $pseudo);


				
			}
 	   			
		else { 
			echo 'isset bug';
	   	}

?>












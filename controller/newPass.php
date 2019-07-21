<?php
				
	   	if (isset($_POST['pseudo']) AND isset($_POST['old_password']) AND isset($_POST['new_password'])) {

	   		$pseudo = htmlspecialchars($_POST['pseudo']);
			$old_password = htmlspecialchars($_POST['old_password']);
			$new_password = htmlspecialchars($_POST['new_password']);
		
				$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
				$req = $connexionManager -> updateUserPw($hashed_password, $pseudo);				
			} 	   			
		else { 
			echo 'isset bug';
	   	}

?>












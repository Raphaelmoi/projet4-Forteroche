<?php

?>

<p>Saisissez votre email</p>
<input type="mail" name="mail">
<input type="submit" name="submit" value="valider">
<?php

    $req = $connexionManager -> getUserForNewPw($email);

	while ($donnees = $req->fetch())
	{
		 echo $donnees['pass'];
		 echo $donnees['email'];
		}
?>
<?php
if ( !empty($_SESSION['pseudo']) ) {

ob_start();
?>
<article class="settingChoice"> 
	<a href="index.php?action=settings">Changer mot de passe</a>  
	<a href="index.php?action=settings&change=mail">Changer mail</a>  
	<a href="index.php?action=settings&change=pseudo">Changer pseudo </a>  

</article>

<section class="corpConnectPage">

	<?php
		if (isset($_GET['change']) && $_GET['change'] == 'mail' ) {?>
			<form action="index.php?action=newmail" method="post">
		    <h2>Changer adresse mail</h2>
			<p><input type="text" name="pseudo" placeholder="Pseudo" required ></p>
			<p><input type="mail" name="old_mail" placeholder="Ancien email" required /></p>
			<p><input type="mail" name="new_mail" placeholder="Comfirmez votre nouveau email" required /></p>
			<p>Saisissez votre mot de passe pour confirmer<input type="password" name="pass" placeholder="mot de passe" required /></p>

		   <input type="submit" value="Changer votre email" >
		</form> 
		<?php
		}
		elseif (isset($_GET['change']) && $_GET['change'] == 'pseudo' ) {
		?>
			<form action="index.php?action=newpseudo" method="post">
			   <h2>Changer pseudo</h2>
			   <p>Saisissez votre nouveau pseudo<input type="text" name="newpseudo" placeholder="Votre nouveau pseudo" required ></p>
			   <p>Saisissez votre pseudo actuel<input type="text" name="pseudo" placeholder="Pseudo" required /></p>
			   <p>Saisissez votre mot de passe pour confirmer <input type="password" name="pass" placeholder="mot de passe" required /></p>

			   <input type="submit" value="Changer de pseudo" >
			</form> 
			<?php
		}
		else{
		?>
		<form action="index.php?action=newpw" method="post">
			<h2>changer mot de passe</h2>
			<p><input type="text" name="pseudo" placeholder="Pseudo" required ></p>
			<p><input type="password" name="old_password" placeholder="ancien mot de passe" required /></p>
			<p><input type="password" name="new_password" placeholder="Nouveau mot de passe" required /></p>
			<input type="submit" value="Changer mot de passe" >
		</form> 
		<?php
		}
		?>
</section>

<?php
$content = ob_get_clean();
require ('templateConnected.php');
}
else
    header('Location: /projet4/index.php?action=connect');
?>

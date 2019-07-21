<?php
if ( !empty($_SESSION['pseudo']) ) {

ob_start();
?>
<section class="corpConnectPage">

	<form action="index.php?action=newpw" method="post">
	    <h2>changer mot de passe</h2>
	    <p id="wrongid" style="color: red;"> <?php
	      if (isset($_GET['erreur'])) {
	         if ($_GET['erreur'] == 'a' ) {
	            ?>
	            identifiant ou mot de passe incorect   
	            <?php
	         }
	      }
	      ?>
	   <p><br><input type="text" name="pseudo" placeholder="Pseudo" required ></p>
	   <p><br> <input type="password" name="old_password" placeholder="mot de passe" required /></p>
	   <p><br> <input type="password" name="new_password" placeholder="mot de passe" required /></p>

	   <input type="submit" value="Changer mot de passe" >

	</form> 
	

</section>
<?php
$content = ob_get_clean();
require ('templateConnected.php');

}
else
    header('Location: /projet4/index.php?action=connect');

?>

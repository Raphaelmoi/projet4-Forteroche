<?php
if ( !empty($_SESSION['pseudo']) ) {

ob_start();
?>
<section class="corpConnectPage">
	<form action="index.php?action=newpw" method="post">
	    <h2>changer mot de passe</h2>
	    <p id="wrongid" style="color: red;"> <?php
	     	if (isset($_GET['error'])) {
	    		if ($_GET['error'] == 'samepw' ) {
	            ?>
	            Vous avez saisie deux fois le même mot de passe 
	            <?php
	        	}
	            elseif ($_GET['error'] == 'fail' ) {
	            ?>
	            Vous n'avez pas saisie le bon mot de passe 
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

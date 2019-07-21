<!-- page permettant la connexion , ne s'ouvre que si aucune session n'est en cours -->
<?php 

  

$title = 'connexion';
ob_start(); ?>
            <section class="corpConnectPage">
                <form action="controller/connexion.php" method="post">
                    <h2>Connectez vous</h2>
                    <p id="wrongid" style="color: red;"> <?php
                       if (isset($_GET['erreur'])) {
                          if ($_GET['erreur'] == 'a' ) {
                             ?>
                             identifiant ou mot de passe incorect   
                             <?php
                          }
                       }
                       ?>
                    <p><br><input type="text" name="connexion_pseudo" placeholder="Pseudo" required ></p>
                    <p><br> <input type="password" name="connexion_motdepasse" placeholder="mot de passe" required /></p>
                    <p>connexion automatique <input id="checkbox" type="checkbox" name="connexionAuto"></p>
                    <input type="submit" value="Se connecter" >

                 </form> 
            </section>       

<?php
$content = ob_get_clean();
require ('connectedViews/templateConnected.php'); ?>
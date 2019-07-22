<!-- CONNECT PAGE access is possible only if not already connect  -->
<?php
$title = 'connexion';
ob_start(); 
?>
<section class="corpConnectPage">
    <form action="index.php?action=isconnected" method="post">
        <h2>Connectez vous</h2>
        <p id="wrongid" style="color: red;"> 
        <?php
        if (isset($_GET['erreur']))
        {
            if ($_GET['erreur'] == 'a')
            {
            ?>
            identifiant ou mot de passe incorect   
            <?php
            }
        }
        ?>
        <p><br><input type="text" name="connexion_pseudo" placeholder="Pseudo" required ></p>
        <p><br><input type="password" name="connexion_motdepasse" placeholder="mot de passe" required /></p>
        <input type="submit" value="Se connecter" >
    </form> 
</section>       

<?php
$content = ob_get_clean();
require ('view/backend/templateConnected.php'); 
?>

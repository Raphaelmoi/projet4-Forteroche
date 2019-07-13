<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Billet simple pour l'Alaska : le blog de Jean Forteroche">
        <title>Jean Forteroche</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../public/style.css">
    </head>
    
    <body>
    	<header>
            <?php include('headerView.php'); ?>            
        </header>

        <section class="corps">   

            <section class="corpConnectPage">
                <form action="connectedViews/connexion.php" method="post">
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
                    <input type="submit" value="valider" >

                 </form> 
            </section>
         

        </section>
        
    </body>
</html>




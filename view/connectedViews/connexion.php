<?php
	session_start();
	try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=memberspace;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}

		$test = 0;
		if (!empty($_SESSION['pseudo']) AND !empty($_SESSION['id'])) {
			$pseudo = htmlspecialchars($_SESSION['pseudo']);
			$motdepasse = htmlspecialchars($_SESSION['id']);
			$test =1;
		};	

		if (isset($_POST['connexion_pseudo']) AND isset($_POST['connexion_motdepasse']) )
		{
			$pseudo = htmlspecialchars($_POST['connexion_pseudo']);
			$motdepasse = htmlspecialchars($_POST['connexion_motdepasse']);
			$test =1;
		}
		elseif (!empty($_COOKIE['login']) && !empty($_COOKIE['pass_hache'])) {
			$pseudo = htmlspecialchars($_COOKIE['login']);
			$motdepasse = htmlspecialchars($_COOKIE['pass_hache']);
			$test = 1;
		}

/*		echo $test;	
*/	   	if ($test == 1) {
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
/*			    	echo "<h1 style = 'color: green;'>welcome back ".$donnees['pseudo']. "</h1>";
*/			    	
			    	$_SESSION['id']= $donnees['pass'];
			    	$_SESSION['pseudo'] = $donnees['pseudo'];
			    	//si on coche case connexion auto
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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Billet simple pour l'Alaska : le blog de Jean Forteroche">
        <title>Jean Forteroche</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/projet4/public/style.css">
    </head>
    
    <body>
    	<header>
            <?php include('../headerView.php'); ?>            
        </header>

        <section class="corps">
	       	<section class="menuIn">
	        	<?php include('menu.php'); ?> 
	        </section>
            <section class="contenuCorps insideSide">

            	<article class="nouvelArticle">
            		<a href="#"> creer nouveau billet</a>
            	</article>


			    <article>
			      <img src="/projet4/public/images/montagnes.jpg">
			      <div>
			          <div class="enteteSommaire"> <h2>TITRE DE l'article  </h2> 
			          </div>
			          <p class="textArticle"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			           
			          </p>
			          <a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a>
			          <div class="gestionnaireArticle">
			          	<nav>
			          		<li>changer l'image</li>
			          		<li>Modifier l'article</li>
			          		<li>Supprimer l'article</li>			          		
			          	</nav>
			          </div>
			      </div>
			    </article>
			</section>
        </section>
        
    </body>
</html>

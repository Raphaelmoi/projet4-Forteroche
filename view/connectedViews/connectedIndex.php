<?php 
$title = 'gestion';
ob_start(); ?>

<article class="nouvelArticle">
	<a href="/projet4/index.php?action=nouveaubillet"><i class="fas fa-plus-circle"></i>
Créer un nouveau billet</a>
</article>

<?php
while ($donnees = $reponse->fetch())
{
?>
    <article class="articleBillet">
      <img src="<?php echo ($donnees['url']); ?>">
      <div>
          <div class="enteteSommaire"> 
            <h2><?php echo htmlspecialchars($donnees['titre']); ?>  </h2> 
          </div>
          <div class="textArticle"> <?php

          $machin = $donnees['contenu'];
          //fait disparaitre iage et video des extraits
          //plus donne une longueur max a l'extrait de 600 caracteres
          if(preg_match("/<img[^>]+\>/i", $machin)) {
              $machin = preg_replace("/<img[^>]+\>/i", "", $machin); 
          }
          if(preg_match("/<iframe[^>]+\>/i", $machin)) {
              $machin = preg_replace("/<iframe[^>]+\>/i", "", $machin); 
          }
          $machin = substr($machin, 0, 520).'...'; 
          echo $machin;
           ?>
          </div>
		          <div class="gestionnaireArticle">
			          	<nav>
                    <li><a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a> </li> 
			          		<li><a href="index.php?action=modifyPostView&amp;id=<?=$donnees['id'] ?>">Modifier le billet</a></li>
			          		<li><a href="index.php?action=deletePost&amp;id=<?=$donnees['id'] ?>" onclick="return confirm('Êtes vous sûr de vouloir supprimer cet article?\nCette action est irréversible')" ><i class="fas fa-trash"></i> Supprimer le billet</a></li>
                        		
			          	</nav>
			       </div>
      </div>
    </article>   

<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('templateConnected.php'); ?>

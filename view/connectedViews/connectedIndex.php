
<?php 
$title = 'gestion';
ob_start(); ?>

<article class="nouvelArticle">
	<a href="/projet4/index.php?action=nouveaubillet"> Créer un nouveau billet</a>
</article>

<?php
while ($donnees = $reponse->fetch())

{
?>
    <article>
      <img src="<?php echo ($donnees['url']); ?>">
      <div>
          <div class="enteteSommaire enteteConnected"> <h2><?php echo htmlspecialchars($donnees['titre']); ?>  </h2> 
          </div>
          <p class="textArticle"> <?=
          //fournit un extrait de l'article,l les 600 premiers caracteres
          $rest = substr(($donnees['contenu']), 0, 600); 
           ?>
          </p>
          <a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a>
		          <div class="gestionnaireArticle">
			          	<nav>
			          		<li><a href="index.php?action=modifyPostView&amp;id=<?=$donnees['id'] ?>">Modifier le billet</a></li>
			          		<li><a href="index.php?action=deletePost&amp;id=<?=$donnees['id'] ?>"><i class="fas fa-trash"></i> Supprimer le billet</a></li>     		
			          	</nav>
			       </div>
      </div>
    </article>   

<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('templateConnected.php'); ?>

<?php $title = 'Mon blog';
ob_start(); ?>

<?php
while ($donnees = $reponse->fetch())
{
?>
    <article>
      <img src="public/images/montagnes.jpg">
      <div>
          <div class="enteteSommaire"> <h2><?php echo htmlspecialchars($donnees['titre']); ?>  </h2> 
          </div>
          <p class="textArticle"> <?=
          //fournit un extrait de l'article,l les 600 premiers caracteres
          $rest = substr(htmlspecialchars($donnees['contenu']), 0, 600); 
           ?>
          </p>
          <a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a>

      </div>
    </article>   

<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('template.php'); ?>

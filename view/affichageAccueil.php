<?php $title = 'Mon blog';
ob_start(); ?>

<?php
while ($donnees = $reponse->fetch())
{
?>
    <article>
      <img src="<?php echo ($donnees['url']); ?>">
      <div>
          <div class="enteteSommaire"> 
            <h2><?php echo ($donnees['titre']); ?>  </h2> 
          </div>
          <p class="textArticle"> <?php

          $machin = $donnees['contenu'];
          //fait disparaitre iMage et video des extraits
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
          </p>
          <div class="btnReadMore">
              <a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a>
          </div>

      </div>
    </article>   

<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('template.php'); ?>

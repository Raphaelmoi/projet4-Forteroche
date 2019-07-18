<?php
ob_start();
?>
<section class="badcommentview">
<?php
if ($number == 0) {
  echo '<p>Aucun commentaire n\'a été signalé ! </p>';
}
else
while ($thiscomment = $comment->fetch())
{
?>
   <article class="commentaire">
      <div class="titreComm">
        <strong><?php echo htmlspecialchars($thiscomment['auteur']); ?> : </strong>
        <?php echo htmlspecialchars($thiscomment['date_commentaire_fr']); ?>

      </div>
      <div>
         <p><?php echo htmlspecialchars($thiscomment['commentaire']); ?></p>
      </div>

      <div class="titreComm"> Commentaire signalé <?= $thiscomment['signalement']?> fois 

        <a href="index.php?action=deletecomment&amp;id=<?=$thiscomment['id']?>" ><i class="fas fa-trash" style = 'color:red;'><span>Supprimer ce commentaire</span></i> </a>
        <a href="index.php?action=validatecomment&amp;id=<?=$thiscomment['id']?>" > <i class="fas fa-check" style = 'color:green;'> <span>Valider ce commentaire</span> </i></a>
      </div>
    </article>
    <?php
}
$comment->closeCursor(); // Termine le traitement de la requête
?>
</section>
<?php
$content = ob_get_clean();
require ('templateconnected.php');
?>

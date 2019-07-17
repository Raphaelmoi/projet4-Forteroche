<?php

ob_start();
while ($thisarticle = $article->fetch())
{
    $title = htmlspecialchars($thisarticle['titre']);
    $idArticle = $thisarticle['id'];
?>

   <p id="retour"><a  href="index.php">Retour à la liste des billets</a></p>    

  <article>
      <div class="news">
        <div class="entete">
          <h2><?=htmlspecialchars($thisarticle['titre']) ?> : lorem ipsum etc</h2>
        </div >
        <p class="textArticle" ><?php echo htmlspecialchars($thisarticle['date_creation_fr']); ?></p>
        <p class="textArticle" ><?php echo $thisarticle['contenu']; ?></p>

        <div class="footer" > <a href=""><i class="fas fa-heart"> J'aime ce billet</i></a></div>

      </div>
  </article>    
<?php
}
$article->closeCursor(); // Termine le traitement de la requête
while ($thiscomment = $comment->fetch())
{
?>
   <article class="commentaire">
      <div class="titreComm">
        <strong><?php echo htmlspecialchars($thiscomment['auteur']); ?> : </strong>
        <?php echo htmlspecialchars($thiscomment['date_commentaire_fr']); ?>
       

      <?php
          if (!empty($_SESSION['pseudo'])) {?>
            <a  href="index.php?action=deletecommentfromviewpage&amp;commentid=<?=$thiscomment['id']?>&amp;id=<?=$idArticle?>">
              <i class="fas fa-trash"> Supprimer ce commentaire</i>
            </a> <?php
          }
          else
          {?>
            <a  href="index.php?action=signalcomment&amp;commentid=<?=$thiscomment['id']?>&amp;id=<?=$idArticle?>">Signaler ce commentaire</a>
         <?php }
      ?>



       
      </div>
      <div>
         <p><?php echo htmlspecialchars($thiscomment['commentaire']); ?></p>
      </div>


    </article>
    <?php
}
$comment->closeCursor(); // Termine le traitement de la requête

?>
   <form class="blocformulaire" action="index.php?action=addComment&amp;id=<?=$_GET['id'] ?>" method="post">
      <p> Pseudo : <br><input type="text" name="auteur" /></p>
      <p> Message : <br><textarea id="commentaire" name="commentaire" rows="5" cols="33"></textarea></p>
      <input name="pageArticle" type="hidden">
      <input id="bouton" type="submit" value="valider" >
    </form>
  
<?php
$content = ob_get_clean();
require ('template.php');
?>

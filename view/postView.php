 <?php
ob_start();

while ($thisarticle = $article->fetch()) {
    $title     = htmlspecialchars($thisarticle['titre']);
    $idArticle = $thisarticle['id'];
    
    if (!isset($_SESSION['like' . $idArticle]) || ($_SESSION['like' . $idArticle] !== $idArticle)) {
        $_SESSION['like' . $idArticle] = 0;
    }
?>

   <div class="btnBackHome">
    <i class="fas fa-chevron-left"></i><a  href="index.php">Retour à la liste des billets</a>
  </div>    

  <article class="billetAlone">
      <div >
        <div class="entete">
          <h2><?= htmlspecialchars($thisarticle['titre']) ?> </h2>
          <?php
          echo htmlspecialchars($thisarticle['date_creation_fr']);
          ?>
        </div>
        <div class="contenuOfArticle">
          <p class="textArticle" ><?php
           echo $thisarticle['contenu'];
        ?></p>
        </div>
        <div class="footer" > 

          <?php
    if ($_SESSION['like' . $idArticle] === $idArticle) {
?>
        <a href="index.php?action=ilike&amp;id=<?= $idArticle ?>&amp;val=moins"> 
            <i id="redHearth" class="fas fa-heart" style="color:red;"> <?= $thisarticle['numberlike']; ?> </i>
          </a>
        <?php
    } elseif ($_SESSION['like' . $idArticle] === 0) {
?>
        <a href="index.php?action=ilike&amp;id=<?= $idArticle ?>&amp;val=plus">   
            <i id="redHearth" class="fas fa-heart"> <?= $thisarticle['numberlike']; ?> </i>
          </a>          
        <?php
    }
?>
      </div>

      </div>
  </article>    
<?php
    
}
$article->closeCursor(); // Termine le traitement de la requête

while ($thiscomment = $comment->fetch()) {
    
?>
 <article class="commentaire">
      <div class="titreComm">
        <strong><?php
    echo htmlspecialchars($thiscomment['auteur']);
?> : </strong>
        <?php
    echo htmlspecialchars($thiscomment['date_commentaire_fr']);
?>
   

      <?php
    if (!empty($_SESSION['pseudo'])) {
?>
          <a  href="index.php?action=deletecommentfromviewpage&amp;commentid=<?= $thiscomment['id'] ?>&amp;id=<?= $idArticle ?>" class="deleteComment" onclick="return confirm('Êtes vous sûr de vouloir supprimer ce commentaire? \nCette action est irréversible!')">
              <i class="fas fa-trash"> <span>Supprimer ce commentaire</span></i>
            </a> <?php
    } else {
        if (isset($_SESSION['report' . $thiscomment['id']]) && $_SESSION['report' . $thiscomment['id']] == $thiscomment['id']) {
?>
              <a href="index.php?action=signalcomment&amp;commentid=<?= $thiscomment['id'] ?>&amp;id=<?= $idArticle ?>&amp;val=moins" class="reportComment reportedComment" >Ce commentaire a été signalé</a>

           <?php
        } elseif (!isset($_SESSION['report' . $thiscomment['id']]) || $_SESSION['report' . $thiscomment['id']] == 0) {
?>
            <a href="index.php?action=signalcomment&amp;commentid=<?= $thiscomment['id'] ?>&amp;id=<?= $idArticle ?>&amp;val=plus" class="reportComment">Signaler ce commentaire</a>
              <?php
        }
    }
?>
   
      </div>
      <div>
         <p><?php
    echo htmlspecialchars($thiscomment['commentaire']);
?></p>
      </div>


    </article>
    <?php
}
$comment->closeCursor(); // Termine le traitement de la requête

?>
 <article class="commentaire">
  <div class="titreComm">
    <span>Poster un commentaire :</span>
  </div>
      <form class="formulaireComment" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>" method="post">

        <p> Pseudo : <input type="text" name="auteur" placeholder="pseudo" required /></p>
        <textarea id="commentaire" name="commentaire"> Votre commentaire ici</textarea>
        <input name="pageArticle" type="hidden">
        <input id="bouton" type="submit" value="Publier ce commentaire" class="publishComment"  >
      </form>

</article>


  
<?php
$content = ob_get_clean();
require('template.php');
?> 
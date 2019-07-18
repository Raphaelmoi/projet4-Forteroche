<?php
ob_start();

while ($thisarticle = $article->fetch()) {
    $title     = htmlspecialchars($thisarticle['titre']);
    $idArticle = $thisarticle['id'];
    
    if (!isset($_SESSION['like' . $idArticle]) || ($_SESSION['like' . $idArticle] !== $idArticle)) {
        $_SESSION['like' . $idArticle] = 0;
    }
?>

   <p id="retour"><a  href="index.php">Retour à la liste des billets</a></p>    

  <article>
      <div class="news">
        <div class="entete">
          <h2><?= htmlspecialchars($thisarticle['titre']) ?> : lorem ipsum etc</h2>
        </div >
        <p class="textArticle" ><?php
    echo htmlspecialchars($thisarticle['date_creation_fr']);
?></p>
        <p class="textArticle" ><?php
    echo $thisarticle['contenu'];
?></p>

        <div class="footer" > 

          <?php
    if ($_SESSION['like' . $idArticle] === $idArticle) {
?>
         <a href="index.php?action=ilike&amp;id=<?= $idArticle ?>&amp;val=moins"> J'aime ce billet  
            <i id="redHearth" class="fas fa-heart" style="color:red;"> <?= $thisarticle['numberlike']; ?> </i>
          </a>
        <?php
    } elseif ($_SESSION['like' . $idArticle] === 0) {
?>
         <a href="index.php?action=ilike&amp;id=<?= $idArticle ?>&amp;val=plus"> J'aime ce billet  
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
           <a  href="index.php?action=deletecommentfromviewpage&amp;commentid=<?= $thiscomment['id'] ?>&amp;id=<?= $idArticle ?>"  onclick="return confirm('Êtes vous sûr de vouloir supprimer ce commentaire? \nCette action est irréversible!')">
              <i class="fas fa-trash"> Supprimer ce commentaire</i>
            </a> <?php
    } else {
        if (isset($_SESSION['report' . $thiscomment['id']]) && $_SESSION['report' . $thiscomment['id']] == $thiscomment['id']) {
?>
               <a href="index.php?action=signalcomment&amp;commentid=<?= $thiscomment['id'] ?>&amp;id=<?= $idArticle ?>&amp;val=moins" style="color:red;">Ce commentaire a été signalé</a>

           <?php
        } elseif (!isset($_SESSION['report' . $thiscomment['id']]) || $_SESSION['report' . $thiscomment['id']] == 0 ) {
?>
             <a href="index.php?action=signalcomment&amp;commentid=<?= $thiscomment['id'] ?>&amp;id=<?= $idArticle ?>&amp;val=plus">Signaler ce commentaire</a>
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
  <form class="blocformulaire" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>" method="post">
      <p> Pseudo : <br><input type="text" name="auteur" /></p>
      <p> Message : <br><textarea id="commentaire" name="commentaire" rows="5" cols="33"></textarea></p>
      <input name="pageArticle" type="hidden">
      <input id="bouton" type="submit" value="valider" >
    </form>
  
<?php
$content = ob_get_clean();
require('template.php');
?>
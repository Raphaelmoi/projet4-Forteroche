<?php ob_start();
$title = "modifier commentaire";
while ($thiscomment = $comment->fetch())
{
?>

<h1>Mon super blog !</h1>

    <form action="index.php?action=modifyComment&amp;id=<?=$_GET['id'] ?>" method="post">

      <p> Nouveau message : <br><textarea id="commentaire" name="commentaire" rows="5" cols="33">
        <?php echo $thiscomment['commentaire'] ?>
      </textarea></p>
      <!-- envoie reference de l'article ou est le commentaire en hidden -->
      <input type="hidden" name="idArticle" value="<?php echo htmlspecialchars($thiscomment['id_billet']); ?>">
      <input type="submit" value="valider" >
    </form>
   
<?php
}
$comment->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('template.php'); ?>

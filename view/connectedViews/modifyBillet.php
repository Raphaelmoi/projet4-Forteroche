
<?php $title = 'modifier billet';
ob_start();
while ($thisarticle = $article->fetch())
{
    $title = htmlspecialchars($thisarticle['titre']);
?>

modification  d'un  billet
<script 
src="https://cdn.tiny.cloud/1/nbm2szncvsw7qyeyg7o32putrav8evdmiwifijffknppjohw/tinymce/5/tinymce.min.js">
</script>
<script>tinymce.init({selector:'textarea'});</script>

  <form method="post" action="index.php?action=modifyPost&amp;id=<?=$thisarticle['id'] ?>">
  	<input type="titre" name="titre" value="<?= htmlspecialchars($thisarticle['titre']) ?>">
  	<textarea name="contenu"> <?php echo $thisarticle['contenu']; ?></textarea>

    <input type="submit" value="valider" >
  </form>

<?php
}
$article->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('templateConnected.php'); ?>
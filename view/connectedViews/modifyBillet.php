
<?php $title = 'modifier billet';
ob_start();

while ($thisarticle = $article->fetch())
{
	$title = htmlspecialchars($thisarticle['titre']);
	?>
	<script 
	src="https://cdn.tiny.cloud/1/nbm2szncvsw7qyeyg7o32putrav8evdmiwifijffknppjohw/tinymce/5/tinymce.min.js">
</script>
<script>tinymce.init({selector:'textarea'});</script>

<form class="tinyForm" method="post" action="index.php?action=modifyPost&amp;id=<?= $thisarticle['id'] ?>" enctype="multipart/form-data">
	<input  class="tinyFormTitre" type="titre" name="titre" value="<?= htmlspecialchars($thisarticle['titre']) ?>">
	<textarea name="contenu"> <?php echo $thisarticle['contenu']; ?></textarea>
	<div class="changeThePicture">
		<img src="<?php echo $thisarticle['url']?>">
		<div>
			<button >changer image :</button>
			<input class="tinyFormImg" type="file" name="fileToUpload" id="fileToUpload">
		</div>

	</div>

	<input class="tinyFormButon" type="submit" value="valider" >
</form>

<?php
}
$article->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('templateConnected.php'); ?>


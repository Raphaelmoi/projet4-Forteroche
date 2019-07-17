<?php $title = 'modifier billet';
ob_start();?>


<?php
while ($thisarticle = $article->fetch())
{
	$title = htmlspecialchars($thisarticle['titre']);
	?>


<form class="tinyForm" method="post" action="index.php?action=modifyPost&amp;id=<?= $thisarticle['id'] ?>" enctype="multipart/form-data">
	<input  class="tinyFormTitre" type="titre" name="titre" value="<?= htmlspecialchars($thisarticle['titre']) ?>">
	<textarea name="contenu"> <?php echo $thisarticle['contenu']; ?></textarea>
	<div class="changeThePicture">
		<img src="<?php echo $thisarticle['url']?>">
		<div>
			<p >Changer l'image ?</p>
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


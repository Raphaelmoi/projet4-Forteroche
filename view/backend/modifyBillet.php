<?php 
if ( !empty($_SESSION['pseudo']) ) {

$title = 'modifier billet';
ob_start();?>

<?php
while ($thisarticle = $article->fetch())
{
	$title = $thisarticle['titre'];
	?>

	<form class="tinyForm" method="post" action="index.php?action=modifyPost&amp;id=<?= $thisarticle['id'] ?>" enctype="multipart/form-data">
		<input class="tinyFormTitre" type="titre" name="titre" value="<?= $thisarticle['titre'] ?>" required>
		<textarea name="contenu"> <?= $thisarticle['contenu']; ?></textarea>
		<div class="changeThePicture">
			<img src="<?= $thisarticle['url']?>" id="outputImg">
			<div>
				<p >Choisissez une image</p>
				<input class="tinyFormImg" type="file" name="fileToUpload" id="fileToUpload" 
				onchange="imageUrl(event)">
			</div>
		</div>
		<input class="tinyFormButon" type="submit" value="valider" >
	</form>

<?php
}
$article->closeCursor(); 
$content = ob_get_clean();
require ('templateConnected.php');
}
else
    header('Location: /projet4/index.php?action=connect');
 ?>


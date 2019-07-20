<?php 
if ( !empty($_SESSION['pseudo']) ) {

$title = 'modifier billet';
ob_start();?>


<?php
while ($thisarticle = $article->fetch())
{
	$title = htmlspecialchars($thisarticle['titre']);
	?>


<form class="tinyForm" method="post" action="index.php?action=modifyPost&amp;id=<?= $thisarticle['id'] ?>" enctype="multipart/form-data">
	<input  class="tinyFormTitre" type="titre" name="titre" value="<?= htmlspecialchars($thisarticle['titre']) ?>" required>
	<textarea name="contenu"> <?php echo $thisarticle['contenu']; ?></textarea>
	<div class="changeThePicture">
		<img src="<?php echo $thisarticle['url']?>" id="outputImg">
		<div>
			<p >Choisissez une image</p>
			<input class="tinyFormImg" type="file" name="fileToUpload" id="fileToUpload" onchange="loadFile(event)">
		</div>
		<script type="text/javascript">
		 	let loadFile = function(event) {
			console.log('yep');
		    var output = document.getElementById('outputImg');
		    output.src = URL.createObjectURL(event.target.files[0]);
		  };
		</script>
	</div>
	<input class="tinyFormButon" type="submit" value="valider" >
</form>

<?php
}
$article->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('templateConnected.php');
}
else
    header('Location: /projet4/index.php?action=connect');
 ?>


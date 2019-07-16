<?php $title = 'modifier billet';
ob_start();?>
	<script 
	src="https://cdn.tiny.cloud/1/nbm2szncvsw7qyeyg7o32putrav8evdmiwifijffknppjohw/tinymce/5/tinymce.min.js">
</script>
  <script>tinymce.init({selector:'textarea',

    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
  });</script>


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


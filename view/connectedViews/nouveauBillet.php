<?php $title = 'nouveau billet';
ob_start(); ?>


  <form class="tinyForm" method="post" action="index.php?action=addPost" enctype="multipart/form-data">
  	<input class="tinyFormTitre" type="titre" name="titre" placeholder="titre du billet">
  	  <textarea name="contenu">Ici le billet himself!</textarea>
		<input class="tinyFormImg" type="file" name="fileToUpload" id="fileToUpload">
       <input class="tinyFormButon" type="submit" value="valider" >
  </form>

<?php
$content = ob_get_clean();
require ('templateConnected.php'); ?>

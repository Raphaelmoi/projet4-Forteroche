<?php $title = 'nouveau billet';
ob_start(); ?>

<script src="https://cdn.tiny.cloud/1/nbm2szncvsw7qyeyg7o32putrav8evdmiwifijffknppjohw/tinymce/5/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea',

    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor'
    ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
  });</script>

  <form class="tinyForm" method="post" action="index.php?action=addPost" enctype="multipart/form-data">
  	<input class="tinyFormTitre" type="titre" name="titre" placeholder="titre du billet">
  	  <textarea name="contenu">Ici le billet himself!</textarea>
		<input class="tinyFormImg" type="file" name="fileToUpload" id="fileToUpload">
       <input class="tinyFormButon" type="submit" value="valider" >
  </form>


	<form action="index.php?action=addPost" method="post" enctype="multipart/form-data">
	    Select image to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload Image" name="submit">
	</form>



<?php
$content = ob_get_clean();
require ('templateConnected.php'); ?>

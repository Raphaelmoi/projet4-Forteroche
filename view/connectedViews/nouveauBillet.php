<?php $title = 'nouveau billet';
ob_start(); ?>

creation d'un nouveau billet
<script src="https://cdn.tiny.cloud/1/nbm2szncvsw7qyeyg7o32putrav8evdmiwifijffknppjohw/tinymce/5/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>
  <form method="post" action="index.php?action=addPost">
  	<input type="titre" name="titre">
  	  <textarea name="contenu">Next, use our Get Started docs to setup Tiny!</textarea>

       <input type="submit" value="valider" >
  </form>


<?php
$content = ob_get_clean();
require ('templateConnected.php'); ?>

<?php $title = 'contact';
ob_start(); ?>

Ici page de contact            

<?php
$content = ob_get_clean();
require ('template.php'); ?>
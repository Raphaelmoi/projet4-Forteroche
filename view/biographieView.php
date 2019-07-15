<?php $title = 'biographie';
ob_start(); ?>

Ici la bio de jean foutreRoche             

<?php
$content = ob_get_clean();
require ('template.php'); ?>

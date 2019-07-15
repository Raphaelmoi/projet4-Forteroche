<?php $title = 'nouveau billet';
ob_start(); ?>

creation d'un nouveau billet

<?php
$content = ob_get_clean();
require ('templateConnected.php'); ?>

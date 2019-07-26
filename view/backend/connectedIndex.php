<!-- The connected HomePAge -->
<?php 
if ( !empty($_SESSION['pseudo']) ) {
	$title = 'gestion';
	ob_start(); 

	require 'indexGestion.php';//choice of style and sort article
	echo $gestionOfArticle;
	 ?>

	<article class="nouvelArticle">
		<a href="/projet4/index.php?action=nouveaubillet">
			<i class="fas fa-plus-circle"></i>
			Créer un nouveau billet
		</a>
	</article>

	<?php
	if (isset($_GET['styleView']) && $_GET['styleView'] == 'inline'){
	    require 'indexInlineView.php';
	    echo $inlineView; 
	}

	elseif (!isset($_GET['styleView']) || $_GET['styleView'] == 'basic'){
	    require 'indexBasicView.php';
	    echo $basicView; 
	}

	$content = ob_get_clean();
	require ('templateConnected.php');
	}
else
    header('Location: /projet4/index.php?action=connect');
?>

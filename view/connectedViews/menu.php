<?php 
if (!empty($_SESSION['pseudo'])) {?>

<nav class="navDeux">
	<ul>
		<li><a href="/projet4/index.php?action=homeControl">Mes articles</a></li>    
		<li><a href="/projet4/index.php?action=nouveaubillet">Créer un nouvel article</a></li>
		<li><a href="/projet4/index.php?action=contact">Nouveaux commentaires</a></li>
		<li><i class="fas fa-exclamation-triangle"></i><a href="/projet4/index.php?action=contact">Commentaires signalés</a></li>
	</ul>
</nav>

<?php }
?>


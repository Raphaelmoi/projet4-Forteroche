<?php
session_start();
?>
<h1> Billet simple pour l'Alaska : le blog de Jean Forteroche</h1>
<nav>
	<ul>
		<li><a href="/projet4/index.php">Blog</a></li>    
		<li><a href="/projet4/index.php?action=bio">Biographie</a></li>
		<li><a href="/projet4/index.php?action=contact">Contact</a></li>
	</ul>
</nav>

<!-- affiche connexion ou deconnexion selon existence ou non d'une session -->
<?php

		if (!empty($_SESSION['pseudo'])) {?>
			<a href="/projet4/index.php?action=disconnect" class="btnConnexion">
				<i class="fas fa-user"></i>
			<p>Déconnexion</p>
			</a><?php
		}
		elseif (empty($_SESSION['pseudo'])){?>
			<a href="/projet4/index.php?action=connect" class="btnConnexion">
				<i class="fas fa-user"></i>
			<p>Connexion</p>
			</a>
		<?php } ?>

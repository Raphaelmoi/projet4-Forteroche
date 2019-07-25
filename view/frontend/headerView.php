<!-- MENU PRINCIPALE -->
<h1> Billet simple pour l'Alaska : le blog de Jean Forteroche</h1>
<h1 class="smallScreenTitle">Billet simple pour l'Alaska</h1>
<nav class="principalNav">
	<ul>
		<li><a href="/projet4/index.php">Blog</a></li>    
		<li><a href="/projet4/index.php?action=bio">Biographie</a></li>
		<li><a href="/projet4/index.php?action=contact">Contact</a></li>
	</ul>
</nav>
<!-- Write connexion or deconnexion, depends if user is connected or not -->
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
<?php 
	} 
?>

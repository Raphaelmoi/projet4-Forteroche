<?php
require_once("model/CommentManager.php");  
$commentManager = new CommentManager();
$count = $commentManager -> countBadComment();

if ( !empty($_SESSION['pseudo']) ) 
{?>

<nav class="navDeux">
	<ul>
		<li><a href="/projet4/index.php?action=homeControl">Mes billets</a></li>    
		<li><a href="/projet4/index.php?action=nouveaubillet">Créer un nouveau billet</a></li>
		<li><a  href="/projet4/index.php?action=badcommentview"> 
			<i id="signaledComm" class="fas fa-exclamation-triangle">
				<span id="span">Commentaires signalés</span></i>
			</a>
		</li>
		<?php if ($count != 0) {
			?> <script type="text/javascript">
				redComments(<?= $count ?>);
			</script><?php
		}?>
		<li ><a href="/projet4/index.php?action=settings"><i class="fas fa-cog"><span>Paramètres</span></i></a></li>
	</ul>
</nav>

<?php }
?>



<!-- ASIDE PAGE -->
<?php
require_once ('model/PostManager.php');
require_once ('controller/getUrl.php');

if (isset($_GET['page'])) {
	$article = $postManager->getPostsPage($_GET['page']);
}
else $article = $postManager->getPostsPage();//default argument = 0
?>

<h2 class="asideTitre">Listes des articles</h2>

<?php
while ($thisarticle = $article->fetch()) {
	$title = $thisarticle['titre'];
?>
	<a href="index.php?action=post&amp;id=<?=$thisarticle['id'] ?>"><?=$thisarticle['titre'] ?> </a>
	<br>
	<div class="asideDecoration"></div>
<?php
}
$article->closeCursor(); 
?>

<!-- when more than 10 articles, nav system apear -->
<div class="asideNavigation"> 
<?php
$count = (int)$postManager->count();
$indice = floor($count / 10);
if ($indice >= 1) {
	for ($i = 0;$i <= $indice;$i++) {
		$url = getUrl() . "page=" . $i;//give the url of the actual page in the good format
			?> 
 			<a href="<?=$url?>" ><?=$i + 1 ?></a>
	<?php
	}
	?>
	</div>
<?php
}
?>
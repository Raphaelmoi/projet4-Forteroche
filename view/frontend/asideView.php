<!-- ASIDE PAGE -->
<?php
require_once ('model/PostManager.php');
require_once ('controller/UtiController.php');

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
$uticontroller = new UtiController();

$indice = floor($count / 10);
if ($indice >= 1) {

	for ($i = 0;$i <= $indice;$i++) {
		$getUrl = $uticontroller -> getUrl() . "page=" . $i;//give the url of the actual page in the good format
			if ( isset($_GET['page']) && $i == $_GET['page']) {
				?>
 				<a href="<?=$getUrl?>" class="indexAside"  ><?=$i + 1 ?></a>
 				<?php
			}
			else{
			?> 
 			<a href="<?=$getUrl?>" class="indexAside" style="color:#888"><?=$i + 1 ?></a>
	<?php
		}
	}
	?>
	</div>
<?php
}
?>
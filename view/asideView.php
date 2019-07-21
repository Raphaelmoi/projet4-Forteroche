
<?php
require_once('model/PostManager.php');

 if (isset($_GET['page'])) {
    $article = $postManager -> getPostsPage($_GET['page']);
            }
    else 
        $article = $postManager -> getPostsPage();
?>
<h2 class="asideTitre">Listes des articles</h2>
<?php
while ($thisarticle = $article->fetch() )
{
    $title = htmlspecialchars($thisarticle['titre']);
?>
  <a href="index.php?action=post&amp;id=<?=$thisarticle['id'] ?>"><?=htmlspecialchars($thisarticle['titre']) ?> </a>
  <br>
   <div class="asideDecoration"></div>

<?php
	

}
$article->closeCursor(); // Termine le traitement de la requête
	?>
	<div class="asideHasard"> 
	<?php 
	//propose les 10 articles suivant
	$count = (int) $postManager->count();
	$indice = floor($count/10);
	if ($count/10 > 1) {
		for ($i=0; $i <= $indice; $i++) { 
			$url= getUrl()."page=".$i;
			?> 
 			<a href="<?= $url ?>" ><?= $i +1 ?></a>
		<?php
		}
		?>
	</div>
<?php
}

//recupere url actuel et la met au bon format pour pouvoir y ajouter identifiant
function getUrl(){
	$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
                === FALSE ? 'http' : 'https';

	$host     = $_SERVER['HTTP_HOST'];
	$script   = $_SERVER['SCRIPT_NAME'];
	$params   = $_SERVER['QUERY_STRING'];
	 
	$currentUrl = $protocol . '://' . $host . $script . '?' . $params;

	 if (preg_match("#\?page=[0-9]#", $currentUrl)) {
	 	$currentUrl = preg_replace("#\?page=[0-9]#", '?', $currentUrl);
	 }
	 elseif (preg_match("#page=[0-9]#", $currentUrl)) {
	 	$currentUrl = preg_replace("#page=[0-9]#", '', $currentUrl);
	 }
	elseif (preg_match("#&page=[0-9]#", $currentUrl)) {
		 	$currentUrl = preg_replace("#&page=[0-9]#", '&', $currentUrl);
		 }
	else{
		$currentUrl = $currentUrl.'&';  
	}
	return $currentUrl;
}
?>


<?php
require_once('model/PostManager.php');
$article = $postManager -> getPosts();

?>
<h2 class="asideTitre">Listes des articles</h2>
<?php
$i = 0;
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

//propose la lecture d'n article au hasard
$count = (int) $postManager->count();
$random = rand(1, $count);
?>
<div class="asideHasard"> <a href="index.php?action=post&amp;id=<?=$random ?>">Lire un article au hasard</a></div>
<?php

$article->closeCursor(); // Termine le traitement de la requête

?>

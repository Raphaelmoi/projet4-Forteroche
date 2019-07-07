
<?php
require_once('model/PostManager.php');
$article = $postManager -> getPosts();

?>
<h2 class="asideTitre">Listes des articles</h2>
<?php
while ($thisarticle = $article->fetch())
{
    $title = htmlspecialchars($thisarticle['titre']);
?>
  <div class="asideDecoration"></div>
  <a href="index.php?action=post&amp;id=<?=$thisarticle['id'] ?>"><?=htmlspecialchars($thisarticle['titre']) ?> : lorem ipsum etc</a>
  <br>
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

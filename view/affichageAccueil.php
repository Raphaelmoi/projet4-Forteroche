<!-- HOME PAGE -->
<?php
$title = 'Mon blog';
ob_start();

while ($donnees = $reponse->fetch())
{
?>
    <article class="articleBillet">
        <img src="<?= $donnees['url']; ?>">
        <div>
            <div class="enteteSommaire"> 
                <h2><?= $donnees['titre']; ?>  </h2> 
            </div>
            <div class="textArticle"> 
            <?php
                $ContenuBillet = formateArticle($donnees['contenu']);               
                echo $ContenuBillet;
            ?>
            </div>
            <div class="btnReadMore">
                <a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a>
            </div>
        </div>
    </article>   
<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('template.php'); 
?>

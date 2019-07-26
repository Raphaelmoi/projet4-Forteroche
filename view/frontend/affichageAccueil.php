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
                $ContenuBillet = $uticontroller -> formateArticle($donnees['contenu']);
                echo $ContenuBillet;
            ?>
            </div>
            <div class="textArticle1220"> 
            <?php
                $ContenuBillet = $uticontroller -> formateArticle($donnees['contenu'], 1220);
                echo $ContenuBillet;
            ?>
            </div>
            <div class="textArticle1000"> 
            <?php
                $ContenuBillet = $uticontroller -> formateArticle($donnees['contenu'], 1000);
                echo $ContenuBillet;
            ?>
            </div>
            <div class="textArticle870"> 
            <?php
                $ContenuBillet = $uticontroller -> formateArticle($donnees['contenu'], 870);
                echo $ContenuBillet;
            ?>
            </div>
            <div class="textArticle600"> 
            <?php
                $ContenuBillet = $uticontroller -> formateArticle($donnees['contenu'], 600);
                echo $ContenuBillet;
            ?>
            </div>
            <div class="btnReadMore">
                <a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a>
            </div>
        </div>
        <!-- little screen background -->
        <div class="backgroundArticle"> <img src="<?= $donnees['url']; ?>"></div>   
    </article>
<?php
}
$reponse->closeCursor(); // Termine le traitement de la requête
$content = ob_get_clean();
require ('template.php'); 
?>

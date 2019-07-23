<?php
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
    		<div class="gestionnaireArticle">
    			<nav>
                    <li><a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a> </li> 
                    <li><a href="index.php?action=modifyPostView&amp;id=<?=$donnees['id'] ?>">Modifier le billet</a></li>
                    <li><a href="index.php?action=deletePost&amp;id=<?=$donnees['id'] ?>" 
                        onclick="return confirm('Êtes vous sûr de vouloir supprimer cet article?\nCette action est irréversible')" ><i class="fas fa-trash"></i> Supprimer le billet</a></li>  		
                </nav>
    		</div>
        </div>
    </article>   

<?php
}
$reponse->closeCursor(); 

$basicView = ob_get_clean();
?>
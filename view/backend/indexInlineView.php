<?php
ob_start();

while ($donnees = $reponse->fetch())
{
?>
    <article class="inlineView ">
        <div class="titreInlineView"> <h2><?= $donnees['titre']; ?></h2></div>
        <div class="gestionnaireArticleInline">
                <nav>
                    <li class="dateInline"><span>le <?= $donnees['date_creation_fr']; ?></span></li>
                    <li><a href="index.php?action=post&amp;id=<?=$donnees['id'] ?>">Lire la suite</a> </li> 
                    <li><a href="index.php?action=modifyPostView&amp;id=<?=$donnees['id'] ?>">Modifier le billet</a></li>
                    <li><a href="index.php?action=deletePost&amp;id=<?=$donnees['id'] ?>" 
                        onclick="return confirm('Êtes vous sûr de vouloir supprimer cet article?\nCette action est irréversible')" ><i class="fas fa-trash"></i> </a></li>
                           
                </nav>
        </div>
    </article>   

<?php
}
$reponse->closeCursor(); 

$inlineView = ob_get_clean();
?>
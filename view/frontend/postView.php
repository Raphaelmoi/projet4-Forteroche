<!-- View of only one article with comments and possibility to add a new comment -->
<?php
ob_start();

while ($thisarticle = $article->fetch()) {
    $title = $thisarticle['titre'];
    $idArticle = $thisarticle['id'];
    //find if user already like the article during the session
    if (!isset($_SESSION['like' . $idArticle]) || ($_SESSION['like' . $idArticle] !== $idArticle)) {
        $_SESSION['like' . $idArticle] = 0;
    }
?>
    <a class="btnBackHome" href="index.php">
        <i class="fas fa-chevron-left"></i>Retour à la liste des billets
    </a>  
    <!-- THE ARTICLE  -->
    <article class="billetAlone">
        <div >
            <div class="entete">
                <h2><?= $thisarticle['titre'] ?> </h2>
                <span> <?= $thisarticle['date_creation_fr'];?></span> 
            </div>
            <div class="contenuOfArticle">
                <p class="textArticle" >
                    <?=
                    $thisarticle['contenu'];
                    ?>
                </p>
            </div>
            <div class="footer" > 
            <?php //if user click on hearth
                if ($_SESSION['like' . $idArticle] === $idArticle) {
            ?>
                <a href="index.php?action=ilike&amp;id=<?=$idArticle?>&amp;val=moins"> 
                    <i id="redHearth" class="fas fa-heart" style="color:red;"> <?=$thisarticle['numberlike']; ?>
                    </i>
                </a>
            <?php
            }  // if user didn't click, or click twice
                elseif ($_SESSION['like' . $idArticle] === 0) {
            ?>
                <a href="index.php?action=ilike&amp;id=<?=$idArticle?>&amp;val=plus">   
                    <i id="redHearth" class="fas fa-heart"> <?=$thisarticle['numberlike']; ?> 
                    </i>
                </a>          
            <?php
            }
            ?>
            </div>
        </div>
    </article>    
<?php
}
$article->closeCursor(); 

// ALL THE COMMENTS OF THE ARTICLE
while ($thiscomment = $comment->fetch()) {
?>
    <article class="commentaire">
        <div class="titreComm">
        <strong><?= $thiscomment['auteur'];?> : </strong>
        <span><?= $thiscomment['date_commentaire_fr'];?></span>
<?php   
    // IF ADMIN IS CONNECT, HE CAN INSTANTLY DELETE COMMENT 
    if (!empty($_SESSION['pseudo'])) {
    ?>
        <a href="index.php?action=deletecommentfromviewpage&amp;commentid=<?= $thiscomment['id'] ?>&amp;id=<?=$idArticle ?>" class="deleteComment" 
            onclick="return confirm('Êtes vous sûr de vouloir supprimer ce commentaire? \nCette action est irréversible!')">
            <i class="fas fa-trash"> <span>Supprimer ce commentaire</span></i>
        </a>

    <?php
    }
    else { //USER CAN REPORT COMMENT AND ALSO CHANGE THEM MIND
        if (isset($_SESSION['report' . $thiscomment['id']]) && $_SESSION['report' . $thiscomment['id']] == $thiscomment['id']) {
    ?>
        <a href="index.php?action=signalcomment&amp;commentid=<?=$thiscomment['id'] ?>&amp;id=<?=$idArticle ?>&amp;val=moins" class="reportComment reportedComment" >Commentaire signalé</a>

    <?php
    }//A COMMENT CANNOT BE REPORTED TWICE BY THE SAME USER,SO...
        elseif (!isset($_SESSION['report' . $thiscomment['id']]) || $_SESSION['report' . $thiscomment['id']] == 0) {
        ?>
        <a href="index.php?action=signalcomment&amp;commentid=<?=$thiscomment['id'] ?>&amp;id=<?=$idArticle ?>&amp;val=plus" class="reportComment">Signaler ce commentaire</a>
        <?php
        }
    }
?>
        </div>
        
        <div>
            <p><?= $thiscomment['commentaire']; ?></p>
        </div>
    
    </article>
    <?php
}
$comment->closeCursor(); 
?>
<!-- POST A NEW COMMENT -->
    <article class="commentaire">
        <div class="titreComm">
            Poster un commentaire :
        </div>
        <form class="formulaireComment" action="index.php?action=addComment&amp;id=<?= $_GET['id'] ?>" 
            method="post">
            <p> Pseudo : <input type="text" name="auteur" placeholder="Pseudo" required /></p>
            <textarea id="commentaire" name="commentaire"> Votre commentaire ici</textarea>
            <input name="pageArticle" type="hidden">
            <input id="bouton" type="submit" value="Publier ce commentaire" class="publishComment"  >
        </form>
    </article>

<?php
$content = ob_get_clean();
require ('template.php');
?>

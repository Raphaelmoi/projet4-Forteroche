 <?php
require('controller/controller.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } 
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } 
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['auteur']) && !empty($_POST['commentaire'])) {
                    addComment($_GET['id'], $_POST['auteur'], $_POST['commentaire']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } 
        elseif ($_GET['action'] == 'modifyCommentView') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyCommentView($_GET['id']);
            } else {
                throw new Exception('Impossible d\'acceder à ce commentaire');
            }
        } 
        elseif ($_GET['action'] == 'modifyComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['commentaire']) && !empty($_POST['idArticle'])) {
                    modifyComment($_GET['id'], $_POST['commentaire'], $_POST['idArticle']);
                }
            } else {
                throw new Exception('Impossible de modifier ce commentaire');
            }
        }
    } else {
        listPosts();
    }
}
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
} 
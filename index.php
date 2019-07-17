<?php
session_start();
require('controller/controller.php');
try {
    if (isset($_GET['action'])) {
        //home page
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        //page for any article 
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //action when visitor add a new comment
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
        //PAGE BIO
            elseif ($_GET['action'] == 'bio') {
            biographie();
        }
        //PAGE CONTACT
            elseif ($_GET['action'] == 'contact') {
            contact();
        }
        //PAGE for connect
            elseif ($_GET['action'] == 'connect') {
            connect();
        }
        //page for disconnect
            elseif ($_GET['action'] == 'disconnect') {
            disconnect();
        }
        //home when you are connect
            elseif ($_GET['action'] == 'homeControl') {
            homeControl();
        }
        //page when you want create new article
            elseif ($_GET['action'] == 'nouveaubillet') {
            nouveauBillet();
        }
        // creating a new article
            elseif ($_GET['action'] == 'addPost') {
            if (!empty($_POST['titre']) && !empty($_POST['contenu']) && isset($_FILES['fileToUpload'])) {
                require 'controller/postAcceptor.php';
                $imageurl   = "public/images/" . basename($_FILES['fileToUpload']["name"]);
                addPost($_POST['titre'], $_POST['contenu'], $imageurl);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }
        //page for modify a post
            elseif ($_GET['action'] == 'modifyPostView') {
            # recuperer id de l'article
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyPost($_GET['id']);
            }
        }
        //modify a post with 2 possibility : with or without an img
            elseif ($_GET['action'] == 'modifyPost') {
            # recuperer id de l'article
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
                    if (($_FILES['fileToUpload']['name'] != "")) {
                        require 'controller/postAcceptor.php';
                        $imageurl   = "public/images/" . basename($_FILES['fileToUpload']["name"]);
                        updateThePost($_GET['id'], $_POST['titre'], $_POST['contenu'], $imageurl);
                    } else {
                        updatePostWithoutImg($_GET['id'], $_POST['titre'], $_POST['contenu']);
                    }
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
        //when you delete a post
            elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
            }
        }
        //when a comment is reported
            elseif ($_GET['action'] == 'signalcomment') {
            # garde l'id de l'article pour y revenir, ajoute 1 au comm signale
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (isset($_GET['commentid']) && $_GET['commentid'] > 0) {
                    signalComment($_GET['id'], $_GET['commentid']);
                }
            }
        }
        //page where all the comment who are report appear
            elseif ($_GET['action'] == 'badcommentview') {
            badCommentView();
        }
        //reset the value of comment signalement for abusive reporting
            elseif ($_GET['action'] == 'validatecomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                validateComment($_GET['id']);
            }
        }
        //when you want delete a comment from the badcommentview page
            elseif ($_GET['action'] == 'deletecomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
        }
        //when you want delete a comment from any page
            elseif ($_GET['action'] == 'deletecommentfromviewpage') {
            if (isset($_GET['commentid']) && $_GET['commentid'] > 0) {
                deleteCommentFromViewPage($_GET['commentid']);
            }
        }
        //if no $_GET['action'] defined, go to home page
    } else {
        listPosts();
    }
}
catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

//créé un espace pour le deuxieme menu si on est connecté
if (!empty($_SESSION['pseudo'])) {
?>
    <script type="text/javascript" src="public/DesignScript.js"></script>
<?php
}
?>
<?php
session_start();
require ('controller/Controller.php');
$controller = new Controller();

try {
    if (isset($_GET['action'])) {
        //---VIEWS---
        //HOME
        if ($_GET['action'] == 'listPosts') {
            $controller -> listPosts();
        }
        //ARTICLE VIEW
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller -> post(htmlspecialchars($_GET['id']));
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //PAGE BIOGRAPHIE
        elseif ($_GET['action'] == 'bio') {
            $controller -> biographie();
        }
        //PAGE CONTACT
        elseif ($_GET['action'] == 'contact') {
            $controller -> contact();
        }
        //PAGE CONNEXION
        elseif ($_GET['action'] == 'connect') {
            $controller -> connect();
        }
        //HOME BACKEND
        elseif ($_GET['action'] == 'homeControl') {
            if (isset($_GET['sort']) && $_GET['sort'] == 'antichrono') {
                $controller -> homeControl(1);
            }
            else
            $controller -> homeControl();
        }
        //NEW ARTICLE VIEW
        elseif ($_GET['action'] == 'nouveaubillet') {
            $controller -> nouveauBillet();
        }
        //MODIFY AN ARTICLE
        elseif ($_GET['action'] == 'modifyPostView') {
            # recuperer id de l'article
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller -> modifyPost(htmlspecialchars($_GET['id']));
            }
        }
        //REPORTED COMMENT VIEW
        elseif ($_GET['action'] == 'badcommentview') {
            $controller -> badCommentView();
        }
        //SETTINGS VIEW
        elseif ($_GET['action'] == 'settings') {
            $controller -> settings();
        }
        //---ACTION---
        //CONNECT action
        elseif ($_GET['action'] == 'isconnected') {
            $controller -> isconnected();
        }
        //DISCONNECT action
        elseif ($_GET['action'] == 'disconnect') {
            $controller -> disconnect();
        }
        //ADD A NEW COMMENT
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['auteur']) && !empty($_POST['commentaire'])) {
                    $controller -> addComment(htmlspecialchars($_GET['id']), htmlspecialchars($_POST['auteur']), htmlspecialchars($_POST['commentaire']));
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //REPORT A COMMENT -> or change your mind, click twice
        elseif ($_GET['action'] == 'signalcomment') {
            //keep id of article to find the way back and add 1 to reported comment
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['commentid']) && $_GET['commentid'] > 0) {
                if ($_GET['val'] == 'plus') {
                    $_SESSION['report' . $_GET['commentid']] = $_GET['commentid'];
                    $controller -> signalComment(htmlspecialchars($_GET['id']), 
                    	htmlspecialchars($_GET['commentid']), 1);
                }
                elseif ($_GET['val'] == 'moins') {
                    $_SESSION['report' . $_GET['commentid']] = 0;
                    $controller -> signalComment(htmlspecialchars($_GET['id']), htmlspecialchars($_GET['commentid']), -1);
                }
            }
        }
        //ADD A LIKE to an article -> or change your mind, click twice
        elseif ($_GET['action'] == 'ilike') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if ($_GET['val'] == 'plus') {
                    $_SESSION['like' . $_GET['id']] = $_GET['id'];
                    $controller -> likeAPost(htmlspecialchars($_GET['id']), 1);
                }
                elseif ($_GET['val'] == 'moins') {
                    $_SESSION['like' . $_GET['id']] = 0;
                    $controller -> likeAPost(htmlspecialchars($_GET['id']), -1);
                }
            }
        }
        // UPLOAD NEW ARTICLE
        elseif ($_GET['action'] == 'addPost') {
            if (!empty($_POST['titre']) && !empty($_POST['contenu']) && isset($_FILES['fileToUpload'])) {
                $controller -> addPost(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']),
                 $_FILES['fileToUpload']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }
        //UPLOAD MODIFY POST (with or without image)
        elseif ($_GET['action'] == 'modifyPost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['titre']) && !empty($_POST['contenu'])) {
                    if (($_FILES['fileToUpload']['name'] != "")) {
                        $controller -> updateThePost(htmlspecialchars($_GET['id']), htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']), $_FILES['fileToUpload']);
                    }
                    else {
                        $controller -> updatePostWithoutImg(htmlspecialchars($_GET['id']), htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['contenu']));
                    }
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
        //UPLOAD AN IMAGE -> call from tiny.js
        elseif ($_GET['action'] == 'addImg') {
            $controller -> uploadImg();
        }
        //DELETE A POST
        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller -> deletePost(htmlspecialchars($_GET['id']));
            }
        }
        //VALIDATE A COMMENT -> reset the value of comment signalement for abusive reporting
        elseif ($_GET['action'] == 'validatecomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller -> validateComment(htmlspecialchars($_GET['id']));
            }
        }
        //DELETE A COMMENT from badCommentView
        elseif ($_GET['action'] == 'deletecomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller -> deleteComment(htmlspecialchars($_GET['id']));
            }
        }
        //DELETE A COMMENT from article page
        elseif ($_GET['action'] == 'deletecommentfromviewpage') {
            if (isset($_GET['commentid']) && $_GET['commentid'] > 0 && isset($_GET['id']) && $_GET['id'] > 0 ) {
                $controller -> deleteCommentFromViewPage(htmlspecialchars($_GET['commentid']), htmlspecialchars($_GET['id']));
            }
        }
        //SEND A MAIL
        elseif ($_GET['action'] == 'sendmail') {
            if (isset($_POST['name']) and isset($_POST['mail']) and isset($_POST['tel']) and isset($_POST['msg'])) {
                $controller -> sendmail(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['mail']), htmlspecialchars($_POST['tel']), htmlspecialchars($_POST['msg']));
            }
        }
        //CHANGE THE PASSWORD
        elseif ($_GET['action'] == 'newpw') {
            if (isset($_POST['pseudo']) and isset($_POST['old_password']) and isset($_POST['new_password'])) {
                $controller -> updatePass(htmlspecialchars($_POST['old_password']), htmlspecialchars($_POST['new_password']), htmlspecialchars($_POST['pseudo']));
            }
            else echo 'isset bug';
        }
        //CHANGE THE EMAIL
        elseif ($_GET['action'] == 'newmail') {
            if (isset($_POST['pseudo']) and isset($_POST['old_mail']) and isset($_POST['new_mail']) and isset($_POST['pass'])) {
                $controller -> updateMail(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['old_mail']), htmlspecialchars($_POST['new_mail']), htmlspecialchars($_POST['pass']));
            }
        }
        //CHANGE THE PSEUDO
        elseif ($_GET['action'] == 'newpseudo') {
            if (isset($_POST['newpseudo']) and isset($_POST['pseudo']) and isset($_POST['pass'])) {
                $controller -> updatePseudo(htmlspecialchars($_POST['newpseudo']), htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass']));
            }
        }
    }
    else {
        //default view -> HOME
       $controller -> listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}


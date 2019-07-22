<?php
session_start();
require ('controller/controller.php');

try {
    if (isset($_GET['action'])) {
        //---VIEWS---
        //HOME
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        //ARTICLE VIEW
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        //PAGE BIOGRAPHIE
        elseif ($_GET['action'] == 'bio') {
            biographie();
        }
        //PAGE CONTACT
        elseif ($_GET['action'] == 'contact') {
            contact();
        }
        //PAGE CONNEXION
        elseif ($_GET['action'] == 'connect') {
            connect();
        }
        //HOME BACKEND
        elseif ($_GET['action'] == 'homeControl') {
            homeControl();
        }
        //NEW ARTICLE VIEW
        elseif ($_GET['action'] == 'nouveaubillet') {
            nouveauBillet();
        }
        //MODIFY AN ARTICLE
        elseif ($_GET['action'] == 'modifyPostView') {
            # recuperer id de l'article
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                modifyPost($_GET['id']);
            }
        }
        //REPORTED COMMENT VIEW
        elseif ($_GET['action'] == 'badcommentview') {
            badCommentView();
        }
        //SETTINGS VIEW
        elseif ($_GET['action'] == 'settings') {
            settings();
        }
        //---ACTION---
        //CONNECT action
        elseif ($_GET['action'] == 'isconnected') {
            isconnected();
        }
        //DISCONNECT action
        elseif ($_GET['action'] == 'disconnect') {
            disconnect();
        }
        //ADD A NEW COMMENT
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['auteur']) && !empty($_POST['commentaire'])) {
                    addComment($_GET['id'], $_POST['auteur'], $_POST['commentaire']);
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
                    signalComment($_GET['id'], $_GET['commentid'], 1);
                }
                elseif ($_GET['val'] == 'moins') {
                    $_SESSION['report' . $_GET['commentid']] = 0;
                    signalComment($_GET['id'], $_GET['commentid'], -1);
                }
            }
        }
        //ADD A LIKE to an article -> or change your mind, click twice
        elseif ($_GET['action'] == 'ilike') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if ($_GET['val'] == 'plus') {
                    $_SESSION['like' . $_GET['id']] = $_GET['id'];
                    likeAPost($_GET['id'], 1);
                }
                elseif ($_GET['val'] == 'moins') {
                    $_SESSION['like' . $_GET['id']] = 0;
                    likeAPost($_GET['id'], -1);
                }
            }
        }
        // UPLOAD NEW ARTICLE
        elseif ($_GET['action'] == 'addPost') {
            if (!empty($_POST['titre']) && !empty($_POST['contenu']) && isset($_FILES['fileToUpload'])) {
                addPost($_POST['titre'], $_POST['contenu'], $_FILES['fileToUpload']);
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
                        updateThePost($_GET['id'], $_POST['titre'], $_POST['contenu'], $_FILES['fileToUpload']);
                    }
                    else {
                        updatePostWithoutImg($_GET['id'], $_POST['titre'], $_POST['contenu']);
                    }
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
        //UPLOAD AN IMAGE -> call from tiny.js
        elseif ($_GET['action'] == 'addImg') {
            uploadImg();
        }
        //DELETE A POST
        elseif ($_GET['action'] == 'deletePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deletePost($_GET['id']);
            }
        }
        //VALIDATE A COMMENT -> reset the value of comment signalement for abusive reporting
        elseif ($_GET['action'] == 'validatecomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                validateComment($_GET['id']);
            }
        }
        //DELETE A COMMENT from badCommentView
        elseif ($_GET['action'] == 'deletecomment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                deleteComment($_GET['id']);
            }
        }
        //DELETE A COMMENT from article page
        elseif ($_GET['action'] == 'deletecommentfromviewpage') {
            if (isset($_GET['commentid']) && $_GET['commentid'] > 0 && isset($_GET['id']) && $_GET['id'] > 0 ) {
                deleteCommentFromViewPage($_GET['commentid'], $_GET['id']);
            }
        }
        //SEND A MAIL
        elseif ($_GET['action'] == 'sendmail') {
            if (isset($_POST['name']) and isset($_POST['mail']) and isset($_POST['tel']) and isset($_POST['msg'])) {
                sendmail($_POST['name'], $_POST['mail'], $_POST['tel'], $_POST['msg']);
            }
        }
        //CHANGE THE PASSWORD
        elseif ($_GET['action'] == 'newpw') {
            if (isset($_POST['pseudo']) and isset($_POST['old_password']) and isset($_POST['new_password'])) {
                updatePass($_POST['old_password'], $_POST['new_password'], $_POST['pseudo']);
            }
            else echo 'isset bug';
        }
    }
    else {
        //default view -> HOME
        listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}


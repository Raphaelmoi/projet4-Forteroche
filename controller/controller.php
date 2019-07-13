<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new PostManager(); // Création d'un objet
    $reponse = $postManager -> getPosts();
    require('view/affichageAccueil.php');
}

function post() {
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    $article = $postManager -> getPost($_GET['id']);
    $comment = $commentManager -> getComments($_GET['id']);
    require('view/postView.php');
}

function addComment($postId, $author, $comment) {
    $postManager = new PostManager();
    $article = $postManager -> getPosts();
    $commentManager = new CommentManager();
    $req = $commentManager -> postComment($postId, $author, $comment);
    if ($req === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id='.$postId);
    }
}

function modifyCommentView($id) {
    $commentManager = new CommentManager();
    $comment = $commentManager -> getCommentToModify($id);
    require('view/modifyCommentView.php');
}

function modifyComment($id, $commentaire, $idArticle) {
    $commentManager = new CommentManager();
    $commentaire = $commentManager -> updateComment($id, $commentaire);
    header('Location: index.php?action=post&id='.$idArticle);
}

function biographie(){
    header('Location: view/biographieView.php');
}
function contact(){
    header('Location: view/contactView.php');
}
function connect(){
    header('Location: view/connectView.php');
}
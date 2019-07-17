<?php
//autoload.
function chargerClasse($classname)
{
  require 'model/'.$classname.'.php';
}
spl_autoload_register('chargerClasse');


function listPosts() {
    $postManager = new PostManager();
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
    $postManager = new PostManager(); // Création d'un objet
    $reponse = $postManager -> getPosts();
    require 'view/biographieView.php';
/*    header('Location: view/biographieView.php');
*/}
function contact(){
    $postManager = new PostManager(); // Création d'un objet
    $reponse = $postManager -> getPosts();
    require 'view/contactView.php';
}
function connect(){
    $postManager = new PostManager(); // Création d'un objet
    $reponse = $postManager -> getPosts();
    require 'view/connectView.php';
}
function disconnect(){
    header('Location: controller/deconnexion.php');
}
function homeControl(){
    $postManager = new PostManager(); // Création d'un objet
    $reponse = $postManager -> getPosts();
    require('view/connectedViews/connectedIndex.php');
}
function nouveauBillet(){
    require('view/connectedViews/nouveauBillet.php');
}

function addPost($titre, $contenu, $imageurl)
{
    $postManager = new PostManager(); 

    $envoi = $postManager -> postPost($titre, $contenu, $imageurl);
    homeControl();
}

function modifyPost($id)
{
    $postManager = new PostManager();
    $article = $postManager -> getPost($id); 
    require('view/connectedViews/modifyBillet.php');
}

function updateThePost($id, $titre, $contenu, $url){
    $postManager = new PostManager();
    $req = $postManager -> updatePost($id, $titre, $contenu, $url); 
    homeControl();
}
function updatePostWithoutImg($id, $titre, $contenu) {
    $postManager = new PostManager();
    $req = $postManager -> updatePostWithoutImg($id, $titre, $contenu); 
    homeControl();
}

function deletePost($id)
{
    $postManager = new PostManager();
    $req = $postManager -> deletePost($id); 
    homeControl();
}

function signalComment($id, $commentid){
    $commentManager = new CommentManager();
    $postManager = new PostManager();

    $req = $commentManager -> updateComment($commentid);
    $article = $postManager -> getPost($id);
    $comment = $commentManager -> getComments($id);
    require('view/postView.php');
}

function badCommentView()
{
    $commentManager = new CommentManager();
    $comment = $commentManager -> getSignaledComments();

    require('view/connectedViews/badComment.php');
}

function deleteComment($id)
{
    $commentManager = new CommentManager();
    $delete = $commentManager -> deleteComment($id);
    badCommentView();
}
function deleteCommentFromViewPage($id)
{
    $commentManager = new CommentManager();
    $delete = $commentManager -> deleteComment($id);
    post();
}
function validateComment($id){
    $commentManager = new CommentManager();
    $validate = $commentManager -> validateComment($id);
    badCommentView();
}
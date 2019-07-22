<?php
/**
 * 
 */
class Controller
{
    
    function __construct()
    {
        spl_autoload_register('Controller::chargerClasse');
    }
    //autoload
    function chargerClasse($classname)
    {
        require 'model/'.$classname.'.php';
    }

    function listPosts() {
        $postManager = new PostManager();
        $reponse = $postManager -> getPosts();
        require 'controller/UtiController.php';
        $uticontroller = new UtiController();
        require('view/frontend/affichageAccueil.php');
    }
    function post($id) {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $article = $postManager -> getPost($id);
        $comment = $commentManager -> getComments($id);
        require('view/frontend/postView.php');
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
    function biographie(){
        $postManager = new PostManager(); 
        $reponse = $postManager -> getPosts();
        require 'view/frontend/biographieView.php';
    }
    function contact(){
        $postManager = new PostManager(); 
        $reponse = $postManager -> getPosts();
        require 'view/frontend/contactView.php';
    }
    function connect(){
        $postManager = new PostManager(); 
        $reponse = $postManager -> getPosts();
        require 'view/frontend/connectView.php';
    }
    function isconnected(){
        require 'controller/UserController.php';

        $connect = new UserController();
        $connexion = $connect -> logIn(); 
    }
    function disconnect(){
        require 'controller/UserController.php';
        $connect = new UserController();
        $deconnexion = $connect -> logOut(); 
    /*    header('Location: controller/deconnexion.php');
    */}
    function homeControl(){
        $postManager = new PostManager();
        $reponse = $postManager -> getPosts();
        require 'controller/UtiController.php';
        $uticontroller = new UtiController();
        require('view/backend/connectedIndex.php');
    }
    function nouveauBillet(){
        require('view/backend/nouveauBillet.php');
    }
    function addPost($titre, $contenu, $imageurl)
    {
        $imageurl = Controller::uploadImg();

        $postManager = new PostManager(); 
        $envoi = $postManager -> postPost($titre, $contenu, $imageurl);
        //pour eviter en cas de f5 de publier 2 fois le meme article :  
        $reponse = $postManager -> getPosts();
        header('Location: index.php?action=homeControl');
    }
    function modifyPost($id)
    {
        $postManager = new PostManager();
        $article = $postManager -> getPost($id); 
        require('view/backend/modifyBillet.php');
    }
    function updateThePost($id, $titre, $contenu, $imageUrl){
        $imageUrl = Controller::uploadImg();

        $postManager = new PostManager();
        $req = $postManager -> updatePost($id, $titre, $contenu, $imageUrl); 
        //pour eviter en cas de f5 de publier 2 fois le meme article :  
        $reponse = $postManager -> getPosts();
        header('Location: index.php?action=homeControl');
    }
    function updatePostWithoutImg($id, $titre, $contenu) {
        $postManager = new PostManager();
        $req = $postManager -> updatePostWithoutImg($id, $titre, $contenu); 
            //pour eviter en cas de f5 de publier 2 fois le meme article :  
        $reponse = $postManager -> getPosts();
        header('Location: index.php?action=homeControl');   
    }
    function deletePost($id)
    {
        $postManager = new PostManager();
        $req = $postManager -> deletePost($id); 
        Controller::homeControl();
    }
    function signalComment($id, $commentid, $val){
        $commentManager = new CommentManager();
        $postManager = new PostManager();
        $req = $commentManager -> reportComment($commentid, $val);
        $article = $postManager -> getPost($id);
        $comment = $commentManager -> getComments($id);
        header('Location: index.php?action=post&id='.$id);
    }

    function badCommentView()
    {
        $commentManager = new CommentManager();
        $comment = $commentManager -> getSignaledComments();
        $number =  $commentManager -> countBadComment();
        require('view/backend/badComment.php');
    }
    function deleteComment($id)
    {
        $commentManager = new CommentManager();
        $delete = $commentManager -> deleteComment($id);
        Controller::badCommentView();
    }
    function deleteCommentFromViewPage($commentid, $articleid)
    {
        $commentManager = new CommentManager();
        $delete = $commentManager -> deleteComment($commentid);
        Controller::post($articleid);
    }
    function validateComment($id){
        $commentManager = new CommentManager();
        $validate = $commentManager -> validateComment($id);
        Controller::badCommentView();
    }

    function likeAPost($id, $val){
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $like = $postManager -> setLike($id, $val);
        $article = $postManager -> getPost($id);
        $comment = $commentManager -> getComments($id);
        header('Location: index.php?action=post&id='.$id);
    }

    function sendmail($name, $mail, $tel, $msg){
        $postManager = new PostManager(); 
        $reponse = $postManager -> getPosts();
        require 'controller/UtiController.php';
        $sendMail = new UtiController();
        $sendAMail = $sendMail -> sendAMail($name, $mail, $tel, $msg);
        
        Controller::contact();
    }

    function settings(){
        require('view/backend/settingsview.php');
    }
    function updatePass($oldPass, $newPass, $pseudo){
        require 'controller/UserController.php';
        $connect = new UserController();
        $newPass = $connect -> newPass($oldPass, $newPass, $pseudo);
    }
    function uploadImg(){
        require 'controller/UtiController.php';
        $imageUploader = new UtiController();
        $imageUrl = $imageUploader -> imageUploader();
        return $imageUrl;
    }
}

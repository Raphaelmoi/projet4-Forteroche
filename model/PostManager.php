<?php
require_once("model/Manager.php"); 

class PostManager extends Manager 
{
    public function getPosts()
    {
        $bdd = $this->dbConnect();
        $reponse = $bdd->query('SELECT id, titre, contenu, url, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin\') AS date_creation_fr FROM billets ORDER BY id ');
        return $reponse;
    }

    public function getPost($postId)
    {
        $bdd = $this->dbConnect();
        $article = $bdd->prepare('SELECT id, titre, contenu, url, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
        $article->execute(array($postId));

        return $article;
    }

    public function postPost($titre, $contenu, $url){
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO billets( titre, contenu, url, date_creation) VALUES( :titre , :contenu, :url, NOW())');
        $req->execute(array(
                    'titre' => $titre,
                    'contenu' => $contenu,
                    'url' => $url
                ));

        return $req;
    }

    //permet la mise à jour d'un nouveau commentaire
    public function updatePost($currentId, $titre, $contenu)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->query("UPDATE billets SET titre = '$titre', contenu = '$contenu', date_creation = NOW() WHERE id = $currentId;");

        return $req;
    }

    public function deletePost($id){
        $bdd = $this->dbConnect();
        $delete = $bdd->query("DELETE FROM billets WHERE id = $id; ");
    }


    public function count()
    {
        $bdd = $this->dbConnect();
        $count = $bdd->query('SELECT COUNT(*) FROM billets')->fetchColumn();

        return $count;
    }


}
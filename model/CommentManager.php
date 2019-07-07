<?php
require_once("model/Manager.php"); 

class CommentManager extends Manager
{
    //recupere tous les commentaires pour un articles donné
    public function getComments($postId)
    {
        $bdd = $this->dbConnect();
        $comment = $bdd->prepare("SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire DESC");
        $comment->execute(array($postId));

        return $comment;
    }
    //recupere le commentaire que l'on souhaite modifier grace à son id
    public function getCommentToModify($id)
    {
        $bdd = $this->dbConnect();
        $comment = $bdd->prepare("SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin') AS date_commentaire_fr FROM commentaires WHERE id = ? ");
        $comment->execute(array($id));

        return $comment;
    }
    //permet la création dun nouveau commentaire
    public function postComment($idArticle, $auteur, $commentaire)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES( :idArticle , :auteur, :commentaire, NOW())');
        $req->execute(array(
                    'idArticle' => $idArticle,
                    'auteur' => $auteur,
                    'commentaire' => $commentaire
                ));

        return $req;
    }
    //permet la mise à jour d'un nouveau commentaire
    public function updateComment($currentId, $commentaire)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->query("UPDATE commentaires SET commentaire = '$commentaire', date_commentaire = NOW() WHERE id = $currentId;");

        return $req;
    }
}
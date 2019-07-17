<?php
require_once("model/Manager.php"); 

class CommentManager extends Manager
{
    //recupere tous les commentaires pour un articles donné
    public function getComments($postId)
    {
        $bdd = $this->dbConnect();
        $comment = $bdd->prepare("SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin') AS date_commentaire_fr, signalement FROM commentaires WHERE id_billet = ? && signalement < 10 ORDER BY date_commentaire DESC");
        $comment->execute(array($postId));

        return $comment;
    }

        public function getSignaledComments()
    {
        $bdd = $this->dbConnect();
        $comment = $bdd->prepare("SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin') AS date_commentaire_fr, signalement FROM commentaires WHERE signalement != ? ORDER BY signalement DESC");
        $comment->execute(array(0));

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

    public function reportComment($currentId)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->query("UPDATE commentaires SET signalement = signalement + 1 WHERE id = $currentId;");

        return $req;
    }
    public function validateComment($currentId)
    {
        $bdd = $this->dbConnect();
        $validate = $bdd->query("UPDATE commentaires SET signalement = 0 WHERE id = $currentId;");

        return $validate;
    }

    public function deleteComment($id)
    {
        $bdd = $this->dbConnect();
        $delete = $bdd->query("DELETE FROM commentaires WHERE id = $id; ");
    }    

    public function countBadComment()
    {
        $bdd = $this->dbConnect();
        $count = $bdd->query('SELECT COUNT(*) FROM commentaires where signalement != 0')->fetchColumn();

        return $count;
    }

}
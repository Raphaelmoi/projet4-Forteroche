<?php
require_once("Manager.php"); 

class UserManager extends Manager
{
    //get user data, needed when try to connect
    public function getUser($pseudo)
    {
    	$bdd = $this->dbConnect();
		$req = $bdd->prepare('SELECT id, pseudo, pass, email FROM membres WHERE pseudo = ?');
		$req->execute(array($pseudo));
		return $req;
    }
    //when user want to change password
    public function updateUserPw($pass, $pseudo){
    	$bdd = $this->dbConnect();
    	$req = $bdd->query("UPDATE membres SET pass = '$pass' WHERE pseudo = '$pseudo';");
        return $req;
    }
    //when user want to change mail
    public function updateUserMail($mail, $pseudo){
        $bdd = $this->dbConnect();
        $req = $bdd->query("UPDATE membres SET email = '$mail' WHERE pseudo = '$pseudo';");
        return $req;
    }
    //when user want to change pseudo
    public function updateUserPseudo($pseudo, $newpseudo){
        $bdd = $this->dbConnect();
        $req = $bdd->query("UPDATE membres SET pseudo = '$newpseudo' WHERE pseudo = '$pseudo';");
        return $req;
    }
    //if result = 0 $pseudo is not in the database
    public function count($pseudo){
        $bdd = $this->dbConnect();
        $count = $bdd->query("SELECT count(pseudo) FROM membres WHERE pseudo = '$pseudo'")->fetchColumn(); 
        return $count;
    }
}

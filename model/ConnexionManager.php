<?php
class ConnexionManager
{
	public function dbConnect() {
        $bdd = new PDO('mysql:host=localhost;dbname=memberspace;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
	}
}
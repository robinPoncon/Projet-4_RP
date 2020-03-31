<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\User;
use \PDO;

/**
* La classe UserManager permet de récupérer, ajouter, modifier et supprimer des utilisateurs de la BDD.
* @Author Robin Ponçon
*/

class UserManager extends Manager
{
	/**
	* Permet de récupérer un article à partir de son id de la BDD.
	* @param INT $id : id venant d'une variable GET 
	* @return OBJECT : Retourne un objet Post avec les données de son id correspondant
	*/

	public function getUser($pseudo)
	{
		$req = $this->db->prepare("SELECT id, pseudo, password, email FROM users WHERE id > 0 AND pseudo = :pseudo");
		$req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
		$req->execute();
		$data = $req->fetch();
		return new User($data);
	}

	public function getUsers()
	{
		$users = [];

		$req = $this->db->query("SELECT id, pseudo, password, email FROM users WHERE id > 0");
		while ($data = $req->fetch())
		{
			$users[] = new User($data);
		}
		return $users;
	}

	public function addUser(User $user)
    {
 
        $req = $this->db->prepare("INSERT INTO users(pseudo, password, email) VALUES(:pseudo, :password, :email)");

        $req->bindValue(":pseudo", $user->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);

        return $req->execute();
        
    }

    public function updateInfoUser(User $user)
	{	
		$req = $this->db->prepare("UPDATE users SET pseudo = :pseudo, password = :password, email = :email WHERE id = :id");

		$req->bindValue(":id", $user->getId(), PDO::PARAM_INT);
		$req->bindValue(":pseudo", $user->getPseudo(), PDO::PARAM_STR);
		$req->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
		$req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);

		return $req->execute();
	}
}
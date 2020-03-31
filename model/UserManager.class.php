<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\User;
use \PDO;

/**
* La classe UserManager fait appel à la BDD pour permettre de récupérer, ajouter, modifier et supprimer les données des utilisateurs.
* @Author Robin Ponçon
*/

class UserManager extends Manager
{
	/**
	* Permet de récupérer un utilisateur à partir de son pseudo de la BDD.
	* @param STRING $pseudo : pseudo venant d'une variable SESSION 
	* @return OBJECT : Retourne un objet utilisateur avec les données de son pseudo correspondant
	*/

	public function getUser($pseudo)
	{
		$req = $this->db->prepare("SELECT id, pseudo, password, email FROM users WHERE id > 0 AND pseudo = :pseudo");
		$req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
		$req->execute();
		$data = $req->fetch();

		return new User($data);
	}

	/**
	* Permet d'ajouter un nouvel utilisateur dans la BDD.
	* @param OBJECT ARRAY $user : nouvel objet de la classe User avec un tableau de données  
	*/

	public function addUser(User $user)
    {
 
        $req = $this->db->prepare("INSERT INTO users(pseudo, password, email) VALUES(:pseudo, :password, :email)");

        $req->bindValue(":pseudo", $user->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);

        $req->execute();
    }

    /**
	* Permet de modifier un utilisateur de la BDD en spécifiant son id
	* @param OBJECT ARRAY $user : nouvel objet de la classe User avec un tableau de données qui écraseront les données de la BDD 
	*/

    public function updateInfoUser(User $user)
	{	
		$req = $this->db->prepare("UPDATE users SET pseudo = :pseudo, password = :password, email = :email WHERE id = :id");

		$req->bindValue(":id", $user->getId(), PDO::PARAM_INT);
		$req->bindValue(":pseudo", $user->getPseudo(), PDO::PARAM_STR);
		$req->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
		$req->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);

		$req->execute();
	}
}
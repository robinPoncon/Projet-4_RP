<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\User;
use \PDO;

class UserManager extends Manager
{
	public function getUser()
	{
		$req = $this->db->prepare("SELECT id, pseudo, password, email FROM users");
		$req->execute();
		$data = $req->fetch();

		return new User($data);
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
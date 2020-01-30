<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Admin;
use \PDO;

class AdminManager extends Manager
{
	public function getAdmin($pseudo)
	{
		$req = $this->db->prepare("SELECT id, pseudo, password, email FROM admin WHERE pseudo = :pseudo");
		$req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
		$req->execute();
		$data = $req->fetch();

		return new Admin($data);
	}

	public function addAdmin(Admin $admin)
    {
 
        $req = $this->db->prepare("INSERT INTO admin(pseudo, password, email) VALUES(:pseudo, :password, :email)");

        $req->bindValue(":pseudo", $admin->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(":password", $admin->getPassword(), PDO::PARAM_STR);
        $req->bindValue(":email", $admin->getEmail(), PDO::PARAM_STR);

        return $req->execute();
        
    }
}
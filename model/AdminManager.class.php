<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Admin;
use \PDO;

class AdminManager extends Manager
{
	public function getAdmin()
	{
		$req = $this->db->prepare("SELECT id, pseudo, password, email FROM admin");
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

    public function updateMDPAdmin(Admin $admin)
	{	
		$req = $this->db->prepare("UPDATE admin SET password = :password WHERE id = 1");

		$req->bindValue(":password", $admin->getPassword(), PDO::PARAM_STR);

		$req->execute();
	}
}
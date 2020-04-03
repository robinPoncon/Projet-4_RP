<?php

namespace RobinP\model;

/**
* La classe Manager permet de se connecter automatiquement à la base de donnée
* @Author Robin Ponçon
*/

Class Manager
{
	protected $db;

	public function __construct()
	{
		$this->dbConnect();
	}

	protected function dbConnect()
	{	
		$this->db = new \PDO("mysql:host=localhost;dbname=Projet-4;charset=utf8", "root", "root");
		$this->db->query('SET NAMES "UTF8"');
		return $this->db;
	}
}

?>
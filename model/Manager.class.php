<?php

namespace RobinP\model;

Class Manager
{
	protected $db;

	public function __construct()
	{
		$this->dbConnect();
	}

	protected function dbConnect()
	{
		$this->db = new \PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "root");
		return $this->db;
	}
}

?>
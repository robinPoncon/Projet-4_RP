<?php

Class Manager
{
	protected function __construct()
	{
		$this->dbConnect();
	}

	protected function dbConnect()
	{
		$db = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "root");
		return $db;
	}
}

?>
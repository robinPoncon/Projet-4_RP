<?php

namespace RobinP\classes;
use \RobinP\classes\Entity;

class Admin extends Entity
{
	private $id;
	private $pseudo;
	private $password;
	private $email;

	public function getId()
	{
		return $this->id;
	}

	public function getPseudo()
	{
		return $this->pseudo;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setId($id)
	{
		$id = (int) $id;

		if ($id > 0)
		{
			return $this->id = $id;
		}
	}

	public function setPseudo($pseudo)
	{
		if (is_string($pseudo))
		{
			return $this->pseudo = $pseudo;
		}
	}

	public function setPassword($password)
	{
		
			return $this->password = $password;
		
	}

	public function setEmail($email)
	{
		
			return $this->email = $email;
		
	}
}
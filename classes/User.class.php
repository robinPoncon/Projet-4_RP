<?php

namespace RobinP\classes;
use \RobinP\classes\Entity;

/**
* La classe User permet de créer un objet User(utilisateur) qui va récupérer en entrée les données de la BDD
* @Author Robin Ponçon
*/

class User extends Entity
{
	private $id;
	private $pseudo;
	private $password;
	private $email;




						// Les Getters

	/**
	* Permet de récupérer l'id d'un utilisateur
	* @return INT $id : Retourne l'id de l'utilisateur
	*/

	public function getId()
	{
		return $this->id;
	}

	/**
	* Permet de récupérer le pseudo d'un utilisateur
	* @return STRING $pseudo : Retourne le pseudo de l'utilisateur
	*/

	public function getPseudo()
	{
		return $this->pseudo;
	}

	/**
	* Permet de récupérer le mot de passe d'un utilisateur
	* @return STRING $password : Retourne le mot de passe de l'utilisateur
	*/

	public function getPassword()
	{
		return $this->password;
	}

	/**
	* Permet de récupérer l'email d'un utilisateur
	* @return STRING $email : Retourne l'email de l'utilisateur
	*/

	public function getEmail()
	{
		return $this->email;
	}




						// Les Setters

	/**
	* Permet de définir la valeur de l'id qu'on récupère via la BDD si elle est supérieur à 0.
	* @param INT $id : id venant de la BDD
	* @return INT $id : on récupère l'id que l'on affecte à notre propriété de classe $id;
	*/

	public function setId($id)
	{
		$id = (int) $id;

		if ($id > 0)
		{
			return $this->id = $id;
		}
	}

	/**
	* Permet de définir la valeur du pseudo qu'on récupère via la BDD si elle est de type STRING.
	* @param STRING $pseudo : pseudo venant de la BDD
	* @return STRING $pseudo : on récupère le pseudo que l'on affecte à notre propriété de classe $pseudo;
	*/

	public function setPseudo($pseudo)
	{
		if (is_string($pseudo))
		{
			return $this->pseudo = $pseudo;
		}
	}

	/**
	* Permet de définir la valeur du mot de passe qu'on récupère via la BDD.
	* @param STRING $password : mot de passe venant de la BDD
	* @return STRING $password : on récupère le mot de passe que l'on affecte à notre propriété de classe $password;
	*/

	public function setPassword($password)
	{	
		return $this->password = $password;
	}

	/**
	* Permet de définir la valeur de l'email qu'on récupère via la BDD si elle est de type STRING.
	* @param STRING $email : email venant de la BDD
	* @return STRING $email : on récupère l'email que l'on affecte à notre propriété de classe $email;
	*/

	public function setEmail($email)
	{
		if (is_string($email))
		{
			return $this->email = $email;
		}
		
	}
}
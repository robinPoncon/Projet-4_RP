<?php

namespace RobinP\classes;
use \RobinP\classes\Entity;
use \DateTime;

/**
* La classe Post permet de créer un objet Post(article) qui va récupérer en entrée les données de BDD
* @Author Robin Ponçon
*/

class Post extends Entity
{
	private $id;
	private $title;
	private $content;
	private $author;
	private $creation_date;

					// Les getters

	/**
	* Permet de récupérer l'id d'un article
	* @return Int $id : Retourne l'id de l'article
	*/

	public function getId()
	{
		return $this->id;
	}

	/**
	* Permet de récupérer le titre d'un article
	* @return String $title : Retourne le titre de l'article
	*/

	public function getTitle()
	{
		return $this->title;
	}

	/**
	* Permet de récupérer le contenu d'un article
	* @return String $content : Retourne le contenu de l'article
	*/

	public function getContent()
	{
		return $this->content;
	}

	/**
	* Permet de récupérer l'auteur d'un article
	* @return String $author : Retourne l'auteur de l'article
	*/

	public function getAuthor()
	{
		return $this->author;
	}

	/**
	* Permet de récupérer la date d'un article
	* @return timestamp $creation_date : Retourne la date de l'article
	*/

	public function getCreationDate()
	{
		return $this->creation_date;
	}


					// Les setters

	/**
	* Permet de définir la valeur de l'id qu'on récupère via la BDD si il est supérieur à 0.
	* @param int $id : id venant de la BDD
	* @return int $id : on récupère l'id que l'on affecte à notre propriété de classe $id;
	*/

	public function setId($id)
	{
		$id = (int) $id;
		
		if($id > 0)
		{
			return $this->id = $id;
		}
	}

	/**
	* Permet de définir la valeur du titre qu'on récupère via la BDD si il est de type string.
	* @param string $title : titre venant de la BDD
	* @return string $title : on récupère le titre que l'on affecte à notre propriété de classe $title;
	*/

	public function setTitle($title)
	{
		if(is_string($title))
		{
			return $this->title = $title;
		}
	}

	/**
	* Permet de définir la valeur du contenu qu'on récupère via la BDD si il est de type string.
	* @param string $content : contenu venant de la BDD
	* @return string $content : on récupère le contenu que l'on affecte à notre propriété de classe $contenu;
	*/

	public function setContent($content)
	{
		if(is_string($content))
		{
			return $this->content = $content;
		}
	}

	/**
	* Permet de définir la valeur de l'auteur qu'on récupère via la BDD si il est de type string.
	* @param string $author : auteur venant de la BDD
	* @return string $author : on récupère l'auteur que l'on affecte à notre propriété de classe $author;
	*/

	public function setAuthor($author)
	{
		if(is_string($author))
		{
			return $this->author = $author;
		}
	}

	public function setCreationDate($creation_date)
	{
		return $this->creation_date = $creation_date;
	}


	public function test()
	{
		echo $this->title . " - " . $this->content . " - " . $this->author;
	}
		
}

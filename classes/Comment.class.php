<?php

namespace RobinP\classes;
use \RobinP\classes\Entity;

/**
* La classe Comment permet de créer un objet Comment(commentaire) qui va récupérer en entrée les données de la BDD
* @Author Robin Ponçon
*/

class Comment extends Entity
{
	private $id;
	private $post_id;
	private $author;
	private $comment;
	private $comment_date;
	private $status;





						// Les getters

	/**
	* Permet de récupérer l'id d'un commentaire
	* @return INT $id : Retourne l'id du commentaire
	*/

	public function getId()
	{
		return $this->id;
	}

	/**
	* Permet de récupérer l'id d'un article
	* @return INT $id : Retourne l'id de l'article
	*/

	public function getPostId()
	{
		return $this->post_id;
	}

	/**
	* Permet de récupérer l'auteur d'un commentaire
	* @return STRING $author : Retourne l'auteur du commentaire
	*/

	public function getAuthor()
	{
		return $this->author;
	}

	/**
	* Permet de récupérer le contenu d'un commentaire
	* @return STRING $comment : Retourne le contenu du commentaire
	*/

	public function getComment()
	{
		return $this->comment;
	}

	/**
	* Permet de récupérer la date d'un commentaire
	* @return TIMESTAMP $myFormatForView : Retourne la date du commentaire 
	*/

	public function getCommentDate()
	{
		// On transforme l'entrée STRING anglais en TIMESTAMP 
		$time = strtotime($this->comment_date);

		// On change le format d'affichage du TIMESTAMP
		$myFormatForView = date("d/m/Y à H:i", $time);
		return $myFormatForView;
	}

	/**
	* Permet de récupérer le status d'un commentaire
	* @return INT $status : Retourne le status du commentaire
	*/

	public function getStatus()
	{
		return $this->status;
	}





						// Les setters

	/**
	* Permet de définir la valeur de l'id qu'on récupère via la BDD si elle est supérieur à 0.
	* @param INT $id : id venant de la BDD
	* @return INT $id : on récupère l'id que l'on affecte à notre propriété de classe $id;
	*/

	public function setId($id)
	{
		$id = (INT) $id;

		if ($id > 0)
		{
			return $this->id = $id;
		}
	}

	/**
	* Permet de définir la valeur du post_id qu'on récupère via la BDD si elle est supérieur à 0.
	* @param INT $post_id : id de l'article venant de la BDD
	* @return INT $post_id : on récupère l'id de l'article que l'on affecte à notre propriété de classe $post_id;
	*/

	public function setPostId($post_id)
	{
		$post_id = (INT) $post_id;

		if ($post_id > 0)
		{
			return $this->post_id = $post_id;
		}
	}

	/**
	* Permet de définir la valeur de l'auteur qu'on récupère via la BDD si elle est de type STRING.
	* @param STRING $author : auteur venant de la BDD
	* @return STRING $author : on récupère l'auteur que l'on affecte à notre propriété de classe $author;
	*/

	public function setAuthor($author)
	{
		if (is_STRING($author))
		{
			return $this->author = $author;
		}
	}

	/**
	* Permet de définir la valeur du commentaire qu'on récupère via la BDD si elle est de type STRING.
	* @param STRING $comment : commentaire venant de la BDD
	* @return STRING $comment : on récupère le commentaire que l'on affecte à notre propriété de classe $comment;
	*/

	public function setComment($comment)
	{
		if (is_STRING($comment))
		{
			return $this->comment = $comment;
		}
	}

	/**
	* Permet de définir la valeur de la date qu'on récupère via la BDD si elle est de type TIMESTAMP.
	* @param TIMESTAMP $comment_date : date venant de la BDD
	* @return TIMESTAMP $comment_date : on récupère la date que l'on affecte à notre propriété de classe $comment_date;
	*/

	public function setCommentDate($comment_date)
	{
		return $this->comment_date = $comment_date;
	}

	/**
	* Permet de définir la valeur du status qu'on récupère via la BDD si elle est de type INT et égale à 1 ou 0.
	* @param INT $status : status venant de la BDD
	* @return INT $status : on récupère le status que l'on affecte à notre propriété de classe $status;
	*/

	public function setStatus($status)
	{
		 
		if ($status === 0 || $status === 1)
		{
			return $this->status = $status;
		}
	}
}

?>
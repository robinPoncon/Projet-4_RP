<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Post;
use \PDO;

/**
* La classe PostManager fait appel à la BDD pour permettre de récupérer, ajouter, modifier et supprimer les données des articles.
* @Author Robin Ponçon
*/

class PostManager extends Manager
{	
	/**
	* Permet de récupérer l'ensemble des articles (10max) de la BDD.
	* @return ARRAY d'object $posts : Retourne un tableau d'objets de l'ensemble des articles où chaque article est une classe objet Post
	*/

	public function getPosts()
	{
		$posts = [];

		$datefr = $this->db->query("SET lc_time_names = 'fr_FR'");
		$datefr->execute();

		$req = $this->db->query("SELECT id, title, author, content, DATE_FORMAT(creation_date, '%d %M %Y') 
			AS creation_date FROM posts ORDER BY creation_date, id DESC LIMIT 0, 10");
		while ($data = $req->fetch())
		{
			$posts[] = new Post($data);
		}
		return $posts;
	}

	/**
	* Permet de récupérer un article à partir de son id de la BDD.
	* @param INT $id : id venant d'une variable GET 
	* @return OBJECT : Retourne un objet Post avec les données de son id correspondant
	*/

	public function getPost($id)
	{
		$datefr = $this->db->query("SET lc_time_names = 'fr_FR'");
		$datefr->execute();

		$req = $this->db->prepare("SELECT id, title, author, content, DATE_FORMAT(creation_date, '%d %M %Y') 
								   AS creation_date FROM posts WHERE id = :id");
		$req->bindValue(":id", $id, PDO::PARAM_INT);
		$req->execute();
		$data = $req->fetch();

		return new Post($data);
	}

	/**
	* Permet d'ajouter un nouvel article dans la BDD.
	* @param OBJECT ARRAY $post : nouvel objet de la classe Post avec un tableau de données  
	*/

	public function addPost(Post $post)
	{
		$this->db->query('SET NAMES "UTF8"'); // Encode le text récupérer avec tinymce

		$req = $this->db->prepare("INSERT INTO posts(title, content, creation_date, author) VALUES(:title, :content, NOW(), :author)");

		$req->bindValue(":title", $post->getTitle(), PDO::PARAM_STR);
		$req->bindValue(":content", $post->getContent(), PDO::PARAM_STR);
		$req->bindValue(":author", $post->getAuthor(), PDO::PARAM_STR);

		$req->execute();
	}

	/**
	* Permet de modifier un article de la BDD en spécifiant son id
	* @param OBJECT ARRAY $post : nouvel objet de la classe Post avec un tableau de données qui écraseront les données de la BDD 
	*/

	public function updatePost(Post $post)
	{	
		$this->db->query('SET NAMES "UTF8"'); // Encode le text récupérer avec tinymce
		$req = $this->db->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");

		$req->bindValue(":title", $post->getTitle(), PDO::PARAM_STR);
		$req->bindValue(":content", $post->getContent(), PDO::PARAM_STR);
		$req->bindValue(":id", $post->getId(), PDO::PARAM_INT);

		$req->execute();
	}

	/**
	* Permet de supprimer un article de la BDD en spécifiant son id
	* @param INT $id : id de l'article à supprimer
	*/

	public function deletePost($id)
	{
		$this->db->exec("DELETE FROM posts WHERE id = " . $id);
	}
}

?>
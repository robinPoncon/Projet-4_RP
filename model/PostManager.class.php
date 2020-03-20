<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Post;
use \PDO;

class PostManager extends Manager
{	
	public function getPosts()
	{
		$posts = [];

		$datefr = $this->db->query("SET lc_time_names = 'fr_FR'");
		$datefr->execute();

		$req = $this->db->query("SELECT id, title, author, content, DATE_FORMAT(creation_date, '%d %M %Y à %Hh%imin%ss') AS creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 10");
		while ($data = $req->fetch())
		{
			$posts[] = new Post($data);
		}
		return $posts;
	}

	public function getPost($id)
	{
		$req = $this->db->prepare("SELECT id, title, author, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date FROM posts WHERE id = :id");
		$req->bindValue(":id", $id, PDO::PARAM_INT);
		$req->execute();
		$data = $req->fetch();

		return new Post($data);
	}

	public function addPost(Post $post)
	{
		$req = $this->db->prepare("INSERT INTO posts(title, content, creation_date, author) VALUES(:title, :content, NOW(), :author)");

		$req->bindValue(":title", $post->getTitle(), PDO::PARAM_STR);
		$req->bindValue(":content", $post->getContent(), PDO::PARAM_STR);
		$req->bindValue(":author", $post->getAuthor(), PDO::PARAM_STR);

		$req->execute();
	}

	public function updatePost(Post $post)
	{	
		$req = $this->db->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");

		$req->bindValue(":title", $post->getTitle(), PDO::PARAM_STR);
		$req->bindValue(":content", $post->getContent(), PDO::PARAM_STR);
		$req->bindValue(":id", $post->getId(), PDO::PARAM_INT);

		$req->execute();
	}

	public function deletePost($id)
	{
		$this->db->exec("DELETE FROM posts WHERE id = " . $id);
	}
}

?>
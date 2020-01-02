<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Post;

class PostManager extends Manager
{	
	public function getPosts()
	{
		$posts = [];

		$req = $this->db->query("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5");
		while ($data = $req->fetch())
		{
			$posts[] = new Post($data);
		}
		return $posts;
	}

	public function getPost($id)
	{
		$req = $this->db->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date FROM posts WHERE id = :id");
		$req->bindValue(":id", $id);
		$req->execute();
		$data = $req->fetch();

		return new Post($data);
	}

	public function deletePost(Post $post)
	{
		$this->db->exec("DELETE FROM posts WHERE id = " . $post->id());
	}

	public function updatePost(Post $post)
	{	
		$req = $this->db->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");

		$req->bindValue(":title", $post->getTitle());
		$req->bindValue(":content", $post->getContent());
		$req->bindValue(":id", $post->getId());

		$req->execute();
	}

	public function addPost(Post $post)
	{
		$req = $this->db->prepare("INSERT INTO posts(title, content, creation_date, author) VALUES(:title, :content, NOW(), :author)");

		$req->bindValue(":title", $post->getTitle());
		$req->bindValue(":content", $post->getContent());
		$req->bindValue(":author", $post->getAuthor());

		$req->execute();
	}
}

?>
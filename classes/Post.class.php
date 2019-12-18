<?php
	
class Post
{
	private $title;
	private $content;
	private $author;

	public function __construct($title, $content, $author)
	{
		$this->setTitle($title);
		$this->setContent($content);
		$this->setAuthor($author);
	}

	// Les getters

	public function getTitle()
	{
		return $this->title;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getAuthor()
	{
		return $this->author;
	}


	// Les setters

	public function setTitle($title)
	{
		if(is_string($title))
		{
			return $this->title = $title;
		}
	}

	public function setContent($content)
	{
		if(is_string($content))
		{
			return $this->content = $content;
		}
	}

	public function setAuthor($author)
	{
		if(is_string($author))
		{
			return $this->author = $author;
		}
	}


	public function test()
	{
		echo $this->title . " - " . $this->content . " - " . $this->author;
	}



	public function showPost()
	{
		// Requete SQL SELECT
	}

	public function addPost(Post $post)
	{
		// Requete SQL INSERT INTO
	}

	public function updatePost(Post $post)
	{
		// Requete SQL UPDATE
	}

	public function deletePost($id)
	{
		// REQUETE SQL DELETE
	}
		
}





?>
<?php

namespace RobinP\classes;
use \RobinP\classes\Entity;

//require "classes/Entity.class.php";

class Post extends Entity
{
	private $title;
	private $content;
	private $author;

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
		
}





?>
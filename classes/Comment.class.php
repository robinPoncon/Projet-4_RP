<?php

class Comment
{
	private $author;
	private $content;

	public function __construct($author, $content)
	{
		$this->setAuthor($author);
		$this->setContent($content);
	}

	// Les getters

	public function getAuthor()
	{
		return $this->author;
	}

	public function getContent()
	{
		return $this->content;
	}

	// Les setters

	public function setAuthor($author)
	{
		if (is_string($author))
		{
			$this->author = $author;
		}
	}

	public function setContent($content)
	{
		if (is_string($content))
		{
			$this->content = $content;
		}
	}
}

?>
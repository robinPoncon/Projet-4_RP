<?php

namespace RobinP\classes;
use \RobinP\classes\Entity;
use \DateTime;

function validateDate($date, $format = 'Y-m-d H:i:s')
	{
    	$d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
	}

class Post extends Entity
{
	private $id;
	private $title;
	private $content;
	private $author;
	private $creation_date;

	// Les getters

	public function getId()
	{
		return $this->id;
	}

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

	public function getCreationDate()
	{
		return $this->creation_date;
	}


	// Les setters

	public function setId($id)
	{
		$id = (int) $id;
		
		if($id > 0)
		{
			return $this->id = $id;
		}
	}

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

	public function setCreationDate($creation_date)
	{
		if (validateDate($creation_date) === false)
		{
  			echo "test";
		}

		else
		{
			return $this->creation_date = $creation_date;
		}

	}


	public function test()
	{
		echo $this->title . " - " . $this->content . " - " . $this->author;
	}
		
}





?>
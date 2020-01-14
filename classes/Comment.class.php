<?php

namespace RobinP\classes;
use \RobinP\classes\Entity;

class Comment extends Entity
{
	private $id;
	private $post_id;
	private $author;
	private $comment;
	private $comment_date;

	// Les getters

	public function getId()
	{
		return $this->id;
	}

	public function getPostId()
	{
		return $this->post_id;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function getCommentDate()
	{
		$time = strtotime($this->comment_date);
		$myFormatForView = date("d/m/Y à H:i:s", $time);
		return $myFormatForView;
	}

	// Les setters

	public function setId($id)
	{
		$id = (int) $id;

		if ($id > 0)
		{
			return $this->id = $id;
		}
	}

	public function setPostId($post_id)
	{
		$post_id = (int) $post_id;

		if ($post_id > 0)
		{
			return $this->post_id = $post_id;
		}
	}

	public function setAuthor($author)
	{
		if (is_string($author))
		{
			return $this->author = $author;
		}
	}

	public function setComment($comment)
	{
		if (is_string($comment))
		{
			return $this->comment = $comment;
		}
	}

	public function setCommentDate($comment_date)
	{
		return $this->comment_date = $comment_date;
	}
}

?>
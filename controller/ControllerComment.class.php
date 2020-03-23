<?php 

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\model\CommentManager;
use \RobinP\classes\Comment;

class ControllerComment
{
	private $post;
	private $postManager;
	private $comments;
	private $commentManager;
	private $newCom;
	private $commentSignaler;

	public function __construct()
	{
		$this->postManager = new PostManager();
		$this->commentManager = new CommentManager();
	}

	public function post()
	{
	    $this->post = $this->postManager->getPost($_GET["id"]);
	    $this->comments = $this->commentManager->getComments($_GET["id"]);

	    require 'view/page/postView.php';
	}

	public function addComment($postId, $author, $comment)
	{
	    $this->newCom = new Comment(["post_id" => $postId, "author" => $author, "comment" => $comment]);
	    
	    $this->commentManager->addComment($this->newCom);
	    
	    header('Location: index.php?action=post&id=' . $postId);
	}

	public function signaler()
	{
		$this->commentSignaler = new Comment(["id" => $_GET["id"], "status" => 0]);
		$this->commentManager->updateComment($this->commentSignaler);
		//var_dump($this->commentSignaler);
		header("Location: index.php?action=listPosts");
	} 

	public function approveComment()
	{
		$this->approveComment = new Comment(["id" => $_GET["id"], "status" => 1]);
		$this->commentManager->updateComment($this->approveComment);
		header("Location: index.php?action=Compte");
	}
}

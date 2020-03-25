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
	private $deleteComment;

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
	    
	    $msg_confirmation = "Le commentaire a bien été ajouté !";
	    $url = "post&id=" . $postId;
	    require "view/page/messageConfirmation.php";
	}

	public function signaler()
	{
		$this->commentSignaler = new Comment(["id" => $_GET["id"], "status" => 0]);
		$this->commentManager->updateComment($this->commentSignaler);
		
		$msg_confirmation = "Le commentaire a bien été signalé !";
	    $url = "post&id=" . $_GET["postId"];
	    require "view/page/messageConfirmation.php";
	} 

	public function approveComment()
	{
		$this->approveComment = new Comment(["id" => $_GET["id"], "status" => 1]);
		$this->commentManager->updateComment($this->approveComment);

		$msg_confirmation = "Le commentaire a bien été approuvé !";
	    $url = "Compte";
	    require "view/page/messageConfirmation.php";
	}

	public function deleteComment()
	{
		$this->deleteComment = $this->commentManager->deleteComment($_GET["id"]);
		$msg_confirmation = "Le commentaire a bien été supprimé !";
	    $url = "Compte";
	    require "view/page/messageConfirmation.php";
	}
}

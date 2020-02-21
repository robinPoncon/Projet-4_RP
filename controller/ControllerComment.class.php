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

	public function post()
	{
		$this->postManager = new PostManager();
		$this->commentManager = new CommentManager();

	    $this->post = $this->postManager->getPost($_GET["id"]);
	    $this->comments = $this->commentManager->getComments($_GET["id"]);

	    require 'view/page/postView.php';
	}

	public function addComment($postId, $author, $comment)
	{

		$this->commentManager = new CommentManager();

	    $this->newCom = new Comment(["post_id" => $postId, "author" => $author, "comment" => $comment]);
	    
	    $this->commentManager->addComment($this->newCom);
	    
	    header('Location: index.php?action=post&id=' . $postId);
	} 
}

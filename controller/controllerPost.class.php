<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\classes\Post;
use \RobinP\model\CommentManager;

class ControllerPost
{
	private $postManager;
	private $posts;
	private $post;
	private $newPost;
	private $postUpdate;
	private $deletePost;

	public function __construct()
	{
		$this->postManager = new PostManager();
		$this->commentManager = new CommentManager();
		$this->posts = $this->postManager->getPosts();
	}

	public function listPosts()
	{
		//var_dump($_COOKIE["cookie"]["pseudo"]);
	    require 'view/page/listPostsView.php'; 
	}

	public function addPost($title, $author, $content)
	{	
		$this->newPost = new Post(["title" => $title, "author" => $author, "content" => $content]);
		$this->post = $this->postManager->addPost($this->newPost);
		$msg_confirmation = "L'article a bien été ajouté !";
	    $url = "Compte";
	    require "view/page/messageConfirmation.php";
	}

	public function viewUpdatePost()
	{
		$this->post = $this->postManager->getPost($_GET["id"]);
		require "view/page/updatePost.php";
	}

	public function updatePost($postId, $title, $content)
	{
		$this->postUpdate = new Post(["id" => $postId, "title" => $title, "content" => $content]);
		$this->post = $this->postManager->updatePost($this->postUpdate);

		$msg_confirmation = "L'article a bien été modifié !";
	    $url = "viewUpdatePost&id=" . $postId;
	    require "view/page/messageConfirmation.php";
	}

	public function deletePost()
	{
		$this->deletePost = $this->postManager->deletePost($_GET["id"]);
		$this->deleteCommentPost = $this->commentManager->deleteCommentPost($_GET["id"]);

		$msg_confirmation = "L'article a bien été supprimé !";
	    $url = "listPosts";
	    require "view/page/messageConfirmation.php";
	}
}








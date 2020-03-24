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
		header("Location: index.php?action=Compte");
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
		header("Location: index.php?action=viewUpdatePost&id=" . $postId);
	}

	public function deletePost()
	{
		$this->deletePost = $this->postManager->deletePost($_GET["id"]);
		$this->deleteCommentPost = $this->commentManager->deleteCommentPost($_GET["id"]);
		header("Location: index.php?action=listPosts");
	}
}








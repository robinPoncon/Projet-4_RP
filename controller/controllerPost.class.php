<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\classes\Post;

class ControllerPost
{
	private $postManager;
	private $posts;
	private $post;
	private $postUpdate;

	public function __construct()
	{
		$this->postManager = new PostManager();
		$this->posts = $this->postManager->getPosts();
	}

	public function listPosts()
	{
	    require 'view/page/listPostsView.php'; 
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
}








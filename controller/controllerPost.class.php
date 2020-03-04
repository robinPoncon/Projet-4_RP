<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\classes\Post;

class ControllerPost
{
	private $postManager;
	private $posts;

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
		require "view/page/updatePost.php";
	}
}








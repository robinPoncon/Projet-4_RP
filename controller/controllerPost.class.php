<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;

class ControllerPost
{
	private $posts;
	private $postManager;

	public function listPosts()
	{
		$this->postManager = new PostManager();
		$this->posts = $this->postManager->getPosts();	

	    require 'view/frontend/listPostsView.php';
	    
	}
}








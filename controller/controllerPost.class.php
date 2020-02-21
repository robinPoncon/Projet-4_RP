<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;

class ControllerPost
{
	private $postManager;
	private $posts;

	public function listPosts()
	{
		$this->postManager = new PostManager();
		$this->posts = $this->postManager->getPosts();

	    require 'view/page/listPostsView.php';
	    
	}
}








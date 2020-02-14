<?php

use \RobinP\model\PostManager;

function listPosts()
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();

    require 'view/frontend/listPostsView.php';
    
}








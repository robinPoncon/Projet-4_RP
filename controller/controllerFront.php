<?php

use \RobinP\model\PostManager;
use \RobinP\model\CommentManager;
use \RobinP\classes\Comment;

function listPosts()
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();

    require 'view/frontend/listPostsView.php';
}

function post()
{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->getPost($_GET["id"]);
    $comments = $commentManager->getComments($_GET["id"]);

    require 'view/frontend/postView.php';
}

function addComment($postId, $author, $comment)
{

	$commentManager = new CommentManager();

    $newCom = new Comment(["post_id" => $postId, "author" => $author, "comment" => $comment]);
    $affectedLines = $commentManager->addComment($newCom);

    header('Location: index.php?action=post&id=' . $postId);
} 
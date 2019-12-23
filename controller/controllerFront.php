<?php

use \RobinP\classes\Post;

$test = new Post(['title' => 'test', 'content' => 'youpi', 'author' => 'rob']);
$test->test();

use \RobinP\model\PostManager;
use \RobinP\model\CommentManager;

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

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require 'view/frontend/postView.php';
}

function addComment($postId, $author, $comment)
{
	$commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception("Impossible d'ajouter le commentaire !");
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
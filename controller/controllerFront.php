<?php

use \RobinP\model\PostManager;
use \RobinP\model\CommentManager;
use \RobinP\classes\Comment;
use \RobinP\model\AdminManager;
use \RobinP\classes\Admin;

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
    
    $commentManager->addComment($newCom);
    
    header('Location: index.php?action=post&id=' . $postId);
} 

function addAdmin($pseudo, $password, $email)
{
    $adminManager = new AdminManager();

    $newAdmin = new Admin(["pseudo" => $pseudo, "password" => $password, "email" => $email]);

    $adminManager->addAdmin($newAdmin);
}

function adminConnectAccueil($pseudo, $password)
{
    $adminManager = new AdminManager();
    
    $admin = $adminManager->getAdmin();

    $isPasswordCorrect = password_verify($password, $admin->getPassword());

    //var_dump($admin);

    if ($isPasswordCorrect && $pseudo === $admin->getPseudo())
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require "view/backend/ListPostsAdmin.php"; 
    }

    else
    {
        throw new Exception("Mauvais login ou mot de passe", 1);
        
    }
}
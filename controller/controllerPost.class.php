<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\classes\Post;
use \RobinP\model\CommentManager;

/**
* La classe ControllerPost fait appel aux classes manager, afin d'afficher, ajouter, modifier, supprimer des articles.
* @Author Robin Ponçon
*/

class ControllerPost
{
	private $postManager;
	private $posts;
	private $post;
	private $newPost;
	private $postUpdate;
	private $deletePost;

	/**
	* Permet de créer automatiquement des nouveaux objets Postmanager, CommentManager ainsi que de faire appel à la méthode getPosts
	*/

	public function __construct()
	{
		$this->postManager = new PostManager();
		$this->commentManager = new CommentManager();
		$this->posts = $this->postManager->getPosts();
	}

	/**
	* Permet de faire appel à la page listPostsView qui affiche l'ensemble des articles
	*/

	public function listPosts()
	{
		//var_dump($_COOKIE["cookie"]["pseudo"]);
		//var_dump($_COOKIE["cookie"]["password"]);
	    require 'view/page/listPostsView.php'; 
	}

	/**
	* Permet d'ajouter un article en récupérant le titre, l'auteur et le contenu provenant d'une variable POST.
	* @param STRING $title : title venant d'une variable POST
	* @param STRING $author : auteur venant d'une variable POST
	* @param STRING $content : contenu venant d'une variable POST
	*/

	public function addPost($title, $author, $content)
	{	
		$this->newPost = new Post(["title" => $title, "author" => $author, "content" => $content]);
		$this->post = $this->postManager->addPost($this->newPost);

		$msg_confirmation = "L'article a bien été ajouté !";
	    $url = "Compte";
	    require "view/page/messageConfirmation.php";
	}

	/**
	* Permet de faire appel à la page updatePost qui affiche l'article correspondant à l'id récupéré.
	*/

	public function viewUpdatePost()
	{
		$this->post = $this->postManager->getPost($_GET["id"]);
		require "view/page/updatePost.php";
	}

	/**
	* Permet de modifier un article en récupérant son id afin de modifier le titre et le contenu provenant d'une variable POST.
	* @param INT $postId : id de l'article venant d'une variable POST (elle même venant de la variable GET avec la méthode au dessus)
	* @param STRING $title : title venant d'une variable POST
	* @param STRING $content : contenu venant d'une variable POST
	*/

	public function updatePost($postId, $title, $content)
	{
		$this->postUpdate = new Post(["id" => $postId, "title" => $title, "content" => $content]);
		$this->post = $this->postManager->updatePost($this->postUpdate);

		$msg_confirmation = "L'article a bien été modifié !";
	    $url = "viewUpdatePost&id=" . $postId;
	    require "view/page/messageConfirmation.php";
	}

	/**
	* Permet de supprimer un article en faisant appel au Manager et en récupérant son id provenant d'une variable GET
	*/

	public function deletePost()
	{
		$this->deletePost = $this->postManager->deletePost($_GET["id"]);
		$this->deleteCommentPost = $this->commentManager->deleteCommentPost($_GET["id"]);

		$msg_confirmation = "L'article a bien été supprimé !";
	    $url = "listPosts";
	    require "view/page/messageConfirmation.php";
	}
}








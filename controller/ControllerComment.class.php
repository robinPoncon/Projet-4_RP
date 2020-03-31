<?php 

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\model\CommentManager;
use \RobinP\classes\Comment;

/**
* La classe ControllerComment fait appel aux classes manager, afin d'afficher, ajouter, modifier, signaler et supprimer des commentaires.
* @Author Robin Ponçon
*/

class ControllerComment
{
	private $post;
	private $postManager;
	private $comments;
	private $commentManager;
	private $newCom;
	private $commentSignaler;
	private $deleteComment;

	/**
	* Permet de créer automatiquement des nouveaux objets Postmanager, CommentManager à chaque appel de la classe
	*/

	public function __construct()
	{
		$this->postManager = new PostManager();
		$this->commentManager = new CommentManager();
	}

	/**
	* Permet de faire appel à la page postView qui affiche l'article et ses commentaires en récupérant son id d'une variable GET
	*/

	public function post()
	{
	    $this->post = $this->postManager->getPost($_GET["id"]);
	    $this->comments = $this->commentManager->getComments($_GET["id"]);

	    require 'view/page/postView.php';
	}

	/**
	* Permet d'ajouter un commentaire en faisant appel au commentManager en récupérant son auteur, son contenu ($comment) et l'id de l'article.
	* @param INT $postId : id de l'article venant d'une variable POST (elle même venant de la variable GET avec la méthode au dessus)
	* @param STRING $author : auteur venant d'une variable POST
	* @param STRING $comment : contenu venant d'une variable POST
	*/

	public function addComment($postId, $author, $comment)
	{
	    $this->newCom = new Comment(["post_id" => $postId, "author" => $author, "comment" => $comment]);
	    $this->commentManager->addComment($this->newCom);
	    
	    $msg_confirmation = "Le commentaire a bien été ajouté !";
	    $url = "post&id=" . $postId;
	    require "view/page/messageConfirmation.php";
	}

	/**
	* Permet de signaler un commentaire en faisant appel au commentManager et en modifiant son status
	*/

	public function signaler()
	{
		$this->commentSignaler = new Comment(["id" => $_GET["id"], "status" => 0]);
		$this->commentManager->updateComment($this->commentSignaler);
		
		$msg_confirmation = "Le commentaire a bien été signalé !";
	    $url = "post&id=" . $_GET["postId"];
	    require "view/page/messageConfirmation.php";
	} 

	/**
	* Permet d'approuver un commentaire en faisant appel au commentManager et en modifiant son status
	*/

	public function approveComment()
	{
		$this->approveComment = new Comment(["id" => $_GET["id"], "status" => 1]);
		$this->commentManager->updateComment($this->approveComment);

		$msg_confirmation = "Le commentaire a bien été approuvé !";
	    $url = "Compte";
	    require "view/page/messageConfirmation.php";
	}

	/**
	* Permet de supprimer un commentaire en faisant appel au commentManager et en récupérant son id avec une variable GET.
	*/

	public function deleteComment()
	{
		$this->deleteComment = $this->commentManager->deleteComment($_GET["id"]);
		$msg_confirmation = "Le commentaire a bien été supprimé !";
	    $url = "Compte";
	    require "view/page/messageConfirmation.php";
	}
}

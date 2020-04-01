<?php
session_start();

require_once "app/Autoloader.php";
Autoloader::register();

use \RobinP\controller\ControllerPost;
use \RobinP\controller\ControllerComment;
use \RobinP\controller\ControllerUser;

$pageError = "view/page/messageErreur.php";

try
{
	if (isset($_GET['action']))
	{
		if ($_GET['action'] == 'listPosts') 
		{
		    $listPosts = new ControllerPost();
		    $listPosts->listPosts();
		}

		elseif ($_GET['action'] == 'post') 
		{
		    if (isset($_GET['id']) && $_GET['id'] > 0) 
		    {
		       	$post = new ControllerComment();
		        $post->post();
		    }
		    else 
		    {
		    	$_SESSION["url"] = "listPosts";
		        throw new \Exception("Aucun identifiant de billet envoyé");
		    }
		}

		elseif ($_GET['action'] == 'signaler')
		{
			if (isset($_GET['id']) && $_GET['id'] > 0) 
		    {
		    	$signaler = new ControllerComment();
		       	$signaler->signaler();
		    }

		    else 
		    {
		    	$_SESSION["url"] = "post&id=" . $_GET["id"];
		        throw new \Exception("Aucun identifiant de billet envoyé");
		    }
		}

		elseif (isset($_POST))
		{
		    if (isset($_POST["addComment"]))
		    {
			    $comment = $_POST["addComment"];

			    if (isset($comment['id']) && $comment['id'] > 0) 
			    {
			        if (!empty($comment['author']) && !empty($comment['comment'])) 
			        {
			           	$addComment = new ControllerComment();
			            $addComment->addComment($comment['id'], $comment['author'], $comment['comment']);
			        } 

			        else 
			        {
			        	$_SESSION["url"] = "post&id=" . $comment["id"];
			           	throw new Exception("Tous les champs ne sont pas remplis");
			        } 
			    }

			    else 
			    {
			    	$_SESSION["url"] = "post&id=" . $comment["id"];
			        throw new Exception('Aucun identifiant de billet envoyé');
			    }
			}
		}
	}

	else
	{
		if (isset($_COOKIE["cookie"]["pseudo"])) 
		{
			$connect = new ControllerUser($_COOKIE["cookie"]["pseudo"]);
			$connect->userConnectAccueil($_COOKIE["cookie"]["pseudo"], $_COOKIE["cookie"]["password"], "");
		}

		else
		{
			$_SESSION["header"] = "template-page-front.php";
		}
		
		$listPosts = new ControllerPost();
		$listPosts->listPosts(); 
	}
		   
	if (isset($_SESSION["pseudo"]) || isset($_COOKIE["cookie"]["pseudo"]))
	{
		if (isset($_GET['action']))
		{
			if ($_GET['action'] == "Compte")
			{
				$compte = new ControllerUser($_SESSION["pseudo"]);
				$compte->espaceCompte();
			}

			elseif ($_GET["action"] == "Deconnexion")
			{
				$deconnect = new ControllerUser($_SESSION["pseudo"]);
				$deconnect->userDeconnect();
			}

			elseif ($_GET['action'] == 'viewUpdatePost') 
			{
			    if (isset($_GET['id']) && $_GET['id'] > 0) 
			    {
			       	$viewUpdatePost = new ControllerPost();
			        $viewUpdatePost->viewUpdatePost();
			    }

			    else 
			    {
			    	$_SESSION["url"] = "listPosts";
			        throw new \Exception("Aucun identifiant de billet envoyé");
			    }
			}

			elseif ($_GET["action"] == "deletePost") 
			{
				if (isset($_GET['id']) && $_GET['id'] > 0) 
			    {
			       	$deletePost = new ControllerPost();
			        $deletePost->deletePost();
			    }

			    else 
			    {
			    	$_SESSION["url"] = "listPosts";
			        throw new \Exception("Aucun identifiant de billet envoyé");
			    }
			}

			elseif ($_GET["action"] == "approve") 
			{
				if (isset($_GET['id']) && $_GET['id'] > 0) 
			    {
			       	$approveComment = new ControllerComment();
			        $approveComment->approveComment();
			    }

			    else 
			    {
			    	$_SESSION["url"] = "Compte";
			        throw new \Exception("Aucun identifiant de billet envoyé");
			    }
			}

			elseif ($_GET["action"] == "deleteComment") 
			{
				if (isset($_GET['id']) && $_GET['id'] > 0) 
			    {
			       	$deleteComment = new ControllerComment();
			        $deleteComment->deleteComment();
			    }

			    else 
			    {
			    	$_SESSION["url"] = "Compte";
			        throw new \Exception("Aucun identifiant de billet envoyé");
			    }
			}
		
			elseif (isset($_POST)) 
			{
				if (isset($_POST["changePseudo"]))
				{
					$changePseudo = $_POST["changePseudo"];

					if (!empty($changePseudo["actuelPseudo"]) && !empty($changePseudo["newPseudo"]) && !empty($changePseudo["verifNewPseudo"])) 
					{	
						$modifPseudo = new ControllerUser($_SESSION["pseudo"]);
						$modifPseudo->changePseudo($changePseudo["actuelPseudo"], $changePseudo["newPseudo"], $changePseudo["verifNewPseudo"]);
					}

					else
					{
						$_SESSION["url"] = "Compte";
						throw new \Exception("Vérifier les pseudos saisis !");
					}
				}

				elseif (isset($_POST["changeMDP"]))
				{
					$changeMDP = $_POST["changeMDP"];

					if (!empty($changeMDP["actuelMDP"]) && !empty($changeMDP["newMDP"]) && !empty($changeMDP["verifNewMDP"])) 
					{
						$modifPass = new ControllerUser($_SESSION["pseudo"]);
						$modifPass->changePassword($changeMDP["actuelMDP"], $changeMDP["newMDP"], $changeMDP["verifNewMDP"]);
					}

					else
					{
						$_SESSION["url"] = "Compte";
						throw new \Exception("Vérifier les mots de passe saisis !");
					}
				}

				elseif (isset($_POST["changeEmail"]))
				{
					$changeEmail = $_POST["changeEmail"];

					if (!empty($changeEmail["actuelEmail"]) && !empty($changeEmail["newEmail"]) && !empty($changeEmail["verifNewEmail"])) 
					{
						$modifMail = new ControllerUser($_SESSION["pseudo"]);
						$modifMail->changeEmail($changeEmail["actuelEmail"], $changeEmail["newEmail"], $changeEmail["verifNewEmail"]);
					}

					else
					{
						$_SESSION["url"] = "Compte";
						throw new \Exception("Vérifier les emails saisis !");
					}
				}

				elseif (isset($_POST["addPost"]))
				{
					
					$addPost = $_POST["addPost"];

					if (!empty($addPost['title']) && !empty($addPost['author']) && !empty($addPost["content"])) 
				    {
				        $newPost = new ControllerPost();
				        $newPost->addPost($addPost['title'], $addPost['author'], $addPost['content']);
				    } 

				    else 
				    {
				    	$_SESSION["url"] = "Compte";
				        throw new Exception("Tous les champs ne sont pas remplis");
				    } 
				}

				elseif (isset($_POST["updatePost"]))
				{
					$updatePost = $_POST["updatePost"];

				    if (isset($updatePost['id']) && $updatePost['id'] > 0) 
				    {
				        if (!empty($updatePost['title']) && !empty($updatePost['content'])) 
				        {
				           	$updatePostUser = new ControllerPost();
				            $updatePostUser->updatePost($updatePost['id'], $updatePost['title'], $updatePost['content']);
				        } 

				        else 
				        {
				        	$_SESSION["url"] = "viewUpdatePost&id=" . $updatePost["id"];
				           	throw new Exception("Tous les champs ne sont pas remplis");
				        } 
				    }

				    else 
				    {
				    	$_SESSION["url"] = "viewUpdatePost&id=" . $updatePost["id"];
				        throw new Exception('Aucun identifiant de billet envoyé');
				    }
				}
			}
		}
	}

	else
	{
		if (isset($_POST)) 
		{
			if (isset($_POST["user"]))
			{
			    $user = $_POST["user"];

			    if (!empty($user["pseudo"]) && !empty($user["password"]))
			    {
			    	$connect = new ControllerUser($user["pseudo"]);
			    	$connect->userConnectAccueil($user["pseudo"], $user["password"], $user["auto"]);
			    }

			    else
			    {
			    	$_SESSION["url"] = "listPosts";
			       	throw new \Exception("Login ou mot de passe non remplis. Veuillez réessayer !");
			    }
			}
		}
	}		
}

catch(Exception $e)
{
	$msg_error = "Erreur : " . $e->getMessage();
	require "view/page/messageErreur.php";
}
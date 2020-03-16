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
			           	throw new Exception("Tous les champs ne sont pas remplis");
			        } 
			    }

			    else 
			    {
			        throw new Exception('Aucun identifiant de billet envoyé');
			    }
			}
		}
	}

	else
	{
		if (!isset($_SESSION["header"])) {
			$_SESSION["header"] = "template-page-front.php";
		}
		
		$listPosts = new ControllerPost();
		$listPosts->listPosts();
	}
		   
	if (isset($_SESSION["pseudo"]))
	{
		if (isset($_GET['action']))
		{
			if ($_GET['action'] == "Compte")
			{
				$compte = new ControllerUser();
				$compte->espaceCompte();
			}

			elseif ($_GET["action"] == "Deconnexion")
			{
				$deconnect = new ControllerUser();
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
						$modifPseudo = new ControllerUser();
						$modifPseudo->changePseudo($changePseudo["actuelPseudo"], $changePseudo["newPseudo"], $changePseudo["verifNewPseudo"]);
					}
					else
					{
						throw new \Exception("Vérifier les pseudos saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>");
					}
				}

				elseif (isset($_POST["changeMDP"]))
				{
					$changeMDP = $_POST["changeMDP"];

					if (!empty($changeMDP["actuelMDP"]) && !empty($changeMDP["newMDP"]) && !empty($changeMDP["verifNewMDP"])) 
					{
						$modifPass = new ControllerUser();
						$modifPass->changePassword($changeMDP["actuelMDP"], $changeMDP["newMDP"], $changeMDP["verifNewMDP"]);
					}

					else
					{
						throw new \Exception("Vérifier les mots de passe saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>");
					}
				}

				elseif (isset($_POST["changeEmail"]))
				{
					$changeEmail = $_POST["changeEmail"];

					if (!empty($changeEmail["actuelEmail"]) && !empty($changeEmail["newEmail"]) && !empty($changeEmail["verifNewEmail"])) 
					{
						$modifMail = new ControllerUser();
						$modifMail->changeEmail($changeEmail["actuelEmail"], $changeEmail["newEmail"], $changeEmail["verifNewEmail"]);
					}

					else
					{
						throw new \Exception("Vérifier les emails saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>");
					}
				}

				elseif (isset($_POST["addPost"]))
				{
					
					$addPost = $_POST["addPost"];
					var_dump($_POST);

					if (!empty($addPost['title']) && !empty($addPost['author']) && !empty($addPost["content"])) 
				    {
				        $newPost = new ControllerPost();
				        $newPost->addPost($addPost['title'], $addPost['author'], $addPost['content']);
				    } 

				    else 
				    {
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
				            var_dump($updatePost);
				        } 

				        else 
				        {
				           	throw new Exception("Tous les champs ne sont pas remplis");
				        } 
				    }

				    else 
				    {
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
			       	$connect = new ControllerUser();
			        $connect->userConnectAccueil($user["pseudo"], $user["password"]);
			    }

			    else
			    {
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
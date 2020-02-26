<?php
session_start();

require_once "app/Autoloader.php";
Autoloader::register();

use \RobinP\controller\ControllerPost;
use \RobinP\controller\ControllerComment;
use \RobinP\controller\ControllerUser;
//var_dump($_SESSION["pseudo"]);
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
		        $msg_error = "Erreur : Aucun identifiant de billet envoyé";
            	require $pageError;
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
			           	$msg_error = "Erreur : Tous les champs ne sont pas remplis";
	            		require $pageError;
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
		$_SESSION["header"] = "template-page-front.php";
		$listPosts = new ControllerPost();
		$listPosts->listPosts();
	}
		   
	if (isset($_SESSION["pseudo"]))
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
					$msg_error = "Erreur : Vérifier les pseudos saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>";
					require $pageError;
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
					$msg_error = "Erreur : Vérifier les mots de passe saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>";
					require $pageError;
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
					$msg_error = "Erreur : Vérifier les emails saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>";
					require $pageError;
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
			       	$msg_error = "Erreur : Login ou mot de passe non remplis. Veuillez réessayer !";
	            	require $pageError;
			    }
			}
		}
	}		
}

catch(Exception $e)
{
	echo "erreur : " . $e->getMessage();
}
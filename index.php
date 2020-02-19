<?php
session_start();

require_once "app/Autoloader.php";
Autoloader::register();

use \RobinP\controller\ControllerPost;
require("controller/controllerComment.php");
require("controller/controllerBackOffice.php");
//var_dump($_SESSION["pseudo"]);
try
{
	if (isset($_SESSION["pseudo"]))
	{
		test();
	}
	else
	{


		if (isset($_GET['action'])) {
		    if ($_GET['action'] == 'listPosts') 
		    {
		        $listPosts = new ControllerPost();
		        $listPosts->listPosts();
		    }
		    elseif ($_GET['action'] == 'post') 
		    {

		    	if (isset($_GET['id']) && $_GET['id'] > 0) 
		    	{
		            post();
		        }
		        else 
		        {
		            throw new Exception('Aucun identifiant de billet envoyé');
		        }
		    }

		    elseif ($_GET['action'] == "Compte")
		    {
		    	espaceCompte();
		    }

		    elseif ($_GET["action"] == "Deconnexion")
		    {
		    	userDeconnect();
		    }

		    elseif (isset($_POST)) 
		    {
		    	if (isset($_POST["user"]))
		        {
		        	$user = $_POST["user"];

		        	if (!empty($user["pseudo"]) && !empty($user["password"]))
		        	{
		        		userConnectAccueil($user["pseudo"], $user["password"]);
		        	}
		        	else
		        	{
		        		throw new Exception("Mauvais login ou mot de passe");
		        	}
		        }

		        elseif (isset($_POST["changeMDP"]))
		        {
		        	$changeMDP = $_POST["changeMDP"];

		        	if (!empty($changeMDP["actuelMDP"]) && !empty($changeMDP["newMDP"]) && !empty($changeMDP["verifNewMDP"])) 
		        	{
		        		changePassword($changeMDP["actuelMDP"], $changeMDP["newMDP"], $changeMDP["verifNewMDP"]);
		        	}
		        	else
		        	{
		        		throw new Exception("Vérifier les mots de passe saisis");	
		        	}
		        }

		        elseif (isset($_POST["changePseudo"]))
		        {
		        	$changePseudo = $_POST["changePseudo"];

		        	if (!empty($changePseudo["actuelPseudo"]) && !empty($changePseudo["newPseudo"]) && !empty($changePseudo["verifNewPseudo"])) 
		        	{
		        		changePseudo($changePseudo["actuelPseudo"], $changePseudo["newPseudo"], $changePseudo["verifNewPseudo"]);
		        	}
		        	else
		        	{
		        		throw new Exception("Vérifier les pseudos saisis");	
		        	}
		        }

		        elseif (isset($_POST["changeEmail"]))
		        {
		        	$changeEmail = $_POST["changeEmail"];

		        	if (!empty($changeEmail["actuelEmail"]) && !empty($changeEmail["newEmail"]) && !empty($changeEmail["verifNewEmail"])) 
		        	{
		        		changeEmail($changeEmail["actuelEmail"], $changeEmail["newEmail"], $changeEmail["verifNewEmail"]);
		        	}
		        	else
		        	{
		        		throw new Exception("Vérifier les emails saisis");	
		        	}
		        }

		        elseif (isset($_POST["addComment"]))
		        {
		        	$comment = $_POST["addComment"];

		        	if (isset($comment['id']) && $comment['id'] > 0) 
		        	{
		        		
		            	if (!empty($comment['author']) && !empty($comment['comment'])) 
		            	{
		            		addComment($comment['id'], $comment['author'], $comment['comment']);
		            	} 

		            	else 
		            	{
		                	throw new Exception('Tous les champs ne sont pas remplis !');
		           		} 
		        	}
		        	else 
		        	{
		            	throw new Exception('Aucun identifiant de billet envoyé');
		        	}
		    	}

		        else
		        {
		        	throw new Exception("Donnée formulaire non attendue");
		        }

		    }
		}
		else 
		{
		    $listPosts = new ControllerPost();
		    $listPosts->listPosts();
		}
	}
}

catch(Exception $e)
{
	echo "erreur : " . $e->getMessage();
}
<?php

require_once "app/Autoloader.php";
Autoloader::register();

require('controller/controllerFront.php');

try
{
	
	if (isset($_GET['action'])) {
	    if ($_GET['action'] == 'listPosts') 
	    {
	        listPosts();
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
	    	adminDeconnect();
	    }

	    elseif (isset($_POST)) 
	    {
	    	if (isset($_POST["admin"]))
	        {
	        	$admin = $_POST["admin"];

	        	if (!empty($admin["pseudo"]) && !empty($admin["password"]))
	        	{
	        		adminConnectAccueil($admin["pseudo"], $admin["password"]);
	        	}
	        	else
	        	{
	        		throw new Exception("Mauvais login ou mot de passe");
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
	    listPosts();
	}
}

catch(Exception $e)
{
	echo "erreur : " . $e->getMessage();
}
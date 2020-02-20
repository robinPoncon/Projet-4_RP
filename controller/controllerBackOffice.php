<?php

use \RobinP\model\PostManager;
use \RobinP\model\UserManager;
use \RobinP\classes\User;
use \RobinP\controller\ControllerPost;

function addUser($pseudo, $password, $email)
{
    $userManager = new UserManager();

    $newUser = new User(["pseudo" => $pseudo, "password" => $password, "email" => $email]);

    $userManager->addUser($newUser);
}

function UserConnectAccueil($pseudo, $password)
{
    $userManager = new UserManager();
    
    $user = $userManager->getUser();

    $isPasswordCorrect = password_verify($password, $user->getPassword());

    //var_dump($admin);

    if ($isPasswordCorrect && $pseudo === $user->getPseudo())
    {

        $_SESSION['pseudo'] = $user->getPseudo();
        $_SESSION["header"] = "template-page-back.php";
        $listPosts = new ControllerPost();
		$listPosts->listPosts();

    }

    else
    {
        throw new Exception("Mauvais login ou mot de passe", 1);
        
    }
}

function espaceCompte()
{
    require "view/page/monCompte.php";
}

function userDeconnect()
{
	
    $_SESSION = array();
    session_destroy();
    $_SESSION["header"] = "template-page-front.php";
    $listPosts = new ControllerPost();
	$listPosts->listPosts();
}

function changePassword($actualPassword, $newPassword, $verifNewPassword)
{
    $userManager = new UserManager();

    $user = $userManager->getUser();

    $newMDPUser = new User(["pseudo" => $user->getPseudo(), "password" => password_hash($newPassword, PASSWORD_DEFAULT), "email" => $user->getEmail()]);

    $isPasswordCorrect = password_verify($actualPassword, $user->getPassword());

    if ($isPasswordCorrect && $newPassword === $verifNewPassword)
    {
        $userManager->updateInfoUser($newMDPUser);

        listPosts();
    }
    else
    {
        throw new Exception("Erreur ! Vérifier les mots de passe saisis");
    }
}

function changePseudo($actualPseudo, $newPseudo, $verifNewPseudo)
{
    $userManager = new UserManager();

    $user = $userManager->getUser();

    $newPseudoUser = new User(["pseudo" => $newPseudo, "password" => $user->getPassword(), "email" => $user->getEmail()]);

    if ($user->getPseudo() === $actualPseudo && $newPseudo === $verifNewPseudo)
    {
        $userManager->updateInfoUser($newPseudoUser);

        listPosts();
    }
    else
    {
        throw new Exception("Erreur ! Vérifier les mots de passe saisis");
    }
}

function changeEmail($actualEmail, $newEmail, $verifNewEmail)
{
    $userManager = new UserManager();

    $user = $userManager->getUser();

    $newEmailUser = new User(["pseudo" => $user->getPseudo(), "password" => $user->getPassword(), "email" => $newEmail]);

    if ($user->getEmail() === $actualEmail && $newEmail === $verifNewEmail && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $newEmail))
    {
        $userManager->updateInfoUser($newEmailUser);

        listPosts();
    }
    else
    {
        throw new Exception("Erreur ! Vérifier les emails saisis");
    }
}
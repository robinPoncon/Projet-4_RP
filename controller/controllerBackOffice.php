<?php

use \RobinP\model\PostManager;
use \RobinP\model\AdminManager;
use \RobinP\classes\Admin;

function addAdmin($pseudo, $password, $email)
{
    $adminManager = new AdminManager();

    $newAdmin = new Admin(["pseudo" => $pseudo, "password" => $password, "email" => $email]);

    $adminManager->addAdmin($newAdmin);
}

function test()
{
	require "view/backend/ListPostsAdmin.php";
}

function adminConnectAccueil($pseudo, $password)
{
    $adminManager = new AdminManager();
    
    $admin = $adminManager->getAdmin();

    $isPasswordCorrect = password_verify($password, $admin->getPassword());

    //var_dump($admin);

    if ($isPasswordCorrect && $pseudo === $admin->getPseudo())
    {
        session_start();
        $_SESSION['pseudo'] = $admin->getPseudo();

        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require "view/backend/ListPostsAdmin.php"; 
    }

    else
    {
        throw new Exception("Mauvais login ou mot de passe", 1);
        
    }
}

function espaceCompte()
{
    require "view/backend/monCompte.php";
}

function adminDeconnect()
{
    session_start();
    $_SESSION = array();
    session_destroy();

    listPosts();
}

function changePassword($actualPassword, $newPassword, $verifNewPassword)
{
    $adminManager = new AdminManager();

    $admin = $adminManager->getAdmin();

    $newMDPAdmin = new Admin(["pseudo" => $admin->getPseudo(), "password" => password_hash($newPassword, PASSWORD_DEFAULT), "email" => $admin->getEmail()]);

    $isPasswordCorrect = password_verify($actualPassword, $admin->getPassword());

    if ($isPasswordCorrect && $newPassword === $verifNewPassword)
    {
        $adminManager->updateMDPAdmin($newMDPAdmin);

        listPosts();
    }
    else
    {
        throw new Exception("Erreur ! Vérifier les mots de passe saisis");
    }
}

function changePseudo($actualPseudo, $newPseudo, $verifNewPseudo)
{
    $adminManager = new AdminManager();

    $admin = $adminManager->getAdmin();

    $newPseudoAdmin = new Admin(["pseudo" => $newPseudo, "password" => $admin->getPassword(), "email" => $admin->getEmail()]);

    if ($admin->getPseudo() === $actualPseudo && $newPseudo === $verifNewPseudo)
    {
        $adminManager->updateMDPAdmin($newPseudoAdmin);

        listPosts();
    }
    else
    {
        throw new Exception("Erreur ! Vérifier les mots de passe saisis");
    }
}
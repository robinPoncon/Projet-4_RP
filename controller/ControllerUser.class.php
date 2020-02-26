<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\model\UserManager;
use \RobinP\classes\User;
use \RobinP\controller\ControllerPost;

class ControllerUser
{
    private $userManager;
    private $newUser;
    private $user;
    private $isPasswordCorrect;
    private $newMDPUser;
    private $newPseudoUser;
    private $newEmailUser;

    public function addUser($pseudo, $password, $email)
    {
        $this->userManager = new UserManager();

        $this->newUser = new User(["pseudo" => $pseudo, "password" => $password, "email" => $email]);

        $this->userManager->addUser($this->newUser);
    }

    public function userConnectAccueil($pseudo, $password)
    {
        $this->userManager = new UserManager();
        
        $this->user = $this->userManager->getUser();

        $this->isPasswordCorrect = password_verify($password, $this->user->getPassword());

        if ($this->isPasswordCorrect && $pseudo === $this->user->getPseudo())
        {
            $_SESSION['pseudo'] = $this->user->getPseudo();
            $_SESSION["id"] = $this->user->getId();
            $_SESSION["header"] = "template-page-back.php";
            $listPosts = new ControllerPost();
            $listPosts->listPosts();
        }

        else
        {
            require "view/page/messageErreur.php";
            throw new \Exception("Mauvais login ou mot de passe"); 

        }
    }

    public function espaceCompte()
    {
        require "view/page/monCompte.php";
    }

    public function userDeconnect()
    {
        $_SESSION = array();
        session_destroy();
        $_SESSION["header"] = "template-page-front.php";
        $listPosts = new ControllerPost();
        $listPosts->listPosts();
    }

    public function changePseudo($actualPseudo, $newPseudo, $verifNewPseudo)
    {
        $this->userManager = new UserManager();

        $this->user = $this->userManager->getUser();

        $this->pseudoUser = new User(["id" => $_SESSION["id"], "pseudo" => $newPseudo, "password" => $this->user->getPassword(), "email" => $this->user->getEmail()]);

        if ($this->user->getPseudo() === $actualPseudo && $newPseudo === $verifNewPseudo)
        {
            $this->userManager->updateInfoUser($this->pseudoUser);

            $_SESSION["pseudo"] = $this->pseudoUser->getPseudo();
            $listPosts = new ControllerPost();
            $listPosts->listPosts();
        }
        else
        {
            throw new Exception("Erreur ! Vérifier les pseudos de passe saisis");
        }
    }

    public function changePassword($actualPassword, $newPassword, $verifNewPassword)
    {
        $this->userManager = new UserManager();

        $this->user = $this->userManager->getUser();

        $this->newMDPUser = new User(["pseudo" => $this->user->getPseudo(), "password" => password_hash($newPassword, PASSWORD_DEFAULT), "email" => $this->user->getEmail()]);

        $this->isPasswordCorrect = password_verify($actualPassword, $this->user->getPassword());

        if ($this->isPasswordCorrect && $newPassword === $verifNewPassword)
        {
            $this->userManager->updateInfoUser($this->newMDPUser);

            $listPosts = new ControllerPost();
            $listPosts->listPosts();
        }
        else
        {
            throw new Exception("Erreur ! Vérifier les mots de passe saisis");
        }
    }

    public function changeEmail($actualEmail, $newEmail, $verifNewEmail)
    {
        $this->userManager = new UserManager();

        $this->user = $this->userManager->getUser();

        $this->newEmailUser = new User(["pseudo" => $this->user->getPseudo(), "password" => $this->user->getPassword(), "email" => $newEmail]);

        if ($this->user->getEmail() === $actualEmail && $newEmail === $verifNewEmail && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $newEmail))
        {
            $this->userManager->updateInfoUser($this->newEmailUser);

            $listPosts = new ControllerPost();
            $listPosts->listPosts();
        }
        else
        {
            throw new Exception("Erreur ! Vérifier les emails saisis");
        }
    }
}

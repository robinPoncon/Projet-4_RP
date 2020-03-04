<?php

namespace RobinP\controller;

use \RobinP\model\PostManager;
use \RobinP\classes\Post;
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
    private $pageError = "view/page/messageErreur.php";
    private $listPosts;

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->user = $this->userManager->getUser();
        $this->listPosts = new ControllerPost();
    }

    public function addUser($pseudo, $password, $email)
    {
        $this->newUser = new User(["pseudo" => $pseudo, "password" => $password, "email" => $email]);

        $this->userManager->addUser($this->newUser);
    }

    public function userConnectAccueil($pseudo, $password)
    {
        $this->isPasswordCorrect = password_verify($password, $this->user->getPassword());

        if ($this->isPasswordCorrect && $pseudo === $this->user->getPseudo())
        {
            $_SESSION['pseudo'] = $this->user->getPseudo();
            $_SESSION["id"] = $this->user->getId();
            $_SESSION["header"] = "template-page-back.php";
            $_SESSION["updateButton"] = '<a class="updateButton" href="index.php?action=updatePost" id="updatePost<?php echo $post->getId()?>"> Modifier </a>';
            $this->listPosts->listPosts();
        }

        else
        {
            throw new \Exception("Login ou mot de passe incorrect, veuillez réessayer");
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
        session_start();
        $_SESSION["header"] = "template-page-front.php";
        $_SESSION["updateButton"] = "";
        header("Location: index.php?action=listPosts");
    }

        

    public function changePseudo($actualPseudo, $newPseudo, $verifNewPseudo)
    {
        $this->pseudoUser = new User(["id" => $_SESSION["id"], "pseudo" => $newPseudo, "password" => $this->user->getPassword(), "email" => $this->user->getEmail()]);

        if ($this->user->getPseudo() === $actualPseudo && $newPseudo === $verifNewPseudo)
        {
            $this->userManager->updateInfoUser($this->pseudoUser);

            $_SESSION["pseudo"] = $this->pseudoUser->getPseudo();
            $this->listPosts->listPosts();
        }
        else
        {
            throw new \Exception("Vérifier les pseudos saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>");
        }
    }

    public function changePassword($actualPassword, $newPassword, $verifNewPassword)
    {
        $this->newMDPUser = new User(["pseudo" => $this->user->getPseudo(), "password" => password_hash($newPassword, PASSWORD_DEFAULT), "email" => $this->user->getEmail()]);

        $this->isPasswordCorrect = password_verify($actualPassword, $this->user->getPassword());

        if ($this->isPasswordCorrect && $newPassword === $verifNewPassword)
        {
            $this->userManager->updateInfoUser($this->newMDPUser);

            $this->listPosts->listPosts();
        }
        else
        {
            throw new \Exception("Vérifier les mots de passe saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>");
        }
    }

    public function changeEmail($actualEmail, $newEmail, $verifNewEmail)
    {
        $this->newEmailUser = new User(["pseudo" => $this->user->getPseudo(), "password" => $this->user->getPassword(), "email" => $newEmail]);

        if ($this->user->getEmail() === $actualEmail && $newEmail === $verifNewEmail && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $newEmail))
        {
            $this->userManager->updateInfoUser($this->newEmailUser);

            $this->listPosts->listPosts();
        }
        else
        {
            throw new \Exception("Vérifier les emails saisis ! " . " Retour à l'espace perso -> " . "<a href='index.php?action=Compte'>Mon compte</a>");
        }
    }
}
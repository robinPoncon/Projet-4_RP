<?php

namespace RobinP\controller;

use \RobinP\model\CommentManager;
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
    private $commentSignaler;

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

    public function userConnectAccueil($pseudo, $password, $connect)
    {
        $this->isPasswordCorrect = password_verify($password, $this->user->getPassword());

        if ($this->isPasswordCorrect && strcmp($pseudo, $this->user->getPseudo()) == 0)
        {
            if ($connect == "true")
            {
                setcookie('cookie[pseudo]', $this->user->getPseudo(), time() + 365*24*3600, "/", null, false, true);
                setcookie('cookie[password]', $this->user->getPassword(), time() + 365*24*3600, "/", null, false, true);
            }
            
            $_SESSION['pseudo'] = $this->user->getPseudo();
            $_SESSION["id"] = $this->user->getId();
            $_SESSION["header"] = "template-page-back.php";

            header("Location: index.php?action=listPosts");

        }

        else
        {
            $_SESSION["url"] = "listPosts";
            throw new \Exception("Login ou mot de passe incorrect, veuillez réessayer");
        }
    }

    public function userConnectAuto($pseudo, $password)
    {
        $this->isPasswordCorrect = strcmp($password, $this->user->getPassword());

        if ($this->isPasswordCorrect == 0 && strcmp($pseudo, $this->user->getPseudo()) == 0)
        {
            $_SESSION['pseudo'] = $this->user->getPseudo();
            $_SESSION["id"] = $this->user->getId();
            $_SESSION["header"] = "template-page-back.php";

            header("Location: index.php?action=listPosts");
        }
    }

    public function espaceCompte()
    {
        $this->commentManager = new CommentManager();
        $this->comments = $this->commentManager->getCommentSignaler();

        require "view/page/monCompte.php";
    }

    public function userDeconnect()
    {
        $_SESSION = array();
        session_destroy();

        setcookie('cookie[pseudo]', "", time() - 3600, "/");
        setcookie('cookie[password]', "", time() - 3600, "/");

        session_start();
        $_SESSION["header"] = "template-page-front.php";
        header("Location: index.php?action=listPosts");
    }

        

    public function changePseudo($actualPseudo, $newPseudo, $verifNewPseudo)
    {
        $this->pseudoUser = new User(["id" => $_SESSION["id"], "pseudo" => $newPseudo, "password" => $this->user->getPassword(), "email" => $this->user->getEmail()]);

        if ($this->user->getPseudo() === $actualPseudo && $newPseudo === $verifNewPseudo)
        {
            $this->userManager->updateInfoUser($this->pseudoUser);

            $_SESSION["pseudo"] = $this->pseudoUser->getPseudo();
            setcookie('cookie[pseudo]', $this->pseudoUser->getPseudo(), time() + 365*24*3600, "/", null, false, true);

            $msg_confirmation = "Le pseudo a bien été modifié !";
            $url = "Compte";
            require "view/page/messageConfirmation.php";
        }

        else
        {
            $_SESSION["url"] = "Compte";
            throw new \Exception("Vérifier les pseudos saisis !");
        }
    }

    public function changePassword($actualPassword, $newPassword, $verifNewPassword)
    {
        $this->newMDPUser = new User(["id" => $_SESSION["id"], "pseudo" => $this->user->getPseudo(), "password" => password_hash($newPassword, PASSWORD_DEFAULT), "email" => $this->user->getEmail()]);

        $this->isPasswordCorrect = password_verify($actualPassword, $this->user->getPassword());

        if ($this->isPasswordCorrect && $newPassword === $verifNewPassword)
        {
            $this->userManager->updateInfoUser($this->newMDPUser);

            setcookie('cookie[password]', $this->newMDPUser->getPassword(), time() + 365*24*3600, "/", null, false, true);

            $msg_confirmation = "Le mot de passe a bien été modifié !";
            $url = "Compte";
            require "view/page/messageConfirmation.php";
        }

        else
        {
            $_SESSION["url"] = "Compte";
            throw new \Exception("Vérifier les mots de passe saisis !");
        }
    }

    public function changeEmail($actualEmail, $newEmail, $verifNewEmail)
    {
        $this->newEmailUser = new User(["pseudo" => $this->user->getPseudo(), "password" => $this->user->getPassword(), "email" => $newEmail]);

        if ($this->user->getEmail() === $actualEmail && $newEmail === $verifNewEmail && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $newEmail))
        {
            $this->userManager->updateInfoUser($this->newEmailUser);

            $msg_confirmation = "L'email a bien été modifié !";
            $url = "Compte";
            require "view/page/messageConfirmation.php";
        }

        else
        {
            $_SESSION["url"] = "Compte";
            throw new \Exception("Vérifier les emails saisis !");
        }
    }
}

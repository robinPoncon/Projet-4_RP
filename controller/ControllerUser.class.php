<?php

namespace RobinP\controller;

use \RobinP\model\CommentManager;
use \RobinP\model\UserManager;
use \RobinP\classes\User;
use \RobinP\controller\ControllerPost;

/**
* La classe ControllerUser fait appel aux classes manager, afin d'afficher, ajouter, modifier des utilisateurs. Afficher l'espace compte.
  Ainsi que gérer la connexion et la déconnexion de la partie back-end du site.
* @Author Robin Ponçon
*/

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

    /**
    * Permet de créer automatiquement des nouveaux objets UserManager, CommentManager, ainsi que de faire appel à la méthode getUser à chaque appel de la classe
    * @param STRING $pseudo : pseudo venant d'une variable SESSION
    */

    public function __construct($pseudo)
    {
        $this->userManager = new UserManager();
        $this->user = $this->userManager->getUser($pseudo);
        $this->listPosts = new ControllerPost();
    }

    /**
    * Permet d'ajouter un utilisateur en faisant appel à l'userManager en récupérant son pseudo, son mot de passe, et son email.
    * @param STRING $pseudo : pseudo venant d'une variable POST
    * @param STRING $password : mot de passe venant d'une variable POST
    * @param STRING $email : email venant d'une variable POST
    */

    public function addUser($pseudo, $password, $email)
    {
        $this->newUser = new User(["pseudo" => $pseudo, "password" => $password, "email" => $email]);

        $this->userManager->addUser($this->newUser);
    }

    /**
    * Permet de connecter un utilisateur à la partie back-end du site ainsi que de créer des cookies 
    * @param STRING $pseudo : pseudo venant d'une variable POST
    * @param STRING $password : mot de passe venant d'une variable POST
    * @param STRING $connect : email venant d'une variable POST
    */

    public function userConnectAccueil($pseudo, $password, $connect)
    {
        $this->isPasswordCorrect = password_verify($password, $this->user->getPassword());

        if ($this->isPasswordCorrect && strcmp($pseudo, $this->user->getPseudo()) == 0)
        {
            if ($connect == "true")
            {
                setcookie('cookie[pseudo]', $this->user->getPseudo(), time() + 365*24*3600, "/", null, false, true);
                setcookie('cookie[password]', $password, time() + 365*24*3600, "/", null, false, true);
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

    /**
    * Permet de faire appel à la page monCompte qui affiche les paramètres du compte utilisateur 
      (modif pseuod, mdp, email, commentaires signalés, création article, etc)
    */

    public function espaceCompte()
    {
        $this->commentManager = new CommentManager();
        $this->comments = $this->commentManager->getCommentSignaler();

        require "view/page/monCompte.php";
    }

    /**
    * Permet de déconnecter un utilisateur et de supprimer ses cookies 
    */

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

    /**
    * Permet de modifier le pseudo de l'utilisateur en faisant appel à l'UserManager en récupérant le pseudo actuel,
    * le nouveau pseudo, et la confirmation du nouveau pseudo
    * @param STRING $actualPseudo : pseudo actuel venant d'une variable POST
    * @param STRING $newPseudo : nouveau pseudo venant d'une variable POST
    * @param STRING $verifNewPseudo : vérification nouveau pseudo venant d'une variable POST
    */

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

    /**
    * Permet de modifier le mot de passe de l'utilisateur en faisant appel à l'UserManager en récupérant le mot de passe actuel,
    * le nouveau mot de passe, et la confirmation du nouveau mot de passe
    * @param STRING $actualPassword : mot de passe actuel venant d'une variable POST
    * @param STRING $newPassword : nouveau mot de passe venant d'une variable POST
    * @param STRING $verifNewPassword : vérification nouveau mot de passe venant d'une variable POST
    */

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

    /**
    * Permet de modifier l'email de l'utilisateur en faisant appel à l'UserManager en récupérant l'email actuel,
    * le nouvel email, et la confirmation du nouvel email
    * @param STRING $actualEmail : email actuel venant d'une variable POST
    * @param STRING $newEmail : nouvel email venant d'une variable POST
    * @param STRING $verifNewEmail : vérification nouvel email venant d'une variable POST
    */

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

<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Comment;
use \PDO;

/**
* La classe CommentManager fait appel à la BDD pour permettre de récupérer, ajouter, modifier et supprimer les données des commentaires.
* @Author Robin Ponçon
*/

class CommentManager extends Manager
{
    /**
    * Permet de récupérer l'ensemble des commentaires de la BDD correspondant à l'id de l'article et avec le status = 1 (approuvé)
    * @return ARRAY d'object $comments : Retourne un tableau d'objets de l'ensemble des commentaires (avec le status = 1) 
              où chaque commentaire est une classe objet Comment
    */

    public function getComments($postId)
    {
        $comments = [];

        $req = $this->db->prepare("SELECT id, post_id, author, comment, comment_date FROM comments 
                                   WHERE post_id = :post_id AND status = 1 ORDER BY comment_date DESC");
        $req->bindValue(":post_id", $postId, PDO::PARAM_INT);
        $req->execute();

        while ($data = $req->fetch()) 
        {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    /**
    * Permet de récupérer les commentaires signalés.
    * @return ARRAY d'object $comments : Retourne un tableau d'objets de l'ensemble des commentaires (avec le status = 0) 
              où chaque commentaire est une classe objet Comment
    */

    public function getCommentSignaler()
    {
        $comments = [];

        $req = $this->db->prepare("SELECT id, post_id, author, comment, comment_date FROM comments WHERE status = :status ORDER BY id DESC");
        $req->bindValue(":status", 0, PDO::PARAM_INT);
        $req->execute();

        while ($data = $req->fetch()) 
        {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    /**
    * Permet d'ajouter un nouveau commentaire dans la BDD.
    * @param OBJECT ARRAY $comment : nouvel objet de la classe Comment avec un tableau de données 
    */

    public function addComment(Comment $comment)
    {
 
        $req = $this->db->prepare("INSERT INTO comments(post_id, author, comment, comment_date, status) 
                                   VALUES(:post_id, :author, :comment, NOW(), 1)");

        $req->bindValue(":post_id", $comment->getPostId(), PDO::PARAM_INT);
        $req->bindValue(":author", $comment->getAuthor(), PDO::PARAM_STR);
        $req->bindValue(":comment", $comment->getComment(), PDO::PARAM_STR);

        $req->execute();
        
    }

    /**
    * Permet de modifier un commentaire de la BDD en spécifiant son id
    * @param OBJECT ARRAY $comment : nouvel objet de la classe Comment avec un tableau de données qui écraseront les données de la BDD.
    */

    public function updateComment(Comment $comment)
    {   
        $req = $this->db->prepare("UPDATE comments SET status = :status WHERE id = :id");

        $req->bindValue(":status", $comment->getStatus(), PDO::PARAM_INT);
        $req->bindValue(":id", $comment->getId(), PDO::PARAM_INT);

        $req->execute();
    }

    /**
    * Permet de supprimer un commentaire de la BDD en spécifiant son id
    * @param INT $id : id du commentaire à supprimer
    */

    public function deleteComment($id)
    {
        $this->db->exec("DELETE FROM comments WHERE id = " . $id);
    }

    /**
    * Permet de supprimer les commentaires de la BDD liés à un article en spécifiant l'id de l'article
    * @param INT $post_id : id de l'article correspondant aux commentaires à supprimer.
    */

    public function deleteCommentPost($post_id)
    {
        $this->db->exec("DELETE FROM comments WHERE post_id = " . $post_id);
    }
}
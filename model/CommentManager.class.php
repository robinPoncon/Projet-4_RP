<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Comment;
use \PDO;

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $comments = [];

        $req = $this->db->prepare("SELECT id, post_id, author, comment, comment_date FROM comments WHERE post_id = :post_id ORDER BY comment_date DESC");
        $req->bindValue(":post_id", $postId, PDO::PARAM_INT);
        $req->execute();

        while ($data = $req->fetch()) 
        {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function addComment(Comment $comment)
    {
 
        $req = $this->db->prepare("INSERT INTO comments(post_id, author, comment, comment_date) VALUES(:post_id, :author, :comment, NOW())");

        $req->bindValue(":post_id", $comment->getPostId(), PDO::PARAM_INT);
        $req->bindValue(":author", $comment->getAuthor(), PDO::PARAM_STR);
        $req->bindValue(":comment", $comment->getComment(), PDO::PARAM_STR);

        return $req->execute();
        
    }

    public function updateComment(Comment $comment)
    {   
        $req = $this->db->prepare("UPDATE comments SET comment = :comment WHERE id = :id");

        $req->bindValue(":comment", $comment->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":id", $comment->getId(), PDO::PARAM_INT);

        $req->execute();
    }

    public function deleteComment(Comment $comment)
    {
        $this->db->exec("DELETE FROM comments WHERE id = " . $comment->getId());
    }
}
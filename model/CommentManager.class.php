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

    public function getComment($id)
    {
        $req = $this->db->prepare("SELECT id, author, comment, comment_date FROM comments WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();

        return new Comment($data);
    }

    public function addComment(Comment $comment)
    {
 
        $req = $this->db->prepare("INSERT INTO comments(post_id, author, comment, comment_date, status) VALUES(:post_id, :author, :comment, NOW(), 1)");

        $req->bindValue(":post_id", $comment->getPostId(), PDO::PARAM_INT);
        $req->bindValue(":author", $comment->getAuthor(), PDO::PARAM_STR);
        $req->bindValue(":comment", $comment->getComment(), PDO::PARAM_STR);

        return $req->execute();
        
    }

    public function updateComment(Comment $comment)
    {   
        $req = $this->db->prepare("UPDATE comments SET status = :status WHERE id = :id");

        $req->bindValue(":status", $comment->getStatus(), PDO::PARAM_STR);
        $req->bindValue(":id", $comment->getId(), PDO::PARAM_INT);

        $req->execute();
    }

    public function deleteComment($id)
    {
        $this->db->exec("DELETE FROM comments WHERE id = " . $id);
    }

    public function deleteCommentPost($post_id)
    {
        $this->db->exec("DELETE FROM comments WHERE post_id = " . $post_id);
    }
}
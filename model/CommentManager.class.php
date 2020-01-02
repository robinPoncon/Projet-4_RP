<?php

namespace RobinP\model;

use \RobinP\model\Manager;
use \RobinP\classes\Comment;

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $comments = [];

        $req = $this->db->prepare("SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS comment_date FROM comments WHERE post_id = :post_id ORDER BY comment_date DESC");
        $req->bindValue(":post_id", $postId);
        $req->execute();

        while ($data = $req->fetch()) 
        {
            $comments[] = new Comment($data);
        }
        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $comments = $this->db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function updateComment($comment, $id)
    {
        $comments = $this->db->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        $updateComment = $comments->execute(array($comment, $id));

        return $updateComment;
    } 
}
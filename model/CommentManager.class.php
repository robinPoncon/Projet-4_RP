<?php

namespace RobinP\model;

use \RobinP\model\Manager;

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $comments = $this->db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

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
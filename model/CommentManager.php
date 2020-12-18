<?php

namespace TP_Blog_avec_commentaires\Model; // La classe sera dans ce namespace

require_once("model/Manager.php");

// class pour y regrouper toutes nos fonctions qui concernent les commentaires
class CommentManager extends Manager
{
    // fonction pour récupérer les commentaires associés à un ID de post
    public function getComments($postId)
    {
        // Connexion à la base de données rappelle de la fonction
        $db = $this->dbConnect();

        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    // Function pour ajouter des commentaires en base de données
    public function postComment($postId, $author, $comment)
    {
        // Connexion à la base de données rappelle de la fonction
        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    // Fonction pour récupérer les commentaires associés à un ID de commentaire
    public function getComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $req->execute(array($id));
        $comment = $req->fetch();
  
        return $comment;
    }

    // Function pour modifier des commentaires déjà existants sur base de données
    public function updateComment($id, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET comment = ?, comment_date = NOW() WHERE id = ?');
        $newComment = $req->execute(array($comment, $id));
  
        return $newComment;
    }
}
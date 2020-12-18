<?php

namespace TP_Blog_avec_commentaires\Model; // La classe sera dans ce namespace

require_once("model/Manager.php");

// class pour y regrouper toutes nos fonctions qui concernent les posts
class PostManager extends Manager
{
    
    // fonction pour récupérer tous posts de la base de donnée et on affiche les ( derniers billets)
    public function getPosts()
    {
        // Connexion à la base de données rappelle de la fonction
        $db = $this->dbConnect();
    
        // On récupère les 5 derniers billets de la base de donnée 
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
    
    
        return $req;
    }
    
    // fonction pour récupérer un post précis en fonction de son ID
    public function getPost($postId)
    {
        // Connexion à la base de données rappelle de la fonction
        $db = $this->dbConnect();
    
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
    
        return $post;
    }
}
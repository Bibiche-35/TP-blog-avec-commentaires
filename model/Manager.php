<?php

namespace TP_Blog_avec_commentaires\Model;

class Manager 
{
    // Nouvelle fonction qui nous permet d'éviter de répéter du code
    // connexion à la base de données avec les blocs try/catch
    protected function dbConnect()
    {
            $db = new \PDO('mysql:host=localhost;dbname=tp_blog;charset=utf8', 'root', '');
            return $db;
    }
}
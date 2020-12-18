<!-- Ceci est le controleur : on y regroupe nos fonctions -->

<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new \TP_Blog_avec_commentaires\model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \TP_Blog_avec_commentaires\model\PostManager();
    $commentManager = new \TP_Blog_avec_commentaires\model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

// Ce contrôleur récupère lui aussi les informations dont on a besoin (id du billet, auteur, commentaire) et les transmet au modèle :

function addComment($postId, $author, $comment)
{
    $commentManager = new \TP_Blog_avec_commentaires\model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

// Ce contrôleur récupère lui aussi les informations dont on a besoin (id du billet, auteur, commentaire) et les transmet au modèle :
function viewComment()
{
    $commentManager = new \TP_Blog_avec_commentaires\model\CommentManager();
    $comment = $commentManager->getComment($_GET['id']);
  
    require('view/frontend/editView.php');
}
  
  
function editComment($id, $comment)
{
    $commentManager = new \TP_Blog_avec_commentaires\model\CommentManager();
  
    $newComment = $commentManager->updateComment($id, $comment);
  
    if ($newComment === false) {
  
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        echo 'commentaire : ' . $_POST['comment'];
        header('Location: index.php?action=viewComment&id=' . $id);
    }
}
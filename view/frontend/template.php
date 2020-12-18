<!-- On va créer un template (aussi appelé gabarit) de page. -->
<!-- On va y retrouver toute la structure de la page, avec des "trous" à remplir. -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/CSS/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <?= $content ?>
    </body>
</html>
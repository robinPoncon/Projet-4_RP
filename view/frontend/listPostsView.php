<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<header>
    <h1>Jean Forteroche</h1>

    <form action="index.php?action=admin" method="post">
        <div>
            <label for="user"> Utilisateur </label>
            <input type="text" id="user" name="user">
        </div>
        <div>
            <label for="password"> Mot de passe </label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Connexion">
        </div>
    </form>
</header>

<h2>Billet simple pour l'Alaska</h1>
<img id="img-alaska" src="view/img/alaska.jpg">



<?php
//var_dump($posts);
foreach ($posts as $post) 
{
    
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post->getTitle()) ?>
            <em>le <?= $post->getCreationDate() ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($post->getContent())) ?>
            <br />
            <em><a href="index.php?action=post&amp;id= <?= $post->getId() ?>">Commentaires</a></em>
        </p>
    </div>
<?php
}

//$posts->closeCursor();

?>
<?php $content = ob_get_clean(); ?>

<?php require('template-page.php'); ?>
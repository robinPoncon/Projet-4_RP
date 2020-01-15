<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Billet simple pour l'Alaska</h1>
<img id="img-alaska" src="view/img/alaska.jpg">
<p>Derniers billets du blog :</p>


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
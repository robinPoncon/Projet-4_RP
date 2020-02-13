<?php $title = htmlspecialchars($post->getTitle());

    ob_start(); 
?>

	<header class="d-flex justify-content-between">
    <a href="index.php?action=admin" class="text-decoration-none"><h1>Billet simple pour l'Alaska</h1></a>

    <form action="index.php?action=admin" method="post" class="d-flex align-items-center">
        <div>
            <input class="connect" type="text" id="user" name="admin[pseudo]" placeholder=" Utilisateur">
        </div>
        <div>
            <input class="connect" type="password" name="admin[password]" placeholder=" Mot de passe">
        </div>
        <div>
            <input id="connexion" class="connect" type="submit" value="Connexion">
        </div>
    </form>
</header>

	<div class="news">
		
		<h3>
			<?= htmlspecialchars($post->getTitle()); ?>
			<em>le <?= $post->getCreationDAte() ?></em>
        </h3>
            
        <p class="content">
            <?= nl2br(htmlspecialchars($post->getContent())) ?>
        </p>

    </div>

    <div id="ajouterComment">
        
        <h4>Ajouter un commentaire</h4>

        <form action="index.php?action=addComment" method="post">
            <input type="hidden" name="addComment[id]" value="<?= $post->getId(); ?>">
            <div class="form-group">
                <input class="form-control" type="text" id="author" name="addComment[author]" placeholder="Pseudo"/>
            </div>
            <div class="form-group">
                <textarea class="form-control" id="comment" name="addComment[comment]" placeholder="Votre commentaire"></textarea>
            </div>
            
            <button class="form-control" id="envoyer" type="submit">Envoyer</button> 
            
        </form>
    </div>

    <?php
        foreach ($comments as $comment)
    	{
    ?>  
        <div id="commentaire">
            <p id="titleComment"><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?> <a href="#"><button id="signaler"> Signaler </button></a> </p>
            <p id="contentComment"><?= nl2br(htmlspecialchars($comment->getComment())) ?> </p>
        </div>
    <?php
        }
    ?>

<?php $content = ob_get_clean(); ?>
<?php require "template-page.php" ?>
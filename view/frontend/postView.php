<?php $title = htmlspecialchars($post->getTitle()); ?>

<?php ob_start(); ?>

	<header class="d-flex justify-content-between">
    <h1>Jean Forteroche</h1>

    <form action="index.php?action=admin" method="post" class="d-flex align-items-center">
        <div>
            <input class="connect" type="text" id="user" name="user" placeholder=" Utilisateur">
        </div>
        <div>
            <input class="connect" type="password" name="password" placeholder=" Mot de passe">
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

    <a href="index.php?action=listPosts"> Retour à l'accueil</a>

    <h4>Ajouter un commentaire</h4>

    <form action="index.php?action=addComment" method="post">
        <input type="hidden" name="addComment[id]" value="<?= $post->getId(); ?>">
        <div class="form-group">
            <label for="author">Auteur</label><br/>
            <input class="form-control" type="text" id="author" name="addComment[author]"/>
        </div>
        <div class="form-group">
            <label for="comment">Commentaire</label><br/>
            <textarea class="form-control" id="comment" name="addComment[comment]"></textarea>
        </div>
        
        <button type="submit">Submit</button> 
    </form>

    <?php
        foreach ($comments as $comment)
    	{
    ?>  
        <div id="commentaire">
            <p id="titleComment"><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?></p>
            <p id="contentComment"><?= nl2br(htmlspecialchars($comment->getComment())) ?> </p>
        </div>
    <?php
        }
    ?>

<?php $content = ob_get_clean(); ?>
<?php require "template-page.php" ?>
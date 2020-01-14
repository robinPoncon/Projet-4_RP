<?php $title = htmlspecialchars($post->getTitle()); ?>

<?php ob_start(); ?>

	<h1>Mon super blog !</h1>
	<p><a href="index.php">Retour à la liste des billets</a></p>

	<div class="news">
		
		<h3>
			<?= htmlspecialchars($post->getTitle()); ?>
			<em>le <?= $post->getCreationDAte() ?></em>
        </h3>
            
        <p>
            <?= nl2br(htmlspecialchars($post->getContent())) ?>
        </p>

    </div>

    <h2>Commentaires</h2>

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
            <p><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?></p>
            <p><?= nl2br(htmlspecialchars($comment->getComment())) ?> </p>
    <?php
        }
    ?>

<?php $content = ob_get_clean(); ?>
<?php require "template-page.php" ?>
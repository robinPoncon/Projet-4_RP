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

    <form action="/Projet-4_RP/index.php?action=addComment" method="post">
        <input type="hidden" name="addComment[id]" value="<?= $post->getId(); ?>">
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="addComment[author]" />
            <label for="content">Commentaire</label><br />
            <textarea id="content" name="addComment[content]"></textarea>
        <?php 

        /*<div>
        </div>
        <div>
            
        </div>
        <div>
        </div> */ ?>
        <button type="submit" formmethod="post" formaction="/Projet-4_RP/index.php?action=addComment">Submit</button> 
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
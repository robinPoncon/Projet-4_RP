<?php $title = htmlspecialchars($this->post->getTitle());

    ob_start(); 
?>
    <div class="news">
		
		<h3>
			<?= htmlspecialchars($this->post->getTitle()); ?>
			<em>le <?= $this->post->getCreationDAte() ?></em>
        </h3>
            
        <p class="content">
            <?= nl2br(htmlspecialchars($this->post->getContent())) ?>
        </p>

    </div>

    <div id="ajouterComment">
        
        <h4>Ajouter un commentaire</h4>

        <form action="index.php?action=addComment" method="post">
            <input type="hidden" name="addComment[id]" value="<?= $this->post->getId(); ?>">
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
        foreach ($this->comments as $comment)
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
<?php require $_SESSION["header"]; ?>
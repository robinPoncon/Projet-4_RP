<?php $title = htmlspecialchars($this->post->getTitle());

    ob_start(); 
?>
    <div class="news">
		
		<h3>
			<?= htmlspecialchars($this->post->getTitle()); ?>
			<em>le <?= $this->post->getCreationDAte() ?></em>
        </h3>
            
        <p class="content">
            <?= nl2br(htmlspecialchars_decode($this->post->getContent())) ?>
        </p>

        <p id="authorView">
            <?= htmlspecialchars($this->post->getAuthor()) ?>    
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
            
            <button onclick="confirmationAddComment()" class="form-control" id="envoyer" type="submit">Envoyer</button> 
            
        </form>
    </div>

    <div>
        <p id="confirmationAddComment">Le commentaire a bien été ajouté !</p>
    </div>

    <?php
        foreach ($this->comments as $comment)
    	{
    ?>  
        <div class="commentaire">
            <p id="titleComment"><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?> 
            <a id="signaler" href="index.php?action=signaler&amp;id=<?= $comment->getId() ?>&amp;postId=<?= $this->post->getId()?>">Signaler</a> </p> 
            <p id="contentComment"><?= nl2br(htmlspecialchars($comment->getComment())) ?> </p>
        </div>
    <?php
        }
    ?>

<?php $content = ob_get_clean(); ?>
<?php require $_SESSION["header"]; ?>
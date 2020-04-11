<?php $title = htmlspecialchars($this->post->getTitle());

    ob_start(); 
?>
    <div class="news">

        <!-- On affiche l'article avec l'idée récupéré dans la variable GET -->
		
		<h3>
			<?= htmlspecialchars($this->post->getTitle()); ?>
			<em> - Le <?= $this->post->getCreationDate() ?></em>
        </h3>
            
        <div class="content">
            <?= nl2br(htmlspecialchars_decode($this->post->getContent())) ?>
        </div>

        <p class="authorView">
            <?= htmlspecialchars($this->post->getAuthor()) ?>    
        </p>

    </div>

    <!-- div formulaire servant à l'ajout de commentaire -->

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

    // Affichage de tous les commentaires liés à l'article et non signalés
    
        foreach ($this->comments as $comment)
    	{
    ?>  
        <div class="commentaire">
            <p class="titleComment"><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?> </p>
            <p class="contentComment"><?= nl2br(htmlspecialchars($comment->getComment())) ?> </p>
            <div class="divSignaler"> 
                <a class="signaler" href="index.php?action=signaler&amp;id=<?= $comment->getId() ?>&amp;postId=<?= $this->post->getId()?>">Signaler</a> 
            </div>
        </div>
    <?php
        }
    ?>

<?php $content = ob_get_clean(); ?>
<?php require $_SESSION["header"]; ?>
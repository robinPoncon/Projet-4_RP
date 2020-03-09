<?php
	
	$title = "Modifier Article";

	ob_start(); 

 ?>

<h4>article en cours</h4>
<div class="news">
		
	<h3>
		<?= htmlspecialchars($this->post->getTitle()); ?>
		<em>le <?= $this->post->getCreationDAte() ?></em>
    </h3>
            
    <p class="content">
        <?= nl2br(strip_tags($this->post->getContent())) ?>
    </p>

</div>

<h4>Modification de l'article</h4>
<div id="wesh">
	<form action="index.php?action=updatePost" method="post">
		<input type="hidden" name="updatePost[id]" value="<?= $this->post->getId(); ?>">
		<input type="text" name="updatePost[title]" value="<?= $this->post->getTitle(); ?>"> 
		<textarea name="updatePost[content]" id='mytextarea'> <?= $this->post->getContent()?> </textarea>
		<input type="submit" value="Envoyer"> 
	</form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require $_SESSION["header"]; ?>

<?php
	
	$title = "Modifier Article";

	ob_start(); 

 ?>

<h4 class="h4Update">Article en cours</h4>
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

<h4 class="h4Update">Modification de l'article</h4>
<div id="updateDiv">
	<form action="index.php?action=updatePost" method="post">
		<input type="hidden" name="updatePost[id]" value="<?= $this->post->getId(); ?>">
		<p class="d-flex">
			<label class="form-control" for="titleUpdate">Titre :</label>
			<input id="titleUpdate" class="form-control" type="text" name="updatePost[title]" value="<?= htmlspecialchars($this->post->getTitle()); ?>"> 
		</p>
		<p>
			<textarea class="form-control" name="updatePost[content]" id='mytextarea'> <?= $this->post->getContent() ?> </textarea>
		</p>
		<input id="validationUpdatePost" class="form-control" type="submit" value="Envoyer"> 
	</form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require $_SESSION["header"]; ?>

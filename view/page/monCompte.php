<?php $title = "Billet simple pour l'Alaska";

	ob_start(); 
?>

<div id="perso">

	<!-- Formulaire pour modifier son pseudo -->

	<div>
		<button id="modifPseudo">Modifier votre Pseudo</button> <br>

		<form action="index.php?action=changePseudo" method="post" id="changePseudo">
		
			<p>
				<input class="d-none" type="text" name="changePseudo[actuelPseudo]" placeholder="Pseudo actuel">
			</p>

			<p>
				<input class="d-none" type="text" name="changePseudo[newPseudo]" placeholder="Nouveau pseudo"> 
			</p>

			<p>
				<input class="d-none" type="text" name="changePseudo[verifNewPseudo]" placeholder="Valider le nouveau pseudo"> 
			</p>

			<p>
				<input id="buttonPseudo" class="d-none" type="submit" value="Envoyer">
			</p>

		</form>

	</div>

	<!-- Formulaire pour modifier son mot de passe -->

	<div>
		<button id="modifMDP">Modifier votre mot de passe</button> <br>

		<form action="index.php?action=changeMDP" method="post" id="changeMDP">
		
			<p>
				<input class="d-none" type="password" name="changeMDP[actuelMDP]" placeholder="Mot de passe actuel">
			</p>

			<p>
				<input class="d-none" type="password" name="changeMDP[newMDP]" placeholder="Nouveau mot de passe"> 
			</p>

			<p>
				<input class="d-none" type="password" name="changeMDP[verifNewMDP]" placeholder="Valider le nouveau mot de passe"> 
			</p>

			<p>
				<input id="buttonMDP" class="d-none" type="submit" value="Envoyer">
			</p>

		</form>

	</div>

	<!-- Formulaire pour modifier son email -->

	<div>
		<button id="modifEmail">Modifier votre Email</button> <br>

		<form action="index.php?action=changeEmail" method="post" id="changeEmail">
		
			<p>
				<input class="d-none" type="text" name="changeEmail[actuelEmail]" placeholder="Email actuel">
			</p>

			<p>
				<input class="d-none" type="text" name="changeEmail[newEmail]" placeholder="Nouveau email"> 
			</p>

			<p>
				<input class="d-none" type="text" name="changeEmail[verifNewEmail]" placeholder="Valider le nouvel email"> 
			</p>

			<p>
				<input id="buttonEmail" class="d-none" type="submit" value="Envoyer">
			</p>

		</form>

	</div>
	
</div>

<section>

	<h4 class="h4Update">Commentaire à modérer</h4>

	<?php

	// Affichage des commentaires signalés 

        foreach ($this->comments as $comment)
    	{
    ?>  
        <div class="commentaireSignaler">
            <p id="titleComment"><strong><?= htmlspecialchars($comment->getAuthor()) ?></strong> le <?= $comment->getCommentDate() ?> 
            <p id="contentComment"><?= nl2br(htmlspecialchars($comment->getComment())) ?> </p>
            <a id="approve" href="index.php?action=approve&amp;id=<?= $comment->getId() ?>"> Approuver</a>
            <button onclick="deleteComment(<?= $comment->getId()?>)" id="deleteComment">Supprimer</button>
        </div>

        <!-- Div de confirmation de la suppression des commentaires -->

        <div class="confirmComment" id="confirm<?= $comment->getId() ?>"> 
	        <p> Voulez-vous vraiment supprimer ce commentaire ? </p>
	        <a id="yesComment" href="index.php?action=deleteComment&amp;id=<?= $comment->getId() ?>"> Oui </a>
	        <button onclick="cancelComment(<?= $comment->getId() ?>)" id="noComment">Non</button>
    	</div>
    <?php
        }
    ?>
	
</section>

<!-- Formulaire d'ajout d'article -->

<div id="newPost">
	<h4>Ajouter un nouvel Article</h4>

	<form action="index.php?action=addPost" method="post">
		<p class="d-flex">
			<label id="labelTitleCrea" class="form-control" for="titleCrea">Titre :</label>
			<input id="titleCrea" class="form-control" type="text" name="addPost[title]" placeholder="Nom de l'article">
		</p>
		<p class="d-flex">
			<label id="labelAuthorCrea" class="form-control" for="authorCrea">Auteur : </label>
			<input id="authorCrea" class="form-control" type="text" name="addPost[author]" placeholder="Nom de l'auteur">
		</p>
		<p>
			<textarea class="form-control" id="mytextarea" type="text" name="addPost[content]" placeholder="Contenu de l'article"></textarea>
		</p>
		<p>
			<input id="validationCreationPost" class="form-control" type="submit" value="Envoyer">
		</p>
		
	</form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require $_SESSION["header"]; ?>
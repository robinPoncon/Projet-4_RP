<?php $title = "Billet simple pour l'Alaska";

	session_start();

	ob_start(); 
?>

<header class="d-flex justify-content-between">
    <a href="index.php?action=listPosts" class="text-decoration-none"><h1>Billet simple pour l'Alaska</h1></a>
    <div id="admin" class="d-flex align-items-center">
        <p>Bienvenue <?= ucfirst($_SESSION["pseudo"]) . " !" ?></p>
        <a href="index.php?action=Deconnexion"> Deconnexion </a>
    </div>
</header>

<div id="perso">

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
				<input class="d-none" type="submit" value="Envoyer">
			</p>

		</form>

	</div>

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
				<input class="d-none" type="submit" value="Envoyer">
			</p>

		</form>

	</div>

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
				<input class="d-none" type="text" name="changeEmail[verifNewEmail]" placeholder="Valider le nouveau email"> 
			</p>

			<p>
				<input class="d-none" type="submit" value="Envoyer">
			</p>

		</form>

	</div>

	<div>
		<textarea id="mytextarea"> Hello World ! </textarea>
	</div>
	
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="view/frontend/admin.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template-page.php'); ?>
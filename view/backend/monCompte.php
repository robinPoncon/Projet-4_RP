<?php $title = "Billet simple pour l'Alaska";

	session_start();

	ob_start(); 
?>

<header class="d-flex justify-content-between">
    <h1>Billet simple pour l'Alaska</h1>
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
				<input type="submit" value="Envoyer">
			</p>

		</form>

	</div>
	
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="view/frontend/admin.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template-page.php'); ?>
<?php $title = "Billet simple pour l'Alaska";

	ob_start(); 
?>

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
				<input id="buttonMDP" class="d-none" type="submit" value="Envoyer">
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
				<input id="buttonPseudo" class="d-none" type="submit" value="Envoyer">
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
				<input class="d-none" type="text" name="changeEmail[verifNewEmail]" placeholder="Valider le nouvel email"> 
			</p>

			<p>
				<input id="buttonEmail" class="d-none" type="submit" value="Envoyer">
			</p>

		</form>

	</div>
	
</div>

<?php $content = ob_get_clean(); ?>

<?php require $_SESSION["header"]; ?>
<?php $title = "Page d'erreur";
    ob_start(); 
?>
<div id="erreur">
	<p><?php echo $msg_error; 
		header("refresh:10;url=index.php?action=" . $_SESSION["url"]);
		?> 
	Vous allez être automatiquement redirigé vers la page précédente.
	</p>
	<p>
		Sinon, cliquer <a href="index.php?action=<?= $_SESSION['url'] ?>"> Ici </a>
	</p>
</div>
<?php $content = ob_get_clean(); ?>
<?php require $_SESSION["header"]; ?>
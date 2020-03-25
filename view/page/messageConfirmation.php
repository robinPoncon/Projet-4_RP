<?php $title = "Page de confirmation";
    ob_start(); 
?>
<div id="confirmation">
	<p>
		<?php 

		echo $msg_confirmation;

		header("refresh:5;url=index.php?action=" . $url);
	
	 	?>
	Vous allez être automatiquement redirigé vers la page précédente. 
	</p>
	<p>
		Sinon, cliquer <a href="index.php?action=<?= $url ?>"> Ici </a>
	</p>
</div>

<?php $content = ob_get_clean(); ?>
<?php require $_SESSION["header"]; ?>
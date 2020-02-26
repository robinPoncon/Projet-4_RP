<?php $title = "Page d'erreur";
    ob_start(); 
?>
<div id="erreur">
	<p><?php echo $msg_error; ?> </p>
</div>
<?php $content = ob_get_clean(); ?>
<?php require $_SESSION["header"]; ?>
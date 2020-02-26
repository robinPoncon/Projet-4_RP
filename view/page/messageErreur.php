<?php

    ob_start(); 
?>
<div id="erreur">
	<p> Veuillez réessayer </p>
</div>
<?php $content = ob_get_clean(); ?>
<?php require $_SESSION["header"]; ?>
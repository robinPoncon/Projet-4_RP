<?php
	
	$title = "Modifier Article";

	ob_start(); 

 ?>

 <div> 
 	<textarea id='mytextarea'> Hello World ! </textarea> 
 </div>

<?php $content = ob_get_clean(); ?>

<?php require $_SESSION["header"]; ?>

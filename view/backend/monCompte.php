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

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template-page.php'); ?>
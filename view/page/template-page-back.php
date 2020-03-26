<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="view/css/back.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
	<script src="https://cdn.tiny.cloud/1/sxq7wlppdsn7uq2723od67ynsomvawaa8ezwg78ylypihzoj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<meta name="viewport" content="width=device-width">
	
</head>
<body>
	<header class="d-flex justify-content-between">
	    <a href="index.php?action=listPosts" class="text-decoration-none"><h1>Billet simple pour l'Alaska</h1></a>
	    <div id="admin" class="d-flex align-items-center">
	        <p>Bienvenue <?= ucfirst($_SESSION["pseudo"]) . " !" ?></p>
	        <a href="index.php?action=Compte"> Mon compte </a>
	        <a href="index.php?action=Deconnexion"> Deconnexion </a>
	    </div>
	</header>
	<?= $content; ?>

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="view/page/admin.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="view/css/front.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
	<script src="https://cdn.tiny.cloud/1/sxq7wlppdsn7uq2723od67ynsomvawaa8ezwg78ylypihzoj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<meta name="viewport" content="width=device-width">

</head>
<body>
	<header class="d-flex justify-content-between">
	    <a href="index.php?action=listPosts" class="text-decoration-none"><h1>Billet simple pour l'Alaska</h1></a>

	    <form id="connexionFront" action="index.php?action=user" method="post" class="d-flex align-items-center">
	    	<div id="connexionPart1">
		        <p>
		            <input class="connect" type="text" id="user" name="user[pseudo]" placeholder=" Utilisateur">
		        </p>

		        <p>
		            <input class="connect" type="password" name="user[password]" placeholder=" Mot de passe">
		        </p>
		    </div>

		    <div id="connexionPart2">
		        <p id="connectAuto">
		        	<input type="hidden" name="user[auto]" value="false">
		        	<input type="checkbox" name="user[auto]" value="true">
		        	Connexion automatique
		        </p>

		        <p>
		            <input id="connexion" class="connect" type="submit" value="Connexion">
		        </p>
		    </div>
	    </form>
	</header>
	<?= $content ?>

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="view/page/admin.js"></script>
	
</body>
</html>
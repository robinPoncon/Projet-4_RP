<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="view/css/projet-4.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
	<script src="https://cdn.tiny.cloud/1/sxq7wlppdsn7uq2723od67ynsomvawaa8ezwg78ylypihzoj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
	<header class="d-flex justify-content-between">
	    <a href="index.php?action=listPosts" class="text-decoration-none"><h1>Billet simple pour l'Alaska</h1></a>

	    <form action="index.php?action=user" method="post" class="d-flex align-items-center">
	        <div>
	            <input class="connect" type="text" id="user" name="user[pseudo]" placeholder=" Utilisateur">
	        </div>
	        <div>
	            <input class="connect" type="password" name="user[password]" placeholder=" Mot de passe">
	        </div>
	        <div>
	            <input id="connexion" class="connect" type="submit" value="Connexion">
	        </div>
	    </form>
	</header>
	<?= $content ?>
</body>
</html>
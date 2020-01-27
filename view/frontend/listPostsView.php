<?php $title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>

<header class="d-flex justify-content-between">
    <h1>Billet simple pour l'Alaska</h1>

    <!-- <form action="index.php?action=admin" method="post" class="d-flex align-items-center">
        <div>
            <input class="connect" type="text" id="user" name="pseudo" placeholder=" Utilisateur">
        </div>
        <div>
            <input class="connect" type="password" name="password" placeholder=" Mot de passe">
        </div>
        <div>
            <input id="connexion" class="connect" type="submit" value="Connexion">
        </div>
    </form>
-->
</header>

<h2 class="position-absolute">Jean Forteroche vous présente son dernier roman !</h1>
<img id="img-alaska" src="view/img/alaska.jpg">

<form action="index.php?action=addAdmin" method="post" class="d-flex align-items-center">
        <div>
            <input class="connect" type="text" id="user" name="addAdmin[pseudo]" placeholder=" Utilisateur">
        </div>
        <div>
            <input class="connect" type="password" name="addAdmin[password]" placeholder=" Mot de passe">
        </div>
        <div>
            <input type="text" name="addAdmin[email]" placeholder=" Email">
        </div>
        <div>
            <input id="connexion" class="connect" type="submit" value="Connexion">
        </div>
</form>


<?php
foreach ($posts as $post) 
{
    
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post->getTitle()) ?>
            <em> - Le <?= $post->getCreationDate() ?></em>
        </h3>
        
        <p class="content">
            <?= substr(htmlspecialchars($post->getContent()), 0, 450) . " ... " . "<a id='contentArticle' href=" . "index.php?action=post&amp;id=" . $post->getId() . "> Lire la suite </a>" ?>
        </p>

        <div class="iconeComment">
            <a class="test" href="index.php?action=post&amp;id= <?= $post->getId() ?>">
                <div class="position-relative" id="icone">
                    <p class="position-absolute" id="trait1"></p>
                    <p class="position-absolute" id="trait2"></p>
                    <p class="position-absolute" id="trait3"></p>
                    <p class="position-absolute" id="triangle"></p>
                </div>
            </a>
        </div>
    </div>
<?php
}

//$posts->closeCursor();

?>
<?php $content = ob_get_clean(); ?>

<?php require('template-page.php'); ?>
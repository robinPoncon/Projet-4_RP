<?php 

    $title = "Billet simple pour l'Alaska";
    // ob_start() sert à ajouter le code qui suit dans la page (dans notre page template-front ou template-back) il est délimité par ob_get_clean() à la fin
    ob_start(); 
?>  

<h2 class="position-absolute">Jean Forteroche vous présente son dernier roman !</h1>
<img id="img-alaska" src="view/img/alaska.jpg">

<!-- On affiche tous les articles, et pour chaque article on affiche le titre, date, contenu, auteur. -->

<?php
foreach ($this->posts as $post) 
{
    
?>
    <div class="news">
        <h3>
            <!-- le htmlspecialchars permet d'afficher du code avec les balises html convertis -->
            <?= htmlspecialchars($post->getTitle()) ?>
            <em> - Le <?= $post->getCreationDate() ?></em>
        </h3>
        
        <p class="content">

            <!-- Le htmlspecialchars_decode permet d'afficher du contenu html en appliquant les balises utilisées 
                substr() permet d'afficher qu'un certain nombre de caractère
            -->

            <?= substr(htmlspecialchars_decode($post->getContent()), 0, 500) . " ... " . "<a id='contentArticle' href=" . "index.php?action=post&amp;id=" . $post->getId() . "> Lire la suite </a>" ?>
        </p>

        <p id="authorView">
            <?= htmlspecialchars($post->getAuthor()) ?>    
        </p>

        <div class="iconeComment">
            <a href="index.php?action=post&amp;id=<?= $post->getId() ?>">
                <div class="position-relative" id="icone">
                    <p class="position-absolute" id="trait1"></p>
                    <p class="position-absolute" id="trait2"></p>
                    <p class="position-absolute" id="trait3"></p>
                    <p class="position-absolute" id="triangle"></p>
                </div></a>
        </div>

        <!-- affichage des icones modifier et supprimer s'il existe une session -->

        <?php if (isset($_SESSION["pseudo"])):  ?>

            <a id='updatePost' href="index.php?action=viewUpdatePost&amp;id=<?= $post->getId() ?>">Modifier</a>
            <button onclick="deletePost(<?= $post->getId()?>)" id="deletePost">Supprimer</button>
            
            
            
        <?php endif; ?>
        
    </div>

    <!-- Boite de confirmation de la suppression d'un article -->

    <div class="confirm" id="confirm<?= $post->getId()?>"> 
        <p> Voulez-vous vraiment supprimer cet article ? </p>
        <a id="yes" href="index.php?action=deletePost&amp;id=<?= $post->getId() ?>"> Oui </a>
        <button onclick="cancelPost(<?= $post->getId() ?>)" id="no" >Non</button>
    </div>

<?php
}

?>
<?php $content = ob_get_clean(); ?>

<!-- Affichage du header front ou back -->

<?php require $_SESSION["header"]; ?>
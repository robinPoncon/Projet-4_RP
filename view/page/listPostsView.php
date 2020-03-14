<?php 

    $title = "Billet simple pour l'Alaska";

    ob_start(); 
?>  

<h2 class="position-absolute">Jean Forteroche vous présente son dernier roman !</h1>
<img id="img-alaska" src="view/img/alaska.jpg">

<?php
foreach ($this->posts as $post) 
{
    
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post->getTitle()) ?>
            <em> - Le <?= $post->getCreationDate() ?></em>
        </h3>
        
        <p class="content">
            <?= substr(htmlspecialchars_decode($post->getContent()), 0, 500) . " ... " . "<a id='contentArticle' href=" . "index.php?action=post&amp;id=" . $post->getId() . "> Lire la suite </a>" ?>
        </p>

        <div class="iconeComment">
            <a class="test" href="index.php?action=post&amp;id=<?= $post->getId() ?>">
                <div class="position-relative" id="icone">
                    <p class="position-absolute" id="trait1"></p>
                    <p class="position-absolute" id="trait2"></p>
                    <p class="position-absolute" id="trait3"></p>
                    <p class="position-absolute" id="triangle"></p>
                </div>
            </a>
        </div>
        <?php if (isset($_SESSION["pseudo"]) && $_SESSION["pseudo"] == "admin"):  ?>
        <a class='updateButton' href="index.php?action=viewUpdatePost&amp;id=<?= $post->getId() ?>">modifier</a>
        <?php endif; ?>
        
    </div>
<?php
}

?>
<?php $content = ob_get_clean(); ?>

<?php require $_SESSION["header"]; ?>
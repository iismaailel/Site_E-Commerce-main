<!Doctype html>
<html>
<head>
    <title>Mon Site</title>
    <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>../inc/css/style.css">
</head>
<body>
<header>
    <div class="conteneur">
        <div>
            <a href="" title="Mon Site">MonSite.com</a>
        </div>
        <nav>
            <?php
                echo '<a href="' . RACINE_SITE . '../connexion.php?action=deconnexion">Se déconnecter</a>';
            ?>
        </nav>
    </div>
</header>
<section>
    <div class="conteneur">
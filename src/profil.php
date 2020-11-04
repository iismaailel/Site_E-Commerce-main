<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecte()) header("location:connexion.php");
// debug($_SESSION);
$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['prenom'] . '</strong></p>';
$contenu .= '<div class="cadre"><h2> Voici vos informations </h2>';
$contenu .= '<p> votre email est: ' . $_SESSION['membre']['email'] . '<br></div><br><br>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//

require_once("inc/haut.inc.php");
echo $contenu;
?>
<li class='nav_item'>
    <a href='commande.php' class="btn btn-primary">vos commandes</a><br><br>
</li>
<?php
require_once("inc/bas.inc.php");
?>

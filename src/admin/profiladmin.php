<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecte())
    header("location:connexion.php");
// debug($_SESSION);
$contenu .= '<p class="centre">Bonjour vous etes connecter en tant que Administrateur.</p>';
$contenu .= '<div  class="card" style="width: 30rem;" ><h2> Voici vos informations </h2>';
$contenu .= '<p> votre email est: ' . $_SESSION['membre']['email'] . '<br></div><br><br>';

$contenu .= '<a href="./gestion_boutique.php?action=affichage" class="btn btn-primary">Afficher la liste des produits</a><br><br>';
$contenu .= '<a href="./gestion_boutique.php?action=ajout" class="btn btn-primary">Ajout d\'un produit</a><br><br>';

//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("./hautadmin.inc.php");
echo $contenu;
require_once("./basadmin.inc.php");
?>
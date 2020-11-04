<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//
$categories_des_produits = executeRequete("SELECT DISTINCT categorie FROM produit");
$contenu .= '<div class="boutique-gauche">';
$contenu .= "<ul>";
while($cat = $categories_des_produits->fetch_assoc())
{
    $contenu .= "<li><a href='?categorie=" . $cat['categorie'] . "'>" . $cat['categorie'] . "</a></li>";
}
$contenu .= "<li><a href='?categorie=prix<10'> prix<10 </a></li>";
$contenu .= "<li><a href='?categorie=10<prix<20'> 10< prix <20 </a></li>";
$contenu .= "<li><a href='?categorie=prix>40'> prix>40 </a></li>";
$contenu .= "<li><a href='?categorie=nomcroiss'> nomcroiss </a></li>";
$contenu .= "<li><a href='?categorie=nomdecroiss'> nomdecroiss </a></li>";
$contenu .= "</ul>";
$contenu .= "</div>";
//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '<div class="boutique-droite">';
if(isset($_GET['categorie']))
{
    if($_GET['categorie']=='prix<10')
	{$donnees = executeRequete("select id_produit,nom,photo,prix from produit where prix < 10");
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="boutique-produit">';
        $contenu .= "<h2>$produit[nom]</h2>";
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';	}
	}
    if($_GET['categorie']=='10<prix<20')
	{$donnees = executeRequete("select id_produit,nom,photo,prix from produit where 10<prix<20");
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="boutique-produit">';
        $contenu .= "<h2>$produit[nom]</h2>";
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';	}
	}
    if($_GET['categorie']=='prix>40')
	{$donnees = executeRequete("select id_produit,nom,photo,prix from produit where prix>40");
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="boutique-produit">';
        $contenu .= "<h2>$produit[nom]</h2>";
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';	}
	}
    if($_GET['categorie']=='nomcroiss')
	{$donnees = executeRequete("select id_produit,nom,photo,prix from produit order by nom asc");
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="boutique-produit">';
        $contenu .= "<h2>$produit[nom]</h2>";
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';	}
	}
    if($_GET['categorie']=='nomdecroiss')
	{$donnees = executeRequete("select id_produit,nom,photo,prix from produit order by nom desc");
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="boutique-produit">';
        $contenu .= "<h2>$produit[nom]</h2>";
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';	}
	}
    $donnees = executeRequete("select id_produit,nom,photo,prix from produit where categorie='$_GET[categorie]'");
    while($produit = $donnees->fetch_assoc())
    {
        $contenu .= '<div class="boutique-produit">';
        $contenu .= "<h2>$produit[nom]</h2>";
        $contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" =\"130\" height=\"100\"></a>";
        $contenu .= "<p>$produit[prix] €</p>";
        $contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
        $contenu .= '</div>';
    
	}
}
$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php"); ?>

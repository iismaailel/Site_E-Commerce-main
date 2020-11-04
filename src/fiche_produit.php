<?php
require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['id_produit']))  { $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); }
if($resultat->num_rows <= 0) { header("location:boutique.php"); exit(); }

$produit = $resultat->fetch_assoc();
$contenu .= "<h2>Nom : $produit[nom]</h2><hr><br>";
$contenu .= "<p>Categorie: $produit[categorie]</p>";
$contenu .= "<img src='$produit[photo]' ='150' height='150'>";
$contenu .= "<p>Prix : $produit[prix] €</p><br>";

if($produit['quantite'] > 0)
{
    $contenu .= "<i>Nombre d'produit(s) disponible : $produit[quantite] </i><br><br>";
    $contenu .= '<form method="post" action="panier.php">';
    $contenu .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";
    $contenu .= '<label for="quantite">Quantité : </label>';
    $contenu .= '<select id="quantite" name="quantite">';
    for($i = 1; $i <= $produit['quantite'] && $i <= 5; $i++)
    {
        $contenu .= "<option>$i</option>";
    }
    $contenu .= '</select>';
    $contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier">';
    $contenu .= '</form>';
}
else
{
    $contenu .= 'Rupture de stock !';
}
$contenu .= "<br><a href='boutique.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a>";
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php"); ?>

<?php

function executeRequete($req)
{
    global $mysqli;
    $resultat = $mysqli->query($req);
    if(!$resultat)
    {
        die("Erreur sur la requete sql.<br>Message : " . $mysqli->error . "<br>Code: " . $req);
    }
    return $resultat;
}

function debug($var, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px; float: right; clear: both; ">';
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    echo 'Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].';
    if($mode === 1)
    {
    echo '<pre>'; print_r($var); echo '</pre>';
    }
    else
    {
    echo '<pre>'; var_dump($var); echo '</pre>';
    }
    echo '</div>';
}

//------------------------------------
function internauteEstConnecte()
{
    if(!isset($_SESSION['membre']))
        return false;
    else
        return true;
}

//------------------------------------
function internauteEstConnecteEtEstAdmin()
{
    if( internauteEstConnecte() && $_SESSION['membre']['statut'] == 1)
        return true;
    else
        return false;
}

//------------------------------------
function creationDuPanier()
{
    if(!isset($_SESSION['panier']))
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['nom'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}
//------------------------------------
function ajouterProduitDansPanier($nom, $id_produit, $quantite, $prix)
{
    creationDuPanier();
    $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
    if($position_produit !== false)
    {
        $_SESSION['panier']['quantite'][$position_produit] += $quantite ;
    }
    else
    {
        $_SESSION['panier']['nom'][] = $nom;
        $_SESSION['panier']['id_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
    }
}
//------------------------------------
function montantTotal()
{
    $total=0;
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
    {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
    }
    return round($total,2);
}
//------------------------------------
function retirerProduitDuPanier($id_produit_a_supprimer)
{
    $position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['id_produit']);
    if ($position_produit !== false)
    {
        array_splice($_SESSION['panier']['nom'], $position_produit, 1);
        array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
        array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
        array_splice($_SESSION['panier']['prix'], $position_produit, 1);
    }
}

function afficherProduit($produit)
{
    $res= '';
    $res .= '<div class="card" style="width: 18rem;">';
    $res .= '<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img class="card-img-top" src="$produit[\'photo\']" alt="Card image cap">';
    $res .= '<div class="card-body">';
    $res .= '<h5 class="card-title">'.$produit['nom'] .'</h5>';
    $res .= '<p class="card-text">'.$produit['prix'] .'€</p>';

    $res .= '<a href="panier.php?ajout_panier=' . $produit['id_produit'] . '" class="btn btn-primary">ajout au panier</a><br><br>';
    $res .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '" class="btn btn-primary">Voir la fiche</a></div></div><br><br><br>';
    return $res;
}

?>
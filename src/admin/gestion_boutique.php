<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location:../connexion.php");
    exit();
}

//--- SUPPRESSION PRODUIT ---//
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{   // $contenu .= $_GET['id_produit']
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=$_GET[id_produit]");
    $produit_a_supprimer = $resultat->fetch_assoc();
    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo'];
    if(!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);
    $contenu .= '<div class="validation">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    executeRequete("DELETE FROM produit WHERE id_produit=$_GET[id_produit]");
    $_GET['action'] = 'affichage';
}
//--- ENREGISTREMENT PRODUIT ---//
if(!empty($_POST))
{   // debug($_POST);
    $photo_bdd = "";
    if(isset($_GET['action']) && $_GET['action'] == 'modification')
    {
        $photo_bdd = $_POST['photo_actuelle'];
    }
    if(!empty($_FILES['photo']['name']))
    {   // debug($_FILES);
        $nom_photo = $_POST['id_produit'] . '_' .$_FILES['photo']['name'];

        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "photo/$nom_photo";
        copy($_FILES['photo']['tmp_name'],$photo_dossier);
    }
    foreach($_POST as $indice => $valeur)
    {
        $_POST[$indice] = htmlEntities(addSlashes($valeur));
    }
    executeRequete("REPLACE INTO produit (id_produit, categorie, nom, photo, prix, quantite) values ('$_POST[id_prouit]', '$_POST[categorie]', '$_POST[nom]', '$photo_bdd',  '$_POST[prix]',  '$_POST[quantite]')");
    $contenu .= '<div class="validation">Le produit a été ajouté</div>';
    $_GET['action'] = 'affichage';
}
//--- LIENS PRODUITS ---//
$contenu .= '<a href="?action=affichage" class="btn btn-primary">Affichage des produits</a><br><br>';
$contenu .= '<a href="?action=ajout" class="btn btn-primary">Ajout d\'un produit</a><br><br>';
$contenu .= '<a href="./profiladmin.php" class="btn btn-primary">Accueil</a ><br><br><hr><br>';
//--- AFFICHAGE PRODUITS ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    $resultat = executeRequete("SELECT * FROM produit");

    $contenu .= '<h2> Affichage des produits </h2>';
    $contenu .= 'Nombre de produit(s) dans la boutique : ' . $resultat->num_rows;
    $contenu .= '<table border="1" cellpadding="5"><tr>';

    while($colonne = $resultat->fetch_field())
    {
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th>Modification</th>';
    $contenu .= '<th>Supression</th>';
    $contenu .= '</tr>';

    while ($ligne = $resultat->fetch_assoc())
    {
        $contenu .= '<tr>';
        foreach ($ligne as $indice => $information)
        {
            if($indice == "photo")
            {
                $contenu .= '<td><img src="' . $information . '" ="70" height="70"></td>';
            }
            else
            {
                $contenu .= '<td>' . $information . '</td>';
            }
        }
        $contenu .= '<td><a href="?action=modification&id_produit=' . $ligne['id_produit'] .'"><img src="../inc/img/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppression&id_produit=' . $ligne['id_produit'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../inc/img/delete.png"></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("./hautadmin.inc.php");
echo $contenu;
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{
    if(isset($_GET['id_produit']))
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=$_GET[id_produit]");
        $produit_actuel = $resultat->fetch_assoc();
    }
    echo '
    <h1> Formulaire Produits </h1>
    <form method="post" enctype="multipart/form-data" action="">
     
        <input type="hidden" id="id_produit" name="id_produit" value="'; if(isset($produit_actuel['id_produit'])) echo $produit_actuel['id_produit']; echo '">
             
        <label for="categorie">categorie</label><br>
        <input type="text" id="categorie" name="categorie" placeholder="la categorie de produit" value="'; if(isset($produit_actuel['categorie'])) echo $produit_actuel['categorie']; echo '" ><br><br>
 
        <label for="nom">nom</label><br>
        <input type="text" id="nom" name="nom" placeholder="le nom du produit" value="'; if(isset($produit_actuel['nom'])) echo $produit_actuel['nom']; echo '" > <br><br>

        <label for="photo">photo</label><br>
        <input type="file" id="photo" name="photo"><br><br>';
    if(isset($produit_actuel))
    {
        echo '<i>Vous pouvez uplaoder une nouvelle photo si vous souhaitez la changer</i><br>';
        echo '<img src="' . $produit_actuel['photo'] . '"  ="90" height="90"><br>';
        echo '<input type="hidden" name="photo_actuelle" value="' . $produit_actuel['photo'] . '"><br>';
    }

    echo '
        <label for="prix">prix</label><br>
        <input type="text" id="prix" name="prix" placeholder="le prix du produit"  value="'; if(isset($produit_actuel['prix'])) echo $produit_actuel['prix']; echo '"><br><br>
         
        <label for="quantite">quantite</label><br>
        <input type="text" id="quantite" name="quantite" placeholder="la quantite du produit"  value="'; if(isset($produit_actuel['quantite'])) echo $produit_actuel['quantite']; echo '"><br><br>
         
        <input type="submit" value="'; echo ucfirst($_GET['action']) . ' du produit">
    </form>';
}
require_once("./basadmin.inc.php");
?>
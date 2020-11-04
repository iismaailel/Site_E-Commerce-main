<?php require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if($_POST)
{
    debug($_POST);
    $membre = executeRequete("SELECT * FROM membre WHERE email='$_POST[email]'");
    if($membre->num_rows > 0)
    {
        $contenu .= "<div class='erreur'>email deja utiliser. Veuillez en choisir un autre svp.</div>";
    }
    else
    {
        foreach($_POST as $indice => $valeur)
        {
            $_POST[$indice] = htmlEntities(addSlashes($valeur));
        }
        $_POST['mdp'] = md5($_POST['mdp']);
        executeRequete("INSERT INTO membre (mdp, nom, prenom, email) VALUES ('$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]')");
        $contenu .= "<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require_once("inc/haut.inc.php"); ?>
<?php echo $contenu; ?>

    <form method="post" action="">
        <label for="nom">Nom</label><br>
        <input type="text" id="nom" name="nom" required="required" placeholder="votre nom"><br><br>

        <label for="prenom">Prénom</label><br>
        <input type="text" id="prenom" name="prenom" required="required" placeholder="votre prénom"><br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required="required" placeholder="exemple@gmail.com"><br><br>

        <label for="mdp">Mot de passe</label><br>
        <input type="password" id="mdp" name="mdp" required="required"><br><br>

        <input type="submit" name="inscription" value="S'inscrire">
    </form>

<?php require_once("inc/bas.inc.php"); ?>
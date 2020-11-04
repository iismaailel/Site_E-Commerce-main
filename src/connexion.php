<?php require_once("inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
if(internauteEstConnecte())
{
    header("location:profil.php");
}
if($_POST)
{
    $_POST['mdp'] = md5($_POST['mdp']);
    // $contenu .=  "email : " . $_POST['email'] . "<br>mdp : " .  $_POST['mdp'] . "";
    $resultat = executeRequete("SELECT * FROM membre WHERE email='$_POST[email]'");
    if($resultat->num_rows != 0)
    {
        $contenu .=  '<div style="background:green">email connu!</div>';
        $membre = $resultat->fetch_assoc();

        if($membre['mdp'] == $_POST['mdp'])
        {
            //$contenu .= '<div class="validation">mdp connu!</div>';
            foreach($membre as $indice => $element)
            {
                if($indice != 'mdp')
                {
                    $_SESSION['membre'][$indice] = $element;
                }
            }
            if($membre['statut'] == 0)
                header("location:profil.php");
            else
                header("location: ./Admin/profiladmin.php");
        }
        else
        {
            $contenu .= '<div class="erreur">Erreur de MDP</div>';
        }
    }
    else
    {
        $contenu .= '<div class="erreur">Erreur d email</div>';
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require_once("inc/haut.inc.php"); ?>
<?php echo $contenu; ?>

    <form method="post" action="">
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br> <br>

        <label for="mdp">Mot de passe</label><br>
        <input type="password" id="mdp" name="mdp"><br><br>

        <input type="submit" value="Se connecter">
    </form>

<?php require_once("inc/bas.inc.php"); ?>
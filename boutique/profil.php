<?php require_once "inc/header.inc.php"; ?>
<?php 

//------------------------------------------------------------------------------------------
// Restriction d'accès à la page profil SI on N'EST PAS connecté

if( !userConnect() ){

    header('location:connexion.php');  // Redirection vers la page profil
    exit;
}

//------------------------------------------------------------------------------------------

if( adminConnect() ){ // Si c'est un admin qui est connecté, alors on affiche le titre 'administrateur'

    $content .= "<h3 style='color:tomato'> ADMINISTRATEUR</h3>";
}

//------------------------------------------------------------------------------------------

//debug( $_SESSION );

// Ici, on récupére le pseudo de la personne connectée et on l'affiche :
$pseudo = $_SESSION['membre']['pseudo'];

$content .= "<h3>Vos informations personnelles</h3>";

$content .= "<p>Votre prénom : " . $_SESSION['membre']['prenom'] . "</p>";
// Nous sommes OBLIGES de faire de la concaténation lorsque l'on souhaite afficher des valeurs d'un tableau multidimensionnel (MEME si on est entre guillemets

$content .= "<p>Votre nom : ". $_SESSION['membre']['nom'] ."</p>";
$content .= "<p>Votre email : ". $_SESSION['membre']['email'] ."</p>";
$content .= "<p>Votre adresse : ". $_SESSION['membre']['adresse'] ." ". $_SESSION['membre']['cp'] ." à " . $_SESSION['membre']['ville'] ."</p>";


?>



<h1>PAGE PROFIL</h1>

<h2> Bonjour <?= $pseudo ?></h2>

<?= $content // Affichage du contenu ?>

<?php require_once "inc/footer.inc.php";?>
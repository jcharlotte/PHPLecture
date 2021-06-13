<?php require_once "inc/header.inc.php"; ?>
<?php 
//debug( $_GET );

if ( isset( $_GET['id_produit'] ) ){ // SI il y a une 'id_produit', c'est que l'on a choisi d'afficher la fiche d'un produit en particulier, donc ici, on récupère les infos du produits, grâce à l'id_produit qui se trouve dans l'URL

    $r = execute_requete(" SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]' ");
}
else{ // SINON, on redirige vers la page d'accueil

    header('location:index1.php');
    exit();
}
//------------------------------------------------------------------------------------------
// Exploitation des données récupérées :
$produit = $r->fetch(PDO::FETCH_ASSOC);
    //debug( $produit );

$content .= "<a href='index1.php'>Retour page d'acceuil</a><br>";
$content .= "<a href='index1.php?categorie=$produit[categorie]'>Retour vers la catégorie $produit[categorie]</a><hr>";

foreach( $produit as $index => $valeur ){ // Je parcours la variable $produit

    if( $index == 'photo'){

        $content .= "<img src='$valeur' width='200px'> <br>";
    }
    elseif( $index != 'id_produit' && $index != 'stock' && $index != 'reference' ){

        $content .= "<p><b>$index</b> : $valeur </p>"; 
    }
    
}

//------------------------------------------------------------------------------------------
// Gestion du stock et du panier :
if( $produit['stock'] > 0){

    $content .= "<p> <b>Nombre de produits disponibles</b> : $produit[stock]</p>";

    $content .= "<form method='post' action='panier.php'>";
    // Ici, l'attribut action='panier.php' : permet d'être redirigé sur le fichier panier.php lorsque je valide le formulaire. Les données du formulaire seront donc traitées sur le ficher panier.php

        $content .= "<input type='hidden' name='id_produit' value='$produit[id_produit]'>";

        $content .= "<label>Quantité</label>";
        $content .= "<select name='quantite'>";

            for( $i =1; $i <= $produit['stock']; $i++){

                $content .= "<option value='$i'> $i </option>";
            }

        $content .= "</select><br><br>";
        $content .= "<input type='submit' name='ajout_panier' value='Ajouter au panier' class='btn btn-secondary'>";
    $content .= "</form>";
}
else{

    $content .= "<p>Rupture de stock! </p>";
}

//------------------------------------------------------------------------------------------
?>

<h1>FICHE PRODUIT</h1>

<?= $content ?>

<?php require_once "inc/footer.inc.php";?>
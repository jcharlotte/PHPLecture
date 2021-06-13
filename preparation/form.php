<?php require_once "inc/header.inc.php" ?>

<?php 
//------------------------------------------------------------------------------------------
// Gestion des joueurs : 
if( !empty( $_POST ) ){
    //debug( $_POST );

    if(strlen( $_POST['nom'] ) <= 3 || strlen( $_POST['nom'] ) > 25 ){

    $error .='<div class="alert alert-danger"> Votre nom doit être compris entre 4 et 25 caractères.</div>';
    }
    if(strlen( $_POST['prenom'] ) <= 2 || strlen( $_POST['prenom'] ) >25 ){

    $error .='<div class="alert alert-danger"> Votre prenom doit être compris entre 3 et 25 caractères.</div>';
    }

    
   if( is_numeric( $_POST['age'] ) ){

        if(strlen( $_POST['age'] ) < 2 || strlen( $_POST['age'] ) > 2 ){

            $error .='<div class="alert alert-danger"> L\'âge doit être compris entre 10 et 99 ans.</div>';
        }
    }
    else{

        $error .='<div class="alert alert-danger"> L\'âge doit être composé de chiffres.</div>';
    }

    if(strlen( $_POST['pays'] ) <= 3 || strlen( $_POST['pays'] ) >25 ){

        $error .='<div class="alert alert-danger"> Votre pays doit être compris entre 4 et 25 caractères.</div>';
    }

    foreach( $_POST AS $index => $valeur ){

        if( $index != 'poste' ){

            $_POST[$index] = htmlentities( addslashes( $valeur ) );
        }
    }

    //debug( $_FILES );
    if( !empty( $_FILES['photo']['name'] ) ){

        $nom_photo = $_POST['nom'] . '_' . $_POST['prenom'] . '_' . $_FILES['photo']['name'];

        $photo_bdd = URL . "$nom_photo";

        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . "/PHP/preparation/$nom_photo";

        copy( $_FILES['photo']['tmp_name'], $photo_dossier );
    }
    else{

        $error .="<div class='alert alert-danger'>Vous n'avez pas uploader de photo.</div>";
    }

    if( empty( $error ) ){

        execute_requete(" INSERT INTO player( nom, prenom, age, pays, poste, photo, presentation )

                            VALUES(
                                    '$_POST[nom]',
                                    '$_POST[prenom]',
                                    '$_POST[age]',
                                    '$_POST[pays]',
                                    '$_POST[poste]',
                                    '$photo_bdd',
                                    '$_POST[presentation]'
                                )
                         ");
    }
}

?>

<h1>Enregistrement</h1>
<?= $content ?>
<?= $error ?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="Nom"><br><br>
    <input type="text" name="prenom" placeholder="Prénom"><br><br>
    <input type="text" name="age" placeholder="Âge"><br><br>
    <input type="text" name="pays" placeholder="Pays"><br><br>
    <input type="radio" name="poste" value="attaque" checked> Attaque
    <input type="radio" name="poste" value="defense"> Défense<br><br>
    <input type="file" name="photo"><br><br>
    <textarea name="presentation" cols="40" rows="10" style="resize:none" placeholder="Description"></textarea><br><br>

    <input type="submit" value="Valider" class="btn btn-secondary">
</form>

<?php require_once "inc/footer.inc.php" ?>

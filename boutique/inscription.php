<?php require_once "inc/header.inc.php"; ?>
<?php

//------------------------------------------------------------------------------------------

if( userConnect() ){

    header('location:profil.php'); // Redirection vers la page de profil
    exit;
}


//------------------------------------------------------------------------------------------

if( $_POST ){

    //debug ( $_POST );

    // Contrôles sur les saisies de l'internaute (Il faudrait faire des contrôles poru TOUS les inputs du form)

    // Contrôle sur la taille du pseudo(15chars max):
    if(strlen( $_POST['pseudo'] ) <= 3 || strlen( $_POST['pseudo'] ) >15 ){
            // Si la taille du pseudo est égale ou inférieur à 3 OU QUE la taille est supérieur à 15, alors on affiche un message d'erreur
            // strLen() : retourne la taille d'une chaîne

        $error .='<div class="alert alert-danger"> Votre pseudo doit être compris entre 4 et 15 caractères.</div>';
    }
    
    // Pseudo doit être unique :
    $r = execute_requete(" SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]' ");

    if(  $r->rowCount() >= 1){

        $error .="<div class='alert alert-danger'>$_POST[pseudo] indisponible.</div>";
    }

    // Boucle sur toutes les saisies afin de les passer dans les fonctions htmlentities() et addslashes()
    foreach( $_POST AS $index => $valeur ){

        if($index != 'sexe' ){

            $_POST[$index] = htmlentities( addslashes( $valeur ) );  
        }    
    }

    // Cryptage du mot de passe : 
    $_POST['mdp'] = password_hash( $_POST['mdp'] , PASSWORD_DEFAULT);
        // password_hash() : permet de créer une clé de hachage

    // Insertion :
    if( empty( $error ) ){

        execute_requete(" INSERT INTO membre( pseudo, mdp, nom, prenom, email, sexe, ville, adresse, cp )

                            VALUES(

                                    '$_POST[pseudo]',
                                    '$_POST[mdp]',
                                    '$_POST[nom]',
                                    '$_POST[prenom]',
                                    '$_POST[email]',
                                    '$_POST[sexe]',
                                    '$_POST[ville]',
                                    '$_POST[adresse]',
                                    '$_POST[cp]'
                            )
                        ");

        $content .= "<div class='alert alert-success'>Inscription validée. 
        <a href='".URL."connexion.php'>Cliquez ici pour vous connecter</a>
    </div>";
    }
}






//------------------------------------------------------------------------------------------
?>
<h1>INSCRIPTION</h1>
<?php echo $error; //affichage des messages d'erreurs?>
<?= $content; // affichage du contenu ?>

<?php echo $error;  // Affichage des messages d'erreurs ?>
    <form method="post">

        <input type="text" name="pseudo" placeholder="Pseudo"><br><br>

        <input type="text" name="mdp" placeholder="Mot de Passe"><br><br>

        <label>Civilité</label><br>
        <input type="radio" name="sexe" value="f" checked> Femme
        <input type="radio" name="sexe" value="m"> Homme<br><br>

        <input type="text" name="nom" placeholder="Nom"><br><br>

        <input type="text" name="prenom" placeholder="Prénom"><br><br>

        <input type="text" name="email" placeholder="Email"><br><br>

        <input type="text" name="adresse" placeholder="Adresse"><br><br>

        <input type="text" name="ville" placeholder="Ville"><br><br>

        <input type="text" name="cp" placeholder="Code Postal"><br><br>

        <input type="submit" value="S'inscrire" class="btn btn-secondary">

    </form>

<?php require_once "inc/footer.inc.php"; ?>
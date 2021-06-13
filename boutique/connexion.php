<?php require_once "inc/header.inc.php"; ?>
<?php

//------------------------------------------------------------------------------------------
// Déconnexion : AVANT la redirection, sinon le script de la déconnexion ne sera pas lu par l'interpréteur php à cause du exit.

//debug( $_GET );

if( isset( $_GET['action'] ) && $_GET['action'] == 'deconnexion' ){ // S'IL existe une 'action' dans l'URL ET QUE sa valeur est égale à 'deconnexion', alors on détruit la session

    session_destroy(); // Détruit le fichier de session
    // unset ( $_SESSION['membre'] ); // supprimera la session/membre (et donc entrainera une déconnexion)
    header('location:index1.php');
    exit;
}

//------------------------------------------------------------------------------------------
//restriction d'accès à la page :
if( userConnect() ){

    header('location:profil.php');  // Redirection vers la page profil
    exit;   // exit; : permet de stopper la lecture du code à cet endroit précis (car on a été redirigé juste avant)
}

//------------------------------------------------------------------------------------------
if( $_POST ){

    //debug( $_POST );

    // Comparaison du pseudo posté et celui en BDD :
    $r = execute_requete(" SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]' ");

    if( $r->rowCount() >= 1){ // Si il y a une correspondance dans la table membre :

        //Ici, je récupère mes données pour les exploiter
        $membre = $r->fetch( PDO::FETCH_ASSOC );
            //debug( $membre );

            //Verification du mdp :
		if( password_verify( $_POST['mdp'] , $membre['mdp'] ) ){
            //password_verify( arg1, arg2 ) : retourne true ou false; permet de comparer une chaine à une chaine cryptée
                //arg1 : le mot de passe (ici, posté par l'internaute)
                //arg2 : la chaine crytée (par la fonction password_hash(), ici le mdp de la BDD)
    
                //insertion des infos de la personne qui se connecte dans le fichier de session :
                $_SESSION['membre'] = $membre;
                //debug( $_SESSION );
    
                //redirection sur la page de profil.php
                header('location:profil.php');
                exit(); //exit(); permet de quitter A CET ENDROIT PRECIS le code (et donc de ne pas interpréter le code qui suit cette instruction)
    
                //boucle foreach pour insérer dans le fichier de session :
                // foreach( $membre as $index => $valeur ){
    
                // 	$_SESSION['membre'][$index] = $valeur;
                // }
    
                //Pareil que la boucle foreach() EN PLUS LONG...
                // $_SESSION['membre']['id_membre'] = $membre['id_membre'];
                // $_SESSION['membre']['pseudo'] = $membre['pseudo'];
                // $_SESSION['membre']['mdp'] = $membre['mdp'];
                // $_SESSION['membre']['nom'] = $membre['nom'];
                // $_SESSION['membre']['prenom'] = $membre['prenom'];
                // $_SESSION['membre']['email'] = $membre['email'];
                // $_SESSION['membre']['sexe'] = $membre['sexe'];
                // $_SESSION['membre']['adresse'] = $membre['adresse'];
                // $_SESSION['membre']['ville'] = $membre['ville'];
                // $_SESSION['membre']['cp'] = $membre['cp'];
                // $_SESSION['membre']['statut'] = $membre['statut'];
    
            }
            else{ //SINON c'est que le mdp n'est pas bon
    
                $error .= "<div class='alert alert-danger'>Mot de passe incorrect</div>";
            }
        }
        else{ //SINON, c'est que le pseudo n'existe pas
    
            $error .= "<div class='alert alert-danger'>Pseudo incorrect</div>";
        }
    }

?>

<h1>CONNEXION</h1>
<?= $error; // Affichage des erreurs ?>
<form method="post">

    <input type="text" name="pseudo" placeholder="Votre pseudo"><br><br>

    <input type="text" name="mdp" placeholder="Mot de Passe"><br><br>

    <input type="submit" value="Se connecter" class="btn btn-secondary">

</form>


<?php require_once "inc/footer.inc.php";?>
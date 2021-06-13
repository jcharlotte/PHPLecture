<?php require_once "../inc/header.inc.php"; ?>
<?php 

//------------------------------------------------------------------------------------------
// Restrictions d'accès à la page administrative
if( !adminConnect() ){ // Si l'admin n'est pas connecté, on le redirige vers la page de connexion

    header('location:../connexion.php');
    exit;
}

//------------------------------------------------------------------------------------------
// SUPPRESSION :
if( isset( $_GET['action'] ) && $_GET['action'] == 'suppression' ){ // SI il y a une 'action' ET QUE cette 'action' est égale à 'suppression', alors on déclence la suppression du produit

    // Suppression de la photo:
    $pdostatement = execute_requete(" SELECT photo FROM produit WHERE id_produit = '$_GET[id_produit]' ");

    $photo_a_supprimer = $pdostatement->fetch( PDO::FETCH_ASSOC );
        //debug( $photo_a_supprimer );
        //str_replace( arg1, arg2, arg3 ) : fonction de php qui permet de remplacer une chaine de caractères
			//arg1 : la chaine que l'on souhaite remplacer
			//arg2 : la chaine de remplacement
			//arg3 : Sur quelle chaine je veux effectuer les changements

		//Ici : je remplace :	http://localhost
					//  par :	$_SERVER['DOCUMENT_ROOT'] <=> C:/xamp/htdocs
					// dans :	$photo_a_supprimer['photo'] <=> http://localhost/PHP/boutique/photo/nom_photo.jpg 
									//(l'adresse de la photo récupérée de la BDD)
    
    $chemin_photo_a_supprimer = str_replace( 'http://localhost', $_SERVER['DOCUMENT_ROOT'], $photo_a_supprimer['photo'] );
    
    if( !empty( $chemin_photo_a_supprimer ) && file_exists( $chemin_photo_a_supprimer ) ){// SI le chemin de la photo n'est PAS VIDE ET QUE le fichier existe

        unlink( $chemin_photo_a_supprimer );
        // unlink( url ) : permet de supprimer un fichier
    }

    // Suppression dans la table 'produit':
	execute_requete(" DELETE FROM produit WHERE id_produit = '$_GET[id_produit]' ");
    header('location:?action=affichage');
}


//------------------------------------------------------------------------------------------
// Gestion des produits : 

if(!empty( $_POST ) ){

    //debug( $_POST );

    // CONTROLE sur les saisies : (il faudrait faire des contrôle pour TOUS les inputs)

    $r = execute_requete(" SELECT * FROM produit WHERE reference = '$_POST[reference]' ");

    if(  $r->rowCount() >= 1){

        $error .="<div class='alert alert-danger'>La référence $_POST[reference] existe déjà.</div>";
    }

    // Ici, je passe toutes les infos postées par l'admin dans les fonctions htmlentities() et addslashes()
    foreach( $_POST as $index => $valeur ){

        $_POST[$index] = htmlentities( addslashes( $valeur) );
    }

    //------------------------------------------------------------------------------------------
    // Gestion de la photo : 

    //debug( $_FILES );
    //debug( $_SERVER );

    if(isset( $_GET['action'] ) && $_GET['action'] == 'modification' ){ // SI je suis dans le cadre d'une modification, je récupère le chemin en BDD (grâce à la value de l'input type='hidden'), et je stock dans la variable $photo_bdd
     
        $photo_bdd = $_POST['photo_actuelle'];
    }

    //------------------------------------------------------------------------------------------
    if( !empty( $_FILES['photo']['name'] ) ){ // Si le nom de la photo (dans $_FILES) N'EST PAS VIDE, c'est ce que l'on a téléchargé un fichier

        // Ici, je rennome la photo :
        $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];
            //debug( $nom_photo );
        
        // Chemin pour accéder à la photo (à insérer en BDD) :
        $photo_bdd = URL . "photo/$nom_photo";
            // Rappel : la constante URL <=> http://localhost/PHP/boutique/
                //debug( $photo_bdd );

        // Où est-ce que l'on souhaite enregistrer le fichier 'physique' de la photo :
        $photo_dossier =  $_SERVER['DOCUMENT_ROOT'] . "/PHP/boutique/photo/$nom_photo";
        // $_SERVER : supeglobal de php qui retourne un tableau associatif avec des informations sur le serv eur courant
        // $_SERVER['DOCUMENT_ROOT'] <=> C:/xampp/htdocs
            //debug( $photo_dossier );

        // Enregistrement de la photo au bon endroit, ici dans le dossier photo de notre serveur
            copy( $_FILES['photo']['tmp_name'], $photo_dossier );
            // copy( arg1, arg2 ):
                //arg1 : chemin du ficher source
                //arg2 : chemin de destination
    }
    else{

        $error .="<div class='alert alert-danger'>Vous n'avez pas uploader de photo.</div>";
    }

    //------------------------------------------------------------------------------------------
    // Gestion des produits : INSERTION & MODIFICATION
    if( isset($_GET['action'] ) && $_GET['action'] == 'modification' ){ // SI il y a une 'action' dans l'URL ET QU'elle est égale à 'modification', alors on effectureune requête update
        execute_requete(" UPDATE produit SET 
                                            reference = '$_POST[reference]',
                                            categorie = '$_POST[categorie]',
                                            titre = '$_POST[titre]',
                                            description = '$_POST[description]',
                                            couleur = '$_POST[couleur]',
                                            taille = '$_POST[taille]',
                                            sexe = '$_POST[sexe]',
                                            photo ='$photo_bdd',
                                            prix = '$_POST[prix]',
                                            stock ='$_POST[stock]'
                        WHERE id_produit = '$_GET[id_produit]'
                        
                        ");
        header('location:?action=affichage');
    }
    elseif(empty ($error ) ){ // SINON, SI la variable $error est vide, je fais mon insertion

        execute_requete(" INSERT INTO produit( reference, categorie, titre, description, couleur, taille, sexe, photo, prix, stock ) 
        
                        VALUES(
                                '$_POST[reference]',
                                '$_POST[categorie]',
                                '$_POST[titre]',
                                '$_POST[description]',
                                '$_POST[couleur]',
                                '$_POST[taille]',
                                '$_POST[sexe]',
                                '$photo_bdd',
                                '$_POST[prix]',
                                '$_POST[stock]'
                            )
                        ");
    }
}

 //------------------------------------------------------------------------------------------
    // Affichage des produits

//debug ( $_GET );

if( isset( $_GET['action'] ) && $_GET['action'] == 'affichage' ){
    // SI il y a une 'action' dans l'URL ET qu'elle est égale à 'affichage', alor on affiche la liste des produits

    // Je récupère les produits en BDD :
    $pdostatement = execute_requete(" SELECT * FROM produit ");
        
    $content .= "<h2> Liste des produits</h2>";

    $content .= "<p>Nombre de produits dans la boutique : " . $pdostatement->rowCount() . "</p>";

    $content .= "<table class='table table-bordered' cellpadding='5'> ";
        $content .= "<tr>";

            $nombre_colone = $pdostatement->columnCount(); // retourne le nombre de colones issues du jeu de résultats que retourne la requête
                //debug( $nombre_colone );

            for( $i = 0; $i < $nombre_colone; $i++ ){

                $info_colone = $pdostatement->getColumnMeta( $i );
                    //debug( $info_colone );
                
                $content .= "<th> $info_colone[name] </th>";
            }
            $content .= "<th>Suppression</th>";
            $content .= "<th>Modification</th>";
        $content .= "</tr>";

        while( $ligne = $pdostatement->fetch( PDO::FETCH_ASSOC ) ){
            //fetch() : permet de retourner un tableau (ici, $ligne) indéxé par les champs de la table 'produit' GRACE au paramètre : PDO::FETCH_ASSOC
                // Ici, $ligne va donc retourner un tableau correspondant à UNE LIGNE de résultat issue de mon jeu de résultat ($pdostatement) de la requête
                // Nous utilisons une boucle WHILE pour afficher TOUTES les lignes TANT QU'il y en a à afficher car fetch() retourne la ligne suivante d'un jeu de résultat
            //debug( $ligne );

            $content .= "<tr>";

                foreach( $ligne as $indice => $valeur ){

                    if( $indice == 'photo'){ // Si l'indice est égale à 'photo', alors on affiche la valeur correspondante dans l'attribut src='' d'une balise img

                        $content .= "<td> <img src='$valeur' width=100px> </td>";
                    }
                    else{ // Sinon, on affiche la valeur dans une cellule simple

                        $content .= "<td> $valeur </td>";
                    }
                }
                $content .= '<td class="text-center">
                                <a href="?action=suppression&id_produit='. $ligne['id_produit'] .'" onclick="return(confirm(\'Voulez-vous vraiment supprimer ce f**** produit ?\'));"
                                >
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>';
                //Ici, on fait passer via le lien <a href=""> des informations dans l'url : une action de suppression et l'id du produit que l'on souhaite supprimer
				//Nous avons également ajouter un popup JS pour pouvoir annuler la suppression car c'est irreversible !!!

                $content .= '<td class="text-center">
                                <a href="?action=modification&id_produit='. $ligne['id_produit'] .'">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>';

                $content .= "</tr>";
        }
        $content .= "</table>";
}


//------------------------------------------------------------------------------------------
 ?>

<h1>GESTION DES PRODUITS</h1>

<a href="?action=ajout">Ajouter un nouveau produit</a><br>
<a href="?action=affichage">Affichage des produits</a><hr>


<?= $error; ?>
<?= $content; ?>


<?php   if( isset($_GET['action']) && ( $_GET['action'] == 'ajout' || $_GET['action'] == 'modification' ) ) : 
    //SI il y a une action ET QUE cette action est égale à 'ajout' 
    
            if( isset( $_GET['id_produit']) ){ // SI il existe un 'id_produit' dans l'URL, c'est que je suis dans le cadre d'une modification

                // Récupération des infos à afficher pour pré-remplir le formulaire :
                $pdostatement = execute_requete(" SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]' ");

                // Exploitation des données :
                $article_actuel = $pdostatement->fetch( PDO::FETCH_ASSOC );
                    //debug( $article_actuel );
            }    
    //------------------------------------------------------------------------------------------
            // Condition pour vérifier l'éxistance de la variable :
            if( isset( $article_actuel['reference'] ) ){

                $reference = $article_actuel['reference'];  // Ici on stocke dans une variable la valeur récupérée en BDD que l'on affichera dans l'attribut value="" des inputs correspondant
            }
            else{   // SINON, c'est que je ne suis pas dans le cadre d'une modification (mais d'un ajout) et alors je stocke du 'vide' dans la variable qui sera affichée dans l'attribut value="" des inputs correspondants

                $reference = '';
            }

            // Version ternaire des conditions (même chose que la condition ci-dessus)

            $categorie = ( isset( $article_actuel['categorie'] ) ) ? $article_actuel['categorie'] : '';
            $titre = ( isset( $article_actuel['titre'] ) ) ? $article_actuel['titre'] : '';
            $description = ( isset( $article_actuel['description'] ) ) ? $article_actuel['description'] : '';
            $couleur = ( isset( $article_actuel['couleur'] ) ) ? $article_actuel['couleur'] : '';
            $prix = ( isset( $article_actuel['prix'] ) ) ? $article_actuel['prix'] : '';
            $stock = ( isset( $article_actuel['stock'] ) ) ? $article_actuel['stock'] : '';

            // Modification du bouton submit
            $ajouter = ( isset( $_GET['action'] ) && $_GET['action'] == 'ajout' ) ? "Ajouter" : '';
            $modifier = ( isset( $_GET['action'] ) && $_GET['action'] == 'modification' ) ? "Modifier" : '';

        // Taille / Civilité
            if( isset( $article_actuel['taille'] ) &&  $article_actuel['taille'] == 'S' ){

                $taille_s = 'selected';
            }
            else{
                $taille_s = '';
            }

            // Version ternaire des autres values
            $taille_m = (isset( $article_actuel['taille'] ) && $article_actuel['taille'] == 'M' ) ? 'selected' : '';
            $taille_l = (isset( $article_actuel['taille'] ) && $article_actuel['taille'] == 'L' ) ? 'selected' : '';
            $taille_xl = (isset( $article_actuel['taille'] ) && $article_actuel['taille'] == 'XL' ) ? 'selected' : '';

            $sexe_m = (isset($article_actuel['sexe'] ) && $article_actuel['sexe'] == 'm') ? 'checked' : '';
            $sexe_f = (isset($article_actuel['sexe'] ) && $article_actuel['sexe'] == 'f') ? 'checked' : '';

            // Photo :
            if( isset( $article_actuel['photo'] ) ){

                $info_photo = '<i> Vous pouvez uploader une nouvelle photo : <br> </i>';
                $info_photo .= "<img src='$article_actuel[photo]' width='80px' ><br><br>";
                $info_photo .= "<input type='hidden' name='photo_actuelle' value='$article_actuel[photo]'>";
                    // Ici, je crée un input type='hidden' (donc caché), avec en value l'adresse de la photo récupérée en bdd pour pouvoir la récupérer pour la modification si je ne télécharge pas une nouvelle photo
            }
            else{

                $info_photo = '<br>';
            }

?>
    <form method="post" enctype="multipart/form-data">
    <!-- enctype="multpart/form-data" : cet attribut est OBLIGATOIRE lorsque l'on souhaite uploader des fichiers et les récupérer via $_FILES -->

        <label>Référence</label><br>
        <input type="text" name="reference" value="<?= $reference ?>"><br><br>

        <label>Catégorie</label><br>
        <input type="text" name="categorie" value="<?= $categorie ?>"><br><br>

        <label>Titre</label><br>
        <input type="text" name="titre" value="<?= $titre ?>"><br><br>

        <label>Description</label><br>
        <input type="text" name="description" value="<?= $description ?>"><br><br>

        <label>Couleur</label><br>
        <input type="text" name="couleur" value="<?= $couleur ?>"><br><br>

        <label>Taille</label><br>
        <select name="taille">
        <option value="S" <?= $taille_s ?> > S </option>
        <option value="M" <?= $taille_m ?> > M </option>
        <option value="L" <?= $taille_l ?> > L </option>
        <option value="XL" <?= $taille_xl ?> > XL </option>
        </select><br><br>

        <label>Civilité</label><br>
        <input type="radio" name="sexe" value="m" <?= $sexe_m ?>>Homme <br>
        <input type="radio" name="sexe" value="f" <?= $sexe_f ?>>Femme <br><br>

        <label>Photo</label><br>
        <input type="file" name="photo"><br>
        <?= $info_photo // Affichage de ma variable $info_photo?>

        <label>Prix</label><br>
        <input type="text" name="prix" value="<?= $prix ?>"><br><br>

        <label>Stock</label><br>
        <input type="text" name="stock" value="<?= $stock ?>"><br><br>

        <input type="submit" value="<?= $ajouter . $modifier ?>" class="btn btn-secondary">
        
    </form>
<?php endif; ?>
<?php require_once "../inc/footer.inc.php"; ?>
<?php require_once "inc/header.inc.php"; ?>
<?php 
//debug( $_POST );
//------------------------------------------------------------------------------------------
if( isset( $_POST['ajout_panier'] ) ){// Ici, on vérifie l'éxistence d'un 'submit' dans 'fiche_produit.php', DONC lorsque l'on ajouteun produit au panier

    $r = execute_requete(" SELECT titre, prix FROM produit WHERE id_produit = '$_POST[id_produit]' ");
    // Ici, $_POST['id_produit'] provient de l'input type='hidden' dans le form de fiche_produit.php

    $produit = $r->fetch( PDO::FETCH_ASSOC );
        //debug( $produit );

        ajout_panier( $produit['titre'], $_POST['id_produit'], $_POST['quantite'], $produit['prix'] );
        // Ici, l'id et la quantité proviennent du formulaire de fiche_produit.php

}

//------------------------------------------------------------------------------------------
// Insertion dans la table 'commande'
if( isset( $_POST['payer'] ) ){

    // methode 1 : $id_membre_connecte = $_SESSION['membre']['id_membre'];
    // methode 1: $total = montant_total();

    $pdo->exec(" INSERT INTO commande( id_membre, montant, date )
 
                            VALUES(
                                    " . $_SESSION['membre']['id_membre'] . ",
                                    " . montant_total() . ", 
                                    NOW()
                            )
                        ");
    // Ici, on utilise exec pour pouvoir utiliser lastInsertId();

    //récupération du numéro de commande : lastInsertId() 
    $id_commande = $pdo->lastInsertId();

    $content .= "<div class='alert alert-success'> Merci pour votre commande, le numéro de la commande est le $id_commande .</div>";

    
    for( $i = 0; $i < sizeof( $_SESSION['panier']['id_produit']); $i++ ){

        // Insertion du détail de la commande dans la table 'details_commande'
		execute_requete(" INSERT INTO details_commande( id_commande, id_produit, quantite, prix) 

						VALUES( $id_commande,
								". $_SESSION['panier']['id_produit'][$i] .",
								". $_SESSION['panier']['quantite'][$i] .",
								". $_SESSION['panier']['prix'][$i] ."
						)
					    ");

        //modification du stock en conséquence de la commande update                
        execute_requete(" UPDATE produit SET
        
                        stock = stock - ". $_SESSION['panier']['quantite'][$i] ."

                        WHERE id_produit = ". $_SESSION['panier']['id_produit'][$i] ."
                         ");
	}

    // Vider le panbier
    unset( $_SESSION['panier'] );
}

//debug( $_SESSION );
//debug( $_POST );

//------------------------------------------------------------------------------------------
//Action de vider le panier : (Ici, cette portion de code est AVANT l'affichage car on détruit la session/panier et donc il n'y aura plus rien à afficher) 
//debug( $_GET );

if( isset( $_GET['action'] ) && $_GET['action'] == 'vider' ){

    unset( $_SESSION['panier'] );
    //unset() : permet de détruire une variable (ici, $_SESSION['panier'] => revient à vide le panier)
}

//------------------------------------------------------------------------------------------
//Affichage du contenu du panier :
$content .= '<table class="table" >';
	$content .= "<tr>
					<th>Titre</th>
					<th>Quantite</th>
					<th>prix</th>
				</tr>";

	if( empty( $_SESSION['panier']['id_produit'] ) ){ //SI la session/panier/id_produit est vide, c'est que je n'ai rien dans mon panier

		$content .= "<tr>
						<td colspan='4'> Votre panier est vide </td>
					</tr>";
	}
	else{ //SINON, c'est qu'il y a des produits dans le panier donc on les affiche

		for( $i = 0; $i < sizeof( $_SESSION['panier']['id_produit']); $i++ ){

			$content .= "<tr>";
				$content .= "<td>". $_SESSION['panier']['titre'][$i] ."</td>";
				$content .= "<td>". $_SESSION['panier']['quantite'][$i] ."</td>";

				//Ici, on mulitplie le prix selon la quantite :
				$prix_total = $_SESSION['panier']['prix'][$i] * $_SESSION['panier']['quantite'][$i];

				$content .= "<td>". $prix_total ." €</td>";

			$content .= "</tr>";
		}

        //MONTANT TOTAL :
        $montant_total = montant_total();
		$content .= "<tr>
						<td colspan='2'>&nbsp;</td>
						<th colspan='2'>". $montant_total ." €</th>
					</tr>";
        
        // VALIDER LE PANIER :
            if( userConnect() ){ // Si l'utilisateur est connecté, on affiche le bouton valider le panier

                $content .= '<form method="post">';
                    $content .= "<tr>";
                        $content .= "<td>";

                            $content .= '<input type="submit" name="payer" value="Payer" class="btn btn-secondary">';

                        $content .= "</td>";
                    $content .= "</tr>";
                $content .= '</form>';
            }
            else {// Sinon, c'est qu'il n'estp as connecté, on affiche les liens pour se connecter ou s'inscrire
                
                $content .= "<tr>";
                    $content .= "<td>";

                        $content .= "Veuillez vous <a href='connexion.php'>connecter</a> ou vous <a href='inscription.php'>inscrire</a>.";

                    $content .= "</td>";
                $content .= "</tr>";
            }

		//VIDER LE PANIER :
		$content .= "<tr>";
			$content .= "<td>";

				$content .= "<a href='?action=vider'> Vider le panier </a>";

			$content .= "</td>";
		$content .= "</tr>";

	}
$content .= "</table>";


//------------------------------------------------------------------------------------------
?>
<h1>PANIER</h1>

<?= $content ?>

<?php require_once "inc/footer.inc.php";?>
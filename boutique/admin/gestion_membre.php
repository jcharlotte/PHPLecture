<?php require_once "../inc/header.inc.php"?>

<?php 
//------------------------------------------------------------------------------------------
	//Ici, on ne prévoit pas l'ajout de membre on considèrera qu'il s'incrira tout seul et dans la partie administrative on changera son statut à "admin" si il faut.

	// Affichage des membres

	// suppression

	//modification
		// Création formulaire pré remplie (qui nous permettra de changer un membre en admin)


//------------------------------------------------------------------------------------------
// Restrictions d'accès à la page administrative
if( !adminConnect() ){

    header('location:../connexion.php');
    exit;
}

//------------------------------------------------------------------------------------------
// SUPPRESSION :
if( isset( $_GET['action'] ) && $_GET['action'] == 'suppression' ){

	execute_requete(" DELETE FROM membre WHERE id_membre = '$_GET[id_membre]' ");
    header('location:?action=affichage');
}

//------------------------------------------------------------------------------------------
// MODIFICATION Membre :
if( !empty( $_POST ) ){

    if( isset($_GET['action'] ) && $_GET['action'] == 'modification' ){
		debug( $_POST );

        execute_requete(" UPDATE membre SET 
                                        pseudo = pseudo,
                                        mdp = mdp,
                                        nom = nom,
                                        prenom = prenom,
                                        email = email,
                                        sexe = sexe,
                                        ville = ville,
                                        cp = cp,
                                        adresse = adresse,
										statut = '$_POST[statut]'

                        WHERE id_membre = '$_GET[id_membre]'
                        
                        ");
        header('location:?action=affichage');
    }
}

//------------------------------------------------------------------------------------------

//debug ( $_GET );

if( isset( $_GET['action'] ) && $_GET['action'] == 'affichage' ){
  
    $r = execute_requete(" SELECT * FROM membre ");

    $content .= "<h2> Liste des membres</h2>";

    $content .= "<p>Nombre de membres inscrits : " . $r->rowCount() . "</p>";

    $content .= "<table class='table table-bordered' cellpadding='5'> ";
        $content .= "<tr>";

            $nombre_colone = $r->columnCount(); 
                //debug( $nombre_colone );

            for( $i = 0; $i < $nombre_colone; $i++ ){

                $info_colone = $r->getColumnMeta( $i );
                    //debug( $info_colone );
                
					if( $info_colone['name'] != 'id_membre' && $info_colone['name'] != 'mdp' ){
				
						$content .= "<th> $info_colone[name] </th>";
					}	
                
            }
            $content .= "<th>Suppression</th>";
            $content .= "<th>Modification</th>";
        $content .= "</tr>";

        while( $ligne = $r->fetch( PDO::FETCH_ASSOC ) ){
           

            $content .= "<tr>";

                foreach( $ligne as $indice => $valeur ){

					if( $indice != 'id_membre' && $indice != 'mdp' ){
				
						$content .= "<td> $valeur </td>"; 
					}


                }
                $content .= '<td class="text-center">
                                <a href="?action=suppression&id_membre='. $ligne['id_membre'] .'" onclick="return(confirm(\'Voulez-vous vraiment supprimer ce membre ?\'));"
                                >
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>';

                $content .= '<td class="text-center">
                                <a href="?action=modification&id_membre='. $ligne['id_membre'] .'">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>';

                $content .= "</tr>";
        }
        $content .= "</table>";
}




//------------------------------------------------------------------------------------------
?>

<h1>GESTION MEMBRE</h1>

<?php

	
	
	if( isset( $_GET['action'] ) && $_GET['action'] == 'modification' ){

        if( isset( $_GET['id_membre']) ){ 
		
		$r = execute_requete(" SELECT pseudo, nom, prenom, statut FROM membre WHERE id_membre = '$_GET[id_membre]' ");
		
		$membre_actuel = $r->fetch( PDO::FETCH_ASSOC );
		//debug( $article_actuel );
	    }


		$statut = ( isset( $membre_actuel['statut'] ) ) ? $membre_actuel['statut'] : '';


		$r = execute_requete(" SELECT * FROM membre WHERE id_membre = '$_GET[id_membre]' ");
		
		$content .= "<table class='table table-bordered' cellpadding='5'> ";
		$content .= "<tr>";
		
		$nombre_colone = $r->columnCount(); 
		//debug( $nombre_colone );
		
		for( $i = 0; $i < $nombre_colone; $i++ ){
			
			$info_colone = $r->getColumnMeta( $i );
			//debug( $info_colone );
			
			if( $info_colone['name'] != 'id_membre' && $info_colone['name'] != 'mdp' ){
				
				$content .= "<th> $info_colone[name] </th>";
			}	
		}
		
		$content .= "</tr>";
		
		while( $ligne = $r->fetch( PDO::FETCH_ASSOC ) ){
			
			
			$content .= "<tr>";
			
			foreach( $ligne as $indice => $valeur ){
				
				if( $indice != 'id_membre' && $indice != 'mdp' && $indice != 'statut' ){
					
					$content .= "<td> $valeur </td>"; 
				}
				elseif( $indice == 'statut' ){
					
					$content .= "<td><form method='post'><input type='text' name='statut' value=$statut></td>";
				}
				
			}
			
			$content .= "</tr>";
		}
		$content .= "</table>";
		$content .= "<hr><input type='submit' value='Modifier' class='btn btn-secondary'></form>";
	}			
?>

<?= $content ?>
<?= $error ?>

<?php require_once "../inc/footer.inc.php"?>
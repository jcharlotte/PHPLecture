<?php require_once "../inc/header.inc.php" ?>
<?php 

//Lors de l'affichage rendre l'id_commande cliquable pour faire en sorte d'afficher le détail de la commande SI on clique dessus


//------------------------------------------------------------------------------------------
// Restrictions d'accès à la page administrative
if( !adminConnect() ){

    header('location:../connexion.php');
    exit;
}

//------------------------------------------------------------------------------------------
// Affichage des commandes

if( isset( $_GET['action'] ) && ($_GET['action'] == 'affichage' || $_GET['action'] =='details') ){

    $r = execute_requete(" SELECT DISTINCT id_commande, montant, date, etat, pseudo, adresse, ville, cp 
                            FROM commande, membre
                            WHERE commande.id_membre = membre.id_membre
                        ");

    $content .= "<h2> Liste des commandes</h2>";

    $content .= "<table class='table table-bordered' cellpadding='5'> ";
        $content .= "<tr>";

            $nombre_colone = $r->columnCount(); 

            for( $i = 0; $i < $nombre_colone; $i++ ){

                $info_colone = $r->getColumnMeta( $i );
                
                $content .= "<th> $info_colone[name] </th>";
            }
        $content .= "</tr>";

        while( $ligne = $r->fetch( PDO::FETCH_ASSOC ) ){
            debug( $ligne );

            $content .= "<tr>";

                foreach( $ligne as $indice => $valeur ){

                    if( $indice == 'id_commande' ){

                        $content .= "<td><a href='?action=details&id_commande=$ligne[id_commande]'>Commande n° $ligne[id_commande]</a></td>";
                    }
                    else{

                        $content .= "<td> $valeur </td>"; 
                    }
                    
                }

                $content .= "</tr>";
        }
        $content .= "</table>";
}

if( isset( $_GET['action'] ) && $_GET['action'] =='details'){

    $r = execute_requete(" SELECT DISTINCT id_commande, montant, date, id_produit, quantite, prix
                            FROM  details_commande AS d, commande AS c
                            WHERE c.id_commande = d.id_commande
                        ");
    debug( $r );
    $content .= "<h2> Details de la commande $_GET[id_commande]</h2>";

    $content .= "<table class='table table-bordered' cellpadding='5'> ";
        $content .= "<tr>";

            $nombre_colone = $r->columnCount(); 

            for( $i = 0; $i < $nombre_colone; $i++ ){

                $info_colone = $r->getColumnMeta( $i );
                
                $content .= "<th> $info_colone[name] </th>";
            }
        $content .= "</tr>";

        while( $ligne = $r->fetch( PDO::FETCH_ASSOC ) ){
            debug( $ligne );

            $content .= "<tr>";

                foreach( $ligne as $indice => $valeur ){

                    $content .= "<td> $valeur </td>"; 
                }

                $content .= "</tr>";
        }
        $content .= "</table>";

}

?>
<h1>GESTION COMMANDES</h1>
<?= $content ?>

<?php require_once "../inc/footer.inc.php" ?>
<?php require_once "inc/header.php"; ?>

<?php 

$affichage = $pdo->query(" SELECT * FROM advert ORDER BY id DESC LIMIT 15 ");

$content .= "<h2>Annonces les plus récentes</h2>";

$content .= "<table class='table table-bordered' cellpadding='5'> ";
        $content .= "<tr>";

            $colone = $affichage->columnCount();

            for( $i = 0; $i < $colone-1; $i++ ){

                $info_colone = $affichage->getColumnMeta( $i );
                
                $content .= "<th>" . strtoupper($info_colone['name']) . "</th>";
            }
            $content .= "<th>Consulter l'annonce</th>";

        $content .= "</tr>";

        while( $ligne = $affichage->fetch( PDO::FETCH_ASSOC ) ){

            $content .= "<tr>";

                foreach( $ligne as $indice => $valeur ){

                    if($indice != 'reservation_message'){

                        if( $indice == 'title' ){

                            $content .= "<td>". strtoupper($valeur) . "</td>";
                        }else{

                            $content .= "<td> $valeur </td>";
                        }
                    }
                }
                $content .= '<td class="text-center">
                                <a href="fiche_bien.php?id='. $ligne['id'] .'">
                                    <i class="fas fa-box-open"></i>
                                </a>
                            </td>';

                $content .= "</tr>";
        }
        $content .= "</table>";


?>

<h1>Accueil</h1>

<?= $content ?>

<?php require_once "inc/footer.php"; ?>
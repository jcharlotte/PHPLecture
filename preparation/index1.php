<?php require_once "inc/header.inc.php" ?>

<?php 

$r = execute_requete(" SELECT * FROM player ");
    //debug( $r );

$content .= "<table class='table table-bordered' cellpadding='5'> ";
$content .= "<tr>";

    $nombre_colone = $r->columnCount();

    for( $i = 0; $i < $nombre_colone; $i++ ){

        $info_colone = $r->getColumnMeta( $i );
        
        $content .= "<th> $info_colone[name] </th>";
    }
$content .= "</tr>";

while( $ligne = $r->fetch( PDO::FETCH_ASSOC ) ){

    $content .= "<tr>";

        foreach( $ligne as $indice => $valeur ){

            if( $indice == 'photo'){
                $content .= "<td> <img src='$valeur' width=100px> </td>";
            }
            elseif( $indice == 'presentation' ){
                
                $content .= "<td>" . substr( $valeur, 0, 15) . "...</td>";
            }
            else{

                $content .= "<td> $valeur </td>";
            }
        }
        $content .= "</tr>";
}
$content .= "</table>";



?>

<h1>Liste des joueurs</h1>
<?= $content ?>

<?php require_once "inc/footer.inc.php" ?>

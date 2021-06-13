<?php require_once "inc/header.php"; ?>

<?php 


if( !empty( $_GET ) ){

    $r = $pdo->query(" SELECT * FROM advert WHERE id = '$_GET[id]' ");

    $infos = $r->fetch(PDO::FETCH_ASSOC);
        //debug($infos);

    foreach ($infos as $index => $value) {
        

        if( $index != 'id' && $index != 'reservation_message'){

            $content .= "<p><b>$index</b> : $value</p>";
        }elseif( $index == 'reservation_message' && $value != 'libre' ){

            $content .= "<p style='color:red'><b>Message de réservation</b> : $value</p>";
        }
    }

            $content .= '<form method="post">';
            $content .= '<textarea name="reservation_message" cols="50" rows="5" placeholder="Votre message" style="resize: none"></textarea><br><br>';
            $content .= '<input type="submit" value="Je réserve" class="btn btn-secondary">';
            $content .= '</form>';


    if( !empty( $_POST) && $_POST['reservation_message'] != 'libre' ){

        $pdo->query(" UPDATE advert SET
                    
                    reservation_message = '$_POST[reservation_message]'

                    WHERE id = '$_GET[id]'
                    ");
    }
}

?>



<h1>Détails</h1>

<?= $content ?>

<?php require_once "inc/footer.php"; ?>
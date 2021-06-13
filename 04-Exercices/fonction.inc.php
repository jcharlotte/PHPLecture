<?php

function calcul( $fruit, $poids){

    if( $poids != NULL){

        if($fruit == 'pommes'){

            $prix_kg = 2 * $poids;
        }elseif($fruit == 'bananes'){

            $prix_kg = 3 * $poids;
        }elseif($fruit == 'cerises'){

            $prix_kg = 4 * $poids;
        }elseif($fruit == 'poires'){

            $prix_kg = 5 * $poids;
        }else{
            return "Ce fruit n'est pas disponible.";
        }
        
        echo "Les $fruit coutent $prix_kg € pour un poids de $poids kg";
    }else{

        echo "Veuillez renseigner un poids.";
    }

}

echo "<hr>";
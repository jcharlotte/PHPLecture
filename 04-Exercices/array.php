<?php
$listFruit = ['pommes', 'bananes', 'cerises', 'poires'];
$listPoids = ['0.1','0.5', '1', '2', '5'];

print '<pre>';
    print_r( $listFruit );
    print_r( $listPoids );
print '</pre>';

echo "<hr>";

require_once "fonction.inc.php";

// echo calcul($listFruit[2], $listPoids[1]);

// echo calcul($listFruit[2], $listPoids[1]);

// for( $i = 0; $i < sizeof($listPoids); $i++){

//     echo calcul($listFruit[2], $listPoids[$i]) . '<br>';
// }


for( $i = 0; $i < sizeof($listPoids); $i++){

    for ( $j = 0; $j < sizeof($listFruit); $j++){

        echo calcul($listFruit[$j], $listPoids[$i]) . '<br>';
    }
}

<?php

require_once "fonction.inc.php";

if( isset( $_GET)) {

    echo calcul( $_GET['fruit'], $_GET['poids']);
}

echo "<hr>"
?>

<a href="lien.php?fruit=pommes&poids=1">Pommes</a>
<a href="lien.php?fruit=bananes&poids=1">Bananes</a>
<a href="lien.php?fruit=cerises&poids=1">Cerises</a>
<a href="lien.php?fruit=poires&poids=1">Poires</a>

<?php

print '<pre>';
    print_r( $_POST);
print '</pre>';


require_once "fonction.inc.php";

if( isset( $_POST)) {

    echo calcul( $_POST['fruit'], $_POST['poids']);
}

echo "<hr>";

?>

<form method="post">
    <select name="fruit">
    <option value="pommes">Pommes</option>
    <option value="bananes">Bananes</option>
    <option value="cerises">Cerises</option>
    <option value="poires">Poires</option>
    </select>
    
    <label for="">Poids</label>
    <input type="text" placeholder="kg" name="poids" value="<?php
if( isset($_POST['poids']))
{
   echo $_POST['poids'];
}
?>">

    <input type="submit" name="validation" value="Valider">
</form>

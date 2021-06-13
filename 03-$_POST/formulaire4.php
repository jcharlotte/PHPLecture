<a href="formulaire2.php">Retour form2</a><br>
    <hr>
    <h1>Formulaire 4</h1>

<?php

// /EXERCICE : 
// 	1 - Faire un formulaire où vous allez renseigner : la ville, le code_postal et l'adresse
// 	2 - Afficher votre adresse de la façon suivante : 
// 		"J'habite au 15 rue Moussorgski à Paris 75018"
// 	2.1 - Gérer les erreurs lorsque l'on arrive sur la page
// 	3 - Afficher toutes les informations du post via une boucle (foreach())


print '<pre>';
    print_r( $_POST);
print'</pre>';

echo '<hr>';

if( $_POST){

    echo "J'habite au $_POST[adresse] à $_POST[ville] $_POST[codePostale] <br>";
}

foreach($_POST as $champs => $valeur){

    echo "$champs : $valeur <br>";
}


//ecriture d'un fichier crée dynamiquement :
$fichier = fopen('liste.txt', 'a');
//fopen() en mode 'a' : permet de créer un fichier s'il n'est pas trouvé sinon, il l'ouvre

$adresse_complete = "$_POST[adresse] à $_POST[ville] dans le $_POST[codePostale]";

fwrite( $fichier, $adresse_complete . "\r\n" );
//fwrite() : permet d'écrire dans un fichier (ici, représenté par $fichier) et en second argument, ce que l'on souhaite écrire dans le fichier
    // "\r\n" : permet de faire un saut de ligne dans un fichier 
    //ATTENTION de bien le mettre entre guillemets et pas entre quotes sinon il sera interprété comme une chaine 

fclose( $fichier );
//fclose() : permet de ferme le fichier et de libérer la ressource

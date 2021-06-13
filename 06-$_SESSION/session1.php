<?php 

session_start();    //session_start() : permet de créer un fichier de session OU de l'ouvrir s'il existe déjà
    // Ce fichier sera enregistré COTE SERVEUR
    // session_start() : sera TOUJOURS SITUER EN HAUT ET EN PREMIER AVANT TOUS TRAITEMENTS ! 


print '<pre>';
	print_r( $_SESSION );
print '</pre>';
echo '<hr>';

// Ici, on alimente notre fichier de session:

$_SESSION[ 'prenom' ] = 'marco';
$_SESSION[ 'nom' ] = 'polo';

// Affichage de Marco :

echo $_SESSION['prenom'] . '<br>';
echo $_SESSION['nom'] . '<br>';

unset( $_SESSION['nom'] );
    // uneset( $arg ) : permet de supprimer une variable et donc de vider une partie de la session

// session_destroy();
    // session_destroy() : permet de supprimer le fichier de session
    // A SAVOIR : cette fonction est lue par l'interpréteur PHP, gardé en mémoire et puis exécuté A LA FIN du script.

echo "J'afficher une info de la session, le prénom : $_SESSION[prenom] <br>";
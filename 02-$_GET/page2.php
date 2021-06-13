<h1>Page 2</h1>

<a href="page1.php">retour Page 1</a>

<?php

// $_GET représente l'URL, il s'agit d'une superglobale et il faut absolument l'écrire en MAJUSCULE sinon ça ne fonctionnera pas !!

print '<pre>';
    print_r( $_GET );
print '</pre>';

if(  !empty( $_GET)){
echo "Paramétre 1 : " . $_GET['article'] . "<br>";
echo "Paramétre 2 : " . $_GET['couleur'] . "<br>";
echo "Paramétre 3 : " . $_GET['prix'] . "<br>";
}

/*
	page2.php?article=jean&couleur=rouge&prix=123
	<=>
	fichier.php?cle=valeur&cle2=valeur2&cle3=valeur3

Pour récupérer la valeur, il faut préciser la clé entre crochets avec la superglobale $_GET, car les superglobales renvoient toujours un array !

Pour faire passer des informations dans l'URL, il faut commencer par mettre un '?' et ensuite une 'clé' suivi d'un '=' et de la valeur correspondante.
Si on souhaite passer plusieurs informations dans l'URL, il suffit de les séparer par un '&'.
*/
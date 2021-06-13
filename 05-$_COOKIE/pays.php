<?php

print '<pre>';
	print_r( $_GET );

	print_r( $_COOKIE );
print '</pre>';

//-----------------------------------------------------
if( isset( $_GET['pays'] ) ){ //SI il existe 'pays' dans l'URL, c'est que l'on a forcément cliqué sur un lien

	$pays = $_GET['pays'];
}
elseif( isset( $_COOKIE['langue_choisie'] ) ){ //SI il existe un cookie nommée 'langue_choisie'

	$pays = $_COOKIE['langue_choisie']; //Ici, on récupère la valeur du cookie et on le transmet à la variable $pays
}
else{ //SINON, c'est que c'est la première fois que j'arrive sur la page web. Donc par défaut, $pays sera égale à 'fr'

	$pays = 'fr';
}

//------------------------------------------------------
//var_dump( time() ); //time() : retourne le timestamp (=nombre de seconde depuis le 1er janvier 1970)

$un_an = 365 * 24 * 60 * 60; //durée en seconde pour une année
//(365jrs * 24h * 60min * 60sec )
	//echo $un_an;

setcookie('langue_choisie', $pays, time()+$un_an );
//Ici, ce cookie sera crée dans tous les cas puisqu'il n'est pas dans une condition

	//UN COOKIE SERA ENREGISTRE COTE CLIENT !!!

//setcookie( arg1, arg2, arg3 );
	//arg1 : nom du cookie
	//arg2 : la valeur du cookie
	//arg3 : durée de vie du cookie 

//Pour accéder aux cookies (Chrome):
	//Cliquer sur : paramètre/
					//Confidentialité et sécurité/
						//Cookies et autres données de site/
							//Afficher l'ensemble des cookies et données de site/
								//Rechercher : 'localhost'

//------------------------------------------------------
switch( $pays ) { //Ici, on compare la valeur de '$pays' et en fonction de sa valeur, on affichera un titre dans la balise <h1> correspondant à la lanque choisie

	case 'fr' : $titre = "Bonjour la France"; break;
	case 'it' : $titre = "Ciao Italia"; break;
	case 'es' : $titre = "Hola Espana"; break;
	case 'en' : $titre = "Hello England"; break;
}

//------------------------------------------------------------------------------
?>

<h1> <?php echo $titre; //affichage ?></h1>

<ul>
	<li><a href="?pays=fr">France</a></li>
	<li><a href="?pays=it">Italie</a></li>
	<li><a href="?pays=es">Espagne</a></li>
	<li><a href="?pays=en">Angleterre</a></li>
</ul>
<?php
/* 
1 - Créer un fichier fonction.inc.php : et créer une fonction calcul() qui va recevoir 2 arguments (fruit, poids) et qui va retourner la phrase :

 => utiliser une condition : qui selon le fruit sélectionné, on créera une variable $prix_kg
		=> ex: si c'est pomme c'est 2€ 
		=> ex: si c'est poires c'est 3€ 

	"Les ... coutent ... € pour un poids de ... grammes" 

	=> pommes, bananes, cerises, poires (retournent un prix au kg)
*/

function calcul( $fruit, $poids ){

	switch( $fruit ){

		case 'pommes' : $prix_kg = 1; break;
		case 'bananes' : $prix_kg = 2; break;
		case 'cerises' : $prix_kg = 3; break;
		case 'poires' : $prix_kg = 4; break;
	}

	// if( $fruit == 'pommes' ){
	// 	$prix_kg = 1;
	// }
	// elseif( $fruit == 'bananes' ){
	// 	$prix_kg = 2;
	// }
	// elseif( $fruit == 'cerises' ){
	// 	$prix_kg = 3;
	// }
	// elseif( $fruit == 'poires' ){
	// 	$prix_kg = 4;
	// }

		// //Version sans condition avec les fruits stockés dans un tableau :
		// $prix_kg = array(  
		// 					'pommes' => 1,
		// 					'bananes' => 2,
		// 					'cerises' => 3,
		// 					'poires' => 4
		// 				);

		// // print '<pre>';
		// // 	print_r( $prix_kg );
		// // print '</pre>';

		// $resultat = $poids * ( $prix_kg[$fruit] / 1000 );

	$resultat = $poids * ( $prix_kg / 1000 );

	return "Les $fruit coutent $resultat € pour un poids de $poids grammes<br>";
}

echo calcul( 'pommes', 500 ) . '<br>';
echo calcul( 'cerises', 1500 ) . '<br>';



//2 - Créer un fichier lien.php. Prévoir 4 liens <a href=""></a> avec le nom des fruits afin de faire en sorte que lorsque l'on clique dessus, le prix du fruit ( pour 1 kg) s'affiche DANS LA MEME PAGE grâce à la fonction calcul().

require_once "fonction.inc.php";
//Inclusion du fichier "fonction.inc.php" pour pouvoir incorporer à cet endroit précis la fonction calcul() et donc de l'utiliser pour avoir le prix au kg

// print '<pre>';
// 	print_r( $_GET );
// print '</pre>';

if( isset( $_GET['fruit'] ) ){ //SI il existe l'indice "fruit" dans l'URL

	echo calcul( $_GET['fruit'] , 1000 );
	//on affiche le prix pour 1000 grammes grâce à la fonction calcul()
}

?>

<hr>
<a href="?fruit=pommes">Pomme</a><br>
<a href="?fruit=bananes">Banane</a><br>
<a href="?fruit=cerises">Cerise</a><br>
<a href="?fruit=poires">Poire</a><br>


<?php
// 3 - Créer un fichier formulaire.php et réaliser un formulaire permettant de selectionner (select) un fruit et saisir un poids.
// -> Affichez via la fonction calcul(), le resultat issue des infos du formulaire
// -> bonus : faites en sorte de garder le dernier fruit sélectionné et le dernier poids saisie dans le formulaire lorsque celui-ci est validé.
// print '<pre>';
// 	print_r( $_POST );
// print '</pre>';

require_once 'fonction.inc.php'; //inclusion de la fonction

if( $_POST ){ //SI on a validé le formulaire
	
	echo calcul( $_POST['fruits'], $_POST['poids']);
}

//-------------------------------------------------------------------
//bonus :

if( isset( $_POST['poids'] ) ){ //SI l'internaute a renseigné un poids (c'est que $_POST['poids'] existe !), alors on récupère le poids saisie et on le stock dans le variable

	$poids_choisi = $_POST['poids'];
}
else{ //SINON, c'est que l'on arrive sur la page pour la premières fois et donc il n'y a pas eu validation du formulaire et donc pas de poids renseigné donc on crée une variable à vide

	$poids_choisi = '';
}

//-----------------------
//Partie <select>
if( isset( $_POST['fruits'] ) && $_POST['fruits'] == 'cerises' ){ //SI $_POST['fruits'] EXISTE ( c'est que l'on a validé le formulaire) ET QUE sa valeur se soit égale à 'cerises', alors on stock la valeur "selected" dans une variable

	$cerise_choisi = "selected";
}
else{ //SINON, on y stocke du vide

	$cerise_choisi = '';
}

//version ternaire
$pomme_choisi = ( isset( $_POST['fruits'] ) && $_POST['fruits'] == 'pommes' ) ? "selected" : '';
$banane_choisi = ( isset( $_POST['fruits'] ) && $_POST['fruits'] == 'bananes' ) ? "selected" : '';
$poire_choisi = ( isset( $_POST['fruits'] ) && $_POST['fruits'] == 'poires' ) ? "selected" : '';

?>
<hr>
<form method="post">
	
	<label>Fruits</label><br>
	<select name="fruits">
		<option value="pommes" <?php echo $pomme_choisi ?> >Pommes</option>
		<option value="poires" <?= $poire_choisi ?> >Poires</option>
		<option value="cerises" <?= $cerise_choisi ?> >Cerises</option>
		<option value="bananes" <?= $banane_choisi ?> >Bananes</option>
	</select><br><br>

	<label>Poids</label><br>
	<input type="text" name="poids" value="<?php echo $poids_choisi ?>"><br><br>
	<!-- Ddans l'attribut value="", j'affiche la variable qui contiendra soit le poids renseigné par l'internaute soir 'rien' la première fois qu'on arrive sur la page -->

	<input type="submit">

</form>


<?php
// 4 - Créer un fichier array.php :
// 	4.1 - Déclarer un tableau avec tous les fruits : pommes, cerises, poires, bananes
	$tab_fruits = array('pommes', 'poires', 'cerises', 'bananes');

// 	4.2 - Déclarer un tableau avec tous les poids suivants : 100, 500, 1000, 2000, 5000
	$tab_poids = array( 100, 500, 1000, 2000, 5000);

// 		4.3 - Affichez les 2 tableaux (faire un print_r() !!! )
		print '<pre>';
			print_r( $tab_fruits );
			print_r( $tab_poids );
		print '</pre>';

// 	4.4 - Sortir le fruit 'cerise' avec le poids 500 via les tableaux créés pour les transmettre à la fonction calcul() et ainsi obtenir le prix
require_once "fonction.inc.php";

echo calcul( $tab_fruits[2], $tab_poids[1] ) . '<hr>';

// 	4.5 - Sortir TOUS les prix pour les cerises avec tous les poids (boucle)
	foreach( $tab_poids as $poids ){

		echo calcul( $tab_fruits[2], $poids );
	}

	//-----------------------------------------------------
	//Autre méthode avec la boucle 'for' :
	echo "<p> Taille du tableau des poids : ". sizeof( $tab_poids ) ." </p>";

	for( $i = 0; $i < sizeof($tab_poids); $i++){

		echo calcul( $tab_fruits[2], $tab_poids[$i] );
	}

// 	4.6 - Sortir tous les prix pour tous les fruits avec tous les poids (boucles imbriquées)
	foreach( $tab_fruits as $valeur_fruit ){

		echo "<h3> $valeur_fruit </h3>";

		foreach( $tab_poids as $valeur_poids ){

			echo calcul( $valeur_fruit, $valeur_poids );
		}
	}

	//-----------------------------------------------------
	//Autre méthode avec la boucle 'for' :
	// for( $i = 0; $i < sizeof( $tab_fruits ); $i++ ){

	// 	echo "<h2> $tab_fruits[$i] </h2>";

	// 	for( $j = 0; $j < count( $tab_poids ); $j++ ){

	// 		echo calcul( $tab_fruits[$i], $tab_poids[$j] );
	// 	}
	// }
	echo '<hr>';

// 		4.7 - faire un affichage dans un tableau ('<table>') pour un affichage plus 'propre'
// 			les titres des colonnes seront les poids
// 			les titres des lignes seront les fruits

echo "<table border='2'>";
	echo "<tr>";

		echo "<th>&nbsp;</th>";
		foreach( $tab_poids as $poids ){

			echo "<th> $poids </th>";
		}

	echo "</tr>";

	foreach( $tab_fruits as $fruit ){

		echo "<tr>";
			echo "<th> $fruit </th>";

			foreach( $tab_poids as $poids ){

				echo "<td>". calcul( $fruit, $poids ) ."</td>";
			}

		echo "</tr>";
	}
echo "</table>";


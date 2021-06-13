<?php
/* EXERCICE :
=> Création d'un repertoire :

	-- 1 - Création bdd 'repertoire'
	CREATE DATABASE repertoire;
	USE repertoire;

	-- 2 - Création table 'annuaire'(id_annuaire, nom, prenom, telephone, ville, code_postal, adresse)
	CREATE TABLE annuaire(
		id_annuaire int(3) NOT NULL auto_increment,
		nom varchar(20) NOT NULL,
		prenom varchar(20) NOT NULL,
		telephone int(10) UNSIGNED ZEROFILL NOT NULL, 
		adresse varchar(50) NOT NULL,
		ville varchar(20) NOT NULL,
		cp int(5) UNSIGNED ZEROFILL NOT NULL,
		PRIMARY KEY (id_annuaire)
	)ENGINE=InnoDB;
*/
// 3 - Connexion BDD

$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));


// 4 - formulaire d'enregistrement
?>

<form method="post"><br><br>

<input type="text" name="nom" placeholder="Nom"><br><br>

<input type="text" name="prenom" placeholder="Prénom"><br><br>

<input type="text" name="telephone" placeholder="Téléphone"><br><br>

<input type="text" name="adresse" placeholder="Adresse"><br><br>

<input type="text" name="cp" placeholder="Code Postal"><br><br>

<input type="text" name="ville" placeholder="Ville"><br><br>

<input type="submit" value="Valider">
</form>



<?php
// 5 - Insertion en base 
	
print '<pre>';
	print_r( $_POST );
print '</pre>';
echo "<hr>";

if( $_POST ){

	$_POST['adresse'] = addslashes( $_POST['adresse'] );
	$_POST['adresse'] = htmlentities( $_POST['adresse'] );

	$pdostatement = $pdo->prepare("INSERT INTO annuaire( nom, prenom, telephone, adresse, cp, ville )

			VALUES( :nom, :prenom, :telephone, :adresse, :cp, :ville )
			");

	
		$pdostatement->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR );
		$pdostatement->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR );
		$pdostatement->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_INT );
		$pdostatement->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR );
		$pdostatement->bindParam(':cp', $_POST['cp'], PDO::PARAM_INT );
		$pdostatement->bindParam(':ville', $_POST['ville'], PDO::PARAM_STR );

	$pdostatement->execute();

}

// 6 - Affichage du repertoire sous forme de tableau !!
//récupération les données que l'on souhaite afficher :

$pdostatement = $pdo->query(" SELECT * FROM annuaire ORDER BY nom ASC ");


	echo "<table border='1'>";
		echo "<tr>";

			$nombre = $pdostatement->columnCount();

			for( $i = 0; $i < $nombre; $i++ ){
				$champs = $pdostatement->getColumnMeta( $i );

				echo "<th> $champs[name] </th>";
			}

		echo "</tr>";

			while( $ligne = $pdostatement->fetch(PDO::FETCH_ASSOC ) ){

			$ligne['adresse'] = stripslashes( $ligne['adresse'] );
			$ligne['adresse'] = html_entity_decode( $ligne['adresse'] );

				echo "<tr>";
					foreach( $ligne as $value ){
						echo "<td> $value </td>";
					}
				echo "</tr>";
			}

	echo "</table>";

// 7 - bonus : ajout d'une colonne "suppression" 

		//Ici, je rajoute une cellule (colonne) 'suppression' dans la ligne d'en-tête
		
			//Ici, je rajoute une cellule (pour chaque ligne) pour avoir un lien de suppression où l'on va passer dans l'URL une information 'suppression' ET l'id de l'adhérent à supprimer

				//Ici, on rajoute un 'popup' à l'aide du JavaScript pour pouvoir donenr la possibilité d'annuler la suppression car les requêtes DELETE sont irreversibles et définitives.


//------------------------------------------------------------------------------------------------------------------

echo "<h2 style='background:#eee; text-align:center'> Correction </h2>";
?>

<?php
/* EXERCICE :
=> Création d'un repertoire :

	-- 1 - Création bdd 'repertoire'
	CREATE DATABASE repertoire;
	USE repertoire;

	-- 2 - Création table 'annuaire'(id_annuaire, nom, prenom, telephone, ville, code_postal, adresse)
	CREATE TABLE annuaire(
		id_annuaire int(3) NOT NULL auto_increment,
		nom varchar(20) NOT NULL,
		prenom varchar(20) NOT NULL,
		telephone int(10) UNSIGNED ZEROFILL NOT NULL, 
		adresse varchar(50) NOT NULL,
		ville varchar(20) NOT NULL,
		cp int(5) UNSIGNED ZEROFILL NOT NULL,
		PRIMARY KEY (id_annuaire)
	)ENGINE=InnoDB;
*/
// 3 - Connexion BDD
// $pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING) );

// 4 - formulaire d'enregistrement
?>
<!-- <form method="post">
	<label>Nom</label><br>
	<input type="text" name="nom"><br><br>
	
	<label>Prénom</label><br>
	<input type="text" name="prenom"><br><br>

	<label>Telephone</label><br>
	<input type="text" name="telephone"><br><br>

	<label>Adresse</label><br>
	<input type="text" name="adresse"><br><br>

	<label>Ville</label><br>
	<input type="text" name="ville"><br><br>

	<label>Code postal</label><br>
	<input type="text" name="cp"><br><br>

	<input type="submit" name="inscription" value="Inscription">
</form> -->
<?php

// 5 - Insertion en base 
// print '<pre>';
// 	print_r( $_POST );
// print '</pre>';

// if( $_POST ){

// 	$pdo->exec("INSERT INTO annuaire(nom, prenom, telephone, adresse, ville, cp) 

// 				VALUES( '$_POST[nom]', 
// 				'$_POST[prenom]', 
// 				'$_POST[telephone]', 
// 				'$_POST[adresse]', 
// 				'$_POST[ville]', 
// 				'$_POST[cp]' )
// 			");

// 	echo "<div style='background:#669933'>Inscription validée !</div>";
// }

// 6 - Affichage du repertoire sous forme de tableau !!
//récupération les données que l'on souhaite afficher :
// $pdostatement = $pdo->query(" SELECT * FROM annuaire ORDER BY nom ASC ");
	//var_dump( $pdostatement );

// echo "<h2>Il y a ". $pdostatement->rowCount() ." adhérent(s)</h2>";

// echo "<table border='2'>";
// 	echo "<tr>";

// 		for(  $i = 0; $i < $pdostatement->columnCount(); $i++ ){

// 			$colonne = $pdostatement->getColumnMeta( $i );
			// print '<pre>';
			// 	print_r( $colonne );
			// print '</pre>';

	// 		echo "<th> $colonne[name] </th>";
	// 	}

	// echo "</tr>";

	// while( $ligne = $pdostatement->fetch( PDO::FETCH_ASSOC ) ){

	// 	echo "<tr>";
			// print '<pre>';
			// 	print_r( $ligne );
			// print '</pre>';

// 			foreach( $ligne as $key => $value ){

// 				echo "<td> $value </td>";
// 			}

// 		echo "</tr>";
// 	}
// echo '</table>';



			//Ici, je rajoute une cellule (pour chaque ligne) pour avoir un lien de suppression où l'on va passer dans l'URL une information 'suppression' ET l'id de l'adhérent à supprimer
				//Ici, on rajoute un 'popup' à l'aide du JavaScript pour pouvoir donenr la possibilité d'annuler la suppression car les requêtes DELETE sont irreversibles et définitives.

// 				echo '<td>
// 				<a href="?action=suppression&id_annuaire='. $ligne['id_annuaire'] .'" onclick="return(confirm(\'En es-tu certain ?\') )" >
// 					Suppr
// 				</a>
// 			</td>';

// 	echo "</tr>";
// }
// echo '</table>';

// 7 - bonus : ajout d'une colonne "suppression" 
// print '<pre>';
// 	print_r( $_GET );
// print '</pre>';

// if( isset($_GET['action']) && $_GET['action'] == 'suppression' ){ //SI il y a une 'action' dans l'URL ET que cette action est égale à 'suppression'

	// $pdo->query("DELETE FROM annuaire WHERE id_annuaire = $_GET[id_annuaire] ");

	//redirection, ici vers la meme page Lire :https://www.php.net/manual/en/function.header.php
// 	header('location:repertoire.php');
// }



 if( !empty( $_POST['prenom'] ) ){ //SI c'est pas vide

 	if( strlen( $_POST['prenom'] ) < 20 ){ //Si la tailel de la chaine est inférieur à 20

		if( preg_match( "/[a-zA-Z]/" , $_POST['prenom'] ) ){

				echo "on est content ! <br>";
 		}
 		else{

// 			echo "error format";
// 		}
// 	}
// 	else{
// 		echo "error taille";
// 	}
// }
// else{

// 	echo "rempli le champ prénom";
// }


//----------------------------------------------

// echo "<hr><hr>";

// foreach( $_POST as $index => $valeur ){

// 	$_POST[$index] = htmlentities( addslashes( $_POST[$index] ) ) ;

// }

// $pdostatement = $pdo->prepare(" INSERT INTO annuaire(nom, prenom, telephone, adresse, ville, cp) 

// 								VALUES( :nom , 
// 										:prenom, 
// 										:telephone, 
// 										:adresse, 
// 										:ville, 
// 										:cp 
// 									)
// 								");
// 	//justification des marqueurs :
// 	$pdostatement->bindParam( ':nom', $_POST['nom'], PDO::PARAM_STR );
// 	$pdostatement->bindParam( ':prenom', $_POST['prenom'], PDO::PARAM_STR );
// 	$pdostatement->bindParam( ':telephone', $_POST['telephone'], PDO::PARAM_STR );
// 	$pdostatement->bindParam( ':adresse', $_POST['adresse'], PDO::PARAM_STR );
// 	$pdostatement->bindParam( ':ville', $_POST['ville'], PDO::PARAM_STR );
// 	$pdostatement->bindParam( ':cp', $_POST['cp'], PDO::PARAM_INT );

// $pdostatement->execute();
// }

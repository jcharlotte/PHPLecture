<?php
/*
	-- 1 -- Creation d'une BDD : 'dialogue'

		CREATE DATABASE dialogue;
		USE dialogue;

	-- 2 -- Création d'une table : 'commentaire' (id_commentaire, pseudo, message, date_enregistrement)

		CREATE TABLE commentaire(
			id_commentaire INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			pseudo VARCHAR(20) NOT NULL,
			message TEXT NOT NULL,
			date_enregistrement DATETIME NOT NULL
		) ENGINE=InnoDB;
*/

// 3 - Connexion à la BDD : 'dialogue'
$pdo = new PDO('mysql:host=localhost;dbname=dialogue', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING) );

//var_dump( $pdo );

//4 - Création d'un formulaire (avec les champs adéquats)
?>
<form method="post">
	<label>Pseudo</label><br>
	<input type="text" name="pseudo"><br><br>

	<label>Message</label><br>
	<textarea name="message"></textarea><br><br>

	<input type="submit" value="Poster">
</form>

<?php

print "<pre>";
	print_r( $_POST );
print "</pre>";

//5 - Insertion des messages postés en bdd

if( $_POST ){ //SI il y a eu validation du formulaire

	// echo "Pseudo posté : $_POST[pseudo] <br>";
	// echo "Message posté : $_POST[message] <br>";

		//Insertion en BDD (MAIS PAS SECURISE !!)
		//$pdo->exec(" INSERT INTO commentaire( pseudo, message, date_enregistrement )VALUES( '$_POST[pseudo]', '$_POST[message]', NOW() ) ");

	//----------------------------------------------
	//addslashes() : permet d'accepter les apostrophes :
	$_POST['message'] = addslashes( $_POST['message'] );
	// 	echo $_POST['message'] . '<br>';

	//htmlentities() : converti les caractères spéciaux en entités HTML 
	$_POST['message'] = htmlentities( $_POST['message'] );
	// 	echo $_POST['message'] . '<br>';

	// //htmlspecialchars() : meme principe 
	//$_POST['message'] = htmlspecialchars( $_POST['message'] );
	// 	echo $_POST['message'] . '<br>';

		//strip_tags() : permet de supprimer les balises HTML et PHP 
		//$_POST['message'] = strip_tags( $_POST['message'] );

	//Préparation de la requête :
	$pdostatement = $pdo->prepare(" INSERT INTO commentaire( pseudo, message, date_enregistrement ) 

					VALUES( :pseudo, :message, NOW() )
				");
		//NOW() : fonction SQL qui retourne la date et l'heure courante

		//justification des marqueurs :
		$pdostatement->bindParam( ':pseudo', $_POST['pseudo'], PDO::PARAM_STR );
		$pdostatement->bindParam( ':message', $_POST['message'], PDO::PARAM_STR );

	$pdostatement->execute(); //exécution de la requête préparée
}

//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
	//Exemple de failles ( pour cet exemple mettre le point 5 en commantaire )

	// if( $_POST ){

	// 	$pdo->query(" INSERT INTO commentaire(pseudo, date_enregistrement, message) 

	// 					VALUES('$_POST[pseudo]', NOW(), '$_POST[message]' )
	// 			 ");
	// }

	//faille CSS :
	//<style>body{display:none;}</style>

	//faille SQL
	// ok');DELETE FROM commentaire;(

//------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
// 6 - Affichage des commentaires :

	//6.1 - récupération des données :
	$pdostatement = $pdo->query(" SELECT * FROM commentaire ORDER BY id_commentaire DESC ");
	//Ici, on récupère TOUTES les infos de la table 'commentaire' ordonnées par 'id_commentaire' dans l'ordre décroissant (le dernier id sera donc affiché en premier)

	//Affichage du nombre de message : 
	echo "Il y a " . $pdostatement->rowCount() . " messages.<br>";
	//rowCount() : retourne le nombre de ligné de résultat retournée par la requête

	//6.2 - affichage des commentaires :
	while( $commentaire = $pdostatement->fetch( PDO::FETCH_ASSOC ) ){

		// print "<pre>";
		// 	print_r( $commentaire );
		// print "</pre>";

		$commentaire['message'] = stripslashes( $commentaire['message'] );
		//stripslashes() : permet de supprimer les antislash 

		$commentaire['message'] = html_entity_decode( $commentaire['message'] );
		//html_entity_decode() : permet de décoder les entités HTML.

		//$commentaire['message'] = htmlspecialchars_decode( $commentaire['message'] );
		//htmlspecialchars_decode() : permet de décoder les entités HTML.

		echo "<div style='border: 1px solid'>";
			echo "<p>$commentaire[pseudo] - le $commentaire[date_enregistrement]</p>";
			echo "<p>$commentaire[message]</p>";
		echo "</div>";
	}
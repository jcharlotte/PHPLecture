<?php

// SQL : 4 requetes à savoir :

// CRUD 
// 	create		=> requête INSERT (insertion en bdd)
// 	update		=> requête UPDATE (modification en bdd)
// 	delete		=> requête DELETE (suppression en bdd)

// 	read		=> requête SELECT (lire/récupérer les infos en bdd)

//----------------------------------------------------------------
//----------------------------------------------------------------

/*	PDO : PHP DATA OBJECT : Représente une connexion entre PHP et un serveur de base de données.

=> EXEC() :

	=> INSERT, UPDATE, DELETE :
		exec() est utilisé pour la formulation de requêtes ne retournant pas de résulat !
		exec() renvoi le nombre de lignes affectées par la requêtes

	Valeur de retour : 
		ECHEC : false
		SUCCES : 1 (ce nombre varie selon le nombre d'enregisrement affecté par la requête)

//-------------------------------------------------------------------
=> QUERY() :

	=> SELECT : Au contraire d'exec(), query() est utilisé pour la formulation de requêtes retournant un ou plusieurs résultats.

	Valeur de retour :
		ECHEC : false
		SUCCES : PDOStatement (objet)

//-------------------------------------------------------------------
=> PREPARE() puis EXECUTE() :

	SELECT, INSERT, UPDATE, DELETE :
		
		prepare() : permet de préparer sans exécuter
		execute() : permet d'exécuter la requête préparée

	Valeur de retour : 
		prepare() : renvoie TOUJOURS un PDOStatement (objet)
		execute() : ECHEC : false
					SUCCES : PDOStatement

=> Les requêtes préparées sont à préconiser si vous exécuter plusieurs fois la même requête et ainsi éviter de répéter le cycle (analyse/interprétation/exécution)
=> Les requêtes préparées sont souvent utilisées pour assainir les données (ex : prepare() / bindValue() / execute() )

exemple : pourquoi requêtes préparées :

	select * from employes; => 3cycles (analyse/interprétation/exécution)
	select * from employes; => 3cycles
	select * from employes; => 3cycles
	select * from employes; => 3cycles => 12 cycles 

	prepare : $req = select * from employes; => 2cycles (analysée et interprétée)

		-> execute($req); 1cycle (exécution)
		-> execute($req); 1cycle
		-> execute($req); 1cycle
		-> execute($req); 1cycle => 6 cycles
*/
//-------------------------------------------------------------------


echo "<h2>Connexion à la BDD</h2>";

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '',

                array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8" )
            );


// Ici, l'objet $pdo représente la connexion à la BDD (ici, 'entreprise')

// Argument de PDO :
    // arg1 : serveur + bdd
    // arg2 : identifiant
    // arg3 : mot de passe
    // arg4 : option (ici, la gestion des erreurs et encodage utf8)


var_dump( $pdo );

print '<pre>';
    print_r( get_class_methods( $pdo ) );
    // get_class_methods( $object ) : permet d'afficher les méthodes d'un objet
print '</>';


//-------------------------------------------------------------------

echo "<h2 style='background:#eee'>Exec() / INSERT / UPDATE / DELETE </h2>";

// INSERTION :

//$resultat = $pdo->exec(" INSERT INTO employes(prenom, nom, sexe, service, date_embauche, salaire) 

//                             VALUES( 'jean', 'jacques', 'm', 'informatique', '2021-01-01', 2222 )
//                         ");

    // Ici, on fait une insertion dans la table 'employes' pour les champs (nom, prenom, sexe, etc.) avec les valeurs correspondantes à insérer.

    // On applique la méthode exec() via l'objet '$pdo', qui représente la connexion à la BDD.


// echo "Nombre d'enregistrements affectés par la requête : $resultat <br>";

// echo "Dernier id généré :" . $pdo->lastInsertId() . '<br>';

//-------------------------------------------------------------------


// UPDATE :

$pdo->exec(" UPDATE employes SET salaire = 3434, nom = 'Jacques', prenom = 'Jean' WHERE id_employes = 991 ");
            // Ici, je modifie la table 'employes' et plus précisément  la colone 'salaire' A CONDITION que l'id-employes soit égale à 991


$pdo->exec(" DELETE FROM employes WHERE id_employes = 991 ");
            // Ici, je supprime de ma table 'employes', l'employé qui a l'id_employes 991


//-------------------------------------------------------------------


echo "<h2 style='background:#eee'>Query() / SELECT / fetch() </h2>";

$pdostatement = $pdo->query(" SELECT * FROM employes WHERE prenom = 'Emilie' ");
            // Ici, je sélectionne toutes (*) les infos provenant de la table 'employes' A CONDITION que dans la colone 'prenom' ce soit égale à 'Emilie'

var_dump( $pdostatement );


print '<pre>';
    print_r( get_class_methods( $pdostatement ) );
print '</>';


//-------------------------------------------------------------------

$emilie = $pdostatement->fetch( PDO::FETCH_ASSOC );
        // fetch() : permet de récupérer les résultats issus de la requête et de les exploiter

print '<pre>';
    print_r( $emilie );
print '</>';

echo " <p> Bonjour, je suis $emilie[prenom] $emilie[nom] du service $emilie[service] </p>";

foreach ( $emilie AS $champs => $valeur ) {
    echo "$champs : $valeur <br>";
}

//-------------------------------------------------------------------

echo "<h2 style='background:#eee'>Query() / SELECT / fetch() / while() </h2>";

$pdostatement = $pdo->query(" SELECT * FROM employes ");

var_dump( $pdostatement );

echo "<p>Nombre d'employés : " . $pdostatement->rowCount() . "</p>";
    // rowCount() : permet de compter le nombre de lignes retournées par la requête

$contenu = $pdostatement->fetch( PDO::FETCH_ASSOC );


while ($contenu = $pdostatement->fetch( PDO::FETCH_ASSOC ) ){
// TANT QU'il y a une ligne de résultat (retourné par le fetch() ), on l'affiche

    // print '<pre>';
    //     print_r( $contenu );
    // print '</pre>';

    echo "<p style='border-bottom:1px solid'> $contenu[prenom] $contenu[nom] </p>";
}

//Ici, il n'y a pas un array avec tous les enregistrements MAIS bien UN array pou CHAQUE enregistrement (par employé)

	//requête qui retourne plusieurs résultats => boucle
	//requête qui ne retourne qu'UN seul résultat => pas de boucle
	//requête qui retourne un seul résultat MAIS potentiellement plusieurs => boucle


//-------------------------------------------------------------------

echo "<h2 style='background:#eee'>Query() / SELECT / fetchAll() / foreach() </h2>";

$pdostatement = $pdo->query(" SELECT * FROM employes ");

var_dump( $pdostatement );

$donnees = $pdostatement->fetchAll( PDO::FETCH_ASSOC );

print '<pre>';
    print_r( $donnees );
print '</pre>';

echo '<hr>';

foreach( $donnees AS $contenu ){


    echo "<div style='border-bottom:1px solid'>";
        foreach( $contenu AS $index => $valeur ){
    
            echo "$valeur /";
        }
    echo "</div>";
}

//-------------------------------------------------------------------

echo "<h2 style='background:#eee'>Query() / SELECT / fetch() / while() => Affichage sous forme de tableau </h2>";

$pdostatement = $pdo->query( " SELECT * FROM employes ");




echo "<table border='2'>";
echo "<tr>";

    $nombre = $pdostatement->columnCount();
    // columnCount : retourne le nombre de colonnes issues du jeu de résultats de la requête
    // echo $nombre;

    for( $i = 0; $i < $nombre; $i++ ){
        $champs = $pdostatement->getColumnMeta ( $i );

        echo "<th> $champs[name] </th>";
    }

echo "</tr>";

    while( $ligne = $pdostatement->fetch(PDO::FETCH_ASSOC ) ){

        echo "<tr>";
            foreach( $ligne as $value ){
                echo "<td> $value </td>";
            }
        echo "</tr>";
    }

echo "</table>";


//-------------------------------------------------------------------

echo "<h2 style='background:#eee'> prepare() -> bindValue() -> execute() </h2>";

$pdostatement = $pdo->prepare(" SELECT * FROM employes WHERE nom = :nom ");
// préparation de la requête
    // :nom : est un marqueur nominatif
// var_dump( $pdostatement );

$nom = "Winter";

$pdostatement->bindValue( ":nom", $nom, PDO::PARAM_STR );
//bindValue(arg1, arg2, arg3 ) : reçoit une variable soit une chaine de caractères en jsutification d'un marqueur
	//arg1 : marqueur nominatif
	//arg2 : justification du marqueur
	//arg3 : justification du paramètre attendu (ici, STRING)

$pdostatement->execute();

$winter = $pdostatement->fetch( PDO::FETCH_ASSOC );

print '<pre>';
    print_r( $winter );
print '</pre>';
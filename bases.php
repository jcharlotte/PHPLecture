<!-- On peut écrire du HTML dans un fichier l'extension .php MAIS l'inverse n'est pas possible -->
<style>
	h1{text-align: center;}
	h2{
		color: orange;
		background: black;
		text-align: center;
	}
</style>

<h1>Bases PHP</h1>

<h2>Ecriture et affichage</h2>


<?php //balise ouvrante d'un passage PHP

    // Ici, on ouvre un passage PHP pour y faire des traitements PHP.

    /*
    commentaire 
    sur plusieurs
    lignes
     */

?> <!-- balise fermante php -->


<?php 
    
echo 'Bonjour tout le monde!'; // 'echo' est une instruction uqi permet de faire un affichage

print "<br><strong>Salut!</strong>"; // 'print' est aussi une instruction qui permet d'effectuer un affichage

    // On peut y mettre des balises HTML qui seront interprétées par le navigateur

?>

<?php echo '<br> Hello <br>'; // affichage ?>

<?= 'coucou'; // Ici, le '=' remplace le 'php echo' ?>


<h2>Les variables : types, déclaration et affectation</h2>

<?php
// Une variable : est un espace nommé qui permet de conserver une ou plusieurs valeurs
// déclaration d'une variable avec le symbole $ ! Par convention, on ne doit pas nommer de variable en commençant par un underscore ou un chiffre !

$a = 345;

echo $a; // Affichage du contenu de la variable $a
echo ' est : ' . gettype( $a ) . '<br>'; //gettype() : fonction prédéfinie de PHP qui permet de connaitre le type d'une variable, ici, integer

$a = "Chaîne de caractères";
echo $a;
echo ' est : ' . gettype($a) . '<br>'; // string

$a = "'123'";
echo $a;
echo ' est : ' . gettype($a) . '<br>'; // string

$a = 1.425;
echo $a;
echo ' est : ' . gettype($a) . '<br>'; // double (chiffre à virgule)

$a = true;
echo $a;
echo ' est : ' . gettype($a) . '<br>'; // boolean


// --------------------------------------------------------------------------------------------------------------
echo "<h2>La concaténation</h2>";


$x = "Bonjour";
$y = 'tout le monde';

echo $x . ' => ' . $y . '<br>';                     // On concatène  des chaînes de caractères avec des variables ou des fonctions interne de PHP avec le symbole '.'


// Les doubles quotes (guillements) permettent d'interpréter les variables ALORS que les quotes simples (apostrophes) n'interprétent pas les variables et renverra une chaîne de caractères

echo 'Avec les quotes : $x $y <br>';                // Ici, affiche : $x $y, les variables NE SONT PAS interprétées
echo "Avec les doubles quotes : $x $y <br>";        // Ici, affiche : Bonjour tout le monde, les variables SONT interprétées

echo '<strong>' , $x , "</strong>";                 // Autre syntaxe possible pour la concaténation avec le symbole ','



// --------------------------------------------------------------------------------------------------------------
echo "<h2>La concaténation lors de l'affectation</h2>";


$prenom = 'Marco';
echo $prenom . '<br>';

$prenom = 'Polo';
echo $prenom . '<br>';

$pseudo = 'Anne';
echo $pseudo . '<br>';

$pseudo .= '-Marie';            // Affectation de la valeur '-Marie' sur la variable '$pseudo' MAIS cela s'ajoute SANS remplacer la valeuyr précédente grâce à l'opérateur : '.='
echo $pseudo . '<br>';



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Les constantes et les constantes magiques</h2>";


// Une constante : est un espace nommé qui permet de conserver une valeur SAUF QUE, comme sont nom l'indique, la valeur sera constante !

define('CAPITALE', 'Paris');    // Par convention, une constante se déclare TOUJOURS en MAJUSCULES
// define (arg1, arg2);
    //arg1 : nom de la constante (MAJUSCULE)
    //arg2 : valeur de la constante
echo CAPITALE . '<br>';

//Constantes magique :

echo __FILE__ . '<br>';         // chemin vers le fichier courant
echo __LINE__ . '<br>';         //  affiche le numéro de la ligne courante
echo __DIR__ . '<br>';          // chemin vers le dossier courant



// --------------------------------------------------------------------------------------------------------------
echo "<h2>EXERCICES</h2>";


$bleu = 'bleu';
$blanc = 'blanc';
$rouge = 'rouge';

echo "$bleu - $blanc - $rouge";



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Opérateurs arothmétiques</h2>";


$a = 10;
$b = 2;

echo $a + $b . '<br>';      //12
echo $a - $b . '<br>';      //8
echo $a * $b . '<br>';      //5
echo $a / $b . '<br>';      //20


// Opérations et Affectation :

$a += $b;                   // équivaut : $a = $a + $b
echo $a . '<br>';           //12

$a -= $b;
echo $a . '<br>';

$a *= $b;
echo $a . '<br>';

$a /= $b;
echo $a . '<br>';



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Structures conditionnelles (if/else)</h2>";


// isset() et empty()

    //isset() : test si ça existe (si c'est défini)
    //empty() : teste si c'est vide (0 ou non défini)

$vara = 0;
$varb = '';

if( empty($vara)){ // Si la variable $vara est vide, 0 ou non défini
    echo "vara : 0, vide ou non définie <br>";
}

if( isset($varb)){ // Si la variable $vara est vide, 0 ou non défini
    echo "varb : elle existe et est définie par rien <br>";
}


$a = 10;
$b = 5;
$c = 2;


if( $a > $b ) {
    echo "A est supérieur à B <br>";
}else{
    echo "Faux : A n'est pas supérieur à B <br>";
}

// => ET : &&
if( $a > $b && $b > $c) { // SI $a est supérieur à $b - ET - $b est supérieur à $c alors j'éxécute le code entre les accolades
    echo "Ok pour les deux conditions <br>";
}

// => OU : ||

if ( $a == 9 || $b > $c){ //SI $a (10) est égal à 9 - OU - que $b (5) est supérieur à $c (2)

	echo "Ok pour au moins une des deux conditions <br>";
}

// => XOR : SEULEMENT une des deux conditions doit être vraie !

if( $a == 1 XOR $b == 5) {
    echo "Ok pour une condition EXCLUSIVE <br>";
}

if ($a ==8){
    echo "1 - A est égale à 8 <br>";
}elseif($a != 10){
    echo "2 - A est différent de 10 <br>";
}else{
    echo '3 - Tout est faux! <br>';
}

// Version ternaire : forme contractée

echo ( $a == 10 ) ? 'A est égal à 10 <br>' : 'FAUX<br>';
// Ici, le '?' remplace le 'if' et le ':' remplace le 'else'

// EXACTEMENT la même chose que la condition ci-dessus:
if ($a == 10){
    echo 'A est égal à 10 <br>';
}
else {
    echo "FAUX <br>";
}

// Comparaison

$vara = 1;
echo '$vara est un ' . gettype($vara) . '<br>';

$varb = '1';
echo '$varb est un ' . gettype($varb) . '<br>';

if ($vara == $varb){
    echo "Il s'agit de la même chose car la valeur est la même <br>";
}

if ($vara === $varb){
    echo "Il s'agit de la même chose car la valeur est la même <br>";
}else{
    echo "Il ne s'agit pas de la même chose car le type est différent <br>";
}

/*
Avec le '===', le test ne fonctionne pas car les types des variables sont différents. L'un est un entier (INT) et l'autre est une chaine (STRING) donc ce n'est pas strictement égal !

	'='		: affectation
	'=='	: comparaison en valeur
	'==='	: comparaison en valeur ET en type
*/



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Condition SWITCH</h2>";


$couleur = 'jaune';

switch( $couleur ){

    case 'bleu' :
        echo "Vous aimez le bleu <br>";
    break;

    case 'rouge' :
        echo "Vous aimez le rouge <br>";
    break;

    case 'vert' :
        echo "Vous aimez le vert <br>";
    break;

    default :       // Cas par défaut si on ne rentre pas dans les cas précédents
        echo "Vous n'aimez pas la couleur <br>";
    break;
}

// --------------------------------------------------------------------------------------------------------------
echo "<h2>EXERCICE</h2>";


// Transcrire le SWITCH en IF/ELSE

$couleur = 'red';

if( $couleur === 'blue'){
    echo "You picked blue";
}elseif( $couleur === 'yellow'){
    echo "You picked yellow";
}else {
    echo "You didn't pick a color <br>";
}


if( $couleur === 'blue' || $couleur === 'yellow' || $couleur === 'green'){
    echo "You picked $couleur";
}else {
    echo "You should pick a color <br>";
}



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Fonctions prédéfinies</h2>";


echo 'Date :' . date("d/m/Y") . '<br>';     // Majuscule et Minuscule ont une importance pour Day Month et Year. Voir : https://www.php.net/manual/en/datetime.format.php


$mail = 'charlotte@webforce.com';

echo strpos( $mail, "@") . '<br>'; 
// strpos(arg1, arg2) : indique la position d'un caractère dans une chaîne
    // arg1 : la chaîne à parcourir
    // arg2 : ce que l'on cherche

    // => Attention, on commence à compter à partir de ZERO !

$phrase = 'Voici ma phrase';

echo strlen( $phrase) . '<br>';
// strlen( arg ) : retourne la taille d'une chaîne
    // arg : la chaîne où l'on veut connaître le nombre de caractère



$texte = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi mollitia quam eum cupiditate ad necessitatibus? Rem, cum animi eligendi, distinctio saepe odio, porro maxime ipsa labore doloremque commodi repellendus tenetur.
Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quam ad nostrum, consequatur quasi aut vero atque. Illo at recusandae veniam velit voluptatem maiores aliquid error, quisquam assumenda iusto nemo. Explicabo.";

echo substr( $texte, 0, 20 ) . "... <a href='#'>Lire la suite </a> <br>";
// substr (arg1, arg2, arg3) : permet de retourner une partie d'une chaîne
    // arg1 : la chaîne que l'on souhaite couper
    // arg2 : la position de départ (où on commence)
    // arg3 : la longueur de la découpe



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Fonctions utilisateurs</h2>";


function separation(){          // déclaration d'une fonction nommée 'séparation' prévue pour ne pas recevoir d'argument car les parenthéses (OBLIGATOIRES) sont vides
    echo"<hr><hr><hr>";         // Ici, entre les accolades, les instructions à éxécuter lors de l'appel de la fonction
}

separation();                   // appel et éxécution de la fonction


function bonjour( $qui ){       // fonction prévue pour recevoir un argument, ici : $qui
    return "Bonjour $qui <br>";
}

echo bonjour( 'Marco');
// Si la fonction est prévue pour recevoir un argument ALORS il faut lui envoyer un argument en paramètre sinon, on a une ERROR FATAL.
// Quand il y a un 'return' dans la fonction, il faut faire un 'echo' de la fonction pour avoir un affichage !


function jourSemaine(){
    $jour = 'Mardi';            // variable LOCALE
    return $jour;               
    echo "YO ! <br>";           // cette ligne de code ne fonctionnera pas car il y a un return juste avant et donc, elle ne sera pas interprétée car on a déjà quitté la fonction
}

echo jourSemaine() . '<br>';    // affichage et appel de la fonction pour l'éxécuter

//echo $jour; // error 'undefined' car elle n'est pas définie dans l'espace global des traitements php MAIS uniquement dans le scop (espace local) de la fonction


$pays = 'France';

function affichePays(){
    global $pays;               // Le echo qui suit ne fonctionnerait pas si nous n'avions pas mis le mot clé "global" qui permet d'importer tout ce qui est déclaré dans l'espace globale à l'intérieur d'un espace local, ici, le scope de la fonction
    echo $pays;
}

affichePays();



// --------------------------------------------------------------------------------------------------------------
echo "<h2>EXERCICE</h2>";
// Exercice : créer une fonction TVA qui attendra deux arguments (le chiffre, le taux) afin que l'on puisse calculer un nombre avec un taux de notre choix
//bonus : mettre un taux par défaut (1.2)

function TVA($ht, $taxes = 1.2){
    return "Prix : " . $ht * $taxes . " € TTC <br>";
}

echo TVA(10);


//Exercice :  Créer une fonction meteo avec 2 arguments (temperature et la saison) qui permet d'afficher une phrase :
	//"Nous sommes en saison et il fait temperature degrés<br>";
    function meteo( $temperature, $saison ){

        echo "Nous sommes en $saison et il fait $temperature degrés<br>";
    
        //echo " Nous sommes en ". $saison ." et il fait ". $temperature ." degrés.<br> ";
    }
    
    meteo( -1, "hiver" );
    meteo( 45, "printemps" );
    echo '<hr>';
    //Exercice : Gérer l'article 'au' SI la saison est 'printemps' et gérer le 's' de degré SI on est strictement au dessus de 2° ou en dessous de -2° : ]-2°; 2°[
    function meteo2( $saison, $temperature ){
    
        if( $saison == 'printemps' ){ //SI la saison est égale à 'printemps' , alors je crée une variable avec la valeur 'au'
    
            $article = ' au ';
        }else{ //SINON , je crée une variable avec la valeur 'en' (si c'est automne, hiver, ete)
    
            $article = ' en ';
        }
        //version ternaire :
        //( $saison == 'printemps' ) ? $article = ' au ' : $article = ' en ';
    
        if( $temperature >= 2 || $temperature <= -2 ){ //SI la temperature est strictement supérieure à 2° OU que la temperature est strcitement inférieure à -2, alors je déclare une variable avec un "s"
    
            $degre = ' degrés';
        }
        else{ //SINON, on se trouve dans l'interval ]-2:2], on déclare une variable sans "s"
            $degre = ' degré';
        }
        //version ternaire :
        //( $temperature >= 2 || $temperature <= -2 ) ? $degre = ' degrés' : $degre = ' degré';
    
        echo "Nous sommes $article $saison et il fait $temperature $degre<br>";
    }
    
    meteo2( "hiver", 1 );
    meteo2( "printemps", 12 );
    meteo2( "printemps", -1.5 );
    meteo2( "ete", 35 );
    meteo2( "automne", 1.3 );


//Les opérateurs : Pour tester les variables, on peut utiliser TOUS les opérateurs de comparaison !
/*
	- égalité : '==' renvoie TRUE si les opérandes sont égales
	- différent de : '!=' renvoie TRUE si les opérandes NE SONT PAS EGALES
	- strictement égal : '===' renvoie TRUE si les opérandes sont EGALES ET DU MEME TYPE
	- strictement différent : '!==' renvoie TRUE si les opérandes NE SONT PAS EGALES OU NE SONT PAS DU MEME TYPE
	- plus grand que : '>'
	- plus grand ou égal à : '>='
	- plus petit que : '<'
	- plus petit ou égal à : '<='

Les instructions dans la condition renvoient toujours TRUE ou FALSE et les instructions de la condition ne seront exécutées QUE si la valeur renvoie TRUE !
*/



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Structures itératives : les boucles</h2>";

//Une boucle : permet de répéter une portion de code tant qu'une condition est réalisée

//boucle WHILE :
$i = 0; //initialisation

while( $i < 5 ){ // TANT QUE $i est inférieur à 5, on exécute le code entre les accolades

	echo "$i => ";

	$i++; //incrémentation : $i++ <=> $i = $i + 1

}

//resultat : 0 => 1 => 2 => 3 => 4 =>
echo "<hr>";

//Exercice : Enlever la flêche à la fin 
	//resultat : 0 => 1 => 2 => 3 => 4

    $i = 0; 
    while( $i < 5 ){
        
        if($i == 4){

        echo "$i <br>";
        }else{

            echo "$i =>";
        }
        $i++;
    }


// Boucle FOR : va répéter un nombre de fois défini les instructions entre les accolades

// A la différence dune boucle while() qui va répéter indéfiniment les instructions TANT QUE la condition n'est pas réalisée !
    // Si l'on doit une boucle MAIS que l'on ne sait pas combien de fois, on va passer dans la boucle, on utilisera alors une boucle WHILE().

for( $i = 0; $i < 11; $i++){ // initialisation; condition; incrémentation

    //Ici, on a 10 tours de boucle
	//Initialisation : On commence a 1 (puisque $i a été initialisé à 1) 
	//Condition : La boucle s'arrête quand $i sera égal à 11 
	//Incrémentation : On augmente de +1 ($i++)

    echo $i . '<br>';
}

//EXERCICE : Afficher un select avec 31 options via une boucle for dans le sens INVERSE. Pour affiche les jours allant de 31 à zero ! 

echo "<select>";

for( $i = 31; $i > 0; $i--){

    echo "<option> $i </option>";
}

echo "</select>";


//EXERCICE : affichez les numéros allant de 1 à 10 dans un tableau ET sur une seule ligne
echo "<table border='1'>";
	echo "<tr>";

		for( $i = 1; $i < 11; $i++ ){ //10 tours de boucle

			echo "<td> $i </td>";
		}

	echo "</tr>";
echo "</table>";

echo "<hr>";
//Exercice : (boucles imbriquées) créer un tableau avec 10 lignes contenant 10 cellules allant de 1 à 100
/*
1  | 2  | 3  | 4  | 5  | 6  | 7  | 8  | 9  | 10 |
11 | 12 | -  | -  | -  | -  | -  | -  | -  | 20 |
21 | -  | -  | -  | -  | -  | -  | -  | -  | 30 |
31 | -  | -  | -  | -  | -  | -  | -  | -  | 40 |
41 | -  | -  | -  | -  | -  | -  | -  | -  | 50 |
51 | -  | -  | -  | -  | -  | -  | -  | -  | 60 |
61 | -  | -  | -  | -  | -  | -  | -  | -  | 70 |
71 | -  | -  | -  | -  | -  | -  | -  | -  | 80 |
81 | -  | -  | -  | -  | -  | -  | -  | -  | 90 |
91 | 92 | 93 | 94 | 95 | 96 | 97 | 98 | 99 | 100|
*/

$numero = 1; //initialisation

echo "<table border='1'>";
	for( $i = 1; $i < 11; $i++ ){ //10 tours de boucle

		echo "<tr>";

			for( $j = 1; $j < 11; $j++ ){ //10 tours de boucle

				echo "<td> $numero </td>"; //Ici, on affiche la variable $numero
				$numero++; //incrémentation : on rajoute +1 à notre variable $numero après avoir créer et afficher sa valeur dans une cellule
			}
		echo "</tr>";
	}
echo "</table><hr>";

//------------------------------------------
//Autre méthode :
echo "<table border='1'>";

	for( $ligne = 0; $ligne < 10; $ligne++ ){ //10 tours de boucle

		echo "<tr>";

			for( $cellule = 1; $cellule < 11; $cellule++ ){ //10 tours de boucle

				echo "<td>". ( 10*$ligne + $cellule ) ."</td>";
	
				//1er tour de boucle : $ligne = 0
					//1er tour 2ème boucle : $cellule = 1
						// -> 10 * 0 + 1 = 1
					//2e tour 2ème boucle : $cellule = 2
						// -> 10 * 0 + 2 = 2 .....
	
				//2e tour de boucle : $ligne = 1
					//1er tour 2ème boucle : $cellule = 1
						// -> 10 * 1 + 1 = 11
					//2e tour 2ème boucle : $cellule = 2
						// -> 10 * 1 + 2 = 12 .....			
			}
		echo "</tr>";
	}
echo "</table><hr>";

//------------------------------------------
//Autre methode :
echo '<table border="1">';
	$i = 1;
	while($i <= 100){
	    echo '<tr>';
		    for($c = 1; $c <= 10 ; $c++){ // 10 tours de boucle

		        echo "<td>$i</td>";
		        $i++;
		    }
	    echo '</tr>';
	}
echo '</table><hr>';

//------------------------------------------
//EMMA version
echo "<table border=1>";
	echo "<tr>";

		for($i = 1 ; $i < 101; $i++){ //100 tours de boucle

		    echo "<td>$i</td>";

		    if ( ($i % 10) == 0 ){

		        echo "</tr><tr>";
		    }
		}

	echo "</tr>";
echo "</table>";



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Les arrays et la boucle FOREACH</h2>";
// la boucle foreach() : FONCTIONNE UNIQUEMENT avec des tableaux ou des objets. Elle retournera une erreur si l'on tente de l'éxécuter sur une variable autre qu'un array (ou objet)

// foreach() : permet de passer en revu les données d'un tableau :


$tableau = ['pomme', 'peche', 'poire'];

$tableau[] = 'cerise'; // Ici, on ajoute une valeur à la fin de notre tableau nommé $tableau

// echo $tableau; // ERROR ! Impossible, on ne peut pas afficher un tableau tel quel, il faut parcourir les données du tableaux pour les afficher.


echo"<pre>";
    var_dump( $tableau );
    echo "<hr>";
    print_r( $tableau );
echo "</pre>";

echo $tableau[3] . '<br>';


// Affichage de TOUTES les infos du tableau :

for( $i = 0; $i < 4; $i++ ){ // 5 tours de boucle

	echo "valeur de i : $i  => ";

	echo $tableau[$i] . ' <br>';
}

// count() et sizeof() : permettent de renvoyer la longueur d'un tableau

echo 'Taille du tableau : ' . count($tableau) . '<br>';
echo 'Taille du tableau : ' . sizeof($tableau) . '<br>';


// Affichage de toutes les infos du tableau de manière dynamique même si l'on rajoute des éléments à notre tableau, toutes les infos seront parcourues :

$tableau[] = 'nouvelleInfo';

for( $i = 0; $i < sizeof($tableau); $i++){

    echo "valeur de i : $i  => ";

	echo $tableau[$i] . ' <br>';
}


//Possibilité de choisir les indice d'un tableau et de passer par la fonction array()
$couleur = array(
    'j' => 'jaune', 
    'r' => 'rouge', 
    'v' => 'vert'
);

print '<pre>';
print_r( $couleur );
print '</pre>';

//Affiche la couleur rouge :
echo $couleur['r'] . '<br>';

//Foreach() : permet de parcourir un tableau (ici, indispensable car les indices du tableaux ne sont pas numériques)
foreach( $couleur as $indice => $valeur ){

echo "Indice : $indice et sa valeur : $valeur <br>";

//version concaténation :
//echo "Indice : ". $indice . " et sa valeur : " . $valeur . "<br>";
}
//Le mot clé "as" est OBLIGATOIRE ! Il fait parti de la boucle foreach.

//SI il y a DEUX variables en arguments après le mot clé "as", le premier (ici, $indice) parcours la colonne des indices et le second (ici, $valeur) parcours la colonne des valeurs.

//SI il n'y a QU'UNE seule variable après le mot clé "as", alors cette variable représentera la colonne des valeurs.
echo '<hr>';
foreach( $couleur as $value ){

echo $value . '<br>';
}

echo '<hr>';
//Autre syntaxe : (ici, on va parcourir le tableau : $tableau )
//Ici, l'accolade ouvrante est remplacée par les deux points ':' et l'accolade fermante par 'endforeach'
foreach( $tableau as $fruit ) :

echo $fruit . ' / ';

endforeach;

//----------------------------------------------------------------------------------------------------
echo "<h2> Les arrays multidimentionnels </h2>";

//les arrays multi sont des tableaux imbriqués dans un autre tableau 

$multi = array( 
    0 => array('prenom' => 'marco', 'nom' => 'polo'), 
    1 => array('prenom' => 'bob', 'nom' => 'dylan'), 
    2 => array('prenom' => 'jean', 'nom' => 'jacques')
 );

print '<pre>';
print_r( $multi );
print '</pre>';

//affiche 'dylan' :
echo $multi[1]['nom'] . '<br>';
echo '<hr>';
//Exercice : Parcourir toutes les infos du tableau ($multi) mes tableaux imbriqués grâce a des boucles foreach :

    foreach( $multi as $value){
       
        foreach( $value as $value2){
            echo $value2 . '<br>';
        }
       
    }



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Les objets</h2>";
// Les objets sont un autr type de données. Un peu à la manière des arrays, il permet de regrouper des informations.
// Ici, on parlera de propriétés (=variables) et de méthodes (=foncitons)

class Etudiant{         // Une class est un constructeur d'objt

    public $prenom = 'Charlotte';
    // 'public' : permet de dire que la propriété est accessible partout
        // Il existe aussi : 'protected' et 'private'

    public $age = 45;

    public function pays(){

        return 'France';
    }
}


// Un objet est un conteneur symbolique qui possède sa propre existence et incorpore des informations et des mécanisme


$etudiant1 = new Etudiant();
// Le mot clé "new" permet d'instancier (déployer) la classe et d'en faire un objet. On se servira de ce qu'il y a à l'intérieur de la classe via l'objet.


print '<pre>';
    var_dump( $etudiant1 );
    print_r( $etudiant1 );
print '</pre>';

// Affiche le prénom (ici : 'Charlotte')
echo $etudiant1->prenom . '<br>';
//Dans un array, on va piocher les informations avec des crochets [] alors que pour les objets, on utilise la fleche '->' pour accéder aux informations de la classe.

//affichage de l'age :
echo $etudiant1->age . '<br>';

print '<pre>';
	print_r( get_class_methods( $etudiant1 ) );
	//get_class_methods() : fonction qui permet de voir les méthodes disponibles d'un objet
print '</pre>';

echo $etudiant1->pays(); //appel d'une méthode toujours avec des parenthèses



// --------------------------------------------------------------------------------------------------------------
echo "<h2>Les inclusions</h2>";

echo "Première fois : <br>";
include "exemple.inc.php"; 

echo "Deuxième fois : <br>";
include_once "exemple.inc.php"; //le "once" permet de vérifier si le fichier a déjà été inclus ET si c'est la cas, on ne le ré-inclus pas.


echo "<hr>Première fois : <br>";
require "exemple.inc.php"; 

echo "Deuxième fois : <br>";
require_once "exemple.inc.php"; //le "once" permet de vérifier si le fichier a déjà été inclus ET si c'est la cas, on ne le ré-inclus pas.

//Différence entre 'include' et 'require' :
	//include : fait une erreur et CONTINUE l'exécution du script
	//require : fait une erreur et STOP l'exécution du script

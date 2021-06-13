<?php 
//Création/ouverture du fichier de session :
session_start();

//------------------------------------------------------------------------------------------
// Connexion à la BDD :
$pdo = new PDO('mysql:host=localhost;dbname=team', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8") );

//------------------------------------------------------------------------------------------
// Définition d'une constante :
define( 'URL', 'http://localhost/PHP/preparation/' );

//------------------------------------------------------------------------------------------
// Définition de variables :
$content = '';      // variable prévue pour recevoir le contenu
$error = '';        // variable prévue pour recevoir les messages d'erreurs

//------------------------------------------------------------------------------------------
// Inclusion du fichier fonction.inc.php 
require_once "fonction.inc.php";
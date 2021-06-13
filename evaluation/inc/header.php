<?php session_start();

//------------------------------------------------------------------------------------------
//Connexion à la BDD :
$pdo = new PDO('mysql:host=sql302.epizy.com;dbname=epiz_28398614_wf3_php_intermediaire_charlotte', 'epiz_28398614', '0nQksqY2wgPYluz', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::
MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8") );

//------------------------------------------------------------------------------------------
define( 'URL', 'http://charlottejanis.rf.gd/evaluation/' );

$content = '';

//------------------------------------------------------------------------------------------
function debug( $arg ){

  echo "<div style='background:#fda500; z-index:1000; padding:15px'>";

      $trace = debug_backtrace();
      //debut_backtrace() : fonction interne de php qui retourne un array avec des infos à l'endroit où l'on fait appel à elle

      echo "Debug demandé dans le fichier : " . $trace[0]['file'] . " à la ligne " . $trace[0]['line'];

      print '<pre>';
          print_r( $arg );
      print '</pre>';
  echo "</div>";
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Bon Appart</title>

    <!-- CDN BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- CDN FONT AWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>


<body>
    
    <header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo URL ?>index1.php">Le Bon Appart</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo URL ?>index1.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL ?>ajout.php">Ajouter une annonce</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL ?>liste-annonces.php">Consulter toutes les annonces</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    </header>


    <main>
      <div class="container">
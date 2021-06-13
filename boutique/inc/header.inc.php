<?php require_once "init.inc.php";  // Inclusion du fichier init.inc.php dans le header ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site boutique</title>

    <!-- CDN BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- CDN FONT AWESOME-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    
</head>



<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo URL ?>index1.php">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php echo URL ?>index1.php">Accueil</a>
        </li>

      <?php if(userConnect() ) : // Si l'internaute est connecté, on affiche les liens profil et déconnexion?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL ?>profil.php">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL ?>connexion.php?action=deconnexion">Déconnexion</a>
          <!-- la déconnexion sera gérée sur la page connexion.php -->
        </li>

      <?php else : // Sinon, c'est que l'on est pas connecté et donc on affiche les liens inscription et connexion ?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL ?>inscription.php">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URL ?>connexion.php">Connexion</a>
        </li>

      <?php endif; // endif : reprséente l'accolade fermante de la condition if ?>

      <li class="nav-item">
          <a class="nav-link" href="<?php echo URL ?>panier.php"><i class="fas fa-shopping-basket"> Panier</i></a>
        </li>

      <?php if( adminConnect() ) : // Si l'admin est connecté, on affiche le menu backoffice?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Backoffice
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?php echo URL ?>admin/gestion_boutique.php"><b>Gestion Produits</b></a></li>
            <li><a class="dropdown-item" href="<?php echo URL ?>admin/gestion_membre.php?action=affichage"><b>Gestion Membres</b></a></li>
            <li><a class="dropdown-item" href="<?php echo URL ?>admin/gestion_commande.php?action=affichage"><b>Gestion Commandes</b></a></li>
            <li></li>
          </ul>
        </li>
      
      <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

    <div class="container">
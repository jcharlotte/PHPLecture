<?php 

// Fonction de debuggage : (permet de faire un print_r() "amélioré")
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

//------------------------------------------------------------------------------------------
// Fonction pour éxécuter les requêtes
function execute_requete( $req ){

    global $pdo;
    $pdostatement = $pdo->query( $req );
    return $pdostatement;
}

//------------------------------------------------------------------------------------------
// Fonction userConnect : si l'internaute est connecté
function userConnect(){

    if( !isset( $_SESSION['membre'] ) ){// SI la session/membre N'EXISTE PAS, cela siginifie que l'on est pas connecté et donc on renvoie'false' (On crée et remplie la session/membre lors de la connexion !!)

        return false;
    }
    else{

        return true;
    }
}

//------------------------------------------------------------------------------------------
// Fonction adminConnect() :
function adminConnect(){

    if( userConnect()  && $_SESSION['membre']['statut'] == 1 ){ // SI l'internaute est connecté ET QU'il est admin (donc que son statut est égal à 1) on renvoie true
        
        return true;
    }
    // else{  // Par défaut, si ce n'est pas 'true', ça sera 'false', le 'else' est donc inutile

    //     return false;
    // }
}

//------------------------------------------------------------------------------------------
// Fonction pour créer un panier :

function creation_panier(){

    if( !isset( $_SESSION['panier'] ) ){ // SI la session/panier N'EXISTE PAS, on la crée

        $_SESSION['panier'] = array();

            $_SESSION['panier']['titre'] = array();
            $_SESSION['panier']['id_produit'] = array();
            $_SESSION['panier']['quantite'] = array();
            $_SESSION['panier']['prix'] = array();
    }
}

//------------------------------------------------------------------------------------------
// Fonction d'ajout d'un produit au panier :

function ajout_panier( $titre, $id_produit, $quantite, $prix ){

    creation_panier();
    // Ici, on fait appel à la fonction déclarée ci-dessus :
        // Soit le panier n'existe pas, et donc on le crée (lap remière que l'on tente d'ajouter un produit au panier)
        // Soit il existe et on l'utilise (puisque qu'on ne rentrera pas dans la condition de la fonction creation-panier() )

    // Est-ce que le produit existe déjà dans le panier?

    $index = array_search( $id_produit, $_SESSION['panier']['id_produit'] );
    // array_search( arg1, arg2);
        //arg1 : ce que l'on cherche
        //arg2 : dans quel tableau on effectue la recherche
        // Valeur de retour : la fonction renvoit la "clé" (correspondant à l'indice du tableau SI il y a une correspondance) ou "false"
    
    if( $index !== false ){ // SI $index est strictement différent de 'false', c'est que le produit est déjà présent dans le panier et donc on va augmenté la quantité

        $_SESSION['panier']['quantite'][$index] += $quantite;
        // Ici, on va précisément à l'indice du produit déjà présent dans le panier et on y ajoute la nouvelle quantité

    }
    else{ // SINON, c'est que le produit n'est pas dans le panier et donc on insert toutes les infos nécessaires

      $_SESSION['panier']['titre'][] = $titre;
    $_SESSION['panier']['id_produit'][] = $id_produit;
    $_SESSION['panier']['quantite'][] = $quantite;
    $_SESSION['panier']['prix'][] = $prix;
    // Ici, [] permet d'ajouter plusieurs 'produit' au panier  
    }
    
}

//------------------------------------------------------------------------------------------
// Fonction montant total du panier :

function montant_total(){

    $total = 0;

    for( $i = 0; $i <sizeof($_SESSION['panier']['id_produit']); $i++ ){

        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
        // A chaque tour de boucle (qui correspond au nombdre de produit dans le panier), on ajoute lem ontant (quantite * prix) pour chaque produit dans la variable $total
    }

    return $total;
}
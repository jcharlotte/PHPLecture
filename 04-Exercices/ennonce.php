<?php
/* 
1 - Créer un fichier fonction.inc.php : et créer une fonction calcul() qui va recevoir 2 arguments (fruit, poids) et qui va retourner la phrase :

 => utiliser une condition : qui selon le fruit sélectionné, on créera une variable $prix_kg
		=> ex: si c'est pomme c'est 2€ 
		=> ex: si c'est poires c'est 3€ 

	"Les ... coutent ... € pour un poids de ... grammes" 

	=> pommes, bananes, cerises, poires (retournent un prix au kg)


2 - Créer une page lien.php. Prévoir 4 liens <a href=""></a> avec le nom des fruits afin de faire en sorte que lorsque l'on clique dessus, le prix du fruit ( pour 1 kg) s'affiche DANS LA MEME PAGE grâce à la fonction calcul().


3 - Créer une page formulaire.php et réaliser un formulaire permettant de selectionner (select) un fruit et saisir un poids.
-> Affichez via la fonction calcul(), le resultat issue des infos du formulaire
-> bonus : faites en sorte de garder le dernier fruit sélectionné et le dernier poids saisie dans le formulaire lorsque celui-ci est validé.


4 - Créer une page array.php :
	4.1 - Déclarer un tableau avec tous les fruits : pommes, cerises, poires, bananes

	4.2 - Déclarer un tableau avec tous les poids suivants : 100, 500, 1000, 2000, 5000

		4.3 - Affichez les 2 tableaux (faire un print_r() )

	4.4 - Sortir le fruit 'cerise' avec le poids 500 via les tableaux créés pour les transmettre à la fonction calcul() et ainsi obtenir le prix

	4.5 - Sortir TOUS les prix pour les cerises avec tous les poids (boucle)

	4.6 - Sortir tous les prix pour tous les fruits avec tous les poids (boucles imbriquées)

		4.7 - faire un affichage dans un tableau ('<table>') pour un affichage plus 'propre'
			les titres des colonnes seront les poids
			les titres des lignes seront les fruits
*/
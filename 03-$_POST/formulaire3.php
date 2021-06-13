<a href="formulaire2.php">Retour form2</a><br>
<hr>

<h1>Formulaire 3</h1>

<?php

print '<pre>';
    print_r( $_POST);
print '</pre>';


//EXERCICE: Affichez les données issues du formulaire2.php et faites en sorte d'informer l'internaute que le prenom ET le mail sont obligatoires (donc dans le cas où le champ est vide affiche un message d'erreur)

	//empty() : teste si c'est une variable est vide !

	//2 solutions :
		//message personnalisé :   => les champs sont obligatoires
								// => le prenom est obligatoire
								// => l'email est obligatoire

		//message global => "les champs sont obligatoires"

	//Bonus : la version ternaire !


if(empty($_POST['pseudo']) && empty($_POST['email'])){
    echo "Les champs sont obligatoires.";
}elseif(empty($_POST['pseudo'])){
    echo "Veuillez renseigner votre pseudo.";
}elseif(empty($_POST['email'])){
    echo "Veuillez renseigner votre Email.";
}
<?php

if( $_POST ){ //Si il a eu un post (donc un 'submit' c'est à dire validation du formulaire)

	echo 'Prénom : ' . $_POST['prenom'] . '<br>';

	echo "Description : $_POST[description] <hr> ";
}
//$_POST est une superglobale de php donc elle retourne un array ET s'écrit toujours en MAJUSCULE. Pour parcourir un Array, il faut préciser entre crochet les indices qui ici, correspondent aux attributs name="" des inputs !

//$_POST['name'] où le 'name' correspond à l'attribut des inputs. D'où la nécessité de bien renseigner cet attribut dans les formulaire pour récupérer les informations postées apr l'internaute.

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire 1</title>
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">
		<!-- Les attributs de la balise <form> :

			method="" : comment vont circuler les données (get OU post)
			action="" : représente l'URL de destination

			enctype="multipart/form-data" : INDISPENSABLE pour pouvoir uploader des fichiers
		-->

		<label>Prenom</label><br>
		<input type="text" name="prenom"><br><br>
		<!-- NE SURTOUT PAS OUBLIER L'ATTRIBUT name="" DANS LES INPUTS D'UN FORMULAIRE !! C'est ce qui permet de récupérer les valeurs de l'input via la superglobale $_POST -->

		<label>Description</label><br>
		<textarea name="description"></textarea><br><br>

		<input type="submit" name="validation" value="Valider">

	</form>
</body>
</html>
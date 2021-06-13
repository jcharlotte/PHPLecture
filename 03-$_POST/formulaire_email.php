<?php

print '<pre>';
    print_r( $_POST);
print'</pre>';

$expediteur = 'From: '. $_POST['expediteur'];


	//envoie mail:
	mail( $_POST['destinataire'], $_POST['objet'], $_POST['message'], $expediteur );
	//mail( arg1, arg2, arg3, arg4) : fonction pour envoyer un mail et l'ordre des arguments est primordial !
		//arg1 : destinataire
		//arg2 : sujet
		//arg3 : message
		//arg4 : en-têtes, ici, l'expediteur


?>


<hr>

<form method="post">

	<label>Expediteur</label><br>
	<input type="text" name="expediteur"><br><br>

	<label>Destinataire</label><br>
	<input type="text" name="destinataire"><br><br>

	<label>Objet</label><br>
	<input type="text" name="objet"><br><br>

	<label>Message</label><br>
	<textarea name="message" cols="30" rows="10"></textarea><br><br>	

	<input type="submit">

</form>
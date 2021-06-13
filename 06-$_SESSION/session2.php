<?php

session_start();
    // lorsque j'effectue une session_start(), la session n'est pas recréée car elle existe déjà. Grâce au session_start déclenché dans le fichier session1.php


print '<pre>';
	print_r( $_SESSION );
print '</pre>';
echo '<hr>';

// Ce fichier n'a rien à voir avec session1.php, nous n'avons pas fait d'inclusion, il pourrait s'appeler n'importe comment, se trouver dans un autre dossier, les informations seraient toujours accessibles!
// C'est tout l'intérêt et la 'puissance' des sessions.
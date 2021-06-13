<?php
/*
CREATE DATABASE team;
USE team;

CREATE TABLE player(
	id_player INT PRIMARY KEY NOT NULL auto_increment,
	nom VARCHAR(25) NOT NULL,
	prenom VARCHAR(25) NOT NULL,
	age INT NOT NULL,
	pays VARCHAR(25) NOT NULL,
	poste ENUM('attaque', 'defense') NOT NULL,
	photo VARCHAR(255) NOT NULL,
	presentation TEXT NOT NULL
)ENGINE=InnoDB;
-----------------------------------------------------------------
Ennonce complet de l'exercice :

	Enregistrement des données (formulaire)
		=> pensez aux controles des saisies !! (addslashes et htmlentities)
			-> nom, prenom OBLIGATOIRE  (2 conditions)
			-> l'age doit etre un ENTIER et avoir 2 chiffre
	Affichage des données sous forme de tableau
		=> 'photo', afficher la photo
		=> 'presentation', couper le texte si trop long substr()
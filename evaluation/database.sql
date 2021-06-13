CREATE DATABASE wf3_php_intermediaire_charlotte;
USE wf3_php_intermediaire_charlotte;

CREATE TABLE advert(
    id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    postal_code INT(5) NOT NULL,
    city VARCHAR(25) NOT NULL,
    type enum('location','vente') NOT NULL,
    price INT(7) NOT NULL,
    reservation_message VARCHAR(200) NOT NULL default 'libre'
) ENGINE=InnoDB;

INSERT INTO advert( id, title, description, postal_code, city, type, price, reservation_message) VALUES
(1, 'Maison', 'Maison avec jardin.', 46300, 'Milhac', 'location', 550, 'libre'),
(2, 'Appartement', 'Appartement avec balcon.', 75018, 'Paris', 'vente', 600000, 'libre'),
(3, 'Maison', 'Maison avec jardin.', 46300, 'Gourdon', 'vente', 550000, 'libre'),
(4, 'Appartement', 'Appartement avec balcon.', 46300, 'Gourdon', 'location', 550, 'libre'),
(5, 'Maison', 'Maison avec jardin.', 46300, 'Gourdon', 'vente', 500000, 'libre'),
(6, 'Appartement', 'Appartement avec balcon.', 75011, 'Paris', 'location', 550, 'libre'),
(7, 'Terrain', 'Terrain constructible.', 46300, 'Gourdon', 'vente', 5000, 'réservé'),
(8, 'Appartement', 'Appartement avec balcon.', 46300, 'Gourdon', 'vente', 160000, 'libre'),
(9, 'Maison', 'Maison avec jardin.', 94800, 'Villejuif', 'location', 550, 'libre'),
(10, 'Appartement', 'Appartement avec balcon.', 46300, 'Gourdon', 'location', 550, 'libre'),
(11, 'Maison', 'Maison avec jardin.', 97820, 'Boutigny', 'location', 620, 'libre'),
(12, 'Appartement', 'Appartement avec balcon.', 46300, 'Gourdon', 'vente', 30000, 'libre'),
(13, 'Maison', 'Maison avec jardin.', 46300, 'Milhac', 'location', 550, 'libre'),
(14, 'Appartement', 'Appartement avec balcon.', 46300, 'Gourdon', 'vente', 25000, 'libre'),
(15, 'Maison', 'Maison avec jardin.', 46300, 'Gourdon', 'vente', 250000, 'libre'),
(16, 'Maison', 'Maison avec jardin.', 91820, 'Boutigny', 'location', 430, 'réservé');
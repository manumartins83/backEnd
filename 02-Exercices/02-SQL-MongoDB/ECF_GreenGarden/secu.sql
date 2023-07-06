-- accès visiteur
CREATE USER 'visiteur'@'localhost' IDENTIFIED BY 'jeje';

GRANT SELECT  
ON produit
TO 'visiteur'@'localhost' IDENTIFIED BY 'jeje';


-- accès client
CREATE USER 'client'@'localhost' IDENTIFIED BY 'lolo';

GRANT SELECT  
ON *
TO 'client'@'localhost' IDENTIFIED BY 'lolo';

GRANT SELECT , INSERT, UPDATE 
ON commande 
TO 'client'@'localhost' IDENTIFIED BY 'lolo';

GRANT SELECT , INSERT, UPDATE 
ON client 
TO 'client'@'localhost' IDENTIFIED BY 'lolo';


-- accès gestion
CREATE USER 'gestion'@'localhost' IDENTIFIED BY 'tata';

GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO 'gestion'@'localhost' IDENTIFIED BY 'tata';


-- accès administrateur
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'zezette';
GRANT SELECT, INSERT, UPDATE, DELETE
ON *
TO 'admin'@'localhost' IDENTIFIED BY 'zezette'
WITH GRANT OPTION;
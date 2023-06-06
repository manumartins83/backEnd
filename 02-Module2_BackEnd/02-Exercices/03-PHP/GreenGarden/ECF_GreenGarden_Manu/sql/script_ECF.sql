use greengarden;



-- CREATE TABLE IF NOT EXISTS t_d_usertype(
-- Id_UserType INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
-- Libelle VARCHAR(50) NOT NULL
-- )ENGINE=INNODB;

-- Insertion nouvel utilisateur "Technicien SAV"
INSERT INTO t_d_usertype(Id_UserType,Libelle) VALUES (4,'Technicien');



-- CREATE TABLE IF NOT EXISTS t_d_user(
-- Id_User INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
-- Login VARCHAR(255) NOT NULL,
-- Password VARCHAR(255) NOT NULL,

-- Id_UserType INT NOT NULL,
-- FOREIGN KEY(t_d_user_ibfk_1) REFERENCES t_d_usertype(Id_UserType)
-- )ENGINE=INNODB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Depuis l'interface inscription.php
-- Login:TONTON pwd:TONTON (sera technicien) => Id_User = 17
-- Login:TUTU pwd:TUTU (sera technicien) => Id_User = 19
-- Login:JOJO pwd:JOJO (sera client) => Id_User = 18


-- Ajout Id_User table "t_d_commercial"
ALTER TABLE t_d_commercial ADD COLUMN Id_User INT;

UPDATE t_d_commercial
SET Id_User=13
WHERE Id_Commercial=1;

update t_d_commercial
SET Id_User=14
WHERE Id_Commercial=2;

ALTER TABLE `t_d_commercial` ADD CONSTRAINT `t_d_commercial_ibfk_user`
FOREIGN KEY (`Id_User`) REFERENCES `t_d_user` (`Id_User`);



CREATE TABLE IF NOT EXISTS t_d_typeRetour(
   Id_Retour INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   Libelle_Retour VARCHAR(255) NOT NULL
)ENGINE=INNODB;

INSERT INTO t_d_typeRetour(Id_Retour,Libelle_Retour) VALUES (1,'NPAI');
INSERT INTO t_d_typeRetour(Id_Retour,Libelle_Retour) VALUES (2,'abs');
INSERT INTO t_d_typeRetour(Id_Retour,Libelle_Retour) VALUES (3,'erreur cde');
INSERT INTO t_d_typeRetour(Id_Retour,Libelle_Retour) VALUES (4,'panne');
INSERT INTO t_d_typeRetour(Id_Retour,Libelle_Retour) VALUES (5,'abimé');
INSERT INTO t_d_typeRetour(Id_Retour,Libelle_Retour) VALUES (6,'non conforme');



CREATE TABLE IF NOT EXISTS t_d_technicienSAV(
   Id_Technicien_SAV INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   Nom_Technicien VARCHAR(255) NOT NULL,

   Id_User INT NOT NULL,
   FOREIGN KEY(Id_User) REFERENCES t_d_user(Id_User)
)ENGINE=INNODB;

INSERT INTO t_d_technicienSAV(Id_Technicien_SAV,Nom_Technicien,Id_User) VALUES (1,'Jéjé Touréparé',17);
INSERT INTO t_d_technicienSAV(Id_Technicien_SAV,Nom_Technicien,Id_User) VALUES (2,'Jeanne Tounické',19);



CREATE TABLE IF NOT EXISTS t_d_ticketSAV(
   Id_Ticket_SAV INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   Num_Ticket_SAV VARCHAR(255),
   Date_Ticket_SAV DATETIME,
   Statut_Ticket_SAV VARCHAR(255),

   Id_Technicien_SAV INT NOT NULL,
   Id_Commande INT NOT NULL,
   Id_Retour INT NOT NULL,
   FOREIGN KEY(Id_Technicien_SAV) REFERENCES t_d_technicienSAV(Id_Technicien_SAV),
   FOREIGN KEY(Id_Commande) REFERENCES t_d_commande(Id_Commande),
   FOREIGN KEY(Id_Retour) REFERENCES t_d_typeRetour(Id_Retour)
);

INSERT INTO t_d_ticketSAV(Id_Ticket_SAV,Num_Ticket_SAV,Date_Ticket_SAV,Statut_Ticket_SAV,Id_Technicien_SAV,Id_Commande,Id_Retour) 
VALUES (1,TIC0000001,'2023-04-03 08:32:05','résolu',1,3,2);
INSERT INTO t_d_ticketSAV(Id_Ticket_SAV,Num_Ticket_SAV,Date_Ticket_SAV,Statut_Ticket_SAV,Id_Technicien_SAV,Id_Commande,Id_Retour) 
VALUES (2,TIC0000002,'2023-05-07 10:25:08','créé',2,4,5);
INSERT INTO t_d_ticketSAV(Id_Ticket_SAV,Num_Ticket_SAV,Date_Ticket_SAV,Statut_Ticket_SAV,Id_Technicien_SAV,Id_Commande,Id_Retour) 
VALUES (3,TIC0000003,'2023-05-26 12:02:14','suivi',2,5,6);

-- insertion auto numéro ticket retour
DELIMITER $$
CREATE TRIGGER `tr_ticket_generate_numticket` BEFORE INSERT ON `t_d_ticketSAV` FOR EACH ROW BEGIN
    DECLARE prefix CHAR(3) DEFAULT 'TIC';
    DECLARE Num_Ticket_SAV INT;

    SELECT COUNT(*) INTO Num_Ticket_SAV FROM t_d_ticketSAV;
    SET Num_Ticket_SAV = Num_Ticket_SAV + 1;

    SET NEW.Num_Ticket_SAV = CONCAT(prefix, LPAD(Num_Ticket_SAV, 7, '0'));
END
$$
DELIMITER ;



-- Modifier requête SQL pour "Jéjé Touréparé" (technicien Login:TONTON pwd:TONTON)
UPDATE t_d_user
SET Id_UserType=4
WHERE Login='TONTON';

-- Modifier requête SQL pour "Jeanne Tounické" (technicien Login:TUTU pwd:TUTU)
UPDATE t_d_user
SET Id_UserType=4
<<<<<<< HEAD
WHERE Login='TUTU';
=======
WHERE Login='TUTU';

-- Modifier requête SQL pour "Gonzales Roberto" (client Login:JOJO pwd:JOJO)
UPDATE t_d_client
SET Id_User=18
WHERE Id_Client=4;
>>>>>>> cf63e177944f042a79ff88eb60e888c7484ebe86

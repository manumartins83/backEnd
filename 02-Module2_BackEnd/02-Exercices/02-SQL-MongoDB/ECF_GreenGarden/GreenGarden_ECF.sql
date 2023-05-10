-- script SQL create + insert

DROP DATABASE IF EXISTS GREENGARDEN;

CREATE DATABASE GREENGARDEN; 
USE GREENGARDEN;


CREATE TABLE Produit(
   ref_prod INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   nom_prod VARCHAR(50) NOT NULL,
   pu_HT_prod DECIMAL(10,2) NOT NULL,
   qte_prod INT,
   photo_prod VARCHAR(50),
   nom_societe VARCHAR(50) NOT NULL
)ENGINE=INNODB;

INSERT INTO Produit (ref_prod, nom_prod, pu_HT_prod, qte_prod, photo_prod, nom_societe) VALUES (124794, 'Cupressocyparis Leylandii', 11, 4, 'cupresso', 'jegere');
INSERT INTO Produit (ref_prod, nom_prod, pu_HT_prod, qte_prod, photo_prod, nom_societe) VALUES (596857, 'Coupe-bordures SmallCut 300/23', 45, 1, 'coupebordure', 'toptop');
INSERT INTO Produit (ref_prod, nom_prod, pu_HT_prod, qte_prod, photo_prod, nom_societe) VALUES (650000, 'meuleuse-couptou', 275, 2, 'meule', 'fifi');


CREATE TABLE Commercial(
   id_com INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   nom_com VARCHAR(50) NOT NULL,
   pre_com VARCHAR(50) NOT NULL
)ENGINE=INNODB;

INSERT INTO Commercial (id_com, nom_com, pre_com) VALUES (63, 'DUBOIS', 'Jean');
INSERT INTO Commercial (id_com, nom_com, pre_com) VALUES (82, 'CRUCHE', 'Josianne');


CREATE TABLE Client(
   ref_cli INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   nom_cli VARCHAR(50) NOT NULL,
   pre_cli VARCHAR(50) NOT NULL,
   rue_fac_cli VARCHAR(50) NOT NULL,
   CP_fac_cli INT NOT NULL,
   ville_fac_cli VARCHAR(50) NOT NULL,
   tel_cli DECIMAL(10,0),
   typ_paie VARCHAR(50) NOT NULL,
   moy_paie VARCHAR(50) NOT NULL,
 
   FK_id_com INT,

   FOREIGN KEY(FK_id_com) REFERENCES Commercial(id_com)
 
)ENGINE=INNODB;

INSERT INTO Client (ref_cli, nom_cli, pre_cli, rue_fac_cli, CP_fac_cli, ville_fac_cli, tel_cli, typ_paie, moy_paie, FK_id_com) VALUES (215, 'MARTINS', 'Emmanuel', '2 rue Angers', 50230, 'cherbourg', 0623232323, 'immédiat', 'CB', 63);
INSERT INTO Client (ref_cli, nom_cli, pre_cli, rue_fac_cli, CP_fac_cli, ville_fac_cli, tel_cli, typ_paie, moy_paie, FK_id_com) VALUES (220, 'KIKI', 'Georges', '10 rue coupgorge', 25250, 'Planoise', 0623232323, 'différé', 'Chèque', 82);


CREATE TABLE Facture(
   num_fac INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   date_fac DATE,

   FK_ref_cli INT NOT NULL,

   FOREIGN KEY(FK_ref_cli) REFERENCES Client(ref_cli)

)ENGINE=INNODB;

INSERT INTO Facture (num_fac, date_fac, FK_ref_cli) VALUES (6523, '2015-02-10', 215);
INSERT INTO Facture (num_fac, date_fac, FK_ref_cli) VALUES (8523, '2023-05-09', 220);


CREATE TABLE Commande(
   num_cde INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   etat_cde VARCHAR(50) NOT NULL,
   date_cde DATE NOT NULL,
   rue_liv_cli VARCHAR(50) NOT NULL,
   CP_liv_cli INT NOT NULL,
   ville_liv_cli VARCHAR(50) NOT NULL,
   
   FK_num_fac INT,

   FOREIGN KEY(FK_num_fac) REFERENCES Facture(num_fac)
)ENGINE=INNODB;

INSERT INTO Commande (num_cde, etat_cde, date_cde, rue_liv_cli, CP_liv_cli, ville_liv_cli, FK_num_fac) VALUES (92407, 'soldée', '2015-01-10', '10 rue Général', 50440, 'querqueville', 6523);
INSERT INTO Commande (num_cde, etat_cde, date_cde, rue_liv_cli, CP_liv_cli, ville_liv_cli, FK_num_fac) VALUES (99999, 'expédiée', '2023-05-07', '5 rue leFlip', 25000, 'Besançon', 8523);

CREATE TABLE Livraison(
   num_bon_liv INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   date_bon_liv DATE NOT NULL,

   FK_num_cde INT,

   FOREIGN KEY(FK_num_cde) REFERENCES Commande(num_cde)

)ENGINE=INNODB;

INSERT INTO Livraison (num_bon_liv, date_bon_liv, FK_num_cde) VALUES (25413, '2015-07-10', 92407);
INSERT INTO Livraison (num_bon_liv, date_bon_liv, FK_num_cde) VALUES (25426, '2015-20-10', 92407);
INSERT INTO Livraison (num_bon_liv, date_bon_liv, FK_num_cde) VALUES (33333, '2023-05-08', 99999);


CREATE TABLE CONTENIR(
   id_prodCde INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   
   FK_ref_prod INT,
   FK_num_cde INT,


   FOREIGN KEY(FK_ref_prod) REFERENCES Produit(ref_prod),
   FOREIGN KEY(FK_num_cde) REFERENCES Commande(num_cde)
)ENGINE=INNODB;

INSERT INTO CONTENIR (id_prodCde, FK_ref_prod, FK_num_cde) VALUES (5, 124794, 92407);
INSERT INTO CONTENIR (id_prodCde, FK_ref_prod, FK_num_cde) VALUES (6, 596857, 92407);
INSERT INTO CONTENIR (id_prodCde, FK_ref_prod, FK_num_cde) VALUES (7, 650000, 99999);


CREATE TABLE TRANSMETTRE(
   id_cliLiv INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   
   FK_ref_cli INT,
   FK_num_bon_liv INT,

   FOREIGN KEY(FK_ref_cli) REFERENCES Client(ref_cli),
   FOREIGN KEY(FK_num_bon_liv) REFERENCES Livraison(num_bon_liv)
)ENGINE=INNODB;

INSERT INTO TRANSMETTRE (id_cliLiv, FK_ref_cli, FK_num_bon_liv) VALUES (8, 215, 25413);
INSERT INTO TRANSMETTRE (id_cliLiv, FK_ref_cli, FK_num_bon_liv) VALUES (9, 215, 25426);
INSERT INTO TRANSMETTRE (id_cliLiv, FK_ref_cli, FK_num_bon_liv) VALUES (10, 220, 33333);


CREATE TABLE PASSER(
   id_cliCde INT NOT NULL PRIMARY KEY AUTO_INCREMENT,

   FK_ref_cli INT,
   FK_num_cde INT,

   FOREIGN KEY(FK_ref_cli) REFERENCES Client(ref_cli),
   FOREIGN KEY(FK_num_cde) REFERENCES Commande(num_cde)
)ENGINE=INNODB;

INSERT INTO PASSER (id_cliCde, FK_ref_cli, FK_num_cde) VALUES (2, 215, 92407);
INSERT INTO PASSER (id_cliCde, FK_ref_cli, FK_num_cde) VALUES (3, 215, 92407);
INSERT INTO PASSER (id_cliCde, FK_ref_cli, FK_num_cde) VALUES (4, 220, 99999);


CREATE TABLE PROPOSER(
   Id_prodCom INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
   remise_cli DECIMAL(10,2),

   FK_ref_prod INT,
   FK_id_com INT,

   FOREIGN KEY(FK_ref_prod) REFERENCES Produit(ref_prod),
   FOREIGN KEY(FK_id_com) REFERENCES Commercial(id_com)
)ENGINE=INNODB;

INSERT INTO PROPOSER (Id_prodCom, remise_cli, FK_ref_prod, FK_id_com) VALUES (10, 4.4, 124794, 63);
INSERT INTO PROPOSER (Id_prodCom, remise_cli, FK_ref_prod, FK_id_com) VALUES (11, 9, 596857, 63);
INSERT INTO PROPOSER (Id_prodCom, remise_cli, FK_ref_prod, FK_id_com) VALUES (12, 25, 650000, 82);
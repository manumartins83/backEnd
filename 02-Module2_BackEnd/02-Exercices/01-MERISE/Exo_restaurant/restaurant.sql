CREATE TABLE Service(
   id_service VARCHAR(3) AUTO_INCREMENT,
   type_service VARCHAR(1) NOT NULL,
   date_service DATE NOT NULL,
   num_table INT NOT NULL,

   PRIMARY KEY(id_service)

)ENGINE=INNODB;


CREATE TABLE Serveur(
   id_employe VARCHAR(5) AUTO_INCREMENT,
   nom_serveur VARCHAR(50) NOT NULL,
   prenom_serveur VARCHAR(50) NOT NULL,
   rue_serveur VARCHAR(50) NOT NULL,
   CP_serveur INT NOT NULL,
   ville_serveur VARCHAR(25) NOT NULL,
   tel_serveur DECIMAL(10,0) NOT NULL,
   certifs_serveur VARCHAR(50),
   id_service VARCHAR(3) NOT NULL,

   PRIMARY KEY(id_employe),

   FOREIGN KEY(id_service) REFERENCES Service(id_service)

)ENGINE=INNODB;


CREATE TABLE Carte(
   id_carte VARCHAR(4) AUTO_INCREMENT,
   nom_entree VARCHAR(15),
   nom_plat VARCHAR(15),
   nom_dessert VARCHAR(15),

   PRIMARY KEY(id_carte)

)ENGINE=INNODB;


CREATE TABLE Boisson(
   id_boisson VARCHAR(4) AUTO_INCREMENT,
   nom_apero VARCHAR(15),
   prix_apero DECIMAL(2,2),
   nom_soda VARCHAR(15),
   prix_soda DECIMAL(2,2),
   nom_digo VARCHAR(15),
   prix_digo DECIMAL(2,2),
   type_cafe VARCHAR(15),
   prix_cafe DECIMAL(2,2),

   PRIMARY KEY(id_boisson)

)ENGINE=INNODB;


CREATE TABLE Vin(
   id_vin VARCHAR(5) AUTO_INCREMENT,
   mille_vin DATE NOT NULL,
   date_achat_vin DATE NOT NULL,
   prix_achat_vin DECIMAL(3,2) NOT NULL,
   prix_vente_vin INT,

   PRIMARY KEY(id_vin)

)ENGINE=INNODB;


CREATE TABLE Viticulteur(
   id_viticulte VARCHAR(6) AUTO_INCREMENT,
   nom_viticulte VARCHAR(50) NOT NULL,
   prenom_viticulte VARCHAR(50) NOT NULL,
   rue_viticulte VARCHAR(50) NOT NULL,
   CP_viticulte INT NOT NULL,
   ville_viticulte VARCHAR(25) NOT NULL,
   tel_viticulte DECIMAL(10,0) NOT NULL,

   PRIMARY KEY(id_viticulte)

)ENGINE=INNODB;


CREATE TABLE PRENDRE(
   id_carte VARCHAR(4) AUTO_INCREMENT,
   id_service VARCHAR(3) AUTO_INCREMENT,
   type_menu VARCHAR(4),

   PRIMARY KEY(id_carte, id_service),

   FOREIGN KEY(id_carte) REFERENCES Carte(id_carte),
   FOREIGN KEY(id_service) REFERENCES Service(id_service)

)ENGINE=INNODB;


CREATE TABLE SUGGERER(
   id_boisson VARCHAR(4) AUTO_INCREMENT,
   id_service VARCHAR(3) AUTO_INCREMENT,

   PRIMARY KEY(id_boisson, id_service),

   FOREIGN KEY(id_boisson) REFERENCES Boisson(id_boisson),
   FOREIGN KEY(id_service) REFERENCES Service(id_service)

)ENGINE=INNODB;


CREATE TABLE PROPOSER(
   id_service VARCHAR(3) AUTO_INCREMENT,
   id_vin VARCHAR(5) AUTO_INCREMENT,

   PRIMARY KEY(id_service, id_vin),

   FOREIGN KEY(id_service) REFERENCES Service(id_service),
   FOREIGN KEY(id_vin) REFERENCES Vin(id_vin)

)ENGINE=INNODB;


CREATE TABLE VENDRE(
   id_vin VARCHAR(5) AUTO_INCREMENT,
   id_viticulte VARCHAR(6) AUTO_INCREMENT,

   PRIMARY KEY(id_vin, id_viticulte),

   FOREIGN KEY(id_vin) REFERENCES Vin(id_vin),
   FOREIGN KEY(id_viticulte) REFERENCES Viticulteur(id_viticulte)

)ENGINE=INNODB;
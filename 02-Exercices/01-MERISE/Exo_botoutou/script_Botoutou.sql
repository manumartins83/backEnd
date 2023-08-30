/* Efface base de données(bdd) si existe */
DROP DATABASE IF EXISTS botoutou;

/* création bdd */
CREATE DATABASE botoutou;

/* utilisation bdd */
USE botoutou;

/* création table */
CREATE TABLE IF NOT EXIST Proprietaire(
   identifiant_proprietaire VARCHAR(50) PRIMARY KEY AUTO_INCREMENT,
   code_postal_proprietaire DECIMAL(5,0) NOT NULL,
   adresse_proprietaire VARCHAR(100) NOT NULL,
   nom_proprietaire VARCHAR(50) NOT NULL,
   ville_proprietaire VARCHAR(50) NOT NULL
)ENGINE=INNODB;

/* création table */
CREATE TABLE IF NOT EXIST Race(
   identifiant_race VARCHAR(50) PRIMARY KEY AUTO_INCREMENT,
   race_chien VARCHAR(50) NOT NULL,
   description_race_chien VARCHAR(100) NOT NULL,
   origine_race_chien VARCHAR(50) NOT NULL,
)ENGINE=INNODB;

/* création table */
CREATE TABLE IF NOT EXIST Concours(
   identifiant_concours VARCHAR(50) PRIMARY KEY AUTO_INCREMENT,
   nombre_participant INT NOT NULL,
   date_concours DATE NOT NULL,
   ville_concours VARCHAR(50) NOT NULL,
   nombre_chien_prime INT NOT NULL,
)ENGINE=INNODB;

/* création table */
CREATE TABLE IF NOT EXIST Chien(
   identifiant_chien VARCHAR(50) PRIMARY KEY AUTO_INCREMENT,
   date_naissance_chien DATE NOT NULL,
   date_acquisition_chien DATE NOT NULL,
   nom_chien VARCHAR(50) NOT NULL,
   sexe_chien VARCHAR(1) NOT NULL,

   fk_identifiant_race VARCHAR(50) NOT NULL,
   fk_identifiant_proprietaire VARCHAR(50) NOT NULL,
   FOREIGN KEY(fk_identifiant_race) REFERENCES Race(identifiant_race),
   FOREIGN KEY(fk_identifiant_proprietaire) REFERENCES Proprietaire(identifiant_proprietaire)
)ENGINE=INNODB;

/* création table */
CREATE TABLE IF NOT EXIST PARTICIPER(
   identifiant_chien VARCHAR(50) PRIMARY KEY AUTO_INCREMENT,

   fk_identifiant_concours VARCHAR(50),
   fk_classement_chien INT NOT NULL,
   FOREIGN KEY(fk_identifiant_chien) REFERENCES Chien(identifiant_chien),
   FOREIGN KEY(fk_identifiant_concours) REFERENCES Concours(identifiant_concours)
)ENGINE=INNODB;
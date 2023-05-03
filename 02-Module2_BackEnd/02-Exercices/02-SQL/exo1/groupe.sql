DROP DATABASE IF EXISTS GROUPE;

CREATE DATABASE GROUPE;

USE GROUPE;


CREATE TABLE Personne(
    per_num INT PRIMARY KEY AUTO_INCREMENT,
    per_nom VARCHAR(50),
    per_prenom VARCHAR(50),
    per_adresse VARCHAR(50),
    per_ville VARCHAR(50)

)ENGINE=INNODB;


CREATE TABLE Groupe(
    gro_num INT PRIMARY KEY AUTO_INCREMENT,
    gro_libelle VARCHAR(50)

)ENGINE=INNODB;


CREATE TABLE Appartient(
    id_appart INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    FK_per_num INT,
    FK_gro_num INT,

    FOREIGN KEY (FK_per_num) REFERENCES Personne(per_num),
    FOREIGN KEY (FK_gro_num) REFERENCES Groupe(gro_num)

)ENGINE=INNODB;
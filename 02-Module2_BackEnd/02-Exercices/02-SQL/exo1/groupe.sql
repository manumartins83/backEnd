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
    personne INT,
    groupe INT,

    PRIMARY KEY(personne, groupe),
    
    FOREIGN KEY (personne) REFERENCES Personne(per_num),
    FOREIGN KEY (groupe) REFERENCES Groupe(gro_num)

)ENGINE=INNODB;
DROP DATABASE IF EXISTS HOTEL;

CREATE DATABASE HOTEL;

USE HOTEL;

CREATE TABLE Station(
    num_station INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_station VARCHAR(50)

)ENGINE=INNODB;


CREATE TABLE Hotel(
    num_hotel INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_hotel VARCHAR(50),
    categorie_hotel INT,
    capacite_hotel INT,
    adresse_hotel VARCHAR(50),

    numstation INT NOT NULL,

    FOREIGN KEY (numstation) REFERENCES Station(num_station)

)ENGINE=INNODB;


CREATE TABLE Chambre(
    num_chambre INT PRIMARY KEY AUTO_INCREMENT,
    capacite_chambre INT,
    type_chambre VARCHAR(50),
    exposition VARCHAR(50),
    degre_confort INT,

    numhotel INT NOT NULL,

    FOREIGN KEY (numhotel) REFERENCES Hotel(num_hotel)

)ENGINE=INNODB;


CREATE TABLE Client(
    num_client INT PRIMARY KEY AUTO_INCREMENT,
    nom_client VARCHAR(50),
    prenom_client VARCHAR(50),
    adresse_client VARCHAR(50)

)ENGINE=INNODB;


CREATE TABLE Reservation(
    id INT NOT NULL AUTO_INCREMENT,
    numchambre INT,
    numclient INT,
    date_debut DATE,
    date_fin DATE,
    date_reservation DATE,
    montant_arrhes FLOAT,
    prix_total FLOAT,

    PRIMARY KEY(id),
    
    FOREIGN KEY (numclient) REFERENCES Client(num_client),
    FOREIGN KEY (numchambre) REFERENCES Chambre(num_chambre)

)ENGINE=INNODB;
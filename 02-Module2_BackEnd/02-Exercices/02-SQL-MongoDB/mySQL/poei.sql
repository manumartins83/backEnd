-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 04 mai 2023 à 16:35
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `poei`
--
CREATE DATABASE IF NOT EXISTS `poei` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `poei`;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE `personne` (
  `num` int(3) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `salaire` int(4) DEFAULT NULL,
  `ville` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`num`, `nom`, `prenom`, `salaire`, `ville`) VALUES
(1, 'Cohen', 'Sophie', 2000, 'Marseille'),
(2, 'Leberre', 'Bernard', 1500, 'Marseille'),
(3, 'Benabar', 'Pierre', 1800, 'Lyon'),
(4, 'Hadad', 'Karim', 2500, 'Paris'),
(5, 'Wick', 'John', 3000, 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE `vehicule` (
  `immatriculation` int(3) NOT NULL,
  `marque` varchar(20) DEFAULT NULL,
  `modele` varchar(20) DEFAULT NULL,
  `annee` int(4) DEFAULT NULL,
  `nump` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`immatriculation`, `marque`, `modele`, `annee`, `nump`) VALUES
(100, 'Peugeot', '5008', 2018, 5),
(200, 'Renault', 'Clio', 2000, 4),
(300, 'Ford', 'Fiesta', 2010, 1),
(400, 'Peugeot', '106', 2002, 3),
(500, 'Citroen', 'C4', 2015, 4),
(600, 'Ford', 'Kuga', 2019, NULL),
(700, 'Fiat', 'Punto', 2008, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`num`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`immatriculation`),
  ADD KEY `fk_vehicule_personne` (`nump`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `num` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `fk_vehicule_personne` FOREIGN KEY (`nump`) REFERENCES `personne` (`num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

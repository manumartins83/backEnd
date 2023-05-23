-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 04 mai 2023 à 16:36
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
-- Base de données : `work`
--
CREATE DATABASE IF NOT EXISTS `work` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `work`;

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

DROP TABLE IF EXISTS `enseignants`;
CREATE TABLE `enseignants` (
  `num` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `salaire` int(11) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`num`, `nom`, `prenom`, `salaire`, `ville`) VALUES
(1, 'Durand', 'Philippe', 2000, 'Marseille'),
(2, 'Leberre', 'Bernard', 1500, 'Paris'),
(3, 'Benammar', 'Pierre', 1800, 'Lyon'),
(4, 'Hadad', 'Karim', 1500, 'Paris'),
(5, 'Cooper', 'David', 3000, 'Marseille'),
(6, 'Benatia', 'Sonia', 1600, 'Toulouse');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`num`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

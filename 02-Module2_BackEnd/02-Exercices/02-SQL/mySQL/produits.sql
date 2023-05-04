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
-- Base de données : `produits`
--
CREATE DATABASE IF NOT EXISTS `produits` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `produits`;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) DEFAULT NULL,
  `cat_parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_lastname` varchar(50) DEFAULT NULL,
  `cus_firstname` varchar(50) DEFAULT NULL,
  `cus_adress` varchar(50) DEFAULT NULL,
  `cus_zipcode` varchar(50) DEFAULT NULL,
  `cus_city` varchar(50) DEFAULT NULL,
  `cus_mail` varchar(50) DEFAULT NULL,
  `cus_phone` varchar(50) DEFAULT NULL,
  `cus_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `ord_order_date` date DEFAULT NULL,
  `ord_payment_date` date DEFAULT NULL,
  `ord_ship_date` date DEFAULT NULL,
  `ord_reception_date` date DEFAULT NULL,
  `ord_status_date` int(11) DEFAULT NULL,
  `ord_cus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders_details`
--

DROP TABLE IF EXISTS `orders_details`;
CREATE TABLE `orders_details` (
  `ode_id` int(11) NOT NULL,
  `ode_unit_price` int(11) DEFAULT NULL,
  `ode_quantity` int(11) DEFAULT NULL,
  `ode_ord_id` int(11) DEFAULT NULL,
  `ode_pro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `pro_price` int(11) DEFAULT NULL,
  `pro_ref` varchar(50) DEFAULT NULL,
  `pro_name` varchar(50) DEFAULT NULL,
  `pro_desc` varchar(50) DEFAULT NULL,
  `pro_publish` int(11) DEFAULT NULL,
  `pro_picture` varchar(50) DEFAULT NULL,
  `pro_cat_id` int(11) DEFAULT NULL,
  `pro_sup_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `sup_id` int(11) NOT NULL,
  `sup_name` varchar(50) DEFAULT NULL,
  `sup_city` varchar(50) DEFAULT NULL,
  `sup_adresse` varchar(50) DEFAULT NULL,
  `sup_zipcode` varchar(50) DEFAULT NULL,
  `sup_contact` varchar(50) DEFAULT NULL,
  `sup_phone` varchar(50) DEFAULT NULL,
  `sup_mail` varchar(50) DEFAULT NULL,
  `sup_countries_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_parent_id` (`cat_parent_id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `ord_cus_id` (`ord_cus_id`);

--
-- Index pour la table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`ode_id`),
  ADD KEY `ode_ord_id` (`ode_ord_id`),
  ADD KEY `ode_pro_id` (`ode_pro_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `pro_cat_id` (`pro_cat_id`),
  ADD KEY `pro_sup_id` (`pro_sup_id`);

--
-- Index pour la table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sup_id`),
  ADD KEY `sup_countries_id` (`sup_countries_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `ode_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`cat_parent_id`) REFERENCES `categories` (`cat_id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ord_cus_id`) REFERENCES `customers` (`cus_id`);

--
-- Contraintes pour la table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `orders_details_ibfk_1` FOREIGN KEY (`ode_ord_id`) REFERENCES `orders` (`ord_id`),
  ADD CONSTRAINT `orders_details_ibfk_2` FOREIGN KEY (`ode_pro_id`) REFERENCES `products` (`pro_id`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`pro_cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`pro_sup_id`) REFERENCES `suppliers` (`sup_id`);

--
-- Contraintes pour la table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`sup_countries_id`) REFERENCES `suppliers` (`sup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

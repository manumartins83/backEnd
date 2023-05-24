-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 01 avr. 2022 à 09:51
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_blog_culinaire`
--
CREATE DATABASE IF NOT EXISTS `bdd_blog_culinaire` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `bdd_blog_culinaire`;

-- --------------------------------------------------------

--
-- Structure de la table `t_auteur`
--

DROP TABLE IF EXISTS `t_auteur`;
CREATE TABLE `t_auteur` (
  `id_auteur` int(11) NOT NULL,
  `nom_auteur` varchar(100) NOT NULL,
  `prenom_auteur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Déchargement des données de la table `t_auteur`
--

INSERT INTO `t_auteur` (`id_auteur`, `nom_auteur`, `prenom_auteur`) VALUES
(1, 'Personne', 'Paul'),
(2, 'Doe', 'John'),
(3, 'Dupont', 'Alexandre'),
(4, 'Voisin', 'Aude');

-- --------------------------------------------------------

--
-- Structure de la table `t_comment`
--

DROP TABLE IF EXISTS `t_comment`;
CREATE TABLE `t_comment` (
  `com_id` int(11) NOT NULL,
  `com_auteur` varchar(255) CHARACTER SET utf16 NOT NULL,
  `com_contenu` text CHARACTER SET utf16 NOT NULL,
  `id_rec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_comment`
--

INSERT INTO `t_comment` (`com_id`, `com_auteur`, `com_contenu`, `id_rec`) VALUES
(1, 'Jonas', 'J\'ai testé avec des amis on s\'est régalé', 4),
(2, 'Amandine', 'Simplement délicieux !!!', 1),
(3, 'Catherine', 'Mes petits enfants ont dévoré', 3),
(4, 'Julien', 'Rien à dire recette facile et délicieuse', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_recipe`
--

DROP TABLE IF EXISTS `t_recipe`;
CREATE TABLE `t_recipe` (
  `rec_id` int(11) NOT NULL,
  `rec_nom` varchar(255) CHARACTER SET utf16 NOT NULL,
  `rec_resume` text CHARACTER SET utf16 NOT NULL,
  `rec_temps` varchar(255) CHARACTER SET utf16 NOT NULL,
  `rec-difficulte` varchar(255) CHARACTER SET utf16 NOT NULL,
  `rec_budget` varchar(255) CHARACTER SET utf16 NOT NULL,
  `rec_ingredients` text CHARACTER SET utf16 NOT NULL,
  `rec_miniature` varchar(100) CHARACTER SET utf16 NOT NULL,
  `rec_image` varchar(255) CHARACTER SET utf16 NOT NULL,
  `rec_preparation` text CHARACTER SET utf16 NOT NULL,
  `rec_categorie` varchar(255) CHARACTER SET utf16 NOT NULL,
  `auteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_recipe`
--

INSERT INTO `t_recipe` (`rec_id`, `rec_nom`, `rec_resume`, `rec_temps`, `rec-difficulte`, `rec_budget`, `rec_ingredients`, `rec_miniature`, `rec_image`, `rec_preparation`, `rec_categorie`, `auteur`) VALUES
(1, 'Risotto à la saucisse de veau', 'Recette facile à réaliser, un vrai délice', '30min', 'facile', 'abordable', '1 barquette de saucisses de veau\r\n2 oignons\r\n3 gousses d’ail\r\n4 tomates pelées\r\n1 cuillère à soupe de thym\r\n1 cuillère à café de curcuma\r\n2 petits morceaux de gingembre\r\n2 cuillères à soupe d’huile d’olive\r\nSel et poivre', 'risotto_mini.png', 'risotto_veau.webp', 'Piquez les saucisses et mettez-les dans l’eau bouillante pendant 10 min.\r\nRéservez les saucisses et videz la marmite. Faites-y chauffer de l’huile d’olive.\r\nFaites revenir les oignons émincés, l’ail écrasé sans les faire trop colorer.\r\nCoupez les saucisses en tronçons de 3 cm puis faites-les revenir avec les oignons. Au bout de 5 min, ajoutez les tomates coupées en petits morceaux, le gingembre écrasé et les aromates.\r\nMélangez-le tout puis laisser mijoter sur feu doux en ôtant le couvercle de temps à autre pour éliminer l’excès d’eau.', 'plat', 1),
(2, 'Sauté de veau au chorizo', 'Une recette savoureuse', '15min', 'moyen', 'moyen', '1 kg de sauté de veau\r\n1 chorizo (doux ou fort selon votre goût)\r\n2 boîtes de pulpe de tomate\r\n1 pot d’olive verte dénoyautées\r\n4 oignons\r\n1 bouquet de basilic\r\n1 bouquet garni\r\n1 gousse d’ail\r\n2 cuillères à soupe d’huile', 'saute_veau_mini.jpg', 'saute_veau.jpg', 'Emincer l’oignon et détailler le chorizo pelé en rondelles.\r\nDécouper le veau en morceaux.\r\nFaire revenir veau et oignons émincés jusqu’à coloration dans l’huile.\r\nAjouter le chorizo puis la pulpe de tomate, le basilic haché et enfin les olives.\r\nCouvrir et faire mijoter à feu doux 1 heure minimum.\r\nCe plat est encore meilleur préparé la veille et réchauffé le jour même.', 'plat', 3),
(3, 'Blanquette de veau', 'Servir avec du riz. Recette très simple et savoureuse !', '45 min', 'difficile', 'cher', '1 kg de blanquette de veau\r\n1 cube de bouillon de légumes\r\n1 bouillon de poule\r\n2 carottes\r\n1 oignon jaune\r\n1 petite boîte de champignon (coupés)\r\n1 petit pot de crème fraîche\r\nCitron\r\nFarine\r\n1 jaune d’oeuf\r\n25 cl de vin blanc\r\nSel et poivre', 'blanquette_mini.jpg', 'blanquette.jpg', 'Faire revenir la viande dans un peu de beurre doux jusqu’à ce que les morceaux soient un peu dorés.\r\nSaupoudrer de 2 cuillères de farine. Bien remuer.\r\nAjouter 2 ou 3 verres d’eau, les cubes de bouillon, le vin et remuer. Ajouter de l’eau si nécessaire pour couvrir.\r\nCouper les carottes en rondelles et émincer les oignons puis les incorporer à la viande, ainsi que les champignons.\r\nLaisser mijoter à feu très doux environ 1h30 à 2h00 en remuant.\r\nSi nécessaire, ajouter de l’eau de temps en temps.\r\n    Dans un bol, bien mélanger la crème fraîche, le jaune d’oeuf et le jus de citron. Ajouter ce mélange au dernier moment, bien remuer et servir tout de suite.', 'plat', 3),
(4, 'Colombo de porc', 'Le colombo est LE plat traditionnel par excellence, réalisé à partir d\'un mélange d\'épices composé de coriandre, de curcuma, de cumin, de moutarde, de girofle, de fenugrec et de poivre', '1 heure', 'facile', 'moyen', '500 gr de sauté de porc et de rouelle  \r\n1/2 citron vert  \r\n1 oignon  \r\n1 bouquet garni  \r\n2 gousses d’ail  \r\n2 cuillères à soupe de poudre de colombo intense, Monde des Epices  \r\n1 cuillère à café de mélange 5 parfums, Monde des épices  \r\n2 carottes  \r\n1 courgette  \r\n1 pomme de terre  \r\n1 feuille de bois d’inde, Monde des Epices  \r\n1 piment antillais  \r\n2 cuillères à soupe d’huile de roucou ou d’huile d’olive\r\nSel et poivre ', 'colombo_mini.jpg', 'colombo.jpg', 'Faites mariner le porc avec l’oignon finement émincé, le jus d\' 1/2 citron, les 2 gousses d’ail et la feuille de bois d’inde écrasés. Salez et poivrez. Couvrez d’eau. Disposez au réfrigérateur deux heures.  \r\n\r\nD’abord vos légumes : pelez et découpez les carottes en gros morceaux. Lavez et coupez les courgettes en rondelles épaisses. Pelez la pomme de terre et coupez-la en quartier.  \r\n\r\nDans une cocotte, faites chauffer 2 cuillères à soupe d’huile et faites y revenir les morceaux de porc égouttés et sans leurs épices. Attention, réservez la marinade et toutes les épices qu’elle contient pour la sauce.  \r\n\r\nFaites dorer tous les morceaux de chaque côté mais ne les laissez pas brûler ! Ajouter ensuite le bouquet garni (6 cives, 4 branches persil, 3 branches thym) ciselé. Mélangez et laissez revenir une dizaine de minutes. Ajoutez un peu d’eau si nécessaire.  \r\n\r\nUne fois la viande bien saisie et les aromates revenues, ajoutez les épices de la marinade et la moitié du jus, puis la poudre à colombo. Mélangez bien et laissez réduire une dizaine de minutes environ.  \r\n\r\nVotre sauce aura maintenant pris la belle couleur ocre caractéristique du colombo et de l’huile de roucou. Disposez y maintenant vos légumes : pomme de terre, carotte, courgette et piment entier en évitant de le percer.  \r\n\r\nCouvrez d’eau, rectifiez l’assaisonnement et laissez mijoter 1 heure. Vérifiez le niveau d’eau en cours et rajoutez-en un peu si nécessaire. Au bout d’une heure votre porc est fondant et votre sauce onctueuse. Le colombo est prêt.  ', 'Plat', 2),
(5, 'Saute de porc au cidre', 'Un sauté de porc au cidre, c’est le genre de plat que nous aimons bien le dimanche midi, un plat rapide à préparer, de préférence la veille, mijoté à souhait et qui réchauffe bien en ces journées froides et pluvieuses.', '45 min', 'facile', 'abordable', '600g d’échine de porc\r\n2 oignons\r\n1 bouteille de cidre brut\r\n2 cuillères à soupe de farine\r\nFond de volaille\r\nSel et poivre', 'saute_porc_mini.jpg', 'saute_porc.jpg', 'Découpez l’échine de porc en cubes d’environ 5-6 centimètres de côté\r\nMettez-les à dorer dans une cocotte avec un peu de matière grasse\r\nOtez la viande de la cocotte, rajoutez de la matière grasse et faites dorer les oignons émincés\r\nRemettez la viande avec les oignons, ajoutez la farine et remuez bien. Mouillez avec la bouteille de cidre\r\nLaissez cuire à feu doux pendant une heure environ. Salez et poivrez\r\nSi la sauce vous semble trop liquide, vous pouvez l’épaissir en y délayant 2 cuillères à café de fond de volaille\r\n\r\nExcellent avec des pommes de terre vapeur ou des pâtes fraîches !', 'Plat', 4);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_auteur`
--
ALTER TABLE `t_auteur`
  ADD PRIMARY KEY (`id_auteur`);

--
-- Index pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `FK_recette_commentaire` (`id_rec`);

--
-- Index pour la table `t_recipe`
--
ALTER TABLE `t_recipe`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `FK_auteur` (`auteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_auteur`
--
ALTER TABLE `t_auteur`
  MODIFY `id_auteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_comment`
--
ALTER TABLE `t_comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `t_recipe`
--
ALTER TABLE `t_recipe`
  MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_comment`
--
ALTER TABLE `t_comment`
  ADD CONSTRAINT `FK_recette_commentaire` FOREIGN KEY (`id_rec`) REFERENCES `t_recipe` (`rec_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_recipe`
--
ALTER TABLE `t_recipe`
  ADD CONSTRAINT `FK_auteur` FOREIGN KEY (`auteur`) REFERENCES `t_auteur` (`id_auteur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

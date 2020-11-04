-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 22 Juin 2020 à 21:45
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `categorie`, `nom`, `photo`, `prix`, `quantite`) VALUES
(3, 'A', 'article 1', '', 20, 3),
(4, 'B', 'article 2', '', 10, 3),
(5, 'A', 'article 1', './photo/3_image-vide.jpg', 20, 3),
(7, 'B', 'article 7', '', 35, 85),
(8, 'B', 'article 8', '', 75, 68),
(9, 'C', 'article 9', '', 61, 70),
(10, 'A', 'article 1', '', 120, 30),
(11, 'B', 'article 11', '', 90, 12),
(12, 'A', 'article 12', '', 115, 36),
(13, 'A', 'article 13', '', 30, 86),
(14, 'A', 'article 14', '', 20, 79),
(15, 'B', 'article 15', '', 26, 45),
(20, 'A', 'article 2', '', 80, 10),
(30, 'B', 'article 3', '', 46, 15),
(40, 'C', 'article 4', '', 100, 20),
(50, 'C', 'article 5', '', 150, 35),
(60, 'A', 'article 6', '', 86, 40),
(110, 'A', 'article 10', '', 28, 45);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

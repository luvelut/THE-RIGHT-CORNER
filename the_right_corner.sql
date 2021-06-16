-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mer. 16 juin 2021 à 09:44
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `the_right_corner`
--

-- --------------------------------------------------------

--
-- Structure de la table `advert`
--

DROP TABLE IF EXISTS `advert`;
CREATE TABLE IF NOT EXISTS `advert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_54F1F40B40C86FCE` (`publisher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `advert`
--

INSERT INTO `advert` (`id`, `publisher_id`, `title`, `published_at`, `image`, `content`, `price`) VALUES
(12, 5, 'Lampe vintage', '2021-06-03 19:30:48', 'lampe-vintage.jpg', 'Vend lampe vintage des années 70', 20),
(13, 5, 'Lampe à lave', '2021-06-03 19:31:02', 'lampelave.jpg', 'Vend lampe à lave très bon état', 25),
(14, 5, 'Jouet en bois', '2021-06-03 19:30:34', 'jeubois.jpg', 'Bon état, convient aux enfants de plus de 5 ans', 30),
(15, 5, 'Kit couture', '2021-06-03 19:30:22', 'couture.jpg', 'Je vend ce kit couture jamais utilisé, n\'hésitez pas à me contactez au 0707070707 pour plus d\'informations', 20),
(16, 5, 'Tapis retro', '2021-06-03 19:30:11', 'tapis.png', 'Neuf, avec étiquette', 40),
(17, 5, 'Lustre', '2021-06-03 19:30:00', 'lustre.jpg', 'Lustre de diamètre 120 cm', 100),
(18, 6, 'Cartable', '2021-06-03 19:31:40', 'cartable.jpg', 'Cartable en cuir', 50),
(19, 6, 'Set de verre en cristal', '2021-06-03 19:31:51', 'verre.jpg', 'A vendre en lot ou à l\'unité', 20),
(20, 6, 'Ours en peluche', '2021-06-03 19:32:01', 'peluche.jpg', 'Neuf avec étiquette, lavable en machine', 3),
(25, 12, 'PS4', '2021-06-05 13:43:19', 'ps4.jpg', 'Neuve avec manette', 2000);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210531212407', '2021-05-31 21:24:29', 123);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `name`, `password`, `is_admin`, `created_at`) VALUES
(4, 'admin', 'admin', '$2y$12$HMPZ2EC3LLbKqrIi.tpZNOtpzqi1L.bngdDNu4397ZpZD1yko6ZIq', 1, '2021-06-01 18:22:58'),
(5, 'membre1', 'membre1', '$2y$12$N1QakFEsAc0Dy3CeTDVUJOTTlQRa.N2duLO.QG9tgU/CPZEOCWa9q', 0, '2021-06-01 18:22:59'),
(6, 'membre2', 'membre2', '$2y$12$kxnHJKr.FEEGob6onK3NGu3ab592G5drTVT9swxlmha4mEMPpXBPG', 0, '2021-06-01 18:22:59'),
(12, 'membre3', 'Membre3', '$2y$12$7XYeV2is6tEDNjwVDjXSE./KvTbtj1fBfxtinpT8K3r1JR9K.mwIG', 0, '2021-06-05 13:25:24');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `advert`
--
ALTER TABLE `advert`
  ADD CONSTRAINT `FK_54F1F40B40C86FCE` FOREIGN KEY (`publisher_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

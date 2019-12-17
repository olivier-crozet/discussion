-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 17 déc. 2019 à 16:31
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `discussion`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(140) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=277 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_utilisateur`, `date`) VALUES
(276, 'dududuu', 14, '2019-12-17 16:08:32'),
(275, 'retest', 18, '2019-12-17 16:08:10'),
(274, 'blabla', 18, '2019-12-17 16:07:46'),
(273, 'essai', 18, '2019-12-17 16:07:19'),
(272, 'o top', 14, '2019-12-17 15:32:40'),
(271, 'lzfjskhkjf fmokklzdelm fkoflkjsfjkl djjdj kfjfksj dfkijjdkl ', 17, '2019-12-17 14:52:51'),
(270, 'gggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 17, '2019-12-17 14:26:11'),
(269, 'salut mon poulet', 17, '2019-12-17 14:25:53'),
(268, 'yes', 16, '2019-12-17 14:22:30'),
(267, 'D', 14, '2019-12-17 14:20:11'),
(266, 'F', 14, '2019-12-17 14:20:05'),
(265, 'DGDEGFD', 14, '2019-12-17 14:17:18'),
(264, 'hola que tal', 14, '2019-12-17 14:00:00'),
(263, 'jessai encore', 14, '2019-12-17 13:46:49'),
(262, 'je suis trop fort', 14, '2019-12-17 13:30:20'),
(261, 'dsfdssdqfsgfds', 14, '2019-12-17 12:05:32'),
(260, 'oooooooooooo', 14, '2019-12-17 00:48:03'),
(257, 'sa va', 16, '2019-12-17 00:34:52'),
(258, 'hola', 14, '2019-12-17 00:35:22'),
(259, 'lala', 14, '2019-12-17 00:35:30'),
(256, 'HOLA ', 16, '2019-12-17 00:34:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

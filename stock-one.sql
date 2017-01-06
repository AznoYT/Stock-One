-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 06 Janvier 2017 à 21:19
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `stock-one`
--

-- --------------------------------------------------------

--
-- Structure de la table `donnee`
--

CREATE TABLE IF NOT EXISTS `donnee` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nom_dossier` varchar(255) NOT NULL,
  `taille` int(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `public` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `donnee`
--

INSERT INTO `donnee` (`ID`, `identifiant`, `type`, `nom`, `nom_dossier`, `taille`, `adresse`, `public`) VALUES
(1, '4N4RCHY', 'pdf', 'Synthese activite 3.pdf', './files/4N4RCHY/', 51896, '', 'n'),
(2, '4N4RCHY', 'mp3', 'Track1.mp3', './files/4N4RCHY/', 284211, '', 'n'),
(3, '4N4RCHY', 'jpeg', 'sylvester staline.jpeg', './files/4N4RCHY/', 38399, '', 'n'),
(4, 'admin', 'png', 'folder.png', './files/admin/', 7047, '', 'n'),
(5, 'admin', 'png', 'gallery.png', './files/admin/', 9418, '', 'n'),
(6, 'admin', 'png', 'movie.png', './files/admin/', 4714, '', 'n'),
(7, 'admin', 'png', 'music.png', './files/admin/', 4793, '', 'n'),
(8, 'admin', 'png', 'text-file.png', './files/admin/', 2406, '', 'n');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `utilisateur` varchar(255) DEFAULT NULL,
  `nom` text,
  `prenom` text,
  `genre` text,
  `email` text,
  `pws` text,
  `notifso` text,
  `notifpartenaire` text,
  `GRADE` varchar(255) DEFAULT NULL,
  UNIQUE KEY `utilisateur` (`utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`utilisateur`, `nom`, `prenom`, `genre`, `email`, `pws`, `notifso`, `notifpartenaire`, `GRADE`) VALUES
('4N4RCHY', 'NOM', 'Prénom', 'Homme', 'adresse.mail@gmail.com', 'incorrect', 'n', 'n', 'USER'),
('admin', '', '', 'Autres', '', 'admin', 'y', 'n', 'ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

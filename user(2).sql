-- phpMyAdmin SQL Dump
-- version 4.2.0
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 16 Décembre 2016 à 16:19
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
  `notifpartenaire` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`utilisateur`, `nom`, `prenom`, `genre`, `email`, `pws`, `notifso`, `notifpartenaire`) VALUES
('4N4RCHY', 'CARDINAL', 'Florian', 'Homme', 'adresse.mail@gmail.com', 'incorrect', 'n', 'n'),
('pipix82', '1', '1', 'Homme', '1@gf', '1', 'y', 'y'),
('Azno', 'Sage', 'Ugo', 'Homme', 'ugo31140@gmail.com', 'ugo31140', 'y', 'y');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD UNIQUE KEY `utilisateur` (`utilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

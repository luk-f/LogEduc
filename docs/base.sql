-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 11 Mai 2015 à 13:38
-- Version du serveur: 5.5.41-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `MIF22-LogEdu`
--

DROP TABLE IF EXISTS `mif22_news`;
DROP TABLE IF EXISTS `mif22_user`;
DROP TABLE IF EXISTS `mif22_levelUserExercice`;

-- ----------------------------------------------------------------------------------------------------------------
--
-- Structure de la table `mif22_news`
--

CREATE TABLE IF NOT EXISTS `mif22_news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `content_news` text NOT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `mif22_news`
--

INSERT INTO `mif22_news` (`id_news`, `content_news`) VALUES
(1, 'Lucas Fouladi, grand compositeur de piano virtuel, est en fait un immigr&eacute; vietnamien clandestin'),
(2, 'Quentin est plus connu sur la sc&egrave;ne internationale sous le nom de Poopy'),
(3, 'La guitare se d&eacute;compose en deux grandes cat&eacute;gories: la guiatre accoustique et la guitare &eacute;lectrique'),
(4, 'Le premier piano date des ann&eacute;es 1700'),
(5, 'On distingue trois grands types instruments, les instruments &agrave; corde, les instruments &agrave; vent et les instruments de percussion');

-- ----------------------------------------------------------------------------------------------------------------
--
-- Structure de la table `mif22_user`
--

CREATE TABLE IF NOT EXISTS `mif22_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `mif22_user`
--

INSERT INTO `mif22_user` (`id_user`, `username_user`, `password_user`) VALUES
(1, 'babs', 'lol'),
(2, 'SmartiesParty', 'mif22'),
(3, 'klu', 'klu');

-- ----------------------------------------------------------------------------------------------------------------
--
-- Structure de la table `mif22_levelUserExercice`
--

CREATE TABLE IF NOT EXISTS `mif22_levelUserExercice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_exercice` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `mif22_user`
--

INSERT INTO `mif22_levelUserExercice` (`id_user`, `id_exercice`, `level`) VALUES
(1, 1, 2),
(1, 2, 7),
(1, 3, 3),
(2, 1, 0),
(2, 2, 0),
(2, 3, 0),
(3, 1, 0),
(3, 2, 0),
(3, 3, 0);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


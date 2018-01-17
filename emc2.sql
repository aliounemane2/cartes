-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 07 Août 2015 à 19:49
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `emc2`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectation`
--

CREATE TABLE IF NOT EXISTS `affectation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zone_id` int(11) NOT NULL,
  `commercial_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7241EE049F2C3FAB` (`zone_id`),
  KEY `IDX_7241EE047854071C` (`commercial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `affectation`
--

INSERT INTO `affectation` (`id`, `event`, `zone_id`, `commercial_id`) VALUES
(1, 'Entree', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nomc`) VALUES
(4, 'boutique'),
(5, 'entreprise'),
(6, 'ecole'),
(7, 'pharmacie');

-- --------------------------------------------------------

--
-- Structure de la table `commercial`
--

CREATE TABLE IF NOT EXISTS `commercial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `commercial`
--

INSERT INTO `commercial` (`id`, `nom`, `prenom`) VALUES
(1, 'Cissé', 'Médoune'),
(3, 'Thiaw ', 'Laye');

-- --------------------------------------------------------

--
-- Structure de la table `limite`
--

CREATE TABLE IF NOT EXISTS `limite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `zone_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A5BB88DC9F2C3FAB` (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Contenu de la table `limite`
--

INSERT INTO `limite` (`id`, `latitude`, `longitude`, `zone_id`) VALUES
(1, 14.736225210734796, -17.47254252433777, 1),
(2, 14.732884134445854, -17.475932836532593, 1),
(3, 14.732707740795513, -17.46829390525818, 1),
(4, 14.736183706995813, -17.477166652679443, 2),
(5, 14.73491783915858, -17.4782395362854, 2),
(6, 14.73491783915858, -17.47649073600769, 2),
(7, 14.736339345976186, -17.46752142906189, 3),
(8, 14.733714220294916, -17.468883991241455, 3),
(9, 14.733672716077576, -17.465869188308716, 3),
(10, 14.736401601537217, -17.47428059577942, 4),
(11, 14.73537438250529, -17.47475266456604, 4),
(12, 14.73568566151134, -17.473948001861572, 4),
(13, 14.736806262250145, -17.472370862960815, 4);

-- --------------------------------------------------------

--
-- Structure de la table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F9036963BCF5E72D` (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `places`
--

INSERT INTO `places` (`id`, `nomp`, `latitude`, `longitude`, `categorie_id`) VALUES
(1, 'uvs', 14.73488671116828, -17.472703456878662, 4),
(2, 'emc2', 14.73334068205419, -17.47248888015747, 5),
(3, 'zarezar', 14.73435753465272, -17.474355697631836, 6),
(4, 'sdcqds', 14.734378286697167, -17.472681999206543, 5),
(5, 'zsefzfe', 14.735996940072571, -17.469699382781982, 6),
(8, 'SDCQS', 14.734056629786334, -17.475568056106567, 5),
(9, 'qssddd', 14.732002164766207, -17.47626543045044, 6),
(10, 'aqzdaz', 14.733579331559636, -17.47921586036682, 7);

-- --------------------------------------------------------

--
-- Structure de la table `point`
--

CREATE TABLE IF NOT EXISTS `point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `heure` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `zone`
--

INSERT INTO `zone` (`id`, `nom`) VALUES
(1, 'Mermoz'),
(2, 'UCAD'),
(3, 'Tobago'),
(4, 'hgcg');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `affectation`
--
ALTER TABLE `affectation`
  ADD CONSTRAINT `FK_7241EE047854071C` FOREIGN KEY (`commercial_id`) REFERENCES `commercial` (`id`),
  ADD CONSTRAINT `FK_7241EE049F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`);

--
-- Contraintes pour la table `limite`
--
ALTER TABLE `limite`
  ADD CONSTRAINT `FK_A5BB88DC9F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`);

--
-- Contraintes pour la table `places`
--
ALTER TABLE `places`
  ADD CONSTRAINT `FK_F9036963BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

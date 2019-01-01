-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 24 Mars 2016 à 17:51
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `calendar`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `color`, `start`, `end`) VALUES
(1, 'All Day Event', 'some text for all day event', '#40E0D0', '2019-01-01 00:00:00', '2019-01-02 00:00:00'),
(2, 'Long Event', 'some text for long event', '#FF0000', '2019-01-07 00:00:00', '2019-01-10 00:00:00'),
(3, 'Short Event', 'some text for repeating event', '#0071c5', '2019-01-09 16:00:00', '2019-01-09 16:30:00'),
(4, 'Conference', 'some text for conference', '#40E0D0', '2019-01-10 00:00:00', '2019-01-12 00:00:00'),
(5, 'Meeting', 'some text for meeting', '#000', '2019-01-11 10:30:00', '2019-01-11 12:30:00'),
(6, 'Lunch', 'some text for lunch', '#0071c5', '2019-01-11 12:00:00', '2019-01-11 1:00:00'),
(7, 'Happy Hour', 'some text for happy hour', '#0071c5', '2019-01-11 17:30:00', '2019-01-11 19:00:00'),
(8, 'Dinner', 'some text for dinner', '#0071c5', '2019-01-11 16:00:00', '2019-01-11 17:30:00'),
(9, 'Birthday Party', 'some text for birthday party', '#FFD700', '2019-01-13 09:00:00', '2019-01-13 12:00:00'),
(10, 'Vacation', 'some text for vacation', '#008000', '2019-01-18 00:00:00', '2019-01-21 00:00:00'),
(11, 'Shopping', 'some text for shopping', '#FF8C00', '2019-01-31 17:30:00', '2019-01-31 18:30:00'),
(12, 'Double click to change', 'some text for double click', '#000', '2019-01-22 00:00:00', '2019-01-22 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

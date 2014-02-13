-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2013 at 04:13 PM
-- Server version: 5.6.15
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `ap_properties`
--

CREATE TABLE IF NOT EXISTS `ap_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `builder` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price_min` float NOT NULL DEFAULT '0',
  `price_max` float NOT NULL DEFAULT '0',
  `sq_ft` int(11) NOT NULL,
  `beds_min` int(11) NOT NULL,
  `beds_max` int(11) NOT NULL,
  `baths_min` int(11) NOT NULL,
  `baths_max` int(11) NOT NULL,
  `stories` int(11) NOT NULL,
  `garage_bays_min` int(11) NOT NULL,
  `garage_bays_max` int(11) NOT NULL,
  `renderings` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `ap_properties`
--

INSERT INTO `ap_properties` (`id`, `builder`, `series`, `model`, `price_min`, `price_max`, `sq_ft`, `beds_min`, `beds_max`, `baths_min`, `baths_max`, `stories`, `garage_bays_min`, `garage_bays_max`, `renderings`, `info`) VALUES
(1, 'Toll Brothers', 'Coronado II', 'Cordoba', 262995, 264995, 2097, 3, 3, 3, 3, 2, 0, 0, '', ''),
(2, 'Toll Brothers', 'Coronado II', 'Madeira', 270995, 272995, 2192, 4, 4, 3, 3, 2, 2, 2, '', ''),
(3, 'Toll Brothers', 'Coronado II', 'Santiago', 279995, 281995, 2464, 3, 3, 3, 3, 2, 2, 2, '', ''),
(4, 'Toll Brothers', 'Bellante', 'Catania', 0, 0, 2495, 3, 3, 3, 3, 1, 2, 3, '', ''),
(5, 'Toll Brothers', 'Bellante', 'Messina', 0, 0, 2684, 3, 3, 3, 3, 1, 3, 3, '', ''),
(6, 'Toll Brothers', 'Bellante', 'Trapani', 0, 0, 2874, 4, 4, 4, 4, 1, 3, 3, '', ''),
(7, 'Toll Brothers', 'Villamar', 'Andora', 0, 0, 2544, 4, 4, 3, 3, 2, 2, 2, '', ''),
(8, 'Toll Brothers', 'Villamar', 'Ravello', 0, 0, 2675, 4, 4, 3, 3, 2, 2, 2, '', ''),
(9, 'Toll Brothers', 'Villamar', 'Treviso', 0, 0, 2954, 4, 4, 3, 3, 2, 2, 2, '', ''),
(10, 'Toll Brothers', 'Carmona', 'Avenida', 0, 0, 3393, 4, 4, 3, 3, 2, 3, 3, '', ''),
(11, 'Toll Brothers', 'Carmona', 'Valencia', 0, 0, 3607, 4, 4, 3, 3, 2, 3, 3, '', ''),
(12, 'Toll Brothers', 'Carmona', 'Maravilla', 0, 0, 3792, 4, 4, 3, 3, 2, 3, 3, '', ''),
(13, 'KB HOME', 'Van Gogh', 'Van Gogh 3161', 0, 0, 3161, 3, 6, 3, 4, 2, 2, 3, '', ''),
(14, 'KB HOME', 'Van Gogh', 'Can Gogh 1957', 0, 0, 1957, 3, 3, 2, 2, 1, 2, 3, '', ''),
(15, 'KB HOME', 'Van Gogh', 'Van Gogh 2713', 0, 0, 2713, 3, 5, 3, 3, 2, 2, 2, '', ''),
(16, 'KB HOME', 'Van Gogh', 'Van Gogh 3153', 0, 0, 3153, 4, 5, 3, 3, 2, 2, 2, '', ''),
(17, 'KB HOME', 'Van Gogh', 'Van Gogh 3558', 0, 0, 3558, 4, 6, 3, 3, 2, 2, 2, '', ''),
(18, 'KB HOME', 'Renoir', 'Renoir 1745', 0, 0, 1745, 3, 3, 3, 3, 2, 2, 2, '', ''),
(19, 'KB HOME', 'Renoir', 'Renoir 1874', 0, 0, 1874, 3, 3, 3, 3, 2, 2, 2, '', ''),
(20, 'KB HOME', 'Renoir', 'Renoir 2228', 0, 0, 2228, 3, 4, 3, 3, 2, 2, 2, '', ''),
(21, 'KB HOME', 'Renoir', 'Renoir 2351', 0, 0, 2351, 3, 5, 3, 3, 2, 2, 2, '', ''),
(22, 'KB HOME', 'Monet', 'Monet 1576', 0, 0, 1576, 3, 3, 3, 3, 2, 2, 2, '', ''),
(23, 'KB HOME', 'Monet', 'Monet 1736', 0, 0, 1736, 3, 3, 3, 3, 2, 2, 2, '', ''),
(24, 'KB HOME', 'Monet', 'Monet 1843', 0, 0, 1843, 3, 3, 3, 3, 2, 2, 2, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

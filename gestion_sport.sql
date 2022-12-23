-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 06, 2019 at 11:03 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_sport`
--

-- --------------------------------------------------------

--
-- Table structure for table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `Matricule` int(4) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Date_Naissance` date NOT NULL,
  `Adresse` varchar(30) NOT NULL,
  `Tel` varchar(15) NOT NULL,
  `Fax` varchar(15) NOT NULL,
  `Email` varchar(25) NOT NULL,
  PRIMARY KEY (`Matricule`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joueurs`
--

INSERT INTO `joueurs` (`Matricule`, `Nom`, `Prenom`, `Date_Naissance`, `Adresse`, `Tel`, `Fax`, `Email`) VALUES
(1, 'Riad', 'hacheman', '1999-11-13', 'Annaba,sidiamar,chaiba,uv12', '0673775937', '0333775937', 'dzriaddz@gmail.com'),
(2, 'Riad', 'Mehrez', '1992-05-24', 'alger,listercity', '0673475778', '0333475778', 'mehrez@lc.com');

-- --------------------------------------------------------

--
-- Table structure for table `pratiques`
--

DROP TABLE IF EXISTS `pratiques`;
CREATE TABLE IF NOT EXISTS `pratiques` (
  `Code_Sport` int(2) NOT NULL,
  `Matricule` int(4) NOT NULL,
  `Date_Debut` date NOT NULL,
  `Date_Fin` date NOT NULL,
  PRIMARY KEY (`Code_Sport`,`Matricule`,`Date_Debut`),
  KEY `Code_Sport` (`Code_Sport`,`Matricule`),
  KEY `fk_m` (`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pratiques`
--

INSERT INTO `pratiques` (`Code_Sport`, `Matricule`, `Date_Debut`, `Date_Fin`) VALUES
(2, 1, '2019-07-01', '2019-07-01'),
(3, 1, '2019-07-18', '2019-08-02'),
(3, 2, '2019-07-03', '2019-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `Code_Sport` int(2) NOT NULL AUTO_INCREMENT,
  `Designation_Sport` varchar(15) NOT NULL,
  `Type_Sport` enum('indivuduel','collectif') NOT NULL,
  PRIMARY KEY (`Code_Sport`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`Code_Sport`, `Designation_Sport`, `Type_Sport`) VALUES
(2, 'football', 'collectif'),
(3, 'ten', 'indivuduel');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pratiques`
--
ALTER TABLE `pratiques`
  ADD CONSTRAINT `fk_cs` FOREIGN KEY (`Code_Sport`) REFERENCES `sports` (`Code_Sport`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_m` FOREIGN KEY (`Matricule`) REFERENCES `joueurs` (`Matricule`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

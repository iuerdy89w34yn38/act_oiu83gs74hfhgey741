-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 28, 2019 at 12:28 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `act_t`
--

DROP TABLE IF EXISTS `act_t`;
CREATE TABLE IF NOT EXISTS `act_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(20) DEFAULT NULL,
  `name` text NOT NULL,
  `balance` text NOT NULL,
  `tbshow` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `act_t`
--

INSERT INTO `act_t` (`id`, `slug`, `name`, `balance`, `tbshow`) VALUES
(1, 'capital', 'Capital', 'credit', 3),
(2, 'revenue', 'Revenue', 'credit', 5),
(3, 'liability', 'Liability', 'credit', 1),
(4, 'expenses', 'Expenses', 'debit', 7),
(5, 'current assets', 'Current Assets', 'debit', 0),
(6, 'fixed assets', 'Fixed Assets', 'debit', 2),
(7, 'drawing capital', 'Drawing Capital', 'debit', 4),
(10, 'cogs', 'Cost of Goods Sold', 'debit', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

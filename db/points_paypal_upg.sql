-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2013 at 07:09 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rayku_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `points_paypal`
--

CREATE TABLE IF NOT EXISTS `points_paypal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `shipping_charge_per_unit` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `points` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `points_paypal`
--

INSERT INTO `points_paypal` (`id`, `title`, `description`, `shipping_charge_per_unit`, `price`, `points`) VALUES
(1, '500', 'To get 500RP', 0, 5, 500),
(2, '1000', 'To get 1000RP', 0, 10, 1000),
(3, '2500', 'To get 2500RP', 0, 25, 2500),
(4, '5000', 'To get 5000RP', 0, 50, 5000),
(5, '10000', 'To get 10000RP', 0, 100, 10000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

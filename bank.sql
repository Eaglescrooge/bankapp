-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2017 at 05:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `secured_password` char(32) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `password`, `secured_password`) VALUES
(1, 'chigozie', 'pword', '47e2a2bc8c8a6988b78e57fe6d19b74d'),
(2, 'James', 'james1', '1613f36d06342303f69469f5a1b29c21'),
(3, 'bola', 'laptop', '312f91285e048e09bb4aefef23627994');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` char(11) NOT NULL,
  `account_type` varchar(15) NOT NULL,
  `opening_balance` float(10,2) NOT NULL,
  `account_balance` float(10,2) NOT NULL,
  `account_number` char(11) NOT NULL,
  `password` char(32) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `firstname`, `lastname`, `email`, `phone_number`, `account_type`, `opening_balance`, `account_balance`, `account_number`, `password`, `admin_id`) VALUES
(1, 'James', 'Opin', 'jopin@gmail.com', '07089523476', 'Current', 10000.00, 5000.00, '646853735', 'b4cc344d25a2efe540adbf2678e2304c', 1),
(2, 'Chigozirim', 'Iheanacho', 'chigozie.acho23@gmail.com', '07089523476', 'domicillary', 10000.00, 11000.00, '264258168', 'b12a583bf5986b37a9bac3c3cd8f2528', 1),
(3, 'Philippe', 'Petit', 'p.petti@gmail.com', '08056749876', 'savings', 6000.00, 30000.00, '982888915', 'e3ab6dbf6a4a2ea457083f1463630d87', 1),
(4, 'Okorie', 'Augustine', 'a.okorie@javingroup.com', '00956834597', 'savings', 250000.00, 230000.00, '126599500', 'b2ee12acfbeafe2725a0d108228d3e07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_date` datetime NOT NULL,
  `transaction_type` varchar(20) NOT NULL,
  `sender` varchar(40) NOT NULL,
  `recipient` varchar(40) NOT NULL,
  `transfer_amount` float(10,2) NOT NULL,
  `initial_balance` float(10,2) NOT NULL,
  `final_balance` float(10,2) NOT NULL,
  `customer_id` int(10) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_date`, `transaction_type`, `sender`, `recipient`, `transfer_amount`, `initial_balance`, `final_balance`, `customer_id`) VALUES
(1, '2017-10-17 14:56:59', 'debit', 'self', 'Philippe Petit', 2000.00, 10000.00, 8000.00, 2),
(2, '2017-10-17 14:56:59', 'credit', 'Chigozirim Iheanacho', 'self', 2000.00, 6000.00, 8000.00, 3),
(3, '2017-10-18 08:04:55', 'debit', 'self', 'Philippe Petit', 7000.00, 8000.00, 1000.00, 2),
(4, '2017-10-18 08:04:56', 'credit', 'Chigozirim Iheanacho', 'self', 7000.00, 8000.00, 15000.00, 3),
(5, '2017-10-18 08:06:56', 'debit', 'self', 'Chigozirim Iheanacho', 5000.00, 15000.00, 10000.00, 3),
(6, '2017-10-18 08:06:56', 'credit', 'Philippe Petit', 'self', 5000.00, 1000.00, 6000.00, 2),
(7, '2017-10-18 08:08:45', 'debit', 'self', 'Chigozirim Iheanacho', 5000.00, 10000.00, 5000.00, 1),
(8, '2017-10-18 08:08:46', 'credit', 'James Opin', 'self', 5000.00, 6000.00, 11000.00, 2),
(9, '2017-10-18 08:27:23', 'debit', 'self', 'Philippe Petit', 20000.00, 250000.00, 230000.00, 4),
(10, '2017-10-18 08:27:23', 'credit', 'Okorie Augustine', 'self', 20000.00, 10000.00, 30000.00, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

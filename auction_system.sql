-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2015 at 06:07 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auction_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE IF NOT EXISTS `customer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) DEFAULT NULL,
  `email` text,
  `password` varchar(11) DEFAULT NULL,
  `fname` text,
  `lname` text,
  `phone_no` text,
  `gender` text,
  `date_of_birth` date DEFAULT NULL,
  `street_add` text,
  `city` text,
  `postal_code` varchar(10) DEFAULT NULL,
  `province` text,
  `country` text,
  `deactivate` int(1) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `username`, `email`, `password`, `fname`, `lname`, `phone_no`, `gender`, `date_of_birth`, `street_add`, `city`, `postal_code`, `province`, `country`, `deactivate`, `created_date`) VALUES
(1, 'admin', 'parthdesai786619@gmail.com', 'admin', 'Parth', 'Desai', '4380001234', 'Male', '1989-04-04', 'De Westmount', 'Montreal', 'H3H1K8', 'Quebec', 'Canada', 0, '0000-00-00 00:00:00'),
(2, 'bhavik', 'bhavikdesai1812@gmail.com', 'test', 'Bhavik', 'Desai', '5148482424', 'Male', '1990-12-16', '1645 De Maisonneuve Ouest', 'Montreal', 'H3H2N3', 'Quebec', 'CA', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_bid`
--

CREATE TABLE IF NOT EXISTS `product_bid` (
  `auction_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `email` text,
  `product_bid_amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`auction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE IF NOT EXISTS `product_details` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `id` int(11) DEFAULT NULL,
  `product_name` text,
  `prod_description` text,
  `prod_category` text,
  `product_bit_amt` text,
  `image` varchar(100) DEFAULT NULL,
  `temp_image` longblob NOT NULL,
  `created_at` datetime NOT NULL,
  `is_bid_over` int(255) NOT NULL,
  `biding_date` datetime NOT NULL,
  `winner_name` varchar(255) NOT NULL,
  `winner_price` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

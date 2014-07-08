-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2014 at 08:15 AM
-- Server version: 5.6.17
-- PHP Version: 5.4.24

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shineisp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `uid`, `sku`, `type_id`, `createdat`, `updatedat`) VALUES
(2, '07ed19b2-a890-4a4a-89ec-dcd3b9734a8a', 'test', 1, '2014-07-08 07:49:02', '2014-07-08 07:49:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_groups`
--

DROP TABLE IF EXISTS `product_groups`;
CREATE TABLE IF NOT EXISTS `product_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_groups`
--

INSERT INTO `product_groups` (`id`, `name`) VALUES
(1, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
CREATE TABLE IF NOT EXISTS `product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`) VALUES
(1, 'Simple');
SET FOREIGN_KEY_CHECKS=1;

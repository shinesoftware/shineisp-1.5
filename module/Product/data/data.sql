-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2014 at 07:48 AM
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
  `type_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`attribute_set_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `uid`, `type_id`, `attribute_set_id`, `createdat`, `updatedat`) VALUES
(2, '22ff2755-1540-4d68-8195-079356c33e22', 1, 1, '2014-07-08 10:21:40', '2014-07-10 16:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE IF NOT EXISTS `product_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`) VALUES
(1, 'name'),
(3, 'description'),
(4, 'metakeyword');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_groups`
--

DROP TABLE IF EXISTS `product_attributes_groups`;
CREATE TABLE IF NOT EXISTS `product_attributes_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product_attributes_groups`
--

INSERT INTO `product_attributes_groups` (`id`, `name`) VALUES
(1, 'Main'),
(2, 'Price'),
(3, 'Metadata');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_set`
--

DROP TABLE IF EXISTS `product_attributes_set`;
CREATE TABLE IF NOT EXISTS `product_attributes_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_attributes_set`
--

INSERT INTO `product_attributes_set` (`id`, `name`) VALUES
(1, 'Default'),
(2, 'Hosting');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_set_idx`
--

DROP TABLE IF EXISTS `product_attributes_set_idx`;
CREATE TABLE IF NOT EXISTS `product_attributes_set_idx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_set_id` (`attribute_set_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `product_attributes_set_idx`
--

INSERT INTO `product_attributes_set_idx` (`id`, `attribute_id`, `attribute_set_id`) VALUES
(23, 3, 1),
(24, 4, 1),
(25, 1, 1);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attributes_set_idx`
--
ALTER TABLE `product_attributes_set_idx`
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

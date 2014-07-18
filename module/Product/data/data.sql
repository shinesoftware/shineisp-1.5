-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2014 at 04:15 PM
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
  `code` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `label` varchar(200) NOT NULL,
  `source_model` varchar(200) DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `code`, `type`, `label`, `source_model`, `is_required`, `is_user_defined`) VALUES
(1, 'name', 'text', 'Name', '', 1, 0),
(2, 'sku', 'text', 'SKU', '', 1, 0),
(3, 'metadescription', 'textarea', 'META Description', NULL, 0, 0),
(4, 'metakeyword', 'text', 'META Keywords', NULL, 0, 0),
(5, 'metatitle', 'text', 'META Title', NULL, 0, 0),
(6, 'status', 'select', 'Status', '\\Base\\Form\\Element\\Enadisabled', 1, 0),
(7, 'urlkey', 'text', 'URL Key', NULL, 1, 0),
(8, 'news_from_date', 'text', 'Set Product as New from Date', NULL, 0, 0),
(9, 'news_to_date', 'text', 'Set Product as New to Date', NULL, 0, 0),
(10, 'short_description', 'textarea', 'Short Description', NULL, 1, 0),
(11, 'description', 'textarea', 'Description', NULL, 1, 0),
(12, 'price', 'text', 'Price', NULL, 1, 0),
(13, 'special_price', 'text', 'Special Price', NULL, 0, 0);

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
  `attribute_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  KEY `attribute_set_id` (`attribute_set_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attributes_set_idx`
--

INSERT INTO `product_attributes_set_idx` (`attribute_id`, `attribute_set_id`) VALUES
(11, 1),
(3, 1),
(4, 1),
(5, 1),
(1, 1),
(8, 1),
(9, 1),
(12, 1),
(10, 1),
(2, 1),
(13, 1),
(6, 1),
(7, 1);

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

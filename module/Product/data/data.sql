-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2014 at 02:26 PM
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
  `type` varchar(200) NOT NULL,
  `input` varchar(50) NOT NULL,
  `css` varchar(250) DEFAULT NULL,
  `label` varchar(200) NOT NULL,
  `source_model` varchar(200) DEFAULT NULL,
  `filters` varchar(255) DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`, `type`, `input`, `css`, `label`, `source_model`, `filters`, `is_required`, `is_user_defined`) VALUES
(1, 'name', 'string', 'text', NULL, 'Name', '', NULL, 1, 0),
(2, 'sku', 'string', 'text', NULL, 'SKU', NULL, '["stringtolower"]', 1, 0),
(3, 'metadescription', 'text', 'textarea', NULL, 'META Description', NULL, NULL, 0, 0),
(4, 'metakeyword', 'string', 'text', NULL, 'META Keywords', NULL, NULL, 0, 0),
(5, 'metatitle', 'string', 'text', NULL, 'META Title', NULL, NULL, 0, 0),
(6, 'status', 'integer', 'select', NULL, 'Status', '\\Base\\Form\\Element\\Enadisabled', NULL, 1, 0),
(7, 'urlkey', 'string', 'text', NULL, 'URL Key', NULL, '["stringtolower"]', 0, 0),
(8, 'news_from_date', 'datetime', 'text', 'date', 'Set Product as New from Date', NULL, NULL, 0, 0),
(9, 'news_to_date', 'datetime', 'text', 'date', 'Set Product as New to Date', NULL, NULL, 0, 0),
(10, 'short_description', 'text', 'textarea', NULL, 'Short Description', NULL, NULL, 1, 0),
(11, 'description', 'text', 'textarea', NULL, 'Description', NULL, NULL, 1, 0),
(12, 'price', 'float', 'text', NULL, 'Price', NULL, NULL, 1, 0),
(13, 'special_price', 'string', 'text', NULL, 'Special Price', NULL, NULL, 0, 0);


--
-- Struttura della tabella `product_attributes_entity_date`
--

DROP TABLE IF EXISTS `product_attributes_entity_date`;
CREATE TABLE IF NOT EXISTS `product_attributes_entity_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
SET FOREIGN_KEY_CHECKS=1;

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_entity_datetime`
--

DROP TABLE IF EXISTS `product_attributes_entity_datetime`;
CREATE TABLE IF NOT EXISTS `product_attributes_entity_datetime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_entity_float`
--

DROP TABLE IF EXISTS `product_attributes_entity_float`;
CREATE TABLE IF NOT EXISTS `product_attributes_entity_float` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_entity_integer`
--

DROP TABLE IF EXISTS `product_attributes_entity_integer`;
CREATE TABLE IF NOT EXISTS `product_attributes_entity_integer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_entity_string`
--

DROP TABLE IF EXISTS `product_attributes_entity_string`;
CREATE TABLE IF NOT EXISTS `product_attributes_entity_string` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_entity_text`
--

DROP TABLE IF EXISTS `product_attributes_entity_text`;
CREATE TABLE IF NOT EXISTS `product_attributes_entity_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Constraints for table `product_attributes_entity_datetime`
--
ALTER TABLE `product_attributes_entity_datetime`
  ADD CONSTRAINT `product_attributes_entity_datetime_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_datetime_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_entity_float`
--
ALTER TABLE `product_attributes_entity_float`
  ADD CONSTRAINT `product_attributes_entity_float_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_float_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_entity_integer`
--
ALTER TABLE `product_attributes_entity_integer`
  ADD CONSTRAINT `product_attributes_entity_integer_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_integer_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_entity_string`
--
ALTER TABLE `product_attributes_entity_string`
  ADD CONSTRAINT `product_attributes_entity_string_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_string_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_entity_text`
--
ALTER TABLE `product_attributes_entity_text`
  ADD CONSTRAINT `product_attributes_entity_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_set_idx`
--
ALTER TABLE `product_attributes_set_idx`
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

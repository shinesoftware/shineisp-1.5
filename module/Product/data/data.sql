-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2014 at 01:52 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `uid`, `type_id`, `attribute_set_id`, `createdat`, `updatedat`) VALUES
(2, '22ff2755-1540-4d68-8195-079356c33e22', 1, 2, '2014-07-08 10:21:40', '2014-09-02 13:29:14'),
(3, '2ad38cd7-be51-43f5-8f98-9564e9a4b341', 1, 1, '2014-08-27 16:26:10', '2014-08-27 16:26:10'),
(4, '6315bd2c-83fc-473e-ba6b-47e4783dfaaa', 1, 1, '2014-08-27 16:29:10', '2014-08-27 16:29:10'),
(5, '63e023b7-6253-4c5a-b38a-4b629e1b704e', 1, 1, '2014-08-27 16:29:41', '2014-08-27 16:29:41'),
(6, 'b4490416-d41e-43a5-998d-1c88e97a1012', 1, 1, '2014-08-27 16:30:02', '2014-08-27 16:30:02'),
(7, '7a45aee9-9acb-4057-b88e-e652d695edf9', 1, 1, '2014-08-27 16:30:21', '2014-08-27 16:30:21'),
(8, '3f3a0014-c90b-4bdb-b936-ec863a00f9cd', 1, 1, '2014-08-27 16:32:19', '2014-08-28 08:38:27');

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
  `validators` text,
  `filetarget` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `filemimetype` text,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`, `type`, `input`, `css`, `label`, `source_model`, `filters`, `validators`, `filetarget`, `filesize`, `filemimetype`, `is_required`, `is_user_defined`) VALUES
(1, 'name', 'string', 'text', NULL, 'Name', '', NULL, NULL, '', NULL, NULL, 1, 0),
(2, 'sku', 'string', 'text', NULL, 'SKU', NULL, '["stringtolower"]', NULL, '', NULL, NULL, 1, 0),
(3, 'metadescription', 'text', 'textarea', NULL, 'META Description', NULL, NULL, NULL, '', NULL, NULL, 0, 0),
(4, 'metakeyword', 'string', 'text', NULL, 'META Keywords', NULL, NULL, NULL, '', NULL, NULL, 0, 0),
(5, 'metatitle', 'string', 'text', NULL, 'META Title', NULL, NULL, NULL, '', NULL, NULL, 0, 0),
(6, 'status', 'integer', 'select', NULL, 'Status', '\\Base\\Form\\Element\\Enadisabled', NULL, NULL, '', NULL, NULL, 1, 0),
(7, 'urlkey', 'string', 'text', NULL, 'URL Key', NULL, '["stringtolower"]', NULL, '', NULL, NULL, 0, 0),
(8, 'news_from_date', 'date', 'text', 'form-control date', 'Set Product as New from Date', NULL, NULL, NULL, '', NULL, NULL, 0, 0),
(9, 'news_to_date', 'date', 'text', 'form-control date', 'Set Product as New to Date', NULL, NULL, NULL, '', NULL, NULL, 0, 0),
(10, 'short_description', 'text', 'textarea', NULL, 'Short Description', NULL, NULL, NULL, '', NULL, NULL, 1, 0),
(11, 'description', 'text', 'textarea', NULL, 'Description', NULL, NULL, NULL, '', NULL, NULL, 1, 0),
(12, 'price', 'float', 'text', NULL, 'Price', NULL, NULL, NULL, '', NULL, NULL, 1, 0),
(13, 'special_price', 'string', 'text', NULL, 'Special Price', NULL, NULL, NULL, '', NULL, NULL, 0, 0),
(14, 'webspace', 'string', 'text', '', 'Web Space', NULL, '["int"]', NULL, '', NULL, NULL, 0, 1),
(15, 'photo', 'string', 'file', 'file', 'Photo', 'Zend\\Form\\Element\\File', '[{"name":"File\\\\RenameUpload","options":{"target":"\\/Library\\/WebServer\\/Documents\\/shineisp2\\/public\\/documents\\/product\\/images\\/","overwrite":true,"use_upload_name":true}}]', '[{"name":"File\\\\UploadFile","filesize":{"max":"100000"},"filemimetype":[{"mimeType":"image\\/jpeg"},{"mimeType":"image\\/gif"},{"mimeType":"image\\/png"}]}]', '/documents/product/images', 100000, '["image\\/jpeg","image\\/gif","image\\/png"]', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_entity_date`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product_attributes_entity_date`
--

INSERT INTO `product_attributes_entity_date` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 8, '2014-09-24'),
(2, 2, 9, '2014-09-24'),
(3, 8, 8, '2014-09-03'),
(4, 8, 9, '2014-08-20');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_attributes_entity_float`
--

INSERT INTO `product_attributes_entity_float` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 12, 10.5),
(2, 8, 12, 10.5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_attributes_entity_integer`
--

INSERT INTO `product_attributes_entity_integer` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 6, 1),
(2, 8, 6, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `product_attributes_entity_string`
--

INSERT INTO `product_attributes_entity_string` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 4, NULL),
(2, 2, 1, 'hosting silver'),
(3, 2, 2, 'hst-01'),
(4, 2, 13, NULL),
(5, 2, 7, 'hosting'),
(6, 2, 5, NULL),
(7, 2, 14, '100'),
(8, 8, 1, 'Hosting Gold'),
(9, 8, 2, 'hst-02'),
(10, 8, 7, 'hosting-gold'),
(11, 8, 13, '8.60'),
(12, 8, 4, NULL),
(13, 8, 5, NULL),
(15, 2, 8, '2014-09-17'),
(16, 2, 9, '02/09/17'),
(17, 2, 15, 'Schermata 2014-09-02 alle 11.34.58.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `product_attributes_entity_text`
--

INSERT INTO `product_attributes_entity_text` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 11, 'test B'),
(2, 2, 3, NULL),
(3, 2, 10, 'test A'),
(4, 8, 3, NULL),
(5, 8, 10, 'test'),
(6, 8, 11, 'test'),
(7, 2, 15, 'f24-turillo.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_groups`
--

DROP TABLE IF EXISTS `product_attributes_groups`;
CREATE TABLE IF NOT EXISTS `product_attributes_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product_attributes_groups`
--

INSERT INTO `product_attributes_groups` (`id`, `name`) VALUES
(1, 'Main'),
(2, 'Price'),
(3, 'Metadata'),
(11, 'Principale'),
(12, 'Hosting'),
(13, 'Content'),
(14, 'Custom'),
(15, 'Images');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_idx`
--

DROP TABLE IF EXISTS `product_attributes_idx`;
CREATE TABLE IF NOT EXISTS `product_attributes_idx` (
  `attribute_group_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  KEY `group_id` (`attribute_group_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `attribute_set_id` (`attribute_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attributes_idx`
--

INSERT INTO `product_attributes_idx` (`attribute_group_id`, `attribute_set_id`, `attribute_id`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 6),
(1, 1, 7),
(1, 1, 8),
(1, 1, 9),
(2, 1, 12),
(2, 1, 13),
(3, 1, 4),
(3, 1, 3),
(3, 1, 5),
(15, 1, 15),
(13, 1, 10),
(13, 1, 11),
(1, 2, 1),
(1, 2, 2),
(1, 2, 6),
(1, 2, 7),
(1, 2, 8),
(1, 2, 9),
(15, 2, 15),
(2, 2, 12),
(2, 2, 13),
(3, 2, 3),
(3, 2, 4),
(3, 2, 5),
(12, 2, 14),
(13, 2, 10),
(13, 2, 11);

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

-- --------------------------------------------------------

--
-- Table structure for table `product_entity_decimal`
--

DROP TABLE IF EXISTS `product_entity_decimal`;
CREATE TABLE IF NOT EXISTS `product_entity_decimal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(2,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_entity_int`
--

DROP TABLE IF EXISTS `product_entity_int`;
CREATE TABLE IF NOT EXISTS `product_entity_int` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_entity_string`
--

DROP TABLE IF EXISTS `product_entity_string`;
CREATE TABLE IF NOT EXISTS `product_entity_string` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_entity_text`
--

DROP TABLE IF EXISTS `product_entity_text`;
CREATE TABLE IF NOT EXISTS `product_entity_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Constraints for table `product_attributes_entity_date`
--
ALTER TABLE `product_attributes_entity_date`
  ADD CONSTRAINT `product_attributes_entity_date_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_date_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_entity_datetime`
--
ALTER TABLE `product_attributes_entity_datetime`
  ADD CONSTRAINT `product_attributes_entity_datetime_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_datetime_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `product_attributes_entity_integer_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_integer_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_entity_string`
--
ALTER TABLE `product_attributes_entity_string`
  ADD CONSTRAINT `product_attributes_entity_string_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_string_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_entity_text`
--
ALTER TABLE `product_attributes_entity_text`
  ADD CONSTRAINT `product_attributes_entity_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_idx`
--
ALTER TABLE `product_attributes_idx`
  ADD CONSTRAINT `product_attributes_idx_ibfk_1` FOREIGN KEY (`attribute_group_id`) REFERENCES `product_attributes_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_idx_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_idx_ibfk_3` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_set_idx`
--
ALTER TABLE `product_attributes_set_idx`
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

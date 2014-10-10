-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Ott 10, 2014 alle 12:50
-- Versione del server: 5.5.38-0ubuntu0.14.04.1
-- Versione PHP: 5.5.16-1+deb.sury.org~precise+2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shineisp2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `product`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dump dei dati per la tabella `product`
--

INSERT INTO `product` (`id`, `uid`, `type_id`, `attribute_set_id`, `createdat`, `updatedat`) VALUES
(2, '22ff2755-1540-4d68-8195-079356c33e22', 1, 2, '2014-07-08 10:21:40', '2014-10-01 11:30:06'),
(11, '9f30e196-295d-4f2d-b7a3-b5be6be1c4b4', 1, 1, '2014-09-25 17:54:56', '2014-09-25 17:54:56'),
(12, 'ea2d3798-3c29-48a5-9b04-76a1101881dc', 1, 2, '2014-09-25 18:07:28', '2014-09-25 18:07:28');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes`
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
  `quick_search` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`, `type`, `input`, `css`, `label`, `source_model`, `filters`, `validators`, `filetarget`, `filesize`, `filemimetype`, `is_required`, `is_user_defined`, `quick_search`) VALUES
(1, 'name', 'string', 'text', '', 'Name', NULL, NULL, NULL, '', NULL, NULL, 1, 0, 1),
(2, 'sku', 'string', 'text', '', 'SKU', NULL, '["cleanurl"]', NULL, '', NULL, NULL, 1, 0, 0),
(3, 'metadescription', 'text', 'textarea', NULL, 'META Description', NULL, NULL, NULL, '', NULL, NULL, 0, 0, 0),
(4, 'metakeyword', 'string', 'text', NULL, 'META Keywords', NULL, NULL, NULL, '', NULL, NULL, 0, 0, 0),
(5, 'metatitle', 'string', 'text', NULL, 'META Title', NULL, NULL, NULL, '', NULL, NULL, 0, 0, 0),
(6, 'status', 'integer', 'select', NULL, 'Status', '\\Base\\Form\\Element\\Enadisabled', NULL, NULL, '', NULL, NULL, 1, 0, 0),
(7, 'urlkey', 'string', 'text', '', 'URL Key', NULL, '["stringtolower","cleanurl"]', NULL, '', NULL, NULL, 0, 0, 0),
(8, 'news_from_date', 'date', 'text', 'form-control date', 'Set Product as New from Date', NULL, NULL, NULL, '', NULL, NULL, 0, 0, 0),
(9, 'news_to_date', 'date', 'text', 'form-control date', 'Set Product as New to Date', NULL, NULL, NULL, '', NULL, NULL, 0, 0, 0),
(10, 'short_description', 'text', 'textarea', NULL, 'Short Description', NULL, NULL, NULL, '', NULL, NULL, 1, 0, 0),
(11, 'description', 'text', 'textarea', NULL, 'Description', NULL, NULL, NULL, '', NULL, NULL, 1, 0, 0),
(12, 'price', 'float', 'text', NULL, 'Price', NULL, NULL, NULL, '', NULL, NULL, 1, 0, 0),
(13, 'special_price', 'string', 'text', NULL, 'Special Price', NULL, NULL, NULL, '', NULL, NULL, 0, 0, 0),
(14, 'webspace', 'string', 'text', '', 'Web Space', NULL, '["int"]', NULL, '', NULL, NULL, 0, 1, 0),
(15, 'photo', 'text', 'file', 'file', 'Photo', 'Zend\\Form\\Element\\File', '[{"name":"File\\\\RenameUpload","options":{"target":"\\/Library\\/WebServer\\/Documents\\/shineisp2\\/public\\/documents\\/product\\/","overwrite":true,"use_upload_name":true}}]', '[{"name":"File\\\\UploadFile","filesize":{"max":"100000"},"filemimetype":[{"mimeType":"image\\/jpeg"},{"mimeType":"image\\/gif"},{"mimeType":"image\\/png"}]}]', '/documents/product', 100000, '["image\\/jpeg","image\\/gif","image\\/png"]', 0, 0, 0),
(16, 'attachment', 'text', 'file', 'file', 'Attachment', 'Zend\\Form\\Element\\File', '[{"name":"File\\\\RenameUpload","options":{"target":"\\/Library\\/WebServer\\/Documents\\/shineisp2\\/public\\/documents\\/product\\/","overwrite":true,"use_upload_name":true}}]', '[{"name":"File\\\\UploadFile","filesize":{"max":"100000"},"filemimetype":[{"mimeType":"application\\/pdf"},{"mimeType":"application\\/msword"},{"mimeType":"application\\/zip"}]}]', '/documents/product', 100000, '["application\\/pdf","application\\/msword","application\\/zip"]', 0, 0, 0);

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_date`
--

INSERT INTO `product_attributes_entity_date` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 8, '2014-09-18'),
(2, 2, 9, '2014-09-17'),
(5, 11, 8, NULL),
(6, 11, 9, NULL),
(7, 12, 8, '2014-09-16'),
(8, 12, 9, '2014-09-30');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_entity_datetime`
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
-- Struttura della tabella `product_attributes_entity_float`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_float`
--

INSERT INTO `product_attributes_entity_float` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 12, 10.5),
(3, 11, 12, 19.99),
(4, 12, 12, 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_entity_integer`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_integer`
--

INSERT INTO `product_attributes_entity_integer` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 6, 1),
(3, 11, 6, 1),
(4, 12, 6, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_entity_string`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_string`
--

INSERT INTO `product_attributes_entity_string` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 4, 'keyword one, keyword two, keyword three'),
(2, 2, 1, 'Hosting Silver'),
(3, 2, 2, 'hst-01'),
(4, 2, 13, '8.60'),
(5, 2, 7, 'hosting-silver'),
(6, 2, 5, 'This is a custom product title '),
(7, 2, 14, '100'),
(15, 2, 8, '2014-09-17'),
(16, 2, 9, '02/09/17'),
(22, 11, 1, 'Zend Developer'),
(23, 11, 2, 'dev-01'),
(24, 11, 7, ''),
(25, 11, 13, '18'),
(26, 11, 4, ''),
(27, 11, 5, ''),
(28, 12, 1, 'Hosting Gold'),
(29, 12, 2, 'hst-02'),
(30, 12, 7, ''),
(31, 12, 13, '12'),
(32, 12, 4, ''),
(33, 12, 5, ''),
(34, 12, 14, '300 gb');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_entity_text`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_text`
--

INSERT INTO `product_attributes_entity_text` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 11, 'test B'),
(2, 2, 3, 'This is the meta description'),
(3, 2, 10, 'test A'),
(7, 2, 15, '[]'),
(8, 2, 16, '[]'),
(9, 11, 3, ''),
(10, 11, 10, 'This is a test for the short description'),
(11, 11, 11, 'This is a simple description of the product'),
(12, 11, 15, ''),
(13, 11, 16, ''),
(14, 12, 3, ''),
(15, 12, 10, 'This is a short description'),
(16, 12, 11, 'This is a description'),
(17, 12, 15, ''),
(18, 12, 16, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_groups`
--

DROP TABLE IF EXISTS `product_attributes_groups`;
CREATE TABLE IF NOT EXISTS `product_attributes_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dump dei dati per la tabella `product_attributes_groups`
--

INSERT INTO `product_attributes_groups` (`id`, `name`) VALUES
(1, 'Main'),
(2, 'Price'),
(3, 'Metadata'),
(12, 'Hosting'),
(13, 'Content'),
(14, 'Custom'),
(15, 'Images');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_groups_idx`
--

DROP TABLE IF EXISTS `product_attributes_groups_idx`;
CREATE TABLE IF NOT EXISTS `product_attributes_groups_idx` (
  `attribute_group_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  KEY `group_id` (`attribute_group_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `attribute_set_id` (`attribute_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `product_attributes_groups_idx`
--

INSERT INTO `product_attributes_groups_idx` (`attribute_group_id`, `attribute_set_id`, `attribute_id`) VALUES
(1, 1, 1),
(1, 1, 2),
(2, 1, 12),
(2, 1, 13),
(1, 1, 10),
(1, 1, 11),
(3, 1, 3),
(3, 1, 4),
(3, 1, 5),
(2, 1, 8),
(2, 1, 9),
(1, 1, 6),
(1, 1, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_idx`
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
-- Dump dei dati per la tabella `product_attributes_idx`
--

INSERT INTO `product_attributes_idx` (`attribute_group_id`, `attribute_set_id`, `attribute_id`) VALUES
(1, 2, 1),
(1, 2, 2),
(1, 2, 6),
(1, 2, 7),
(1, 2, 8),
(1, 2, 9),
(2, 2, 12),
(2, 2, 13),
(3, 2, 3),
(3, 2, 4),
(3, 2, 5),
(12, 2, 14),
(13, 2, 10),
(13, 2, 11),
(15, 2, 15),
(15, 2, 16),
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
(13, 1, 10),
(13, 1, 11),
(15, 1, 15),
(15, 1, 16);

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_set`
--

DROP TABLE IF EXISTS `product_attributes_set`;
CREATE TABLE IF NOT EXISTS `product_attributes_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `product_attributes_set`
--

INSERT INTO `product_attributes_set` (`id`, `name`, `default`) VALUES
(1, 'Default', 1),
(2, 'Hosting', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_set_idx`
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
-- Struttura della tabella `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `product_category`
--

INSERT INTO `product_category` (`id`, `uid`, `name`, `parent_id`, `createdat`, `updatedat`) VALUES
(1, '0000-0000-0000', 'Hosting', 0, '2014-10-10 00:00:00', '2014-10-10 00:00:00'),
(2, '0000-0000-0000', 'Wordpress', 1, '2014-10-10 00:00:00', '2014-10-10 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_entity_decimal`
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
-- Struttura della tabella `product_entity_int`
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
-- Struttura della tabella `product_entity_string`
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
-- Struttura della tabella `product_entity_text`
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
-- Struttura della tabella `product_groups`
--

DROP TABLE IF EXISTS `product_groups`;
CREATE TABLE IF NOT EXISTS `product_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `product_groups`
--

INSERT INTO `product_groups` (`id`, `name`) VALUES
(1, 'Default');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_types`
--

DROP TABLE IF EXISTS `product_types`;
CREATE TABLE IF NOT EXISTS `product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `product_types`
--

INSERT INTO `product_types` (`id`, `name`) VALUES
(1, 'Simple');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `product_attributes_entity_date`
--
ALTER TABLE `product_attributes_entity_date`
  ADD CONSTRAINT `product_attributes_entity_date_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_date_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_entity_datetime`
--
ALTER TABLE `product_attributes_entity_datetime`
  ADD CONSTRAINT `product_attributes_entity_datetime_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_datetime_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_entity_float`
--
ALTER TABLE `product_attributes_entity_float`
  ADD CONSTRAINT `product_attributes_entity_float_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_float_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_entity_integer`
--
ALTER TABLE `product_attributes_entity_integer`
  ADD CONSTRAINT `product_attributes_entity_integer_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_integer_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_entity_string`
--
ALTER TABLE `product_attributes_entity_string`
  ADD CONSTRAINT `product_attributes_entity_string_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_string_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_entity_text`
--
ALTER TABLE `product_attributes_entity_text`
  ADD CONSTRAINT `product_attributes_entity_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_entity_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_groups_idx`
--
ALTER TABLE `product_attributes_groups_idx`
  ADD CONSTRAINT `product_attributes_groups_idx_ibfk_1` FOREIGN KEY (`attribute_group_id`) REFERENCES `product_attributes_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_groups_idx_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_groups_idx_ibfk_3` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_idx`
--
ALTER TABLE `product_attributes_idx`
  ADD CONSTRAINT `product_attributes_idx_ibfk_1` FOREIGN KEY (`attribute_group_id`) REFERENCES `product_attributes_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_idx_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_idx_ibfk_3` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `product_attributes_set_idx`
--
ALTER TABLE `product_attributes_set_idx`
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
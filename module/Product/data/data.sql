-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Lug 29, 2014 alle 15:50
-- Versione del server: 5.5.38
-- Versione PHP: 5.5.12-2+deb.sury.org~precise+1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `product`
--

INSERT INTO `product` (`id`, `uid`, `type_id`, `attribute_set_id`, `createdat`, `updatedat`) VALUES
(2, '22ff2755-1540-4d68-8195-079356c33e22', 1, 1, '2014-07-08 10:21:40', '2014-07-29 15:49:35');

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
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dump dei dati per la tabella `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `name`, `type`, `input`, `css`, `label`, `source_model`, `filters`, `is_required`, `is_user_defined`) VALUES
(1, 'name', 'string', 'text', NULL, 'Name', '', NULL, 1, 0),
(2, 'sku', 'string', 'text', NULL, 'SKU', NULL, '["stringtolower"]', 1, 0),
(3, 'metadescription', 'text', 'textarea', NULL, 'META Description', NULL, NULL, 0, 0),
(4, 'metakeyword', 'string', 'text', NULL, 'META Keywords', NULL, NULL, 0, 0),
(5, 'metatitle', 'string', 'text', NULL, 'META Title', NULL, NULL, 0, 0),
(6, 'status', 'integer', 'select', NULL, 'Status', '\\Base\\Form\\Element\\Enadisabled', NULL, 1, 0),
(7, 'urlkey', 'string', 'text', NULL, 'URL Key', NULL, '["stringtolower"]', 0, 0),
(8, 'news_from_date', 'date', 'text', 'date', 'Set Product as New from Date', NULL, NULL, 0, 0),
(9, 'news_to_date', 'date', 'text', 'date', 'Set Product as New to Date', NULL, NULL, 0, 0),
(10, 'short_description', 'text', 'textarea', NULL, 'Short Description', NULL, NULL, 1, 0),
(11, 'description', 'text', 'textarea', NULL, 'Description', NULL, NULL, 1, 0),
(12, 'price', 'float', 'text', NULL, 'Price', NULL, NULL, 1, 0),
(13, 'special_price', 'string', 'text', NULL, 'Special Price', NULL, NULL, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_date`
--

INSERT INTO `product_attributes_entity_date` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 8, '2014-07-08'),
(2, 2, 9, '2015-07-31');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_float`
--

INSERT INTO `product_attributes_entity_float` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 12, 10.2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_integer`
--

INSERT INTO `product_attributes_entity_integer` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 6, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_string`
--

INSERT INTO `product_attributes_entity_string` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 4, 'hosting, website, domain, shared'),
(2, 2, 1, 'hosting silver'),
(3, 2, 2, 'hst-slv'),
(4, 2, 13, '5.64'),
(5, 2, 7, 'hosting-silver');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `product_attributes_entity_text`
--

INSERT INTO `product_attributes_entity_text` (`id`, `entity_id`, `attribute_id`, `value`) VALUES
(1, 2, 11, 'this is the main description of the product'),
(2, 2, 3, 'this is the metatag description'),
(3, 2, 10, 'this is a short description');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_groups`
--

DROP TABLE IF EXISTS `product_attributes_groups`;
CREATE TABLE IF NOT EXISTS `product_attributes_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `product_attributes_groups`
--

INSERT INTO `product_attributes_groups` (`id`, `name`) VALUES
(1, 'Main'),
(2, 'Price'),
(3, 'Metadata');

-- --------------------------------------------------------

--
-- Struttura della tabella `product_attributes_set`
--

DROP TABLE IF EXISTS `product_attributes_set`;
CREATE TABLE IF NOT EXISTS `product_attributes_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `product_attributes_set`
--

INSERT INTO `product_attributes_set` (`id`, `name`) VALUES
(1, 'Default'),
(2, 'Hosting');

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

--
-- Dump dei dati per la tabella `product_attributes_set_idx`
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
-- Limiti per la tabella `product_attributes_set_idx`
--
ALTER TABLE `product_attributes_set_idx`
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_set_idx_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

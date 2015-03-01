-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: dbserver.shinesoftware.it
-- Generato il: Feb 09, 2015 alle 09:03
-- Versione del server: 5.5.41
-- Versione PHP: 5.4.36-0+deb7u3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shine_tango`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_block`
--

DROP TABLE IF EXISTS `cms_block`;
CREATE TABLE IF NOT EXISTS `cms_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `placeholder` varchar(100) NOT NULL,
  `content` text,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `language_id` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_page`
--

DROP TABLE IF EXISTS `cms_page`;
CREATE TABLE IF NOT EXISTS `cms_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `tags` varchar(255) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `layout` text,
  `showonlist` tinyint(1) NOT NULL DEFAULT '1',
  `metatitle` varchar(255) DEFAULT NULL,
  `metadescription` text,
  `metakeywords` text,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `cms_page_category`
--

DROP TABLE IF EXISTS `cms_page_category`;
CREATE TABLE IF NOT EXISTS `cms_page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cms_block`
--
ALTER TABLE `cms_block`
  ADD CONSTRAINT `cms_block_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `base_languages` (`id`) ON DELETE SET NULL;

--
-- Limiti per la tabella `cms_page`
--
ALTER TABLE `cms_page`
  ADD CONSTRAINT `cms_page_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `cms_page_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cms_page_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `cms_page` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `cms_page_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `base_languages` (`id`) ON DELETE SET NULL;
SET FOREIGN_KEY_CHECKS=1;

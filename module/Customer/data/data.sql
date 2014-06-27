-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 18, 2014 alle 13:04
-- Versione del server: 5.5.37
-- Versione PHP: 5.5.12-2+deb.sury.org~precise+1

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
-- Struttura della tabella `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(50) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(200) DEFAULT NULL,
  `birthdistrict` varchar(50) DEFAULT NULL,
  `birthcountry` varchar(50) DEFAULT NULL,
  `birthnationality` varchar(50) DEFAULT NULL,
  `taxpayernumber` varchar(20) DEFAULT NULL,
  `vat` varchar(20) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `legalform_id` int(11) DEFAULT NULL,
  `note` text,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `issubscriber` tinyint(1) NOT NULL DEFAULT '1',
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `isreseller` tinyint(1) DEFAULT NULL,
  `taxfree` tinyint(1) DEFAULT NULL,
  `group_id` int(11) NOT NULL DEFAULT '2',
  `last_password_change` datetime DEFAULT NULL,
  `force_password_change` tinyint(1) NOT NULL,
  `ignore_latefee` tinyint(1) NOT NULL,
  `resetpwd_key` varchar(50) DEFAULT NULL,
  `resetpwd_expire` datetime DEFAULT NULL,
  `isp_id` int(11) NOT NULL DEFAULT '1',
  `uuid` varchar(50) DEFAULT NULL,
  `language_id` int(11) DEFAULT '1',
  `customer_number` varchar(50) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `legalform_id` (`legalform_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=705 ;

-- --------------------------------------------------------
-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 23, 2014 alle 16:45
-- Versione del server: 5.5.37
-- Versione PHP: 5.5.12-2+deb.sury.org~precise+1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shineisp2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `customer_address`
--

DROP TABLE IF EXISTS `customer_address`;
CREATE TABLE IF NOT EXISTS `customer_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `street` text NOT NULL,
  `city` varchar(150) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `base` tinyint(4) NOT NULL DEFAULT '0',
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id_idx` (`country_id`),
  KEY `addresses_customer_id_idx` (`customer_id`),
  KEY `addresses_region_id_idx` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=590 ;

--
-- Limiti per la tabella `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `base_region` (`region_id`),
  ADD CONSTRAINT `customer_address_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `base_country` (`id`);
SET FOREIGN_KEY_CHECKS=1;

--
-- Struttura della tabella `customer_company_type`
--

CREATE TABLE IF NOT EXISTS `customer_company_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `legalform_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `legalform_id` (`legalform_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `customer_legalform`
--

CREATE TABLE IF NOT EXISTS `customer_legalform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;



DROP TABLE IF EXISTS `customer_contact`;
CREATE TABLE IF NOT EXISTS `customer_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id_idx` (`type_id`),
  KEY `customer_id_idx` (`customer_id`),
  KEY `contacts_customer_id_idx` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=653 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_contact`
--
ALTER TABLE `customer_contact`
  ADD CONSTRAINT `customer_contact` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;
  
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`legalform_id`) REFERENCES `customer_legalform` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `customer_company_type` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Limiti per la tabella `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `addresses_country_id_countries_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`),
  ADD CONSTRAINT `addresses_customer_id_customers_customer_id_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`region_id`);

--
-- Limiti per la tabella `customer_company_type`
--
ALTER TABLE `customer_company_type`
  ADD CONSTRAINT `customer_company_type_ibfk_1` FOREIGN KEY (`legalform_id`) REFERENCES `customer_legalform` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
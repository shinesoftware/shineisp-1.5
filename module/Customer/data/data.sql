
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `customer`;
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

ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `base_region` (`region_id`),
  ADD CONSTRAINT `customer_address_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `base_country` (`id`);

CREATE TABLE IF NOT EXISTS `customer_company_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `legalform_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `legalform_id` (`legalform_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `customer_legalform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `customer_contact`;
CREATE TABLE IF NOT EXISTS `customer_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

SET FOREIGN_KEY_CHECKS=1;
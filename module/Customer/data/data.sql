SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `customer_company_type`
--

DROP TABLE IF EXISTS `customer_company_type`;
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
-- Table structure for table `customer_legalform`
--

DROP TABLE IF EXISTS `customer_legalform`;
CREATE TABLE IF NOT EXISTS `customer_legalform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`legalform_id`) REFERENCES `customer_legalform` (`id`) ON DELETE CASCADE ON UPDATE SET NULL,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `customer_company_type` (`id`) ON DELETE CASCADE ON UPDATE SET NULL;

--
-- Constraints for table `customer_company_type`
--
ALTER TABLE `customer_company_type`
  ADD CONSTRAINT `customer_company_type_ibfk_1` FOREIGN KEY (`legalform_id`) REFERENCES `customer_legalform` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

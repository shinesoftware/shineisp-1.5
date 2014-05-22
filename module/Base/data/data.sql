
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(250) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `code` varchar(2) NOT NULL,
  `base` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `locale`, `code`, `base`, `active`) VALUES
(1, 'English', 'en_US', 'en', 1, 1),
(2, 'Italiano', 'it_IT', 'it', 0, 1),
(3, 'French', 'fr_FR', 'fr', 0, 0),
(4, 'Spanish', 'es_ES', 'es', 0, 0),
(5, 'Dutch', 'nl_NL', 'nl', 0, 1),
(6, 'German', 'de_DE', 'de', 0, 1),
(7, 'Greek', 'el_GR', 'gr', 0, 0),
(8, 'Hungarian', 'hu_HU', 'hu', 0, 0);
SET FOREIGN_KEY_CHECKS=1;

-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2014 at 09:25 AM
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
-- Table structure for table `base_country`
--

DROP TABLE IF EXISTS `base_country`;
CREATE TABLE IF NOT EXISTS `base_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=273 ;

--
-- Dumping data for table `base_country`
--

INSERT INTO `base_country` (`id`, `name`, `code`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Albania', 'AL'),
(3, 'Algeria', 'DZ'),
(4, 'Andorra', 'AD'),
(5, 'Angola', 'AO'),
(6, 'Antigua and Barbuda', 'AG'),
(7, 'Argentina', 'AR'),
(8, 'Armenia', 'AM'),
(9, 'Australia', 'AU'),
(10, 'Austria', 'AT'),
(11, 'Azerbaijan', 'AZ'),
(12, 'Bahamas, The', 'BS'),
(13, 'Bahrain', 'BH'),
(14, 'Bangladesh', 'BD'),
(15, 'Barbados', 'BB'),
(16, 'Belarus', 'BY'),
(17, 'Belgium', 'BE'),
(18, 'Belize', 'BZ'),
(19, 'Benin', 'BJ'),
(20, 'Bhutan', 'BT'),
(21, 'Bolivia', 'BO'),
(22, 'Bosnia and Herzegovina', 'BA'),
(23, 'Botswana', 'BW'),
(24, 'Brazil', 'BR'),
(25, 'Brunei', 'BN'),
(26, 'Bulgaria', 'BG'),
(27, 'Burkina Faso', 'BF'),
(28, 'Burundi', 'BI'),
(29, 'Cambodia', 'KH'),
(30, 'Cameroon', 'CM'),
(31, 'Canada', 'CA'),
(32, 'Cape Verde', 'CV'),
(33, 'Central African Republic', 'CF'),
(34, 'Chad', 'TD'),
(35, 'Chile', 'CL'),
(36, 'China, People''s Republic of', 'CN'),
(37, 'Colombia', 'CO'),
(38, 'Comoros', 'KM'),
(39, 'Congo, Democratic Republic of the (Congo ﾖ Kinshasa)', 'CD'),
(40, 'Congo, Republic of the (Congo ﾖ Brazzaville)', 'CG'),
(41, 'Costa Rica', 'CR'),
(42, 'Cote d''Ivoire (Ivory Coast)', 'CI'),
(43, 'Croatia', 'HR'),
(44, 'Cuba', 'CU'),
(45, 'Cyprus', 'CY'),
(46, 'Czech Republic', 'CZ'),
(47, 'Denmark', 'DK'),
(48, 'Djibouti', 'DJ'),
(49, 'Dominica', 'DM'),
(50, 'Dominican Republic', 'DO'),
(51, 'Ecuador', 'EC'),
(52, 'Egypt', 'EG'),
(53, 'El Salvador', 'SV'),
(54, 'Equatorial Guinea', 'GQ'),
(55, 'Eritrea', 'ER'),
(56, 'Estonia', 'EE'),
(57, 'Ethiopia', 'ET'),
(58, 'Fiji', 'FJ'),
(59, 'Finland', 'FI'),
(60, 'France', 'FR'),
(61, 'Gabon', 'GA'),
(62, 'Gambia, The', 'GM'),
(63, 'Georgia', 'GE'),
(64, 'Germany', 'DE'),
(65, 'Ghana', 'GH'),
(66, 'Greece', 'GR'),
(67, 'Grenada', 'GD'),
(68, 'Guatemala', 'GT'),
(69, 'Guinea', 'GN'),
(70, 'Guinea-Bissau', 'GW'),
(71, 'Guyana', 'GY'),
(72, 'Haiti', 'HT'),
(73, 'Honduras', 'HN'),
(74, 'Hungary', 'HU'),
(75, 'Iceland', 'IS'),
(76, 'India', 'IN'),
(77, 'Indonesia', 'ID'),
(78, 'Iran', 'IR'),
(79, 'Iraq', 'IQ'),
(80, 'Ireland', 'IE'),
(81, 'Israel', 'IL'),
(82, 'Italy', 'IT'),
(83, 'Jamaica', 'JM'),
(84, 'Japan', 'JP'),
(85, 'Jordan', 'JO'),
(86, 'Kazakhstan', 'KZ'),
(87, 'Kenya', 'KE'),
(88, 'Kiribati', 'KI'),
(89, 'Korea, Democratic People''s Republic of (North Korea)', 'KP'),
(90, 'Korea, Republic of  (South Korea)', 'KR'),
(91, 'Kuwait', 'KW'),
(92, 'Kyrgyzstan', 'KG'),
(93, 'Laos', 'LA'),
(94, 'Latvia', 'LV'),
(95, 'Lebanon', 'LB'),
(96, 'Lesotho', 'LS'),
(97, 'Liberia', 'LR'),
(98, 'Libya', 'LY'),
(99, 'Liechtenstein', 'LI'),
(100, 'Lithuania', 'LT'),
(101, 'Luxembourg', 'LU'),
(102, 'Macedonia', 'MK'),
(103, 'Madagascar', 'MG'),
(104, 'Malawi', 'MW'),
(105, 'Malaysia', 'MY'),
(106, 'Maldives', 'MV'),
(107, 'Mali', 'ML'),
(108, 'Malta', 'MT'),
(109, 'Marshall Islands', 'MH'),
(110, 'Mauritania', 'MR'),
(111, 'Mauritius', 'MU'),
(112, 'Mexico', 'MX'),
(113, 'Micronesia', 'FM'),
(114, 'Moldova', 'MD'),
(115, 'Monaco', 'MC'),
(116, 'Mongolia', 'MN'),
(117, 'Montenegro', 'ME'),
(118, 'Morocco', 'MA'),
(119, 'Mozambique', 'MZ'),
(120, 'Myanmar (Burma)', 'MM'),
(121, 'Namibia', 'NA'),
(122, 'Nauru', 'NR'),
(123, 'Nepal', 'NP'),
(124, 'Netherlands', 'NL'),
(125, 'New Zealand', 'NZ'),
(126, 'Nicaragua', 'NI'),
(127, 'Niger', 'NE'),
(128, 'Nigeria', 'NG'),
(129, 'Norway', 'NO'),
(130, 'Oman', 'OM'),
(131, 'Pakistan', 'PK'),
(132, 'Palau', 'PW'),
(133, 'Panama', 'PA'),
(134, 'Papua New Guinea', 'PG'),
(135, 'Paraguay', 'PY'),
(136, 'Peru', 'PE'),
(137, 'Philippines', 'PH'),
(138, 'Poland', 'PL'),
(139, 'Portugal', 'PT'),
(140, 'Qatar', 'QA'),
(141, 'Romania', 'RO'),
(142, 'Russia', 'RU'),
(143, 'Rwanda', 'RW'),
(144, 'Saint Kitts and Nevis', 'KN'),
(145, 'Saint Lucia', 'LC'),
(146, 'Saint Vincent and the Grenadines', 'VC'),
(147, 'Samoa', 'WS'),
(148, 'San Marino', 'SM'),
(149, 'Sao Tome and Principe', 'ST'),
(150, 'Saudi Arabia', 'SA'),
(151, 'Senegal', 'SN'),
(152, 'Serbia', 'RS'),
(153, 'Seychelles', 'SC'),
(154, 'Sierra Leone', 'SL'),
(155, 'Singapore', 'SG'),
(156, 'Slovakia', 'SK'),
(157, 'Slovenia', 'SI'),
(158, 'Solomon Islands', 'SB'),
(159, 'Somalia', 'SO'),
(160, 'South Africa', 'ZA'),
(161, 'Spain', 'ES'),
(162, 'Sri Lanka', 'LK'),
(163, 'Sudan', 'SD'),
(164, 'Suriname', 'SR'),
(165, 'Swaziland', 'SZ'),
(166, 'Sweden', 'SE'),
(167, 'Switzerland', 'CH'),
(168, 'Syria', 'SY'),
(169, 'Tajikistan', 'TJ'),
(170, 'Tanzania', 'TZ'),
(171, 'Thailand', 'TH'),
(172, 'Timor-Leste (East Timor)', 'TL'),
(173, 'Togo', 'TG'),
(174, 'Tonga', 'TO'),
(175, 'Trinidad and Tobago', 'TT'),
(176, 'Tunisia', 'TN'),
(177, 'Turkey', 'TR'),
(178, 'Turkmenistan', 'TM'),
(179, 'Tuvalu', 'TV'),
(180, 'Uganda', 'UG'),
(181, 'Ukraine', 'UA'),
(182, 'United Arab Emirates', 'AE'),
(183, 'United Kingdom', 'GB'),
(184, 'United States', 'US'),
(185, 'Uruguay', 'UY'),
(186, 'Uzbekistan', 'UZ'),
(187, 'Vanuatu', 'VU'),
(188, 'Vatican City', 'VA'),
(189, 'Venezuela', 'VE'),
(190, 'Vietnam', 'VN'),
(191, 'Yemen', 'YE'),
(192, 'Zambia', 'ZM'),
(193, 'Zimbabwe', 'ZW'),
(194, 'Abkhazia', 'GE'),
(195, 'China, Republic of (Taiwan)', 'TW'),
(196, 'Nagorno-Karabakh', 'AZ'),
(197, 'Northern Cyprus', 'CY'),
(198, 'Pridnestrovie (Transnistria)', 'MD'),
(199, 'Somaliland', 'SO'),
(200, 'South Ossetia', 'GE'),
(201, 'Ashmore and Cartier Islands', 'AU'),
(202, 'Christmas Island', 'CX'),
(203, 'Cocos (Keeling) Islands', 'CC'),
(204, 'Coral Sea Islands', 'AU'),
(205, 'Heard Island and McDonald Islands', 'HM'),
(206, 'Norfolk Island', 'NF'),
(207, 'New Caledonia', 'NC'),
(208, 'French Polynesia', 'PF'),
(209, 'Mayotte', 'YT'),
(210, 'Saint Barthelemy', 'GP'),
(211, 'Saint Martin', 'GP'),
(212, 'Saint Pierre and Miquelon', 'PM'),
(213, 'Wallis and Futuna', 'WF'),
(214, 'French Southern and Antarctic Lands', 'TF'),
(215, 'Clipperton Island', 'PF'),
(216, 'Bouvet Island', 'BV'),
(217, 'Cook Islands', 'CK'),
(218, 'Niue', 'NU'),
(219, 'Tokelau', 'TK'),
(220, 'Guernsey', 'GG'),
(221, 'Isle of Man', 'IM'),
(222, 'Jersey', 'JE'),
(223, 'Anguilla', 'AI'),
(224, 'Bermuda', 'BM'),
(225, 'British Indian Ocean Territory', 'IO'),
(226, 'British Sovereign Base Areas', ''),
(227, 'British Virgin Islands', 'VG'),
(228, 'Cayman Islands', 'KY'),
(229, 'Falkland Islands (Islas Malvinas)', 'FK'),
(230, 'Gibraltar', 'GI'),
(231, 'Montserrat', 'MS'),
(232, 'Pitcairn Islands', 'PN'),
(233, 'Saint Helena', 'SH'),
(234, 'South Georgia and the South Sandwich Islands', 'GS'),
(235, 'Turks and Caicos Islands', 'TC'),
(236, 'Northern Mariana Islands', 'MP'),
(237, 'Puerto Rico', 'PR'),
(238, 'American Samoa', 'AS'),
(239, 'Baker Island', 'UM'),
(240, 'Guam', 'GU'),
(241, 'Howland Island', 'UM'),
(242, 'Jarvis Island', 'UM'),
(243, 'Johnston Atoll', 'UM'),
(244, 'Kingman Reef', 'UM'),
(245, 'Midway Islands', 'UM'),
(246, 'Navassa Island', 'UM'),
(247, 'Palmyra Atoll', 'UM'),
(248, 'U.S. Virgin Islands', 'VI'),
(249, 'Wake Island', 'UM'),
(250, 'Hong Kong', 'HK'),
(251, 'Macau', 'MO'),
(252, 'Faroe Islands', 'FO'),
(253, 'Greenland', 'GL'),
(254, 'French Guiana', 'GF'),
(255, 'Guadeloupe', 'GP'),
(256, 'Martinique', 'MQ'),
(257, 'Reunion', 'RE'),
(258, 'Aland', 'AX'),
(259, 'Aruba', 'AW'),
(260, 'Netherlands Antilles', 'AN'),
(261, 'Svalbard', 'SJ'),
(262, 'Ascension', 'AC'),
(263, 'Tristan da Cunha', 'TA'),
(264, 'Antarctica', 'AQ'),
(265, 'Kosovo', 'CS'),
(266, 'Palestinian Territories (Gaza Strip and West Bank)', 'PS'),
(267, 'Western Sahara', 'EH'),
(268, 'Australian Antarctic Territory', 'AQ'),
(269, 'Ross Dependency', 'AQ'),
(270, 'Peter I Island', 'AQ'),
(271, 'Queen Maud Land', 'AQ'),
(272, 'British Antarctic Territory', 'AQ');

-- --------------------------------------------------------

--
-- Table structure for table `base_languages`
--

DROP TABLE IF EXISTS `base_languages`;
CREATE TABLE IF NOT EXISTS `base_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(250) NOT NULL,
  `locale` varchar(5) NOT NULL,
  `code` varchar(2) NOT NULL,
  `base` tinyint(1) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `base_languages`
--

INSERT INTO `base_languages` (`id`, `language`, `locale`, `code`, `base`, `active`) VALUES
(1, 'English', 'en_US', 'en', 1, 1),
(2, 'Italiano', 'it_IT', 'it', 0, 1),
(3, 'French', 'fr_FR', 'fr', 0, 0),
(4, 'Spanish', 'es_ES', 'es', 0, 0),
(5, 'Dutch', 'nl_NL', 'nl', 0, 1),
(6, 'German', 'de_DE', 'de', 0, 1),
(7, 'Serbian', 'sr_CS', 'rs', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `base_province`
--

DROP TABLE IF EXISTS `base_province`;
CREATE TABLE IF NOT EXISTS `base_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id_idx` (`country_id`),
  KEY `region_id_idx` (`region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `base_province`
--

INSERT INTO `base_province` (`id`, `region_id`, `country_id`, `name`, `code`) VALUES
(1, 19, 82, 'Agrigento', 'AG'),
(2, 2, 82, 'Alessandria', 'AL'),
(3, 10, 82, 'Ancona', 'AN'),
(4, 1, 82, 'Aosta', 'AO'),
(5, 9, 82, 'Arezzo', 'AR'),
(6, 10, 82, 'Ascoli Piceno', 'AP'),
(7, 2, 82, 'Asti', 'AT'),
(8, 16, 82, 'Avellino', 'AV'),
(9, 15, 82, 'Bari', 'BA'),
(10, 5, 82, 'Belluno', 'BL'),
(11, 16, 82, 'Benevento', 'BN'),
(12, 3, 82, 'Bergamo', 'BG'),
(13, 2, 82, 'Biella', 'BI'),
(14, 7, 82, 'Bologna', 'BO'),
(15, 4, 82, 'Bolzano - Bozen', 'BZ'),
(16, 3, 82, 'Brescia', 'BS'),
(17, 15, 82, 'Brindisi', 'BR'),
(18, 20, 82, 'Cagliari', 'CA'),
(19, 19, 82, 'Caltanissetta', 'CL'),
(20, 13, 82, 'Campobasso', 'CB'),
(21, 16, 82, 'Caserta', 'CE'),
(22, 19, 82, 'Catania', 'CT'),
(23, 18, 82, 'Catanzaro', 'CZ'),
(24, 12, 82, 'Chieti', 'CH'),
(25, 3, 82, 'Como', 'CO'),
(26, 18, 82, 'Cosenza', 'CS'),
(27, 3, 82, 'Cremona', 'CR'),
(28, 18, 82, 'Crotone', 'KR'),
(29, 2, 82, 'Cuneo', 'CN'),
(30, 19, 82, 'Enna', 'EN'),
(31, 7, 82, 'Ferrara', 'FE'),
(32, 9, 82, 'Firenze', 'FI'),
(33, 15, 82, 'Foggia', 'FG'),
(34, 7, 82, 'Forlì-Cesena', 'FC'),
(35, 14, 82, 'Frosinone', 'FR'),
(36, 8, 82, 'Genova', 'GE'),
(37, 6, 82, 'Gorizia', 'GO'),
(38, 9, 82, 'Grosseto', 'GR'),
(39, 8, 82, 'Imperia', 'IM'),
(40, 13, 82, 'Isernia', 'IS'),
(41, 12, 82, 'L''Aquila', 'AQ'),
(42, 8, 82, 'La Spezia', 'SP'),
(43, 14, 82, 'Latina', 'LT'),
(44, 15, 82, 'Lecce', 'LE'),
(45, 3, 82, 'Lecco', 'LC'),
(46, 9, 82, 'Livorno', 'LI'),
(47, 3, 82, 'Lodi', 'LO'),
(48, 9, 82, 'Lucca', 'LU'),
(49, 10, 82, 'Macerata', 'MC'),
(50, 3, 82, 'Mantova', 'MN'),
(51, 9, 82, 'Massa - Carrara', 'MS'),
(52, 17, 82, 'Matera', 'MT'),
(53, 19, 82, 'Messina', 'ME'),
(54, 3, 82, 'Milano', 'MI'),
(55, 7, 82, 'Modena', 'MO'),
(56, 16, 82, 'Napoli', 'NA'),
(57, 2, 82, 'Novara', 'NO'),
(58, 20, 82, 'Nuoro', 'NU'),
(59, 20, 82, 'Oristano', 'OR'),
(60, 5, 82, 'Padova', 'PD'),
(61, 19, 82, 'Palermo', 'PA'),
(62, 7, 82, 'Parma', 'PR'),
(63, 3, 82, 'Pavia', 'PV'),
(64, 11, 82, 'Perugia', 'PG'),
(65, 10, 82, 'Pesaro e Urbino', 'PU'),
(66, 12, 82, 'Pescara', 'PE'),
(67, 7, 82, 'Piacenza', 'PC'),
(68, 9, 82, 'Pisa', 'PI'),
(69, 9, 82, 'Pistoia', 'PT'),
(70, 6, 82, 'Pordenone', 'PN'),
(71, 17, 82, 'Potenza', 'PZ'),
(72, 9, 82, 'Prato', 'PO'),
(73, 19, 82, 'Ragusa', 'RG'),
(74, 7, 82, 'Ravenna', 'RA'),
(75, 18, 82, 'Reggio Calabria', 'RC'),
(76, 7, 82, 'Reggio Emilia', 'RE'),
(77, 14, 82, 'Rieti', 'RI'),
(78, 7, 82, 'Rimini', 'RN'),
(79, 14, 82, 'Roma', 'RM'),
(80, 5, 82, 'Rovigo', 'RO'),
(81, 16, 82, 'Salerno', 'SA'),
(82, 20, 82, 'Sassari', 'SS'),
(83, 8, 82, 'Savona', 'SV'),
(84, 9, 82, 'Siena', 'SI'),
(85, 19, 82, 'Siracusa', 'SR'),
(86, 3, 82, 'Sondrio', 'SO'),
(87, 15, 82, 'Taranto', 'TA'),
(88, 12, 82, 'Teramo', 'TE'),
(89, 11, 82, 'Terni', 'TR'),
(90, 2, 82, 'Torino', 'TO'),
(91, 19, 82, 'Trapani', 'TP'),
(92, 4, 82, 'Trento', 'TN'),
(93, 5, 82, 'Treviso', 'TV'),
(94, 6, 82, 'Trieste', 'TS'),
(95, 6, 82, 'Udine', 'UD'),
(96, 3, 82, 'Varese', 'VA'),
(97, 5, 82, 'Venezia', 'VE'),
(98, 2, 82, 'Verbano - Cusio', 'VB'),
(99, 2, 82, 'Vercelli', 'VC'),
(100, 5, 82, 'Verona', 'VR'),
(101, 18, 82, 'Vibo - Valentia', 'VV'),
(102, 5, 82, 'Vicenza', 'VI'),
(103, 14, 82, 'Viterbo', 'VT'),
(104, 20, 82, 'Olbia-Tempio', 'OT'),
(105, 20, 82, 'Carbonia-Iglesias', 'CI'),
(106, 20, 82, 'Medio Campidano', 'VS'),
(107, 3, 82, 'Monza e della Brianza', 'MB');

-- --------------------------------------------------------

--
-- Table structure for table `base_region`
--

DROP TABLE IF EXISTS `base_region`;
CREATE TABLE IF NOT EXISTS `base_region` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `base_region`
--

INSERT INTO `base_region` (`id`, `country_id`, `name`) VALUES
(1, 82, 'Valle d''Aosta'),
(2, 82, 'Piemonte'),
(3, 82, 'Lombardia'),
(4, 82, 'Trentino-Alto Adige'),
(5, 82, 'Veneto'),
(6, 82, 'Friuli-Venezia Giulia'),
(7, 82, 'Emilia-Romagna'),
(8, 82, 'Liguria'),
(9, 82, 'Toscana'),
(10, 82, 'Marche'),
(11, 82, 'Umbria'),
(12, 82, 'Abruzzo'),
(13, 82, 'Molise'),
(14, 82, 'Lazio'),
(15, 82, 'Puglia'),
(16, 82, 'Campania'),
(17, 82, 'Basilicata'),
(18, 82, 'Calabria'),
(19, 82, 'Sicilia'),
(20, 82, 'Sardegna'),
(21, 82, 'San Marino');

-- --------------------------------------------------------

--
-- Table structure for table `base_settings`
--

DROP TABLE IF EXISTS `base_settings`;
CREATE TABLE IF NOT EXISTS `base_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `base_settings`
--

INSERT INTO `base_settings` (`id`, `module`, `parameter`, `value`) VALUES
(3, 'Cms', 'defaultlayout', '1column'),
(4, 'Cms', 'postperpage', '5'),
(5, 'Cms', 'recordsperpage', '2'),
(6, 'Customer', 'recordsperpage', '2');

-- --------------------------------------------------------

--
-- Table structure for table `base_status`
--

DROP TABLE IF EXISTS `base_status`;
CREATE TABLE IF NOT EXISTS `base_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  `section` varchar(200) DEFAULT NULL,
  `public` tinyint(1) DEFAULT '1',
  `code` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `base_status`
--

INSERT INTO `base_status` (`id`, `status`, `section`, `public`, `code`) VALUES
(1, 'Deleted', 'generic', 1, 'deleted'),
(2, 'Suspended', 'generic', 1, 'suspended'),
(3, 'Active', 'generic', 1, 'active'),
(4, 'Active', 'domains', 1, 'active'),
(5, 'Expired', 'domains', 1, 'expired'),
(6, 'Processing', 'domains', 1, 'processing'),
(7, 'Redenption period', 'epp_domains', 1, 'redemption'),
(8, 'Registrar hold', 'epp_domains', 1, 'hold'),
(9, 'To be Paid', 'orders', 1, 'tobepaid'),
(10, 'Expired', 'orders', 1, 'expired'),
(12, 'Active', 'customers', 1, 'active'),
(13, 'Suspended', 'customers', 1, 'suspended'),
(14, 'Deleted', 'customers', 1, 'deleted'),
(15, 'Active', 'servers', 1, 'active'),
(16, 'Suspended', 'servers', 1, 'suspended'),
(17, 'Deleted', 'servers', 1, 'deleted'),
(18, 'Pending', 'orders', 1, 'pending'),
(19, 'Processing', 'orders', 1, 'processing'),
(20, 'Deleted', 'orders', 1, 'deleted'),
(21, 'Complete', 'orders', 1, 'complete'),
(22, 'Expecting a reply', 'tickets', 1, 'expectingreply'),
(23, 'Processing', 'tickets', 1, 'processing'),
(24, 'Solved', 'tickets', 1, 'solved'),
(25, 'Closed', 'tickets', 1, 'closed'),
(26, 'Active', 'domains_tasks', 1, 'active'),
(27, 'Processing', 'domains_tasks', 1, 'processing'),
(28, 'Deleted', 'domains', 1, 'deleted'),
(29, 'Suspended', 'domains', 1, 'suspended'),
(30, 'Closed', 'orders', 1, 'closed'),
(31, 'Complete', 'domains_tasks', 1, 'complete'),
(32, 'Future Release', 'tickets', 1, 'future-release'),
(33, 'Changed', 'orders', 1, 'changed'),
(34, 'Paid', 'orders', 1, 'paid');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `base_province`
--
ALTER TABLE `base_province`
  ADD CONSTRAINT `base_province_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `base_region` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `base_province_country_id_countries_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE;

--
-- Constraints for table `base_region`
--
ALTER TABLE `base_region`
  ADD CONSTRAINT `base_region_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `base_country` (`id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

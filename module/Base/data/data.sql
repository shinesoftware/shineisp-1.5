-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Giu 23, 2014 alle 16:35
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
-- Struttura della tabella `base_country`
--

DROP TABLE IF EXISTS `base_country`;
CREATE TABLE IF NOT EXISTS `base_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=273 ;

--
-- Dump dei dati per la tabella `base_country`
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
-- Struttura della tabella `base_languages`
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
-- Dump dei dati per la tabella `base_languages`
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
-- Struttura della tabella `base_province`
--

DROP TABLE IF EXISTS `base_province`;
CREATE TABLE IF NOT EXISTS `base_province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `provinces_country_id_idx` (`country_id`),
  KEY `provinces_region_id_idx` (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `base_region`
--

DROP TABLE IF EXISTS `base_region`;
CREATE TABLE IF NOT EXISTS `base_region` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`region_id`),
  KEY `region_country_id_idx` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `base_settings`
--

DROP TABLE IF EXISTS `base_settings`;
CREATE TABLE IF NOT EXISTS `base_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `base_status`
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
-- Dump dei dati per la tabella `base_status`
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
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `base_province`
--
ALTER TABLE `base_province`
  ADD CONSTRAINT `base_province_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `base_country` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `base_province_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `base_region` (`region_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `provinces_region_id_states_region_id` FOREIGN KEY (`region_id`) REFERENCES `base_region` (`region_id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `base_region`
--
ALTER TABLE `base_region`
  ADD CONSTRAINT `states_country_id_countries_country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

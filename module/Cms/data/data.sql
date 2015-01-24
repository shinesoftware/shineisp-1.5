-- phpMyAdmin SQL Dump
-- version 4.1.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2014 at 06:19 AM
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
-- Table structure for table `cms_block`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `cms_block`
--

INSERT INTO `cms_block` (`id`, `title`, `placeholder`, `content`, `visible`, `language_id`, `createdat`, `updatedat`) VALUES
(6, 'Callout', 'callout', '<p><img alt="banner" src="http://www.adelaide.edu.au/pce/images/pods/image9.jpg" style="height:169px; width:260px" /></p>\r\n', 1, 2, '2014-05-24 18:13:58', '2014-05-26 17:23:06'),
(7, 'Contacts', 'contacts', '<div class="panel panel-default">\r\n	<!-- Default panel contents -->\r\n	<div class="panel-heading">\r\n		Contact Us\r\n	</div>\r\n	<div class="panel-body">\r\n		<p>Our developers are available from Monday to Friday. [09.00 am - 06:00 pm]<br>Send your enquiry by contact form. Click here to show the contact form: <a href="\\&quot;/contacts\\&quot;"><i class="fa fa-phone"></i> Contacts Now</a></p>\r\n	</div>\r\n	<!-- List group -->\r\n	<ul class="list-group">\r\n		<li class="list-group-item"><a href="/contacts">Contact Us</a></li>\r\n		<li class="list-group-item">Dapibus ac facilisis in</li>\r\n		<li class="list-group-item">Morbi leo risus</li>\r\n		<li class="list-group-item">Porta ac consectetur ac</li>\r\n		<li class="list-group-item">Vestibulum at eros</li>\r\n	</ul>\r\n</div>', 1, 2, '2014-05-26 11:08:05', '2014-05-26 11:08:05'),
(8, 'Callout 2', 'callout-2', '<div class="alert alert-info">This is a STATIC block!</div>\r\n', 1, 1, '2014-05-26 17:29:55', '2014-05-26 17:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
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
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `title`, `slug`, `category_id`, `language_id`, `visible`, `tags`, `createdat`, `updatedat`, `content`, `parent_id`, `layout`, `showonlist`) VALUES
(2, 'This is a ZF2 Module', 'this-is-a-zf2-module', 2, 2, 1, 'test,home', '2014-05-19 15:59:15', '2014-06-17 06:16:13', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dolor nunc, consectetur non turpis et, tempus consequat tortor. Morbi nec felis at urna ornare porttitor. Ut nec sem fringilla, ornare mauris in, volutpat tortor. Pellentesque blandit, urna non condimentum vulputate, arcu orci fermentum justo, a mollis dui erat aliquam odio. <strong>Cras quis diam tortor. </strong></p>\r\n\r\n<p>{callout-2}</p>\r\n\r\n<p><a href="https://pbs.twimg.com/media/BoBTKnYCIAEgV8X.jpg:large" target="_blank"><img alt="Monfalcone" src="https://pbs.twimg.com/media/BoBTKnYCIAEgV8X.jpg:large" style="border-style:solid; border-width:1px; float:left; height:142px; margin:5px; width:212px" /></a></p>\r\n\r\n<p>Morbi convallis pharetra feugiat. Aliquam erat volutpat. Etiam at euismod lacus. Nullam quis nisl pulvinar felis malesuada bibendum. In non urna ultrices, eleifend leo vel, pellentesque leo. Sed id mauris est. Suspendisse auctor sapien lectus, ac auctor neque dictum et. Sed quis consectetur tortor.</p>\r\n', NULL, '<?xml version="1.0" encoding="UTF-8"?>\r\n<layout>\r\n    <default layout="2columns-right"> \r\n        <commons> \r\n            <blocks>\r\n                 <block side="right">contacts</block>\r\n                 <block side="right">callout</block>                 \r\n            </blocks>\r\n        </commons>\r\n    </default>\r\n</layout>', 1),
(5, 'Lorem Ipsum Test', 'lorem-ipsum-test', 2, 1, 1, 'homepage,first page', '2014-05-19 22:40:39', '2014-05-24 14:02:59', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu est bibendum, rutrum nisl a, pharetra magna. Suspendisse rutrum nunc at gravida consequat. Sed nec diam in ipsum congue ultricies vitae a leo. Pellentesque mollis justo at diam vehicula elementum. Donec velit metus, mollis at mi eu, varius sollicitudin diam. Donec accumsan accumsan vehicula. Aliquam tempor neque at suscipit auctor. Maecenas id ornare ligula.</p>\r\n\r\n<p>Curabitur eget ante velit. Phasellus ac leo varius eros gravida tincidunt. Curabitur aliquam eros id pretium vestibulum. Aliquam in congue lectus. Nullam ut augue eleifend urna rhoncus fringilla vel vitae eros. Mauris malesuada augue consequat leo fringilla, eu ultrices odio sodales. Cras semper nibh sit amet nibh commodo vestibulum. Aenean vitae viverra ligula.</p>\r\n\r\n<p>Ut hendrerit sapien vitae lacus semper, eget sollicitudin justo pellentesque. Phasellus tempor eros vitae quam pulvinar, a interdum mi tristique. Aenean venenatis magna ut purus ullamcorper, non viverra arcu dictum. Nunc congue placerat rhoncus. Phasellus et tortor eget nunc condimentum pretium at quis magna. Aliquam congue in orci ac feugiat. Curabitur porttitor mollis magna, sit amet consequat tortor consequat at. Mauris risus augue, sollicitudin eu risus ac, faucibus pharetra augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec scelerisque volutpat egestas.</p>\r\n', 2, NULL, 1),
(6, 'Homepage', 'homepage', 1, 1, 1, '', '2014-05-26 17:48:10', '2014-06-17 06:17:47', '<p>This is the <strong>homepage</strong></p>\r\n', NULL, '<?xml version="1.0" encoding="UTF-8"?>\r\n<layout>\r\n    <default layout="blank"> \r\n        <commons> \r\n            <blocks>\r\n                 <block side="beforecontent">callout-2</block>                 \r\n            </blocks>\r\n        </commons>\r\n    </default>\r\n</layout>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_page_category`
--

DROP TABLE IF EXISTS `cms_page_category`;
CREATE TABLE IF NOT EXISTS `cms_page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_page_category`
--

INSERT INTO `cms_page_category` (`id`, `category`, `visible`) VALUES
(1, 'Generic', 1),
(2, 'News', 1),
(3, 'PHP Development', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cms_block`
--
ALTER TABLE `cms_block`
  ADD CONSTRAINT `cms_block_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `base_languages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD CONSTRAINT `cms_page_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `cms_page_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cms_page_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `cms_page` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `cms_page_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `base_languages` (`id`) ON DELETE SET NULL;
SET FOREIGN_KEY_CHECKS=1;

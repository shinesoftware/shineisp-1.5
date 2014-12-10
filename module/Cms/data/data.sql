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

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cms_block
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_block`;

CREATE TABLE `cms_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `placeholder` varchar(100) NOT NULL,
  `content` text,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `language_id` int(11) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `cms_block_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `base_languages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `cms_block` WRITE;
/*!40000 ALTER TABLE `cms_block` DISABLE KEYS */;

INSERT INTO `cms_block` (`id`, `title`, `placeholder`, `content`, `visible`, `language_id`, `createdat`, `updatedat`)
VALUES
	(6,'Callout','callout','<p><img alt=\"banner\" src=\"http://www.adelaide.edu.au/pce/images/pods/image9.jpg\" style=\"height:169px; width:260px\" /></p>\r\n',1,2,'2014-05-24 18:13:58','2014-05-26 17:23:06'),
	(7,'Contacts','contacts','<div class=\"panel panel-default\">\r\n	<!-- Default panel contents -->\r\n	<div class=\"panel-heading\">\r\n		Contact Us\r\n	</div>\r\n	<div class=\"panel-body\">\r\n		<p>Our developers are available from Monday to Friday. [09.00 am - 06:00 pm]<br>Send your enquiry by contact form. Click here to show the contact form: <a href=\"\\&quot;/contacts\\&quot;\"><i class=\"fa fa-phone\"></i> Contacts Now</a></p>\r\n	</div>\r\n	<!-- List group -->\r\n	<ul class=\"list-group\">\r\n		<li class=\"list-group-item\"><a href=\"/contacts\">Contact Us</a></li>\r\n		<li class=\"list-group-item\">Dapibus ac facilisis in</li>\r\n		<li class=\"list-group-item\">Morbi leo risus</li>\r\n		<li class=\"list-group-item\">Porta ac consectetur ac</li>\r\n		<li class=\"list-group-item\">Vestibulum at eros</li>\r\n	</ul>\r\n</div>',1,2,'2014-05-26 11:08:05','2014-05-26 11:08:05'),
	(8,'Footer','footer','<footer role=\"contentinfo\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-3 col-sm-3 col-md-3 col-xs-12\">\r\n<h4>About ShineISP</h4>\r\n\r\n<p>ShineISP is a <strong>billing system</strong> to <strong>manage your customers</strong> (CMS, eCommerce, CRM, ERP) like WHMCS and WHMAP, Parallels Plesk Billing, AWBS (Advanced Webhosting Billing System) and ClientExec.</p>\r\n\r\n<ul class=\"list-inline\">\r\n	<li><a class=\"fa fa-facebook\" href=\"https://www.facebook.com/shinesoftware\">&nbsp;</a> <a class=\"fa fa-google\" href=\"https://www.googleplus.com/shinesoftware\">&nbsp;</a> <a class=\"fa fa-twitter\" href=\"https://www.twitter.com/shinesoftware\">&nbsp;</a> <a class=\"fa fa-linkedin\" href=\"https://www.linkedin.com/shinesoftware\">&nbsp;</a></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-sm-3 col-md-3 col-xs-12\">\r\n<h4>Main Infomation</h4>\r\n\r\n<ul class=\"list-unstyled\">\r\n	<li><a href=\"/\">Homepage</a></li>\r\n	<li><a href=\"/cms/generic.html\">About Us</a></li>\r\n	<li><a href=\"/cms/generic.html\">Where we are</a></li>\r\n	<li><a href=\"/cms/generic.html\">Helpdesk</a></li>\r\n	<li><a href=\"/cms/generic.html\">Work with us</a></li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-sm-3 col-md-3 col-xs-12\">\r\n<h4>License &amp; Disclaimers</h4>\r\n\r\n<ul class=\"list-unstyled\">\r\n	<li><a href=\"/cms/generic.html\">Software License</a></li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"col-lg-3 col-sm-3 col-md-3 col-xs-12\">\r\n<h4>Technical Support</h4>\r\n\r\n<ul class=\"list-unstyled\">\r\n	<li><a href=\"/contacts\">Contact Us</a></li>\r\n	<li><a href=\"/cms/generic.html\">Wiki</a></li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</footer>\r\n',1,1,'2014-05-26 17:29:55','2014-12-10 15:34:49'),
	(9,'Callout 2','callout-2','<p><img class=\"img-responsive\" src=\"http://placehold.it/810x150&amp;text=this%20is%20a%20simple%20cms%20block!\" /></p>\r\n',1,5,'2014-12-10 15:57:01','2014-12-10 15:57:26');

/*!40000 ALTER TABLE `cms_block` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_page`;

CREATE TABLE `cms_page` (
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
  KEY `language_id` (`language_id`),
  CONSTRAINT `cms_page_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `cms_page_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cms_page_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `cms_page` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `cms_page_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `base_languages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `cms_page` WRITE;
/*!40000 ALTER TABLE `cms_page` DISABLE KEYS */;

INSERT INTO `cms_page` (`id`, `title`, `slug`, `category_id`, `language_id`, `visible`, `tags`, `createdat`, `updatedat`, `content`, `parent_id`, `layout`, `showonlist`)
VALUES
	(2,'This is a simple page','this-is-a-zf2-module',2,2,1,'test,home,cms page','2014-05-19 15:59:15','2014-12-10 15:59:04','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dolor nunc, consectetur non turpis et, tempus consequat tortor. Morbi nec felis at urna ornare porttitor. Ut nec sem fringilla, ornare mauris in, volutpat tortor. Pellentesque blandit, urna non condimentum vulputate, arcu orci fermentum justo, a mollis dui erat aliquam odio. <strong>Cras quis diam tortor. </strong></p>\r\n\r\n<p>{callout-2}</p>\r\n\r\n<p><a href=\"https://pbs.twimg.com/media/BoBTKnYCIAEgV8X.jpg:large\" target=\"_blank\"><img alt=\"Monfalcone\" src=\"https://pbs.twimg.com/media/BoBTKnYCIAEgV8X.jpg:large\" style=\"border-style:solid; border-width:1px; float:left; height:142px; margin:5px; width:212px\" /></a></p>\r\n\r\n<p>Morbi convallis pharetra feugiat. Aliquam erat volutpat. Etiam at euismod lacus. Nullam quis nisl pulvinar felis malesuada bibendum. In non urna ultrices, eleifend leo vel, pellentesque leo. Sed id mauris est. Suspendisse auctor sapien lectus, ac auctor neque dictum et. Sed quis consectetur tortor.</p>\r\n',NULL,'<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<layout>\r\n    <default layout=\"2columns-right\"> \r\n        <commons> \r\n            <blocks>\r\n                 <block side=\"right\">contacts</block>\r\n                 <block side=\"right\">callout</block>                 \r\n            </blocks>\r\n        </commons>\r\n    </default>\r\n</layout>',1),
	(6,'Homepage','homepage',1,1,1,'homepage,english','2014-05-26 17:48:10','2014-12-10 15:59:22','<!-- Heading Row -->\r\n<div class=\"row\">\r\n<div class=\"col-md-8\"><img alt=\"\" class=\"img-responsive img-rounded\" src=\"http://placehold.it/900x350&amp;text=ShineISP%20v.2.0\" /></div>\r\n<!-- /.col-md-8 -->\r\n\r\n<div class=\"col-md-4\">\r\n<h1>ShineISP v.2.0</h1>\r\n\r\n<p>After 2 years of experiences with ShineISP v.1 and Zend Framework 1.12 and Doctrine we are ready to start the <strong>new version of the software</strong>. <strong>More powerful</strong> and <strong>extensible</strong>. Thanks to all the users, IT companies the new version is open to a collaboration for developing new modules.</p>\r\n<a class=\"btn btn-primary btn-lg\" href=\"https://github.com/shinesoftware/shineisp2/fork\">Fork Me!</a></div>\r\n<!-- /.col-md-4 --></div>\r\n<!-- /.row -->\r\n\r\n<hr /><!-- Call to Action Well -->\r\n<div class=\"row\">\r\n<div class=\"col-lg-12\">\r\n<div class=\"well text-center\">Awesome! This is a good way to start your new Open Source collaboration with the ShineISP community!</div>\r\n</div>\r\n<!-- /.col-lg-12 --></div>\r\n<!-- /.row --><!-- Content Row -->\r\n\r\n<div class=\"row\">\r\n<div class=\"col-md-4\">\r\n<h2>Simple Modules</h2>\r\n\r\n<div class=\"markdown-body\">\r\n<p>Zend Framework 2.0 introduces a new and powerful approach to modules. This new module system is designed with flexibility, simplicity, and re-usability in mind. A module may contain just about anything: PHP code, including MVC functionality; library code; view scripts; and/or public assets such as images, CSS, and JavaScript. The possibilities are endless.</p>\r\n\r\n<p>ShineISP is ready to &quot;inject&quot; new modules, services and much more to increase the number of features. So if you would like to add a new feature, clone it, add your module and share it. If the module is well written we will include it in our next release.</p>\r\n</div>\r\n<a class=\"btn btn-default\" href=\"https://github.com/shinesoftware/shineisp2/wiki/Getting%20Involved\">More Info</a></div>\r\n<!-- /.col-md-4 -->\r\n\r\n<div class=\"col-md-4\">\r\n<h2>How can I contribute?</h2>\r\n\r\n<p>It&#39;s really simple because at the moment we are at the &quot;Scratch Step&quot;.</p>\r\n\r\n<p>Now we can choose what we need to include in the software and how to write it. So if you are interested in a real collaboration with us, don&#39;t be scared <a href=\"mailto:info@shineisp.com?subject=Collaboration&amp;body=Hi%2C%20my%20name%20is%20....%20and%20I%20would%20like%20to%20collaborate%20with%20you%20to%20build%20a%20new%20ShineISP%20version.%20My%20skills%20are%3A%20....%0ARegards\">write us</a>! By the way you can help us in these important steps.</p>\r\n<a class=\"btn btn-default\" href=\"http://www.shineisp.com\">More Info</a></div>\r\n<!-- /.col-md-4 -->\r\n\r\n<div class=\"col-md-4\">\r\n<h2>YouTube playlist</h2>\r\n\r\n<p><iframe allowfullscreen=\"\" frameborder=\"0\" height=\"215\" src=\"//www.youtube.com/embed/HGNKwzvtAUE?list=PLNbQWggLBk4O8Q6B9urvFUisPjsL3FfTR\" width=\"360\"></iframe></p>\r\n<a class=\"btn btn-default\" href=\"#\">More Info</a></div>\r\n<!-- /.col-md-4 --></div>\r\n<!-- /.row --><!-- Footer -->\r\n\r\n<footer>\r\n<div class=\"row\">\r\n<div class=\"col-lg-12\">\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n</footer>\r\n',NULL,'<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<layout>\r\n    <default layout=\"blank\"> \r\n        <commons> \r\n            <blocks>\r\n                 <block side=\"endbody\">footer</block>                 \r\n            </blocks>\r\n        </commons>\r\n    </default>\r\n</layout>',0),
	(7,'Generic','generic',1,1,1,'generic page,cms,page','2014-12-10 15:34:26','2014-12-10 15:35:13','<p class=\"lead\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>\r\n',NULL,'',0);

/*!40000 ALTER TABLE `cms_page` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cms_page_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cms_page_category`;

CREATE TABLE `cms_page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `cms_page_category` WRITE;
/*!40000 ALTER TABLE `cms_page_category` DISABLE KEYS */;

INSERT INTO `cms_page_category` (`id`, `category`, `visible`)
VALUES
	(1,'Generic',1),
	(2,'News',1),
	(3,'PHP Development',1);

/*!40000 ALTER TABLE `cms_page_category` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
SET FOREIGN_KEY_CHECKS=1;

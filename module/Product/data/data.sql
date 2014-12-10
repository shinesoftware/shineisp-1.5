# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: shineisp2
# Generation Time: 2014-12-10 13:40:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

SET FOREIGN_KEY_CHECKS=0;

# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`attribute_set_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `uid`, `type_id`, `attribute_set_id`, `createdat`, `updatedat`)
VALUES
    (2,'22ff2755-1540-4d68-8195-079356c33e22',1,2,'2014-07-08 10:21:40','2014-12-09 23:36:41'),
    (11,'9f30e196-295d-4f2d-b7a3-b5be6be1c4b4',1,1,'2014-09-25 17:54:56','2014-09-25 17:54:56'),
    (12,'ea2d3798-3c29-48a5-9b04-76a1101881dc',1,2,'2014-09-25 18:07:28','2014-09-25 18:07:28');

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes`;

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `element_id` int(11) DEFAULT '1',
  `css` varchar(250) DEFAULT NULL,
  `label` varchar(200) NOT NULL,
  `source_model` varchar(200) DEFAULT NULL,
  `filters` varchar(255) DEFAULT NULL,
  `validators` text,
  `filetarget` varchar(255) DEFAULT NULL,
  `filesize` int(11) DEFAULT NULL,
  `filemimetype` text,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_user_defined` tinyint(1) NOT NULL DEFAULT '0',
  `quick_search` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes` WRITE;
/*!40000 ALTER TABLE `product_attributes` DISABLE KEYS */;

INSERT INTO `product_attributes` (`id`, `name`, `type`, `element_id`, `css`, `label`, `source_model`, `filters`, `validators`, `filetarget`, `filesize`, `filemimetype`, `is_required`, `is_user_defined`, `quick_search`)
VALUES
    (1,'name','string',1,'','Name',NULL,NULL,NULL,'',NULL,NULL,1,0,1),
    (2,'sku','string',1,'','SKU',NULL,'[\"cleanurl\"]',NULL,'',NULL,NULL,1,0,0),
    (3,'metadescription','text',1,NULL,'META Description',NULL,NULL,NULL,'',NULL,NULL,0,0,0),
    (4,'metakeyword','string',1,NULL,'META Keywords',NULL,NULL,NULL,'',NULL,NULL,0,0,0),
    (5,'metatitle','string',1,NULL,'META Title',NULL,NULL,NULL,'',NULL,NULL,0,0,0),
    (6,'status','integer',1,NULL,'Status','\\Base\\Form\\Element\\Enadisabled',NULL,NULL,'',NULL,NULL,1,0,0),
    (7,'urlkey','string',1,'','URL Key',NULL,'[\"stringtolower\",\"cleanurl\"]',NULL,'',NULL,NULL,0,0,0),
    (8,'news_from_date','date',8,'','Set Product as New from Date',NULL,NULL,NULL,'',NULL,NULL,0,0,0),
    (9,'news_to_date','date',8,'','Set Product as New to Date',NULL,NULL,NULL,'',NULL,NULL,0,0,0),
    (10,'short_description','text',3,NULL,'Short Description',NULL,NULL,NULL,'',NULL,NULL,1,0,0),
    (11,'description','text',3,NULL,'Description',NULL,NULL,NULL,'',NULL,NULL,1,0,0),
    (12,'price','float',1,NULL,'Price',NULL,NULL,NULL,'',NULL,NULL,1,0,0),
    (13,'special_price','string',1,NULL,'Special Price',NULL,NULL,NULL,'',NULL,NULL,0,0,0),
    (14,'webspace','string',1,'','Web Space',NULL,'[\"int\"]',NULL,'',NULL,NULL,0,1,0),
    (15,'photo','text',7,'','Photo','Zend\\Form\\Element\\File','[{\"name\":\"File\\\\RenameUpload\",\"options\":{\"target\":\"\\/Library\\/WebServer\\/Documents\\/shineisp2\\/public\\/documents\\/product\\/\",\"overwrite\":true,\"use_upload_name\":true}}]','[{\"name\":\"File\\\\UploadFile\",\"filesize\":{\"max\":\"100000\"},\"filemimetype\":[{\"mimeType\":\"image\\/jpeg\"},{\"mimeType\":\"image\\/gif\"},{\"mimeType\":\"image\\/png\"}]}]','/documents/product',100000,'[\"image\\/jpeg\",\"image\\/gif\",\"image\\/png\"]',0,0,0),
    (16,'attachment','text',7,'','Attachment','Zend\\Form\\Element\\File','[{\"name\":\"File\\\\RenameUpload\",\"options\":{\"target\":\"\\/Library\\/WebServer\\/Documents\\/shineisp2\\/public\\/documents\\/product\\/\",\"overwrite\":true,\"use_upload_name\":true}}]','[{\"name\":\"File\\\\UploadFile\",\"filesize\":{\"max\":\"100000\"},\"filemimetype\":[{\"mimeType\":\"application\\/pdf\"},{\"mimeType\":\"application\\/msword\"},{\"mimeType\":\"application\\/zip\"}]}]','/documents/product',100000,'[\"application\\/pdf\",\"application\\/msword\",\"application\\/zip\"]',0,0,0),
    (18,'category','string',5,'\n','Category',NULL,NULL,NULL,'',NULL,NULL,0,0,0);

/*!40000 ALTER TABLE `product_attributes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_elements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_elements`;

CREATE TABLE `product_attributes_elements` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `input_type` varchar(200) DEFAULT NULL,
  `description` text,
  `css` varchar(255) DEFAULT NULL,
  `attributes` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_attributes_elements` WRITE;
/*!40000 ALTER TABLE `product_attributes_elements` DISABLE KEYS */;

INSERT INTO `product_attributes_elements` (`id`, `name`, `input_type`, `description`, `css`, `attributes`)
VALUES
    (1,'Text','text','Simple text object','form-control',NULL),
    (2,'Textarea','textarea','A simple multiline text area','form-control',NULL),
    (3,'Wysiwyg','textarea','CKEditor is a ready-for-use HTML text editor designed to simplify web content creation. It\'s a WYSIWYG editor that brings common word processor features directly to your web pages. ','wysiwyg',NULL),
    (4,'Select','select','A simple dropdown box','form-control',NULL),
    (5,'Advanced Select','hidden','Select2 is a jQuery based replacement for select boxes. It supports searching, remote data sets, and infinite scrolling of results. ','select2','{\"data-field-id\":\"id\",\"data-fields-data\":\"name\",\"data-multiple\":\"true\",\"data-url-search\":\"\\/admin\\/product\\/search\"}'),
    (6,'Multiselect','select','A custom select / multiselect for Bootstrap using button dropdown, designed to behave like regular Bootstrap selects.','form-control','{\"data-container\":\"body\",\"data-selected-text-format\":\"count > 2\",\"data-size\":\"auto\",\"data-live-search\":\"true\"}'),
    (7,'File','file','File selector','form-control file','[\"data-preview-file-type\":\"text\"]'),
    (8,'Date','text','A date picker object','form-control date',NULL);

/*!40000 ALTER TABLE `product_attributes_elements` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_entity_date
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_entity_date`;

CREATE TABLE `product_attributes_entity_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_entity_date_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_entity_date_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_entity_date` WRITE;
/*!40000 ALTER TABLE `product_attributes_entity_date` DISABLE KEYS */;

INSERT INTO `product_attributes_entity_date` (`id`, `entity_id`, `attribute_id`, `value`)
VALUES
    (1,2,8,'2014-09-18'),
    (2,2,9,'2014-09-17'),
    (5,11,8,NULL),
    (6,11,9,NULL),
    (7,12,8,'2014-09-16'),
    (8,12,9,'2014-09-30');

/*!40000 ALTER TABLE `product_attributes_entity_date` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_entity_datetime
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_entity_datetime`;

CREATE TABLE `product_attributes_entity_datetime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_entity_datetime_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_entity_datetime_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table product_attributes_entity_float
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_entity_float`;

CREATE TABLE `product_attributes_entity_float` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_entity_float_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_entity_float_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_entity_float` WRITE;
/*!40000 ALTER TABLE `product_attributes_entity_float` DISABLE KEYS */;

INSERT INTO `product_attributes_entity_float` (`id`, `entity_id`, `attribute_id`, `value`)
VALUES
    (1,2,12,10.5),
    (3,11,12,19.99),
    (4,12,12,15);

/*!40000 ALTER TABLE `product_attributes_entity_float` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_entity_integer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_entity_integer`;

CREATE TABLE `product_attributes_entity_integer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_entity_integer_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_entity_integer_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_entity_integer` WRITE;
/*!40000 ALTER TABLE `product_attributes_entity_integer` DISABLE KEYS */;

INSERT INTO `product_attributes_entity_integer` (`id`, `entity_id`, `attribute_id`, `value`)
VALUES
    (1,2,6,1),
    (3,11,6,1),
    (4,12,6,1);

/*!40000 ALTER TABLE `product_attributes_entity_integer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_entity_string
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_entity_string`;

CREATE TABLE `product_attributes_entity_string` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_entity_string_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_entity_string_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_entity_string` WRITE;
/*!40000 ALTER TABLE `product_attributes_entity_string` DISABLE KEYS */;

INSERT INTO `product_attributes_entity_string` (`id`, `entity_id`, `attribute_id`, `value`)
VALUES
    (1,2,4,'keyword one, keyword two, keyword three'),
    (2,2,1,'Hosting Silver'),
    (3,2,2,'hst-01'),
    (4,2,13,'8.60'),
    (5,2,7,'hosting-silver'),
    (6,2,5,'This is a custom product title '),
    (7,2,14,'100'),
    (15,2,8,'2014-09-17'),
    (16,2,9,'02/09/17'),
    (22,11,1,'Zend Developer'),
    (23,11,2,'dev-01'),
    (24,11,7,''),
    (25,11,13,'18'),
    (26,11,4,''),
    (27,11,5,''),
    (28,12,1,'Hosting Gold'),
    (29,12,2,'hst-02'),
    (30,12,7,''),
    (31,12,13,'12'),
    (32,12,4,''),
    (33,12,5,''),
    (34,12,14,'300 gb'),
    (35,2,18,'7,14');

/*!40000 ALTER TABLE `product_attributes_entity_string` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_entity_text
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_entity_text`;

CREATE TABLE `product_attributes_entity_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_entity_text_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_entity_text_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_entity_text` WRITE;
/*!40000 ALTER TABLE `product_attributes_entity_text` DISABLE KEYS */;

INSERT INTO `product_attributes_entity_text` (`id`, `entity_id`, `attribute_id`, `value`)
VALUES
    (1,2,11,'<p>test B</p>\r\n'),
    (2,2,3,'This is the meta description'),
    (3,2,10,'<p>test A</p>\r\n'),
    (7,2,15,'[]'),
    (8,2,16,'[]'),
    (9,11,3,''),
    (10,11,10,'This is a test for the short description'),
    (11,11,11,'This is a simple description of the product'),
    (12,11,15,''),
    (13,11,16,''),
    (14,12,3,''),
    (15,12,10,'This is a short description'),
    (16,12,11,'This is a description'),
    (17,12,15,''),
    (18,12,16,'');

/*!40000 ALTER TABLE `product_attributes_entity_text` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_groups`;

CREATE TABLE `product_attributes_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_groups` WRITE;
/*!40000 ALTER TABLE `product_attributes_groups` DISABLE KEYS */;

INSERT INTO `product_attributes_groups` (`id`, `name`)
VALUES
    (1,'Main'),
    (2,'Price'),
    (3,'Metadata'),
    (12,'Hosting'),
    (13,'Content'),
    (14,'Custom'),
    (15,'Images'),
    (17,'Category');

/*!40000 ALTER TABLE `product_attributes_groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_groups_idx
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_groups_idx`;

CREATE TABLE `product_attributes_groups_idx` (
  `attribute_group_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  KEY `group_id` (`attribute_group_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `attribute_set_id` (`attribute_set_id`),
  CONSTRAINT `product_attributes_groups_idx_ibfk_1` FOREIGN KEY (`attribute_group_id`) REFERENCES `product_attributes_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_groups_idx_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_groups_idx_ibfk_3` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_groups_idx` WRITE;
/*!40000 ALTER TABLE `product_attributes_groups_idx` DISABLE KEYS */;

INSERT INTO `product_attributes_groups_idx` (`attribute_group_id`, `attribute_set_id`, `attribute_id`)
VALUES
    (1,1,1),
    (1,1,2),
    (2,1,12),
    (2,1,13),
    (1,1,10),
    (1,1,11),
    (3,1,3),
    (3,1,4),
    (3,1,5),
    (2,1,8),
    (2,1,9),
    (1,1,6),
    (1,1,7);

/*!40000 ALTER TABLE `product_attributes_groups_idx` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_idx
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_idx`;

CREATE TABLE `product_attributes_idx` (
  `attribute_group_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  KEY `group_id` (`attribute_group_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `attribute_set_id` (`attribute_set_id`),
  CONSTRAINT `product_attributes_idx_ibfk_1` FOREIGN KEY (`attribute_group_id`) REFERENCES `product_attributes_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_idx_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_attributes_idx_ibfk_3` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_idx` WRITE;
/*!40000 ALTER TABLE `product_attributes_idx` DISABLE KEYS */;

INSERT INTO `product_attributes_idx` (`attribute_group_id`, `attribute_set_id`, `attribute_id`)
VALUES
    (1,1,1),
    (1,1,2),
    (1,1,6),
    (1,1,7),
    (1,1,8),
    (1,1,9),
    (2,1,12),
    (2,1,13),
    (3,1,4),
    (3,1,3),
    (3,1,5),
    (13,1,10),
    (13,1,11),
    (15,1,15),
    (15,1,16),
    (17,1,18),
    (1,2,1),
    (1,2,2),
    (1,2,6),
    (1,2,7),
    (1,2,8),
    (1,2,9),
    (2,2,12),
    (2,2,13),
    (3,2,3),
    (3,2,4),
    (3,2,5),
    (12,2,14),
    (13,2,10),
    (13,2,11),
    (15,2,15),
    (15,2,16),
    (17,2,18);

/*!40000 ALTER TABLE `product_attributes_idx` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_set
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_set`;

CREATE TABLE `product_attributes_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_attributes_set` WRITE;
/*!40000 ALTER TABLE `product_attributes_set` DISABLE KEYS */;

INSERT INTO `product_attributes_set` (`id`, `name`, `default`)
VALUES
    (1,'Default',1),
    (2,'Hosting',0);

/*!40000 ALTER TABLE `product_attributes_set` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attributes_set_idx
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attributes_set_idx`;

CREATE TABLE `product_attributes_set_idx` (
  `attribute_id` int(11) NOT NULL,
  `attribute_set_id` int(11) NOT NULL,
  KEY `attribute_set_id` (`attribute_set_id`),
  KEY `attribute_id` (`attribute_id`),
  CONSTRAINT `product_attributes_set_idx_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `product_attributes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_attributes_set_idx_ibfk_2` FOREIGN KEY (`attribute_set_id`) REFERENCES `product_attributes_set` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table product_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_category`;

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `createdat` datetime NOT NULL,
  `updatedat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;

INSERT INTO `product_category` (`id`, `uid`, `name`, `description`, `parent_id`, `createdat`, `updatedat`)
VALUES
    (7,'79251bc4-b115-4830-9073-1bb4f764fb0e','Hosting',NULL,0,'2014-12-08 11:20:52','2014-12-08 11:20:52'),
    (10,'79251bc4-b115-4830-9073-1bb4f764fb0e','Wordpress','Hosting per il software Wordpress',7,'2014-12-08 11:20:52','2014-12-08 15:52:02'),
    (14,'b6f12c1c-293d-41ec-b920-d7c23a193ba3','SHDSL',NULL,52,'2014-12-08 15:10:31','2014-12-10 14:36:20'),
    (49,'ee685dd2-29e2-4ffe-b4ef-b3141b7468eb','Support',NULL,0,'2014-12-10 14:28:54','2014-12-10 14:29:00'),
    (50,'e69f663e-0003-4cb2-912b-a39f76c38718','Technical System',NULL,49,'2014-12-10 14:29:10','2014-12-10 14:29:10'),
    (51,'e3e4eeb7-608e-4d21-aa77-868d1dd175e3','System Administrator',NULL,49,'2014-12-10 14:35:53','2014-12-10 14:35:53'),
    (52,'526f3029-7503-4757-8da1-6cb8a9a689e1','Data Lines',NULL,0,'2014-12-10 14:36:15','2014-12-10 14:36:15'),
    (53,'0a2f2d7d-e7c3-4e05-978d-ae1cedc685a8','ADSL',NULL,52,'2014-12-10 14:36:29','2014-12-10 14:36:29'),
    (54,'c380c2a4-ebfa-47ec-bafc-21ad5a8478c4','Magento',NULL,7,'2014-12-10 14:37:45','2014-12-10 14:37:45');

/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_entity_decimal
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_entity_decimal`;

CREATE TABLE `product_entity_decimal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` decimal(2,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table product_entity_int
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_entity_int`;

CREATE TABLE `product_entity_int` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table product_entity_string
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_entity_string`;

CREATE TABLE `product_entity_string` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table product_entity_text
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_entity_text`;

CREATE TABLE `product_entity_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table product_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_groups`;

CREATE TABLE `product_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_groups` WRITE;
/*!40000 ALTER TABLE `product_groups` DISABLE KEYS */;

INSERT INTO `product_groups` (`id`, `name`)
VALUES
    (1,'Default');

/*!40000 ALTER TABLE `product_groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_types`;

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `product_types` WRITE;
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;

INSERT INTO `product_types` (`id`, `name`)
VALUES
    (1,'Simple');
    



/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET FOREIGN_KEY_CHECKS=1;   
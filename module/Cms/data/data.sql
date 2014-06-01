-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2014 at 12:29 PM
-- Server version: 5.5.27-log
-- PHP Version: 5.5.8

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `shineisp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
CREATE TABLE IF NOT EXISTS `block` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`id`, `title`, `placeholder`, `content`, `visible`, `language_id`, `createdat`, `updatedat`) VALUES
(6, 'Callout', 'callout', '<p><img alt="banner" src="http://www.adelaide.edu.au/pce/images/pods/image9.jpg" style="height:169px; width:260px" /></p>\r\n', 1, 2, '2014-05-24 18:13:58', '2014-05-26 17:23:06'),
(7, 'Contacts', 'contacts', '<div class="panel panel-default">\r\n	<!-- Default panel contents -->\r\n	<div class="panel-heading">\r\n		Contact Us\r\n	</div>\r\n	<div class="panel-body">\r\n		<p>Our developers are available from Monday to Friday. [09.00 am - 06:00 pm]<br>Send your enquiry by contact form. Click here to show the contact form: <a href="\\&quot;/contacts\\&quot;"><i class="fa fa-phone"></i> Contacts Now</a></p>\r\n	</div>\r\n	<!-- List group -->\r\n	<ul class="list-group">\r\n		<li class="list-group-item"><a href="/contacts">Contact Us</a></li>\r\n		<li class="list-group-item">Dapibus ac facilisis in</li>\r\n		<li class="list-group-item">Morbi leo risus</li>\r\n		<li class="list-group-item">Porta ac consectetur ac</li>\r\n		<li class="list-group-item">Vestibulum at eros</li>\r\n	</ul>\r\n</div>', 1, 2, '2014-05-26 11:08:05', '2014-05-26 11:08:05'),
(8, 'Callout 2', 'callout-2', '<div class="alert alert-info">This is a STATIC block!</div>\r\n', 1, 1, '2014-05-26 17:29:55', '2014-05-26 17:31:55'),
(9, 'Carousel', 'carousel', '<!-- Carousel\r\n    ================================================== -->\r\n<div class="carousel slide" data-ride="carousel" id="myCarousel"><!-- Indicators -->\r\n<ol class="carousel-indicators">\r\n	<li class="active" data-slide-to="0" data-target="#myCarousel">&nbsp;</li>\r\n	<li data-slide-to="1" data-target="#myCarousel">&nbsp;</li>\r\n	<li data-slide-to="2" data-target="#myCarousel">&nbsp;</li>\r\n</ol>\r\n\r\n<div class="carousel-inner">\r\n<div class="item active"><img alt="First slide" src="/img/background-slide.png" />\r\n<div class="container">\r\n<div class="carousel-caption">\r\n<h1>ShineISP 2 - Open Source Project</h1>\r\n<p>This is the CMS module for the ShineISP project. If you need to extend it, clone it, edit it and then Push a Release to GitHub.</p>\r\n<p><a class="btn btn-lg btn-primary" href="https://github.com/shinesoftware/shineisp2" role="button">Go to ShineISP Project</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="item"><img alt="Second slide" src="/img/background-slide.png" />\r\n<div class="container">\r\n<div class="carousel-caption">\r\n<h1>Create your Pages</h1>\r\n\r\n<p>Cms Module offers simple features to create your own web pages. You can use <span class="label label-success">tags</span> and categories to organize all the information.</p>\r\n\r\n<p><a class="btn btn-lg btn-primary" href="https://github.com/shinesoftware/shineisp2/wiki/Cms" role="button">Learn more</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="item"><img alt="Third slide" src="/img/background-slide.png" />\r\n<div class="container">\r\n<div class="carousel-caption">\r\n<h1>Getting Involved</h1>\r\n\r\n<p>Fork ShineISP 2 now and start to contribute with the community!</p>\r\n\r\n<p><a class="btn btn-lg btn-primary" href="https://github.com/shinesoftware/shineisp2/fork" role="button">Fork It!</a></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<hr/>', 1, 2, '2014-05-31 11:40:08', '2014-05-31 12:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `showonlist` tinyint(1) NOT NULL DEFAULT '1',
  `tags` varchar(255) DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  `updatedat` datetime DEFAULT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `layout` text,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `parent_id` (`parent_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `slug`, `category_id`, `language_id`, `visible`, `showonlist`, `tags`, `createdat`, `updatedat`, `content`, `parent_id`, `layout`) VALUES
(2, 'This is a ZF2 Module', 'this-is-a-zf2-module', 2, 2, 1, 1, 'test,home', '2014-05-19 15:59:15', '2014-05-30 22:11:41', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dolor nunc, consectetur non turpis et, tempus consequat tortor. Morbi nec felis at urna ornare porttitor. Ut nec sem fringilla, ornare mauris in, volutpat tortor. Pellentesque blandit, urna non condimentum vulputate, arcu orci fermentum justo, a mollis dui erat aliquam odio. <strong>Cras quis diam tortor. </strong></p>\r\n\r\n<p>{callout-2}</p>\r\n\r\n<p><a href="https://pbs.twimg.com/media/BoBTKnYCIAEgV8X.jpg:large" target="_blank"><img alt="Monfalcone" src="https://pbs.twimg.com/media/BoBTKnYCIAEgV8X.jpg:large" style="border-style:solid; border-width:1px; float:left; height:142px; margin:5px; width:212px" /></a></p>\r\n\r\n<p>Morbi convallis pharetra feugiat. Aliquam erat volutpat. Etiam at euismod lacus. Nullam quis nisl pulvinar felis malesuada bibendum. In non urna ultrices, eleifend leo vel, pellentesque leo. Sed id mauris est. Suspendisse auctor sapien lectus, ac auctor neque dictum et. Sed quis consectetur tortor.</p>\r\n', NULL, '<?xml version="1.0" encoding="UTF-8"?>\r\n<layout>\r\n    <default template="2columns-right"> \r\n        <commons> \r\n            <head action="clearall">                             \r\n                 <js>/test.js</js>\r\n                 <css>/test.css</css>\r\n            </head>\r\n            <blocks>\r\n                 <block side="right">contacts</block>\r\n                 <block side="right">callout</block>                 \r\n            </blocks>\r\n        </commons>\r\n    </default>\r\n</layout>'),
(5, 'About Us', 'about-us', 1, 1, 1, 1, 'homepage,first page', '2014-05-19 22:40:39', '2014-05-29 18:34:05', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu est bibendum, rutrum nisl a, pharetra magna. Suspendisse rutrum nunc at gravida consequat. Sed nec diam in ipsum congue ultricies vitae a leo. Pellentesque mollis justo at diam vehicula elementum. Donec velit metus, mollis at mi eu, varius sollicitudin diam. Donec accumsan accumsan vehicula. Aliquam tempor neque at suscipit auctor. Maecenas id ornare ligula.</p>\r\n\r\n<p>Curabitur eget ante velit. Phasellus ac leo varius eros gravida tincidunt. Curabitur aliquam eros id pretium vestibulum. Aliquam in congue lectus. Nullam ut augue eleifend urna rhoncus fringilla vel vitae eros. Mauris malesuada augue consequat leo fringilla, eu ultrices odio sodales. Cras semper nibh sit amet nibh commodo vestibulum. Aenean vitae viverra ligula.</p>\r\n\r\n<p>Ut hendrerit sapien vitae lacus semper, eget sollicitudin justo pellentesque. Phasellus tempor eros vitae quam pulvinar, a interdum mi tristique. Aenean venenatis magna ut purus ullamcorper, non viverra arcu dictum. Nunc congue placerat rhoncus. Phasellus et tortor eget nunc condimentum pretium at quis magna. Aliquam congue in orci ac feugiat. Curabitur porttitor mollis magna, sit amet consequat tortor consequat at. Mauris risus augue, sollicitudin eu risus ac, faucibus pharetra augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec scelerisque volutpat egestas.</p>\r\n', 2, ''),
(6, 'Homepage', 'homepage', 1, 1, 1, 0, '', '2014-05-26 17:48:10', '2014-05-31 12:05:11', '<div class="container marketing"><!-- Three columns of text below the carousel -->\r\n<div class="row">\r\n<div class="col-lg-4"><img alt="140x140" class="img-circle" data-src="holder.js/140x140" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+" style="width: 140px; height: 140px;" />\r\n<h2>Heading</h2>\r\n\r\n<p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>\r\n\r\n<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 -->\r\n\r\n<div class="col-lg-4"><img alt="140x140" class="img-circle" data-src="holder.js/140x140" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+" style="width: 140px; height: 140px;" />\r\n<h2>Heading</h2>\r\n\r\n<p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>\r\n\r\n<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 -->\r\n\r\n<div class="col-lg-4"><img alt="140x140" class="img-circle" data-src="holder.js/140x140" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iMTQwIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjcwIiB5PSI3MCIgc3R5bGU9ImZpbGw6I2FhYTtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxMnB4O2ZvbnQtZmFtaWx5OkFyaWFsLEhlbHZldGljYSxzYW5zLXNlcmlmO2RvbWluYW50LWJhc2VsaW5lOmNlbnRyYWwiPjE0MHgxNDA8L3RleHQ+PC9zdmc+" style="width: 140px; height: 140px;" />\r\n<h2>Heading</h2>\r\n\r\n<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>\r\n\r\n<p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>\r\n</div>\r\n<!-- /.col-lg-4 --></div>\r\n<!-- /.row --><!-- START THE FEATURETTES -->\r\n\r\n<hr class="featurette-divider" />\r\n<div class="row featurette">\r\n<div class="col-md-7">\r\n<h2 class="featurette-heading">First featurette heading. <span class="text-muted">It&#39;ll blow your mind.</span></h2>\r\n\r\n<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>\r\n</div>\r\n\r\n<div class="col-md-5"><img alt="500x500" class="featurette-image img-responsive" data-src="holder.js/500x500/auto" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjI1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjMxcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NTAweDUwMDwvdGV4dD48L3N2Zz4=" /></div>\r\n</div>\r\n\r\n<hr class="featurette-divider" />\r\n<div class="row featurette">\r\n<div class="col-md-5"><img alt="500x500" class="featurette-image img-responsive" data-src="holder.js/500x500/auto" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjI1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjMxcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NTAweDUwMDwvdGV4dD48L3N2Zz4=" /></div>\r\n\r\n<div class="col-md-7">\r\n<h2 class="featurette-heading">Oh yeah, it&#39;s that good. <span class="text-muted">See for yourself.</span></h2>\r\n\r\n<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>\r\n</div>\r\n</div>\r\n\r\n<hr class="featurette-divider" />\r\n<div class="row featurette">\r\n<div class="col-md-7">\r\n<h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>\r\n\r\n<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>\r\n</div>\r\n\r\n<div class="col-md-5"><img alt="500x500" class="featurette-image img-responsive" data-src="holder.js/500x500/auto" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI2VlZSIvPjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjI1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjMxcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NTAweDUwMDwvdGV4dD48L3N2Zz4=" /></div>\r\n</div>\r\n\r\n<hr class="featurette-divider" /><!-- /END THE FEATURETTES --><!-- FOOTER --></div>\r\n', NULL, '<?xml version="1.0" encoding="UTF-8"?>\r\n<layout>\r\n    <default template="blank"> \r\n        <commons> \r\n            <blocks>\r\n                 <block side="beforecontent">carousel</block>                 \r\n            </blocks>\r\n        </commons>\r\n    </default>\r\n</layout>');

-- --------------------------------------------------------

--
-- Table structure for table `page_category`
--

DROP TABLE IF EXISTS `page_category`;
CREATE TABLE IF NOT EXISTS `page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `page_category`
--

INSERT INTO `page_category` (`id`, `category`, `visible`) VALUES
(1, 'Generic', 1),
(2, 'News', 1),
(3, 'PHP Development', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `page_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `page` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `page_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE SET NULL;
SET FOREIGN_KEY_CHECKS=1;

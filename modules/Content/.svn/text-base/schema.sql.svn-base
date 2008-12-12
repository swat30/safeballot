-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 21, 2008 at 04:39 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `trunk`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `content_pages`
-- 

DROP TABLE IF EXISTS `content_pages`;
CREATE TABLE `content_pages` (
  `id` int(11) NOT NULL auto_increment,
  `page_name` varchar(32) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `access` varchar(64) NOT NULL default 'public',
  PRIMARY KEY  (`id`),
  KEY `page_name` (`page_name`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `content_pages`
-- 

INSERT INTO `content_pages` VALUES (1, 'Home', '2007-12-15 20:23:33', 1, 'public');

-- --------------------------------------------------------

-- 
-- Table structure for table `content_page_data`
-- 

DROP TABLE IF EXISTS `content_page_data`;
CREATE TABLE `content_page_data` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `locale_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL default '0',
  `page_title` text NOT NULL,
  `meta_title` varchar(64) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `content_page_data`
-- 

INSERT INTO `content_page_data` VALUES (1, 1, '<p>Lorem ipsum <strong>dolor</strong> sit amet, consectetuer adipiscing elit. Mauris ultricies. Vivamus vel ante. Mauris ut leo. Curabitur ac risus i<a href=\\"/file/13\\">n quam iaculis e</a>uismod. Praesent at felis. Phasellus in quam. Quisque laoreet leo venenatis erat tempor adipiscing. Cras dolor. Aenean ligula turpis, viverra eget, aliquet blandit, sodales sit amet, ligula. Maecenas bibendum euismod tortor. Phasellus aliquet augue in enim. Morbi id mi. Sed lacus. Vivamus consequat.</p>\r\n<p>Nullam aliquam dolor vitae odio. Donec vulputate varius turpis. Sed mollis consectetuer erat. Nulla non quam. Duis ac lorem. Aenean eu nisi id nisl suscipit pellentesque. Aenean aliquam elit eget nulla. Nunc porttitor ultricies velit. Nam sed massa. Mauris sit amet nisl. Aenean justo eros, laoreet id, sollicitudin vel, aliquam in, tortor. Praesent ornare. Nam imperdiet luctus tortor. Donec lobortis. Ut sodales, metus eu cursus egestas, nunc lacus vulputate lorem, non lacinia elit sem bibendum nulla. Curabitur dolor urna, eleifend semper, dictum eget, pulvinar vitae, nisi. Morbi lacinia.</p>\r\n<p>Praesent pharetra, urna non egestas ultricies, tellus ligula consectetuer nisl, eu adipiscing eros ante nec enim. Mauris ut metus vitae tellus blandit malesuada. Praesent hendrerit dui. Quisque tristique magna in urna. Phasellus tellus purus, euismod sed, porttitor eget, tempor et, purus. Quisque sed orci. Etiam nec ligula sit amet risus vulputate ultrices. Fusce a orci. Sed libero nisi, iaculis nec, mattis vel, malesuada vel, arcu. Sed et ante sit amet velit ultrices pulvinar. Quisque eget magna ut ligula fringilla consectetuer. Vestibulum lectus.</p>\r\n<p>In nibh elit, tristique sed, semper vitae, eleifend sit amet, leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tortor. Fusce tortor metus, pretium sit amet, ornare imperdiet, vestibulum sit amet, erat. Nam dui. Suspendisse at felis vitae lectus congue hendrerit. Donec dictum neque in tortor eleifend placerat. Integer volutpat eros vitae felis. Integer porta pede sed libero. Nullam velit augue, consequat vel, vestibulum quis, egestas feugiat, erat. Phasellus quis mauris. Sed tincidunt imperdiet ipsum. Morbi aliquam, augue sed viverra mollis, quam neque vehicula pede, nec luctus enim magna at sem. Curabitur pharetra ante eleifend velit. Etiam eu est.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In eu mauris! Curabitur fermentum, lectus nec aliquet vehicula, mauris quam accumsan sapien, in sollicitudin erat mi sit amet purus. Phasellus pretium neque sollicitudin tellus. Sed in est. Morbi ac sem. Quisque ornare iaculis sapien. Donec eleifend aliquet nisl. Fusce dapibus ipsum nec metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas malesuada nibh id turpis. Aliquam erat volutpat. Etiam aliquet volutpat justo. Etiam at tortor.<br /> <br /> Donec a est. Nulla vitae mi. Fusce vehicula turpis eget mauris sodales pellentesque? Donec tempor! Aliquam malesuada urna sit amet purus. Duis quis purus ut est sollicitudin semper. Maecenas erat nisi, luctus sit amet, rutrum ac, malesuada ac; arcu? Donec at lacus. Duis ac eros vitae pede adipiscing placerat? Sed id nunc. Fusce justo eros, vehicula ac; elementum non, tristique eu, ligula. Etiam non sem quis neque placerat molestie. Mauris commodo purus eget pede.<br /> <br /> Aliquam ornare orci ut nulla. Integer in mauris. Vivamus erat. Pellentesque in eros. Curabitur eleifend metus et felis. Maecenas varius ante non enim. Aenean mollis ipsum id nisi. In iaculis. Nulla quis pede? In nisi? Praesent gravida, quam eu tincidunt lacinia, pede lacus scelerisque justo; et rutrum dolor eros id lorem. Quisque blandit rutrum mi. In hac habitasse platea dictumst. Donec eleifend pede quis nisi. Nam lectus ante, dapibus eget; molestie sit amet, pulvinar vitae, diam. Quisque nec leo et sapien sodales sollicitudin. Maecenas et mauris et erat viverra adipiscing. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam varius rutrum eros.</p>', 1, '2008-07-21 12:50:41', 0, 'Happy Title', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `content_templates`
-- 

DROP TABLE IF EXISTS `content_templates`;
CREATE TABLE `content_templates` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL default '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `preview_image` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `content_templates`
-- 

INSERT INTO `content_templates` VALUES (1, 'Blank Template', 'Basic template with no predefined titles, images, etc.', '<p>&nbsp;</p>', 'blank.png');
INSERT INTO `content_templates` VALUES (2, 'Page Title', 'Blank Template with a page title at the top.', '<h1>Page Title</h1>\r\n<p>&nbsp;</p>', 'title.png');
INSERT INTO `content_templates` VALUES (3, 'Title with Image on Left', 'The title of the page is shown at the top, and an image of your choice is on the left with text wrapped around it.', '', 'titleimageleft.png');
INSERT INTO `content_templates` VALUES (4, 'Title with Image on Right', 'The title of the page is shown at the top, and an image of your choice is on the right with text wrapped around it.', '', 'titleimageright.png');

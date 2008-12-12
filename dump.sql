-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 20, 2008 at 01:22 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `safeballot`
-- 
--DROP DATABASE IF EXISTS `safeballot`;

--CREATE DATABASE `safeballot`;

USE `safeballot`;
-- --------------------------------------------------------

-- 
-- Table structure for table `address`
-- 

CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `adr_streetaddress` varchar(128) NOT NULL,
  `adr_city` varchar(64) NOT NULL,
  `adr_postalcode` varchar(16) default NULL,
  `s_id` int(11) default NULL,
  `c_id` int(11) default NULL,
  `adr_geocode` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Generic Address Table' AUTO_INCREMENT=514 ;

-- 
-- Dumping data for table `address`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `auth`
-- 

CREATE TABLE `auth` (
  `aut_id` int(11) unsigned NOT NULL auto_increment,
  `aut_username` varchar(32) NOT NULL,
  `aut_password` varchar(32) NOT NULL,
  `aut_salt` varchar(32) NOT NULL,
  `aut_agp_id` int(11) NOT NULL,
  `aut_last_touched` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `aut_name` varchar(255) NOT NULL,
  `aut_email` varchar(255) NOT NULL,
  `aut_status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`aut_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `auth`
-- 

INSERT INTO `auth` VALUES (1, 'norex', 'c68e8e578955211af6dd5e2b8dc722b0', 'norexcms4815c0ca531070.82883754', 1, '2008-07-21 10:56:56', 'Norex Development', 'chris@norex.ca', 1);
INSERT INTO `auth` VALUES (2, 'sdafds', 'a85e3f5941d874133940732560e70450', 'norexcms4899a1e7beda63.14795341', 1, '2008-08-06 10:07:02', 'sdafds', 'test@test.ca', 0);
INSERT INTO `auth` VALUES (3, 'emp1', '8a18a6288ca2d0c60f3ff735ed78a814', 'norexcms4899a20edcba90.52907703', 4, '2008-08-11 09:39:41', 'Test', 'test@test.ca', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `auth_groups`
-- 

CREATE TABLE `auth_groups` (
  `agp_id` int(11) unsigned NOT NULL auto_increment,
  `agp_name` varchar(50) NOT NULL,
  `agp_status` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`agp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `auth_groups`
-- 

INSERT INTO `auth_groups` VALUES (1, 'Administrator', 1);
INSERT INTO `auth_groups` VALUES (4, 'Company 1', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `blocks`
-- 

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('active','inactive') NOT NULL default 'active',
  `sort` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- 
-- Dumping data for table `blocks`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `campaigns`
-- 

CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `campaigns`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `campaign_choices`
-- 

CREATE TABLE `campaign_choices` (
  `id` int(11) NOT NULL auto_increment,
  `campaign_id` int(11) NOT NULL,
  `choice` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `campaign_choices`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `campaign_hash`
-- 

CREATE TABLE `campaign_hash` (
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `hash` varchar(21) NOT NULL,
  PRIMARY KEY  (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `campaign_hash`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `campaign_recipients`
-- 

CREATE TABLE `campaign_recipients` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `campaign_recipients`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `campaign_votes`
-- 

CREATE TABLE `campaign_votes` (
  `id` int(11) NOT NULL auto_increment,
  `choice_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `campaign_votes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `content_pages`
-- 

CREATE TABLE `content_pages` (
  `id` int(11) NOT NULL auto_increment,
  `page_name` varchar(32) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `access` varchar(64) NOT NULL default 'public',
  PRIMARY KEY  (`id`),
  KEY `page_name` (`page_name`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `content_pages`
-- 

INSERT INTO `content_pages` VALUES (1, 'Home', '2007-12-15 20:23:33', 1, 'public');

-- --------------------------------------------------------

-- 
-- Table structure for table `content_page_data`
-- 

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `content_page_data`
-- 

INSERT INTO `content_page_data` VALUES (1, 1, '<p>Lorem ipsum <strong>dolor</strong> sit amet, consectetuer adipiscing elit. Mauris ultricies. Vivamus vel ante. Mauris ut leo. Curabitur ac risus i<a href=\\"/file/13\\">n quam iaculis e</a>uismod. Praesent at felis. Phasellus in quam. Quisque laoreet leo venenatis erat tempor adipiscing. Cras dolor. Aenean ligula turpis, viverra eget, aliquet blandit, sodales sit amet, ligula. Maecenas bibendum euismod tortor. Phasellus aliquet augue in enim. Morbi id mi. Sed lacus. Vivamus consequat.</p>\r\n<p>Nullam aliquam dolor vitae odio. Donec vulputate varius turpis. Sed mollis consectetuer erat. Nulla non quam. Duis ac lorem. Aenean eu nisi id nisl suscipit pellentesque. Aenean aliquam elit eget nulla. Nunc porttitor ultricies velit. Nam sed massa. Mauris sit amet nisl. Aenean justo eros, laoreet id, sollicitudin vel, aliquam in, tortor. Praesent ornare. Nam imperdiet luctus tortor. Donec lobortis. Ut sodales, metus eu cursus egestas, nunc lacus vulputate lorem, non lacinia elit sem bibendum nulla. Curabitur dolor urna, eleifend semper, dictum eget, pulvinar vitae, nisi. Morbi lacinia.</p>\r\n<p>Praesent pharetra, urna non egestas ultricies, tellus ligula consectetuer nisl, eu adipiscing eros ante nec enim. Mauris ut metus vitae tellus blandit malesuada. Praesent hendrerit dui. Quisque tristique magna in urna. Phasellus tellus purus, euismod sed, porttitor eget, tempor et, purus. Quisque sed orci. Etiam nec ligula sit amet risus vulputate ultrices. Fusce a orci. Sed libero nisi, iaculis nec, mattis vel, malesuada vel, arcu. Sed et ante sit amet velit ultrices pulvinar. Quisque eget magna ut ligula fringilla consectetuer. Vestibulum lectus.</p>\r\n<p>In nibh elit, tristique sed, semper vitae, eleifend sit amet, leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tortor. Fusce tortor metus, pretium sit amet, ornare imperdiet, vestibulum sit amet, erat. Nam dui. Suspendisse at felis vitae lectus congue hendrerit. Donec dictum neque in tortor eleifend placerat. Integer volutpat eros vitae felis. Integer porta pede sed libero. Nullam velit augue, consequat vel, vestibulum quis, egestas feugiat, erat. Phasellus quis mauris. Sed tincidunt imperdiet ipsum. Morbi aliquam, augue sed viverra mollis, quam neque vehicula pede, nec luctus enim magna at sem. Curabitur pharetra ante eleifend velit. Etiam eu est.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In eu mauris! Curabitur fermentum, lectus nec aliquet vehicula, mauris quam accumsan sapien, in sollicitudin erat mi sit amet purus. Phasellus pretium neque sollicitudin tellus. Sed in est. Morbi ac sem. Quisque ornare iaculis sapien. Donec eleifend aliquet nisl. Fusce dapibus ipsum nec metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas malesuada nibh id turpis. Aliquam erat volutpat. Etiam aliquet volutpat justo. Etiam at tortor.<br /> <br /> Donec a est. Nulla vitae mi. Fusce vehicula turpis eget mauris sodales pellentesque? Donec tempor! Aliquam malesuada urna sit amet purus. Duis quis purus ut est sollicitudin semper. Maecenas erat nisi, luctus sit amet, rutrum ac, malesuada ac; arcu? Donec at lacus. Duis ac eros vitae pede adipiscing placerat? Sed id nunc. Fusce justo eros, vehicula ac; elementum non, tristique eu, ligula. Etiam non sem quis neque placerat molestie. Mauris commodo purus eget pede.<br /> <br /> Aliquam ornare orci ut nulla. Integer in mauris. Vivamus erat. Pellentesque in eros. Curabitur eleifend metus et felis. Maecenas varius ante non enim. Aenean mollis ipsum id nisi. In iaculis. Nulla quis pede? In nisi? Praesent gravida, quam eu tincidunt lacinia, pede lacus scelerisque justo; et rutrum dolor eros id lorem. Quisque blandit rutrum mi. In hac habitasse platea dictumst. Donec eleifend pede quis nisi. Nam lectus ante, dapibus eget; molestie sit amet, pulvinar vitae, diam. Quisque nec leo et sapien sodales sollicitudin. Maecenas et mauris et erat viverra adipiscing. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam varius rutrum eros.</p>', 1, '2008-07-21 12:50:41', 0, 'Happy Title', '', '', '');
INSERT INTO `content_page_data` VALUES (2, 1, '<p>Lorem ipsum <strong>dolor</strong> sit amet, consectetuer adipiscing elit. Mauris ultricies. Vivamus vel ante. Mauris ut leo. Curabitur ac risus i<a href=\\"/file/13\\">n quam iaculis e</a>uismod. Praesent at felis. Phasellus in quam. Quisque laoreet leo venenatis erat tempor adipiscing. Cras dolor. Aenean ligula turpis, viverra eget, aliquet blandit, sodales sit amet, ligula. Maecenas bibendum euismod tortor. Phasellus aliquet augue in enim. Morbi id mi. Sed lacus. Vivamus consequat.</p>\r\n<p>Nullam aliquam dolor vitae odio. Donec vulputate varius turpis. Sed mollis consectetuer erat. Nulla non quam. Duis ac lorem. Aenean eu nisi id nisl suscipit pellentesque. Aenean aliquam elit eget nulla. Nunc porttitor ultricies velit. Nam sed massa. Mauris sit amet nisl. Aenean justo eros, laoreet id, sollicitudin vel, aliquam in, tortor. Praesent ornare. Nam imperdiet luctus tortor. Donec lobortis. Ut sodales, metus eu cursus egestas, nunc lacus vulputate lorem, non lacinia elit sem bibendum nulla. Curabitur dolor urna, eleifend semper, dictum eget, pulvinar vitae, nisi. Morbi lacinia.</p>\r\n<p>Praesent pharetra, urna non egestas ultricies, tellus ligula consectetuer nisl, eu adipiscing eros ante nec enim. Mauris ut metus vitae tellus blandit malesuada. Praesent hendrerit dui. Quisque tristique magna in urna. Phasellus tellus purus, euismod sed, porttitor eget, tempor et, purus. Quisque sed orci. Etiam nec ligula sit amet risus vulputate ultrices. Fusce a orci. Sed libero nisi, iaculis nec, mattis vel, malesuada vel, arcu. Sed et ante sit amet velit ultrices pulvinar. Quisque eget magna ut ligula fringilla consectetuer. Vestibulum lectus.</p>\r\n<p>In nibh elit, tristique sed, semper vitae, eleifend sit amet, leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tortor. Fusce tortor metus, pretium sit amet, ornare imperdiet, vestibulum sit amet, erat. Nam dui. Suspendisse at felis vitae lectus congue hendrerit. Donec dictum neque in tortor eleifend placerat. Integer volutpat eros vitae felis. Integer porta pede sed libero. Nullam velit augue, consequat vel, vestibulum quis, egestas feugiat, erat. Phasellus quis mauris. Sed tincidunt imperdiet ipsum. Morbi aliquam, augue sed viverra mollis, quam neque vehicula pede, nec luctus enim magna at sem. Curabitur pharetra ante eleifend velit. Etiam eu est.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In eu mauris! Curabitur fermentum, lectus nec aliquet vehicula, mauris quam accumsan sapien, in sollicitudin erat mi sit amet purus. Phasellus pretium neque sollicitudin tellus. Sed in est. Morbi ac sem. Quisque ornare iaculis sapien. Donec eleifend aliquet nisl. Fusce dapibus ipsum nec metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas malesuada nibh id turpis. Aliquam erat volutpat. Etiam aliquet volutpat justo. Etiam at tortor.<br /> <br /> Donec a est. Nulla vitae mi. Fusce vehicula turpis eget mauris sodales pellentesque? Donec tempor! Aliquam malesuada urna sit amet purus. Duis quis purus ut est sollicitudin semper. Maecenas erat nisi, luctus sit amet, rutrum ac, malesuada ac; arcu? Donec at lacus. Duis ac eros vitae pede adipiscing placerat? Sed id nunc. Fusce justo eros, vehicula ac; elementum non, tristique eu, ligula. Etiam non sem quis neque placerat molestie. Mauris commodo purus eget pede.<br /> <br /> Aliquam ornare orci ut nulla. Integer in mauris. Vivamus erat. Pellentesque in eros. Curabitur eleifend metus et felis. Maecenas varius ante non enim. Aenean mollis ipsum id nisi. In iaculis. Nulla quis pede? In nisi? Praesent gravida, quam eu tincidunt lacinia, pede lacus scelerisque justo; et rutrum dolor eros id lorem. Quisque blandit rutrum mi. In hac habitasse platea dictumst. Donec eleifend pede quis nisi. Nam lectus ante, dapibus eget; molestie sit amet, pulvinar vitae, diam. Quisque nec leo et sapien sodales sollicitudin. Maecenas et mauris et erat viverra adipiscing. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam varius rutrum eros.</p>', 1, '2008-08-06 09:18:59', 1, 'Happy Title', '', '', '');
INSERT INTO `content_page_data` VALUES (3, 1, '<p>Lorem ipsum <strong>dolor</strong> sit amet, consectetuer adipiscing elit. Mauris ultricies. Vivamus vel ante. Mauris ut leo. Curabitur ac risus i<a href=\\"/file/13\\">n quam iaculis e</a>uismod. Praesent at felis. Phasellus in quam. Quisque laoreet leo venenatis erat tempor adipiscing. Cras dolor. Aenean ligula turpis, viverra eget, aliquet blandit, sodales sit amet, ligula. Maecenas bibendum euismod tortor. Phasellus aliquet augue in enim. Morbi id mi. Sed lacus. Vivamus consequat.</p>\r\n<p>Nullam aliquam dolor vitae odio. Donec vulputate varius turpis. Sed mollis consectetuer erat. Nulla non quam. Duis ac lorem. Aenean eu nisi id nisl suscipit pellentesque. Aenean aliquam elit eget nulla. Nunc porttitor ultricies velit. Nam sed massa. Mauris sit amet nisl. Aenean justo eros, laoreet id, sollicitudin vel, aliquam in, tortor. Praesent ornare. Nam imperdiet luctus tortor. Donec lobortis. Ut sodales, metus eu cursus egestas, nunc lacus vulputate lorem, non lacinia elit sem bibendum nulla. Curabitur dolor urna, eleifend semper, dictum eget, pulvinar vitae, nisi. Morbi lacinia.</p>\r\n<p>Praesent pharetra, urna non egestas ultricies, tellus ligula consectetuer nisl, eu adipiscing eros ante nec enim. Mauris ut metus vitae tellus blandit malesuada. Praesent hendrerit dui. Quisque tristique magna in urna. Phasellus tellus purus, euismod sed, porttitor eget, tempor et, purus. Quisque sed orci. Etiam nec ligula sit amet risus vulputate ultrices. Fusce a orci. Sed libero nisi, iaculis nec, mattis vel, malesuada vel, arcu. Sed et ante sit amet velit ultrices pulvinar. Quisque eget magna ut ligula fringilla consectetuer. Vestibulum lectus.</p>\r\n<p>In nibh elit, tristique sed, semper vitae, eleifend sit amet, leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec tortor. Fusce tortor metus, pretium sit amet, ornare imperdiet, vestibulum sit amet, erat. Nam dui. Suspendisse at felis vitae lectus congue hendrerit. Donec dictum neque in tortor eleifend placerat. Integer volutpat eros vitae felis. Integer porta pede sed libero. Nullam velit augue, consequat vel, vestibulum quis, egestas feugiat, erat. Phasellus quis mauris. Sed tincidunt imperdiet ipsum. Morbi aliquam, augue sed viverra mollis, quam neque vehicula pede, nec luctus enim magna at sem. Curabitur pharetra ante eleifend velit. Etiam eu est.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In eu mauris! Curabitur fermentum, lectus nec aliquet vehicula, mauris quam accumsan sapien, in sollicitudin erat mi sit amet purus. Phasellus pretium neque sollicitudin tellus. Sed in est. Morbi ac sem. Quisque ornare iaculis sapien. Donec eleifend aliquet nisl. Fusce dapibus ipsum nec metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas malesuada nibh id turpis. Aliquam erat volutpat. Etiam aliquet volutpat justo. Etiam at tortor.<br /> <br /> Donec a est. Nulla vitae mi. Fusce vehicula turpis eget mauris sodales pellentesque? Donec tempor! Aliquam malesuada urna sit amet purus. Duis quis purus ut est sollicitudin semper. Maecenas erat nisi, luctus sit amet, rutrum ac, malesuada ac; arcu? Donec at lacus. Duis ac eros vitae pede adipiscing placerat? Sed id nunc. Fusce justo eros, vehicula ac; elementum non, tristique eu, ligula. Etiam non sem quis neque placerat molestie. Mauris commodo purus eget pede.<br /> <br /> Aliquam ornare orci ut nulla. Integer in mauris. Vivamus erat. Pellentesque in eros. Curabitur eleifend metus et felis. Maecenas varius ante non enim. Aenean mollis ipsum id nisi. In iaculis. Nulla quis pede? In nisi? Praesent gravida, quam eu tincidunt lacinia, pede lacus scelerisque justo; et rutrum dolor eros id lorem. Quisque blandit rutrum mi. In hac habitasse platea dictumst. Donec eleifend pede quis nisi. Nam lectus ante, dapibus eget; molestie sit amet, pulvinar vitae, diam. Quisque nec leo et sapien sodales sollicitudin. Maecenas et mauris et erat viverra adipiscing. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam varius rutrum eros.</p>', 1, '2008-08-06 10:09:33', 0, 'Happy Title', '', '', '');
INSERT INTO `content_page_data` VALUES (4, 2, '<p>dfsgrfhfghfdgh</p>', 1, '2008-08-19 12:26:15', 1, 'dfsgfdsg', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `content_templates`
-- 

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

-- --------------------------------------------------------

-- 
-- Table structure for table `countries`
-- 

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL default '0',
  `codetwo` char(2) NOT NULL default '',
  `codethree` char(3) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  `currency` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `countries`
-- 

INSERT INTO `countries` VALUES (1, 'AF', 'AFG', 'Afghanistan', 'AFN');
INSERT INTO `countries` VALUES (2, 'AL', 'ALB', 'Albania', 'ALL');
INSERT INTO `countries` VALUES (3, 'DZ', 'DZA', 'Algeria', 'DZD');
INSERT INTO `countries` VALUES (4, 'AD', 'AND', 'Andorra', 'EUR');
INSERT INTO `countries` VALUES (5, 'AO', 'AGO', 'Angola', 'AOA');
INSERT INTO `countries` VALUES (6, 'AG', 'ATG', 'Antigua and Barbuda', 'XCD');
INSERT INTO `countries` VALUES (7, 'AR', 'ARG', 'Argentina', 'ARS');
INSERT INTO `countries` VALUES (8, 'AM', 'ARM', 'Armenia', 'AMD');
INSERT INTO `countries` VALUES (9, 'AU', 'AUS', 'Australia', 'AUD');
INSERT INTO `countries` VALUES (10, 'AT', 'AUT', 'Austria', 'EUR');
INSERT INTO `countries` VALUES (11, 'AZ', 'AZE', 'Azerbaijan', 'AZM');
INSERT INTO `countries` VALUES (12, 'BS', 'BHS', 'Bahamas, The', 'BSD');
INSERT INTO `countries` VALUES (13, 'BH', 'BHR', 'Bahrain', 'BHD');
INSERT INTO `countries` VALUES (14, 'BD', 'BGD', 'Bangladesh', 'BDT');
INSERT INTO `countries` VALUES (15, 'BB', 'BRB', 'Barbados', 'BBD');
INSERT INTO `countries` VALUES (16, 'BY', 'BLR', 'Belarus', 'BYR');
INSERT INTO `countries` VALUES (17, 'BE', 'BEL', 'Belgium', 'EUR');
INSERT INTO `countries` VALUES (18, 'BZ', 'BLZ', 'Belize', 'BZD');
INSERT INTO `countries` VALUES (19, 'BJ', 'BEN', 'Benin', 'XOF');
INSERT INTO `countries` VALUES (20, 'BT', 'BTN', 'Bhutan', 'BTN');
INSERT INTO `countries` VALUES (21, 'BO', 'BOL', 'Bolivia', 'BOB');
INSERT INTO `countries` VALUES (22, 'BA', 'BIH', 'Bosnia and Herzegovina', 'BAM');
INSERT INTO `countries` VALUES (23, 'BW', 'BWA', 'Botswana', 'BWP');
INSERT INTO `countries` VALUES (24, 'BR', 'BRA', 'Brazil', 'BRL');
INSERT INTO `countries` VALUES (25, 'BN', 'BRN', 'Brunei', 'BND');
INSERT INTO `countries` VALUES (26, 'BG', 'BGR', 'Bulgaria', 'BGN');
INSERT INTO `countries` VALUES (27, 'BF', 'BFA', 'Burkina Faso', 'XOF');
INSERT INTO `countries` VALUES (28, 'BI', 'BDI', 'Burundi', 'BIF');
INSERT INTO `countries` VALUES (29, 'KH', 'KHM', 'Cambodia', 'KHR');
INSERT INTO `countries` VALUES (30, 'CM', 'CMR', 'Cameroon', 'XAF');
INSERT INTO `countries` VALUES (31, 'CA', 'CAN', 'Canada', 'CAD');
INSERT INTO `countries` VALUES (32, 'CV', 'CPV', 'Cape Verde', 'CVE');
INSERT INTO `countries` VALUES (33, 'CF', 'CAF', 'Central African Republic', 'XAF');
INSERT INTO `countries` VALUES (34, 'TD', 'TCD', 'Chad', 'XAF');
INSERT INTO `countries` VALUES (35, 'CL', 'CHL', 'Chile', 'CLP');
INSERT INTO `countries` VALUES (36, 'CN', 'CHN', 'China, People''s Republic of', 'CNY');
INSERT INTO `countries` VALUES (37, 'CO', 'COL', 'Colombia', 'COP');
INSERT INTO `countries` VALUES (38, 'KM', 'COM', 'Comoros', 'KMF');
INSERT INTO `countries` VALUES (39, 'CD', 'COD', 'Congo, Democratic Republic of the (Congo / Kinshasa)', 'CDF');
INSERT INTO `countries` VALUES (40, 'CG', 'COG', 'Congo, Republic of the (Congo / Brazzaville)', 'XAF');
INSERT INTO `countries` VALUES (41, 'CR', 'CRI', 'Costa Rica', 'CRC');
INSERT INTO `countries` VALUES (42, 'CI', 'CIV', 'Cote d''Ivoire (Ivory Coast)', 'XOF');
INSERT INTO `countries` VALUES (43, 'HR', 'HRV', 'Croatia', 'HRK');
INSERT INTO `countries` VALUES (44, 'CU', 'CUB', 'Cuba', 'CUP');
INSERT INTO `countries` VALUES (45, 'CY', 'CYP', 'Cyprus', 'CYP');
INSERT INTO `countries` VALUES (46, 'CZ', 'CZE', 'Czech Republic', 'CZK');
INSERT INTO `countries` VALUES (47, 'DK', 'DNK', 'Denmark', 'DKK');
INSERT INTO `countries` VALUES (48, 'DJ', 'DJI', 'Djibouti', 'DJF');
INSERT INTO `countries` VALUES (49, 'DM', 'DMA', 'Dominica', 'XCD');
INSERT INTO `countries` VALUES (50, 'DO', 'DOM', 'Dominican Republic', 'DOP');
INSERT INTO `countries` VALUES (51, 'EC', 'ECU', 'Ecuador', 'USD');
INSERT INTO `countries` VALUES (52, 'EG', 'EGY', 'Egypt', 'EGP');
INSERT INTO `countries` VALUES (53, 'SV', 'SLV', 'El Salvador', 'USD');
INSERT INTO `countries` VALUES (54, 'GQ', 'GNQ', 'Equatorial Guinea', 'XAF');
INSERT INTO `countries` VALUES (55, 'ER', 'ERI', 'Eritrea', 'ERN');
INSERT INTO `countries` VALUES (56, 'EE', 'EST', 'Estonia', 'EEK');
INSERT INTO `countries` VALUES (57, 'ET', 'ETH', 'Ethiopia', 'ETB');
INSERT INTO `countries` VALUES (58, 'FJ', 'FJI', 'Fiji', 'FJD');
INSERT INTO `countries` VALUES (59, 'FI', 'FIN', 'Finland', 'EUR');
INSERT INTO `countries` VALUES (60, 'FR', 'FRA', 'France', 'EUR');
INSERT INTO `countries` VALUES (61, 'GA', 'GAB', 'Gabon', 'XAF');
INSERT INTO `countries` VALUES (62, 'GM', 'GMB', 'Gambia, The', 'GMD');
INSERT INTO `countries` VALUES (63, 'GE', 'GEO', 'Georgia', 'GEL');
INSERT INTO `countries` VALUES (64, 'DE', 'DEU', 'Germany', 'EUR');
INSERT INTO `countries` VALUES (65, 'GH', 'GHA', 'Ghana', 'GHC');
INSERT INTO `countries` VALUES (66, 'GR', 'GRC', 'Greece', 'EUR');
INSERT INTO `countries` VALUES (67, 'GD', 'GRD', 'Grenada', 'XCD');
INSERT INTO `countries` VALUES (68, 'GT', 'GTM', 'Guatemala', 'GTQ');
INSERT INTO `countries` VALUES (69, 'GN', 'GIN', 'Guinea', 'GNF');
INSERT INTO `countries` VALUES (70, 'GW', 'GNB', 'Guinea-Bissau', 'XOF');
INSERT INTO `countries` VALUES (71, 'GY', 'GUY', 'Guyana', 'GYD');
INSERT INTO `countries` VALUES (72, 'HT', 'HTI', 'Haiti', 'HTG');
INSERT INTO `countries` VALUES (73, 'HN', 'HND', 'Honduras', 'HNL');
INSERT INTO `countries` VALUES (74, 'HU', 'HUN', 'Hungary', 'HUF');
INSERT INTO `countries` VALUES (75, 'IS', 'ISL', 'Iceland', 'ISK');
INSERT INTO `countries` VALUES (76, 'IN', 'IND', 'India', 'INR');
INSERT INTO `countries` VALUES (77, 'ID', 'IDN', 'Indonesia', 'IDR');
INSERT INTO `countries` VALUES (78, 'IR', 'IRN', 'Iran', 'IRR');
INSERT INTO `countries` VALUES (79, 'IQ', 'IRQ', 'Iraq', 'IQD');
INSERT INTO `countries` VALUES (80, 'IE', 'IRL', 'Ireland', 'EUR');
INSERT INTO `countries` VALUES (81, 'IL', 'ISR', 'Israel', 'ILS');
INSERT INTO `countries` VALUES (82, 'IT', 'ITA', 'Italy', 'EUR');
INSERT INTO `countries` VALUES (83, 'JM', 'JAM', 'Jamaica', 'JMD');
INSERT INTO `countries` VALUES (84, 'JP', 'JPN', 'Japan', 'JPY');
INSERT INTO `countries` VALUES (85, 'JO', 'JOR', 'Jordan', 'JOD');
INSERT INTO `countries` VALUES (86, 'KZ', 'KAZ', 'Kazakhstan', 'KZT');
INSERT INTO `countries` VALUES (87, 'KE', 'KEN', 'Kenya', 'KES');
INSERT INTO `countries` VALUES (88, 'KI', 'KIR', 'Kiribati', 'AUD');
INSERT INTO `countries` VALUES (89, 'KP', 'PRK', 'Korea, Democratic People''s Republic of (North Korea)', 'KPW');
INSERT INTO `countries` VALUES (90, 'KR', 'KOR', 'Korea, Republic of  (South Korea)', 'KRW');
INSERT INTO `countries` VALUES (91, 'KW', 'KWT', 'Kuwait', 'KWD');
INSERT INTO `countries` VALUES (92, 'KG', 'KGZ', 'Kyrgyzstan', 'KGS');
INSERT INTO `countries` VALUES (93, 'LA', 'LAO', 'Laos', 'LAK');
INSERT INTO `countries` VALUES (94, 'LV', 'LVA', 'Latvia', 'LVL');
INSERT INTO `countries` VALUES (95, 'LB', 'LBN', 'Lebanon', 'LBP');
INSERT INTO `countries` VALUES (96, 'LS', 'LSO', 'Lesotho', 'LSL');
INSERT INTO `countries` VALUES (97, 'LR', 'LBR', 'Liberia', 'LRD');
INSERT INTO `countries` VALUES (98, 'LY', 'LBY', 'Libya', 'LYD');
INSERT INTO `countries` VALUES (99, 'LI', 'LIE', 'Liechtenstein', 'CHF');
INSERT INTO `countries` VALUES (100, 'LT', 'LTU', 'Lithuania', 'LTL');
INSERT INTO `countries` VALUES (101, 'LU', 'LUX', 'Luxembourg', 'EUR');
INSERT INTO `countries` VALUES (102, 'MK', 'MKD', 'Macedonia', 'MKD');
INSERT INTO `countries` VALUES (103, 'MG', 'MDG', 'Madagascar', 'MGA');
INSERT INTO `countries` VALUES (104, 'MW', 'MWI', 'Malawi', 'MWK');
INSERT INTO `countries` VALUES (105, 'MY', 'MYS', 'Malaysia', 'MYR');
INSERT INTO `countries` VALUES (106, 'MV', 'MDV', 'Maldives', 'MVR');
INSERT INTO `countries` VALUES (107, 'ML', 'MLI', 'Mali', 'XOF');
INSERT INTO `countries` VALUES (108, 'MT', 'MLT', 'Malta', 'MTL');
INSERT INTO `countries` VALUES (109, 'MH', 'MHL', 'Marshall Islands', 'USD');
INSERT INTO `countries` VALUES (110, 'MR', 'MRT', 'Mauritania', 'MRO');
INSERT INTO `countries` VALUES (111, 'MU', 'MUS', 'Mauritius', 'MUR');
INSERT INTO `countries` VALUES (112, 'MX', 'MEX', 'Mexico', 'MXN');
INSERT INTO `countries` VALUES (113, 'FM', 'FSM', 'Micronesia', 'USD');
INSERT INTO `countries` VALUES (114, 'MD', 'MDA', 'Moldova', 'MDL');
INSERT INTO `countries` VALUES (115, 'MC', 'MCO', 'Monaco', 'EUR');
INSERT INTO `countries` VALUES (116, 'MN', 'MNG', 'Mongolia', 'MNT');
INSERT INTO `countries` VALUES (117, 'CS', 'SCG', 'Montenegro', 'EUR');
INSERT INTO `countries` VALUES (118, 'MA', 'MAR', 'Morocco', 'MAD');
INSERT INTO `countries` VALUES (119, 'MZ', 'MOZ', 'Mozambique', 'MZM');
INSERT INTO `countries` VALUES (120, 'MM', 'MMR', 'Myanmar (Burma)', 'MMK');
INSERT INTO `countries` VALUES (121, 'NA', 'NAM', 'Namibia', 'NAD');
INSERT INTO `countries` VALUES (122, 'NR', 'NRU', 'Nauru', 'AUD');
INSERT INTO `countries` VALUES (123, 'NP', 'NPL', 'Nepal', 'NPR');
INSERT INTO `countries` VALUES (124, 'NL', 'NLD', 'Netherlands', 'EUR');
INSERT INTO `countries` VALUES (125, 'NZ', 'NZL', 'New Zealand', 'NZD');
INSERT INTO `countries` VALUES (126, 'NI', 'NIC', 'Nicaragua', 'NIO');
INSERT INTO `countries` VALUES (127, 'NE', 'NER', 'Niger', 'XOF');
INSERT INTO `countries` VALUES (128, 'NG', 'NGA', 'Nigeria', 'NGN');
INSERT INTO `countries` VALUES (129, 'NO', 'NOR', 'Norway', 'NOK');
INSERT INTO `countries` VALUES (130, 'OM', 'OMN', 'Oman', 'OMR');
INSERT INTO `countries` VALUES (131, 'PK', 'PAK', 'Pakistan', 'PKR');
INSERT INTO `countries` VALUES (132, 'PW', 'PLW', 'Palau', 'USD');
INSERT INTO `countries` VALUES (133, 'PA', 'PAN', 'Panama', 'PAB');
INSERT INTO `countries` VALUES (134, 'PG', 'PNG', 'Papua New Guinea', 'PGK');
INSERT INTO `countries` VALUES (135, 'PY', 'PRY', 'Paraguay', 'PYG');
INSERT INTO `countries` VALUES (136, 'PE', 'PER', 'Peru', 'PEN');
INSERT INTO `countries` VALUES (137, 'PH', 'PHL', 'Philippines', 'PHP');
INSERT INTO `countries` VALUES (138, 'PL', 'POL', 'Poland', 'PLN');
INSERT INTO `countries` VALUES (139, 'PT', 'PRT', 'Portugal', 'EUR');
INSERT INTO `countries` VALUES (140, 'QA', 'QAT', 'Qatar', 'QAR');
INSERT INTO `countries` VALUES (141, 'RO', 'ROU', 'Romania', 'RON');
INSERT INTO `countries` VALUES (142, 'RU', 'RUS', 'Russia', 'RUB');
INSERT INTO `countries` VALUES (143, 'RW', 'RWA', 'Rwanda', 'RWF');
INSERT INTO `countries` VALUES (144, 'KN', 'KNA', 'Saint Kitts and Nevis', 'XCD');
INSERT INTO `countries` VALUES (145, 'LC', 'LCA', 'Saint Lucia', 'XCD');
INSERT INTO `countries` VALUES (146, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'XCD');
INSERT INTO `countries` VALUES (147, 'WS', 'WSM', 'Samoa', 'WST');
INSERT INTO `countries` VALUES (148, 'SM', 'SMR', 'San Marino', 'EUR');
INSERT INTO `countries` VALUES (149, 'ST', 'STP', 'Sao Tome and Principe', 'STD');
INSERT INTO `countries` VALUES (150, 'SA', 'SAU', 'Saudi Arabia', 'SAR');
INSERT INTO `countries` VALUES (151, 'SN', 'SEN', 'Senegal', 'XOF');
INSERT INTO `countries` VALUES (153, 'SC', 'SYC', 'Seychelles', 'SCR');
INSERT INTO `countries` VALUES (154, 'SL', 'SLE', 'Sierra Leone', 'SLL');
INSERT INTO `countries` VALUES (155, 'SG', 'SGP', 'Singapore', 'SGD');
INSERT INTO `countries` VALUES (156, 'SK', 'SVK', 'Slovakia', 'SKK');
INSERT INTO `countries` VALUES (157, 'SI', 'SVN', 'Slovenia', 'SIT');
INSERT INTO `countries` VALUES (158, 'SB', 'SLB', 'Solomon Islands', 'SBD');
INSERT INTO `countries` VALUES (159, 'SO', 'SOM', 'Somalia', 'SOS');
INSERT INTO `countries` VALUES (160, 'ZA', 'ZAF', 'South Africa', 'ZAR');
INSERT INTO `countries` VALUES (161, 'ES', 'ESP', 'Spain', 'EUR');
INSERT INTO `countries` VALUES (162, 'LK', 'LKA', 'Sri Lanka', 'LKR');
INSERT INTO `countries` VALUES (163, 'SD', 'SDN', 'Sudan', 'SDD');
INSERT INTO `countries` VALUES (164, 'SR', 'SUR', 'Suriname', 'SRD');
INSERT INTO `countries` VALUES (165, 'SZ', 'SWZ', 'Swaziland', 'SZL');
INSERT INTO `countries` VALUES (166, 'SE', 'SWE', 'Sweden', 'SEK');
INSERT INTO `countries` VALUES (167, 'CH', 'CHE', 'Switzerland', 'CHF');
INSERT INTO `countries` VALUES (168, 'SY', 'SYR', 'Syria', 'SYP');
INSERT INTO `countries` VALUES (169, 'TJ', 'TJK', 'Tajikistan', 'TJS');
INSERT INTO `countries` VALUES (170, 'TZ', 'TZA', 'Tanzania', 'TZS');
INSERT INTO `countries` VALUES (171, 'TH', 'THA', 'Thailand', 'THB');
INSERT INTO `countries` VALUES (172, 'TL', 'TLS', 'Timor-Leste (East Timor)', 'USD');
INSERT INTO `countries` VALUES (173, 'TG', 'TGO', 'Togo', 'XOF');
INSERT INTO `countries` VALUES (174, 'TO', 'TON', 'Tonga', 'TOP');
INSERT INTO `countries` VALUES (175, 'TT', 'TTO', 'Trinidad and Tobago', 'TTD');
INSERT INTO `countries` VALUES (176, 'TN', 'TUN', 'Tunisia', 'TND');
INSERT INTO `countries` VALUES (177, 'TR', 'TUR', 'Turkey', 'TRY');
INSERT INTO `countries` VALUES (178, 'TM', 'TKM', 'Turkmenistan', 'TMM');
INSERT INTO `countries` VALUES (179, 'TV', 'TUV', 'Tuvalu', 'AUD');
INSERT INTO `countries` VALUES (180, 'UG', 'UGA', 'Uganda', 'UGX');
INSERT INTO `countries` VALUES (181, 'UA', 'UKR', 'Ukraine', 'UAH');
INSERT INTO `countries` VALUES (182, 'AE', 'ARE', 'United Arab Emirates', 'AED');
INSERT INTO `countries` VALUES (183, 'GB', 'GBR', 'United Kingdom', 'GBP');
INSERT INTO `countries` VALUES (184, 'US', 'USA', 'United States', 'USD');
INSERT INTO `countries` VALUES (185, 'UY', 'URY', 'Uruguay', 'UYU');
INSERT INTO `countries` VALUES (186, 'UZ', 'UZB', 'Uzbekistan', 'UZS');
INSERT INTO `countries` VALUES (187, 'VU', 'VUT', 'Vanuatu', 'VUV');
INSERT INTO `countries` VALUES (188, 'VA', 'VAT', 'Vatican City', 'EUR');
INSERT INTO `countries` VALUES (189, 'VE', 'VEN', 'Venezuela', 'VEB');
INSERT INTO `countries` VALUES (190, 'VN', 'VNM', 'Viet Nam', 'VND');
INSERT INTO `countries` VALUES (191, 'YE', 'YEM', 'Yemen', 'YER');
INSERT INTO `countries` VALUES (192, 'ZM', 'ZMB', 'Zambia', 'ZMK');
INSERT INTO `countries` VALUES (193, 'ZW', 'ZWE', 'Zimbabwe', 'ZWD');
INSERT INTO `countries` VALUES (195, 'TW', 'TWN', 'China, Republic of (Taiwan)', 'TWD');
INSERT INTO `countries` VALUES (202, 'CX', 'CXR', 'Christmas Island', 'AUD');
INSERT INTO `countries` VALUES (203, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'AUD');
INSERT INTO `countries` VALUES (205, 'HM', 'HMD', 'Heard Island and McDonald Islands', '');
INSERT INTO `countries` VALUES (206, 'NF', 'NFK', 'Norfolk Island', 'AUD');
INSERT INTO `countries` VALUES (207, 'NC', 'NCL', 'New Caledonia', 'XPF');
INSERT INTO `countries` VALUES (208, 'PF', 'PYF', 'French Polynesia', 'XPF');
INSERT INTO `countries` VALUES (209, 'YT', 'MYT', 'Mayotte', 'EUR');
INSERT INTO `countries` VALUES (210, 'PM', 'SPM', 'Saint Pierre and Miquelon', 'EUR');
INSERT INTO `countries` VALUES (211, 'WF', 'WLF', 'Wallis and Futuna', 'XPF');
INSERT INTO `countries` VALUES (212, 'TF', 'ATF', 'French Southern and Antarctic Lands', '');
INSERT INTO `countries` VALUES (214, 'BV', 'BVT', 'Bouvet Island', '');
INSERT INTO `countries` VALUES (215, 'CK', 'COK', 'Cook Islands', 'NZD');
INSERT INTO `countries` VALUES (216, 'NU', 'NIU', 'Niue', 'NZD');
INSERT INTO `countries` VALUES (217, 'TK', 'TKL', 'Tokelau', 'NZD');
INSERT INTO `countries` VALUES (218, 'GG', 'GGY', 'Guernsey', 'GGP');
INSERT INTO `countries` VALUES (219, 'IM', 'IMN', 'Isle of Man', 'IMP');
INSERT INTO `countries` VALUES (220, 'JE', 'JEY', 'Jersey', 'JEP');
INSERT INTO `countries` VALUES (221, 'AI', 'AIA', 'Anguilla', 'XCD');
INSERT INTO `countries` VALUES (222, 'BM', 'BMU', 'Bermuda', 'BMD');
INSERT INTO `countries` VALUES (223, 'IO', 'IOT', 'British Indian Ocean Territory', '');
INSERT INTO `countries` VALUES (224, 'VG', 'VGB', 'British Virgin Islands', 'USD');
INSERT INTO `countries` VALUES (225, 'KY', 'CYM', 'Cayman Islands', 'KYD');
INSERT INTO `countries` VALUES (226, 'FK', 'FLK', 'Falkland Islands (Islas Malvinas)', 'FKP');
INSERT INTO `countries` VALUES (227, 'GI', 'GIB', 'Gibraltar', 'GIP');
INSERT INTO `countries` VALUES (228, 'MS', 'MSR', 'Montserrat', 'XCD');
INSERT INTO `countries` VALUES (229, 'PN', 'PCN', 'Pitcairn Islands', 'NZD');
INSERT INTO `countries` VALUES (230, 'SH', 'SHN', 'Saint Helena', 'SHP');
INSERT INTO `countries` VALUES (231, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', '');
INSERT INTO `countries` VALUES (232, 'TC', 'TCA', 'Turks and Caicos Islands', 'USD');
INSERT INTO `countries` VALUES (233, 'MP', 'MNP', 'Northern Mariana Islands', 'USD');
INSERT INTO `countries` VALUES (234, 'PR', 'PRI', 'Puerto Rico', 'USD');
INSERT INTO `countries` VALUES (235, 'AS', 'ASM', 'American Samoa', 'USD');
INSERT INTO `countries` VALUES (236, 'UM', 'UMI', 'Baker Island', '');
INSERT INTO `countries` VALUES (237, 'GU', 'GUM', 'Guam', 'USD');
INSERT INTO `countries` VALUES (245, 'VI', 'VIR', 'U.S. Virgin Islands', 'USD');
INSERT INTO `countries` VALUES (247, 'HK', 'HKG', 'Hong Kong', 'HKD');
INSERT INTO `countries` VALUES (248, 'MO', 'MAC', 'Macau', 'MOP');
INSERT INTO `countries` VALUES (249, 'FO', 'FRO', 'Faroe Islands', 'DKK');
INSERT INTO `countries` VALUES (250, 'GL', 'GRL', 'Greenland', 'DKK');
INSERT INTO `countries` VALUES (251, 'GF', 'GUF', 'French Guiana', 'EUR');
INSERT INTO `countries` VALUES (252, 'GP', 'GLP', 'Guadeloupe', 'EUR');
INSERT INTO `countries` VALUES (253, 'MQ', 'MTQ', 'Martinique', 'EUR');
INSERT INTO `countries` VALUES (254, 'RE', 'REU', 'Reunion', 'EUR');
INSERT INTO `countries` VALUES (255, 'AX', 'ALA', 'Aland', 'EUR');
INSERT INTO `countries` VALUES (256, 'AW', 'ABW', 'Aruba', 'AWG');
INSERT INTO `countries` VALUES (257, 'AN', 'ANT', 'Netherlands Antilles', 'ANG');
INSERT INTO `countries` VALUES (258, 'SJ', 'SJM', 'Svalbard', 'NOK');
INSERT INTO `countries` VALUES (259, 'AC', 'ASC', 'Ascension', 'SHP');
INSERT INTO `countries` VALUES (260, 'TA', 'TAA', 'Tristan da Cunha', 'SHP');
INSERT INTO `countries` VALUES (261, 'AQ', 'ATA', 'Antarctica', '');
INSERT INTO `countries` VALUES (263, 'PS', 'PSE', 'Palestinian Territories (Gaza Strip and West Bank)', 'ILS');
INSERT INTO `countries` VALUES (264, 'EH', 'ESH', 'Western Sahara', 'MAD');

-- --------------------------------------------------------

-- 
-- Table structure for table `datastorage`
-- 

CREATE TABLE `datastorage` (
  `id` int(11) NOT NULL auto_increment,
  `data` longblob NOT NULL,
  `content_type` varchar(128) NOT NULL,
  `filename` varchar(128) NOT NULL,
  `filesize` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `datastorage`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `datastorage_search`
-- 

CREATE TABLE `datastorage_search` (
  `id` int(11) NOT NULL auto_increment,
  `file_id` int(11) NOT NULL,
  `tags` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- 
-- Dumping data for table `datastorage_search`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `groups_permissions`
-- 

CREATE TABLE `groups_permissions` (
  `group_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  UNIQUE KEY `group_id_2` (`group_id`,`perm_id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `groups_permissions`
-- 

INSERT INTO `groups_permissions` VALUES (1, 1);
INSERT INTO `groups_permissions` VALUES (1, 2);
INSERT INTO `groups_permissions` VALUES (1, 3);
INSERT INTO `groups_permissions` VALUES (1, 4);
INSERT INTO `groups_permissions` VALUES (1, 5);
INSERT INTO `groups_permissions` VALUES (1, 6);
INSERT INTO `groups_permissions` VALUES (1, 7);
INSERT INTO `groups_permissions` VALUES (1, 8);
INSERT INTO `groups_permissions` VALUES (4, 10);
INSERT INTO `groups_permissions` VALUES (4, 11);
INSERT INTO `groups_permissions` VALUES (4, 12);
INSERT INTO `groups_permissions` VALUES (4, 13);

-- --------------------------------------------------------

-- 
-- Table structure for table `help`
-- 

CREATE TABLE `help` (
  `helpid` varchar(32) NOT NULL,
  `title` tinytext,
  `body` text,
  PRIMARY KEY  (`helpid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `help`
-- 

INSERT INTO `help` VALUES ('addmenuitem', 'Add Menu Item', '"Add Menu Item" will guide you through the process of adding links to your site''s menu structure');

-- --------------------------------------------------------

-- 
-- Table structure for table `images`
-- 

CREATE TABLE `images` (
  `id` int(11) NOT NULL auto_increment,
  `data` mediumblob NOT NULL,
  `content_type` varchar(32) NOT NULL,
  `filename` varchar(64) NOT NULL,
  `filesize` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `images`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `images_cache`
-- 

CREATE TABLE `images_cache` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `image_id` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `data` blob NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `hash_2` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- 
-- Dumping data for table `images_cache`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `locale`
-- 

CREATE TABLE `locale` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(16) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- 
-- Dumping data for table `locale`
-- 

INSERT INTO `locale` VALUES (1, 'en_CA', 'English (Canada)');
INSERT INTO `locale` VALUES (2, 'fr_CA', 'Fran&ccedil;ais (Canada)');
INSERT INTO `locale` VALUES (3, 'ja_JP', 'Japanese (&#x65e5;&#x672c;&#x8a9e;)');
INSERT INTO `locale` VALUES (4, 'ar_OM', 'Arabic (Oman)\r\n(&#x0627;&#x0644;&#x0639;&#x0631;&#x0628;&#x064a;&#x0629;)');
INSERT INTO `locale` VALUES (5, 'el_GR', 'Greek\r\n(&#x0395;&#x03bb;&#x03bb;&#x03b7;&#x03bd;&#x03b9;&#x03ba;&#x03ac;)');
INSERT INTO `locale` VALUES (6, 'ar_SY', 'Arabic (Syria)\r\n(&#x0627;&#x0644;&#x0639;&#x0631;&#x0628;&#x064a;&#x0629;)');
INSERT INTO `locale` VALUES (7, 'id_ID', 'Bahasa Indonesia');
INSERT INTO `locale` VALUES (8, 'bs_BA', 'Bosanski');
INSERT INTO `locale` VALUES (9, 'bg_BG', 'Bulgarian\r\n(&#x0411;&#x044a;&#x043b;&#x0433;&#x0430;&#x0440;&#x0441;&#x043a;&#x0438;)');
INSERT INTO `locale` VALUES (10, 'ca_ES', 'Catal&agrave;');
INSERT INTO `locale` VALUES (11, 'zh_CN', 'Chinese (Simplified)\r\n(&#x7b80;&#x4f53;&#x4e2d;&#x6587;)');
INSERT INTO `locale` VALUES (12, 'zh_TW', 'Chinese (Traditional)\r\n(&#x6b63;&#x9ad4;&#x4e2d;&#x6587;)');
INSERT INTO `locale` VALUES (13, 'cs_CZ', 'Czech (&#x010c;esky)');
INSERT INTO `locale` VALUES (14, 'da_DK', 'Dansk');
INSERT INTO `locale` VALUES (15, 'de_DE', 'Deutsch');
INSERT INTO `locale` VALUES (16, 'en_US', 'English (American)');
INSERT INTO `locale` VALUES (17, 'en_GB', 'English (British)');
INSERT INTO `locale` VALUES (18, 'es_ES', 'Espa&ntilde;ol');
INSERT INTO `locale` VALUES (19, 'et_EE', 'Eesti');
INSERT INTO `locale` VALUES (20, 'gl_ES', 'Galego');
INSERT INTO `locale` VALUES (21, 'he_IL', 'Hebrew (&#x05E2;&#x05D1;&#x05E8;&#x05D9;&#x05EA;)');
INSERT INTO `locale` VALUES (22, 'is_IS', '&Iacute;slenska');
INSERT INTO `locale` VALUES (23, 'it_IT', 'Italiano');
INSERT INTO `locale` VALUES (24, 'km_KH', 'Khmer (&#x1781;&#x17d2;&#x1798;&#x17c2;&#x179a;)');
INSERT INTO `locale` VALUES (25, 'ko_KR', 'Korean (&#xd55c;&#xad6d;&#xc5b4;)');
INSERT INTO `locale` VALUES (26, 'lv_LV', 'Latvie&#x0161;u');
INSERT INTO `locale` VALUES (27, 'lt_LT', 'Lietuvi&#x0173;');
INSERT INTO `locale` VALUES (28, 'mk_MK', 'Macedonian\r\n(&#x041c;&#x0430;&#x043a;&#x0435;&#x0434;&#x043e;&#x043d;&#x0441;&#x043a;&#x0438;)');
INSERT INTO `locale` VALUES (29, 'hu_HU', 'Magyar');
INSERT INTO `locale` VALUES (30, 'nl_NL', 'Nederlands');
INSERT INTO `locale` VALUES (31, 'nb_NO', 'Norsk bokm&aring;l');
INSERT INTO `locale` VALUES (32, 'nn_NO', 'Norsk nynorsk');
INSERT INTO `locale` VALUES (33, 'fa_IR', 'Persian (&#x0641;&#x0627;&#x0631;&#x0633;&#x0649;)');
INSERT INTO `locale` VALUES (34, 'pl_PL', 'Polski');
INSERT INTO `locale` VALUES (35, 'pt_PT', 'Portugu&ecirc;s');
INSERT INTO `locale` VALUES (36, 'pt_BR', 'Portugu&ecirc;s Brasileiro');
INSERT INTO `locale` VALUES (37, 'ro_RO', 'Rom&acirc;n&auml;');
INSERT INTO `locale` VALUES (38, 'ru_RU', 'Russian\r\n(&#x0420;&#x0443;&#x0441;&#x0441;&#x043a;&#x0438;&#x0439;)');
INSERT INTO `locale` VALUES (39, 'sk_SK', 'Slovak (Sloven&#x010d;ina)');
INSERT INTO `locale` VALUES (40, 'sl_SI', 'Slovenian (Sloven&#x0161;&#x010d;ina)');
INSERT INTO `locale` VALUES (41, 'fi_FI', 'Suomi');
INSERT INTO `locale` VALUES (42, 'sv_SE', 'Svenska');
INSERT INTO `locale` VALUES (43, 'th_TH', 'Thai (&#x0e44;&#x0e17;&#x0e22;)');
INSERT INTO `locale` VALUES (44, 'tr_TR', 'T&uuml;rk&ccedil;e');
INSERT INTO `locale` VALUES (45, 'uk_UA', 'Ukrainian\r\n(&#x0423;&#x043a;&#x0440;&#x0430;&#x0457;&#x043d;&#x0441;&#x044c;&#x043a;&#x0430;)');

-- --------------------------------------------------------

-- 
-- Table structure for table `menu`
-- 

CREATE TABLE `menu` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `display` tinytext NOT NULL,
  `link` mediumtext NOT NULL,
  `module_id` int(11) NOT NULL,
  `target` enum('same','new') NOT NULL,
  `status` enum('active','disabled') NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `menu`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `menu_loaded`
-- 

CREATE TABLE `menu_loaded` (
  `id` int(11) NOT NULL auto_increment,
  `menu` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `menu_loaded`
-- 

INSERT INTO `menu_loaded` VALUES (1, ' <div id="nav">\r\n	<ul id="navUl">\r\n						<li><a href="/Content/Home">fgdhfdgh</a></li>\r\n			</ul>\r\n</div>\r');

-- --------------------------------------------------------

-- 
-- Table structure for table `modules`
-- 

CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `module` varchar(32) NOT NULL,
  `display_name` varchar(64) NOT NULL,
  `status` enum('active','disabled') NOT NULL,
  `sort_order` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `module` (`module`),
  UNIQUE KEY `sort_order` (`sort_order`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `modules`
-- 

INSERT INTO `modules` VALUES (1, 'Content', 'Site Content', 'active', 1);
INSERT INTO `modules` VALUES (2, 'Skeleton', 'Skeleton', 'disabled', 2);
INSERT INTO `modules` VALUES (5, 'Menu', 'Menu Management', 'active', 4);
INSERT INTO `modules` VALUES (7, 'Support', 'Support', 'active', 5);
INSERT INTO `modules` VALUES (8, 'User', 'User', 'active', 6);
INSERT INTO `modules` VALUES (17, 'Blocks', 'Blocks Management', 'active', 15);
INSERT INTO `modules` VALUES (21, 'Gallery', 'Photo Gallery', 'disabled', 45);
INSERT INTO `modules` VALUES (22, 'Campaigns', 'Campaigns', 'active', 23);

-- --------------------------------------------------------

-- 
-- Table structure for table `module_options`
-- 

CREATE TABLE `module_options` (
  `module` varchar(64) NOT NULL,
  `options` longtext,
  PRIMARY KEY  (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `module_options`
-- 

INSERT INTO `module_options` VALUES ('CMS', 'a:3:{s:4:"name";s:26:"Norex Core Web Development";s:11:"defaultPage";s:4:"Home";s:16:"defaultPageTitle";s:13:"Kitchen Party";}');
INSERT INTO `module_options` VALUES ('Content', 'a:1:{s:11:"funtestitem";s:23:"Config Options are Fun!";s:15:"restrictedpages";s:4:"true";}');
INSERT INTO `module_options` VALUES ('Support', 'a:1:{i:45;i:45;}');

-- --------------------------------------------------------

-- 
-- Table structure for table `permissions`
-- 

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL auto_increment,
  `key` tinytext NOT NULL,
  `title` tinytext NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `permissions`
-- 

INSERT INTO `permissions` VALUES (1, 'viewcontentadmin', 'View Content Module', 'Allow viewing of the admin interface for the Content module');
INSERT INTO `permissions` VALUES (2, 'addcontentpages', 'Add Pages', 'Allow user to add Content Pages to site');
INSERT INTO `permissions` VALUES (3, 'deletecontentpages', 'Delete Pages', 'Allow user to delete Content Pages from site');
INSERT INTO `permissions` VALUES (4, 'viewcontentlayers', 'View Content Layers', 'Allow user to view Content Page layers');
INSERT INTO `permissions` VALUES (5, 'admin', 'Admin', 'Allows user to use the admin interface');
INSERT INTO `permissions` VALUES (6, 'editcontent', 'Edit Content Page', 'Allow user to edit a content page');
INSERT INTO `permissions` VALUES (7, 'assigngroups', 'Assign User to a group', 'Whether or not to allow the user to assign a group to another user');
INSERT INTO `permissions` VALUES (8, 'viewusermodule', 'View User Module', 'Allow viewing of the admin interface for the User Module');
INSERT INTO `permissions` VALUES (9, 'membersaccess', 'Member Page Access', 'Allows users to view restricted areas of the site');
INSERT INTO `permissions` VALUES (10, 'addcampaign', 'Add and Edit Campaigns', 'Allows user to add and edit campaigns under their current company');
INSERT INTO `permissions` VALUES (11, 'viewcampaign', 'View Campaigns', 'Allows user to have read access to campaigns');
INSERT INTO `permissions` VALUES (12, 'addcampaignrecips', 'Add and edit campaign recipients', 'Allows user to add and edit campaign recipients in their group');
INSERT INTO `permissions` VALUES (13, 'newuserhash', 'Create hash for new recipient', 'Allows new recipients to be added to existing campaigns');

-- --------------------------------------------------------

-- 
-- Table structure for table `states`
-- 

CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL default '0',
  `country` int(10) unsigned NOT NULL default '0',
  `code` varchar(5) NOT NULL default '',
  `name` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `states`
-- 

INSERT INTO `states` VALUES (72, 31, 'NU', 'Nunavut');
INSERT INTO `states` VALUES (1, 31, 'AB', 'Alberta');
INSERT INTO `states` VALUES (2, 31, 'BC', 'British Columbia');
INSERT INTO `states` VALUES (3, 31, 'MB', 'Manitoba');
INSERT INTO `states` VALUES (4, 31, 'NB', 'New Brunswick');
INSERT INTO `states` VALUES (5, 31, 'NF', 'Newfoundland');
INSERT INTO `states` VALUES (6, 31, 'NT', 'Northwest Territories');
INSERT INTO `states` VALUES (7, 31, 'NS', 'Nova Scotia');
INSERT INTO `states` VALUES (8, 31, 'ON', 'Ontario');
INSERT INTO `states` VALUES (9, 31, 'PE', 'Prince Edward Island');
INSERT INTO `states` VALUES (10, 31, 'QC', 'Quebec');
INSERT INTO `states` VALUES (11, 31, 'SK', 'Saskatchewan');
INSERT INTO `states` VALUES (12, 31, 'YT', 'Yukon');
INSERT INTO `states` VALUES (13, 184, 'AL', 'Alabama');
INSERT INTO `states` VALUES (14, 184, 'AK', 'Alaska');
INSERT INTO `states` VALUES (15, 184, 'AS', 'American Samoa');
INSERT INTO `states` VALUES (16, 184, 'AZ', 'Arizona');
INSERT INTO `states` VALUES (17, 184, 'AR', 'Arkansas');
INSERT INTO `states` VALUES (18, 184, 'CA', 'California');
INSERT INTO `states` VALUES (19, 184, 'CO', 'Colorado');
INSERT INTO `states` VALUES (20, 184, 'CT', 'Connecticut');
INSERT INTO `states` VALUES (21, 184, 'DE', 'Delaware');
INSERT INTO `states` VALUES (22, 184, 'DC', 'District of Columbia');
INSERT INTO `states` VALUES (23, 184, 'FM', 'Fed. States of Micronesia');
INSERT INTO `states` VALUES (24, 184, 'FL', 'Florida');
INSERT INTO `states` VALUES (25, 184, 'GA', 'Georgia');
INSERT INTO `states` VALUES (26, 184, 'GU', 'Guam');
INSERT INTO `states` VALUES (27, 184, 'HI', 'Hawaii');
INSERT INTO `states` VALUES (28, 184, 'ID', 'Idaho');
INSERT INTO `states` VALUES (29, 184, 'IL', 'Illinois');
INSERT INTO `states` VALUES (30, 184, 'IN', 'Indiana');
INSERT INTO `states` VALUES (31, 184, 'IA', 'Iowa');
INSERT INTO `states` VALUES (32, 184, 'KS', 'Kansas');
INSERT INTO `states` VALUES (33, 184, 'KY', 'Kentucky');
INSERT INTO `states` VALUES (34, 184, 'LA', 'Louisiana');
INSERT INTO `states` VALUES (35, 184, 'ME', 'Maine');
INSERT INTO `states` VALUES (36, 184, 'MH', 'Marshall Islands');
INSERT INTO `states` VALUES (37, 184, 'MD', 'Maryland');
INSERT INTO `states` VALUES (38, 184, 'MA', 'Massachusetts');
INSERT INTO `states` VALUES (39, 184, 'MI', 'Michigan');
INSERT INTO `states` VALUES (40, 184, 'MN', 'Minnesota');
INSERT INTO `states` VALUES (41, 184, 'MS', 'Mississippi');
INSERT INTO `states` VALUES (42, 184, 'MO', 'Missouri');
INSERT INTO `states` VALUES (43, 184, 'MT', 'Montana');
INSERT INTO `states` VALUES (44, 184, 'NE', 'Nebraska');
INSERT INTO `states` VALUES (45, 184, 'NV', 'Nevada');
INSERT INTO `states` VALUES (46, 184, 'NH', 'New Hampshire');
INSERT INTO `states` VALUES (47, 184, 'NJ', 'New Jersey');
INSERT INTO `states` VALUES (48, 184, 'NM', 'New Mexico');
INSERT INTO `states` VALUES (49, 184, 'NY', 'New York');
INSERT INTO `states` VALUES (50, 184, 'NC', 'North Carolina');
INSERT INTO `states` VALUES (51, 184, 'ND', 'North Dakota');
INSERT INTO `states` VALUES (52, 184, 'MP', 'Northern Mariana Is.');
INSERT INTO `states` VALUES (53, 184, 'OH', 'Ohio');
INSERT INTO `states` VALUES (54, 184, 'OK', 'Oklahoma');
INSERT INTO `states` VALUES (55, 184, 'OR', 'Oregon');
INSERT INTO `states` VALUES (56, 184, 'PW', 'Palau');
INSERT INTO `states` VALUES (57, 184, 'PA', 'Pennsylvania');
INSERT INTO `states` VALUES (58, 184, 'PR', 'Puerto Rico');
INSERT INTO `states` VALUES (59, 184, 'RI', 'Rhode Island');
INSERT INTO `states` VALUES (60, 184, 'SC', 'South Carolina');
INSERT INTO `states` VALUES (61, 184, 'SD', 'South Dakota');
INSERT INTO `states` VALUES (62, 184, 'TN', 'Tennessee');
INSERT INTO `states` VALUES (63, 184, 'TX', 'Texas');
INSERT INTO `states` VALUES (64, 184, 'UT', 'Utah');
INSERT INTO `states` VALUES (65, 184, 'VT', 'Vermont');
INSERT INTO `states` VALUES (66, 184, 'VA', 'Virginia');
INSERT INTO `states` VALUES (67, 184, 'VI', 'Virgin Islands');
INSERT INTO `states` VALUES (68, 184, 'WA', 'Washington');
INSERT INTO `states` VALUES (69, 184, 'WV', 'West Virginia');
INSERT INTO `states` VALUES (70, 184, 'WI', 'Wisconsin');
INSERT INTO `states` VALUES (71, 184, 'WY', 'Wyoming');

-- --------------------------------------------------------

-- 
-- Table structure for table `support`
-- 

CREATE TABLE `support` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `support`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `templates`
-- 

CREATE TABLE `templates` (
  `module` varchar(32) NOT NULL default '',
  `path` varchar(64) NOT NULL,
  `data` longtext NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `id` int(11) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  KEY `path` (`path`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- 
-- Dumping data for table `templates`
-- 

INSERT INTO `templates` VALUES ('Module_Content', 'content.tpl', '<script type="text/javascript">genFlash(''/flash/leftCol.swf?pagetitle={$content->getPageTitle()}'', 615, 35, '''', ''transparent'');</script>\r\n{$content->getContent()}', '2008-07-28 20:26:32', 33);
INSERT INTO `templates` VALUES ('CMS', 'site.tpl', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<meta name="keywords" content="{$metaKeywords}" />\r\n<meta name="description" content="{$metaDescription}" />\r\n<meta name="title" content="{$metaTitle}" />\r\n<title>{$title}</title>\r\n<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css" />\r\n\r\n\r\n<script type="text/javascript" src="/js/prototype.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n\r\n<h1>{$title}</h1>\r\n\r\n{module class="Menu"}\r\n	\r\n{if $user}<a href="/user/logout">Logout</a>{else}<a href="/user/login">Login</a>{/if}\r\n\r\n{module class=$module}\r\n\r\n</body>\r\n</html>', '2008-08-05 11:35:40', 37);
INSERT INTO `templates` VALUES ('CMS', 'css/cssMenus.css', '', '2008-07-29 00:42:33', 53);
INSERT INTO `templates` VALUES ('CMS', 'css/style.css', 'ol {\r\n	list-style-type: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\nfieldset {\r\n	border: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n', '2008-07-29 00:44:53', 55);
INSERT INTO `templates` VALUES ('Module_Menu', 'menu_rendertop.tpl', '<div id="nav">\r\n	<ul id="navUl">\r\n	{assign var=menuCount value=0}\r\n	{foreach from=$menu item=item}\r\n		{assign var=menuCount value=$menuCount+1}\r\n		{strip}<li><a href="{$item->link}"{if $item->target == "new"} target="_blank"{/if}>{$item->display}</a>\r\n		{if $item->children}{assign var="children" value=true}<ul>{else}{assign var="children" value=false}{/if}\r\n		{foreach from=$item->children item=item}\r\n		{assign var="depth" value=1}\r\n		{include file=db:menu_renderitems.tpl menu=item}\r\n		{/foreach}\r\n		{if $children}</ul>{/if}\r\n		</li>\r\n		{if $menuCount < $menu|@count}\r\n			<li class="menuDivider">?</li>\r\n		{/if}{/strip}\r\n		{/foreach}\r\n	</ul>\r\n</div>', '2008-07-29 01:43:02', 57);
INSERT INTO `templates` VALUES ('CMS', 'site.tpl', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<meta name="keywords" content="{$metaKeywords}" />\r\n<meta name="description" content="{$metaDescription}" />\r\n<meta name="title" content="{$metaTitle}" />\r\n<title>{$title}</title>\r\n<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css" />\r\n\r\n\r\n<script type="text/javascript" src="/js/prototype.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n\r\n<h1>{$title}</h1>\r\n\r\n{module class="Menu"}\r\n	\r\n{if $user}<a href="/user/logout">Logout</a>{else}<a href="/user/login">Login</a>{/if}\r\n\r\n{module class=$module}\r\n\r\n</body>\r\n</html>\r\n', '2008-08-06 09:18:02', 58);
INSERT INTO `templates` VALUES ('Module_Content', 'content.tpl', '<script type="text/javascript">genFlash(''/flash/leftCol.swf?pagetitle={$content->getPageTitle()}'', 615, 35, '''', ''transparent'');</script>\r\n{$content->getContent()}\r\n', '2008-08-06 09:18:31', 59);
INSERT INTO `templates` VALUES ('Module_Menu', 'menu_rendertop.tpl', '<div id="nav">\r\n	<ul id="navUl">\r\n	{assign var=menuCount value=0}\r\n	{foreach from=$menu item=item}\r\n		{assign var=menuCount value=$menuCount+1}\r\n		{strip}<li><a href="{$item->link}"{if $item->target == "new"} target="_blank"{/if}>{$item->display}</a>\r\n		{if $item->children}{assign var="children" value=true}<ul>{else}{assign var="children" value=false}{/if}\r\n		{foreach from=$item->children item=item}\r\n		{assign var="depth" value=1}\r\n		{include file=db:menu_renderitems.tpl menu=item}\r\n		{/foreach}\r\n		{if $children}</ul>{/if}\r\n		</li>\r\n		{if $menuCount < $menu|@count}\r\n			<li class="menuDivider">?</li>\r\n		{/if}{/strip}\r\n		{/foreach}\r\n	</ul>\r\n</div>\r\n', '2008-08-06 09:18:45', 60);
INSERT INTO `templates` VALUES ('CMS', 'css/cssMenus.css', '#navUl, #navUl ul { /* all lists */\r\n  padding: 0;\r\n  margin: 0;\r\n  list-style: none;\r\n}\r\nul#navUl {\r\nwidth:548px;\r\nheight:35px;\r\n}\r\n#navUl li.menuDivider {\r\n  width:1px;\r\n  height:11px;\r\n  line-height:33px;\r\n  color:#a4c93d;\r\n  font-size:11px;\r\n}\r\n#navUl a {\r\n  display: block;\r\n  font-family:Trebuchet MS, Arial, sans-serif;\r\n  font-size:12px;\r\n  font-weight:700;\r\n  text-decoration:none;\r\n  color:#5a9096;\r\n  line-height:35px;\r\n  padding-bottom:3px;\r\n}\r\n#navUl a:hover {\r\ncolor:#a4c93d;\r\n}\r\n\r\n#navUl li { /* all list items */\r\n  float:left;\r\n  height:33px;\r\n}\r\n#navUl li a {\r\n  padding: 0 8px;\r\n  line-height:33px;\r\n}\r\n#navUl li ul{ /* second-level lists */\r\n  position: absolute;\r\n  background: #a4c93d;\r\n  width: 10em;\r\n  left: -999em; /* using left instead of display to hide menus because display: none isn''t read by screen readers */\r\n  text-align:left;\r\n}\r\n\r\n#navUl li ul li {\r\n  display: block;\r\n  clear: left;\r\n  width: 100%;\r\n  line-height:24px;\r\n  border-bottom:1px dotted #FFF;\r\n}\r\n#navUl li ul li a {\r\n  font-size: 14px;\r\n  line-height: 30px;\r\ncolor:#fff;\r\nfont-size:11px;\r\n}\r\n#navUl li ul ul { /* third-and-above-level lists */\r\n  margin: -1em 0 0 10em;\r\n}\r\n\r\n#navUl li:hover ul ul, #navUl li:hover ul ul ul, #navUl li.sfhover ul ul, #navUl li.sfhover ul ul ul {\r\n  left: -999em;\r\n}\r\n\r\n#navUl li:hover ul, #navUl li li:hover ul, #navUl li li li:hover ul, #navUl li.sfhover ul, #navUl li li.sfhover ul, #navUl li li li.sfhover ul { /* lists nested under hovered list items */\r\n  left: auto;\r\n}\r\n\r\n#navUl li ul li:hover, #navUl li ul li.sfhover {\r\n  background:#5a9096;\r\n}\r\n\r\n#navUl li ul li a:hover {\r\n  color:#000;\r\n}\r\n\r\n#navUl li ul li ul li {\r\n  top:0;\r\n}\r\n', '2008-08-06 10:26:23', 61);
INSERT INTO `templates` VALUES ('CMS', 'css/style.css', 'ol {\r\n	list-style-type: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\nfieldset {\r\n	border: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\n/******************************************************************************************************************************\r\n  Dynamic ASP / Norex.com LTD Content Management System (CMS) Software\r\n  Using this script without obtaining licenses from Norex.com LTD. is illegal.\r\n\r\n  Copyright (c) 2003-2007 Norex.com LTD\r\n  This program is a commercially licensed product. No person may redistribute it and/or modify it under the terms of the License agreement.\r\n*****************************************************************************************************************************\r\n============================================================================================================================\r\n\r\n    * Filename: style.css\r\n    * Version: 1.0.1 (2008-02-05) YYYY-MM-DD\r\n		* Changelog : 2008-02-07 - Added a banner section\r\n    * Website: http://www.?\r\n    * Author: Norex.com LTD (Justin Bellefontaine, Eric Covert)\r\n    * Description: Standard Cascading Style Sheet for CMS Installation - Handles site-wide styling of elements and structure.\r\n	* Notes: No notes at this time.\r\n\r\n    == STRUCTURE NOTES: ========================\r\n    * Page width: 800px\r\n    * Number of columns: 2\r\n    ============================================\r\n	\r\n	== INDEX: ======================================================\r\n	_container : Site Container\r\n	_header : Site Header\r\n	_navi : Site Navigation\r\n	_banner : Banner\r\n	_content : Main Content Area (Left Column/Right Column)\r\n	_footer : Site Footer\r\n	_contentStyles : General Content styles (p, a, h1, h2, etc.)\r\n	_custom : Custom CSS section (Unique to all sites)\r\n	================================================================\r\n\r\n=============================================================================================================================*/\r\nbody {\r\nbackground-image:url(/mockup/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\ndiv#banner { behavior: url(/iepngfix.htc) }\r\n\r\n/* _container ==========================================*/\r\ndiv#container {\r\nwidth:800px;\r\n}\r\n\r\n/* _header ==========================================*/\r\ndiv#header {\r\nwidth:800px;\r\nheight:76px;\r\nfloat:left;\r\n}\r\n\r\ndiv#logo {\r\nwidth:232px;\r\nheight:76px;\r\nfloat:left;\r\nbackground-image:url(/mockup/images/logo.jpg);\r\nbackground-repeat:no-repeat;\r\npadding:0 20px 0 0;\r\n}\r\n\r\n/* _navi ==========================================*/\r\ndiv#nav {\r\nwidth:548px;\r\nheight:35px;\r\nfloat:left;\r\n}\r\n\r\n/* _banner ==========================================*/\r\ndiv#banner {\r\nwidth:800px;\r\nheight:274px;\r\nfloat:left;\r\nbackground-image:url(/mockup/images/banner_bg.png);\r\nbackground-repeat:no-repeat;\r\ntext-align:left;\r\n}\r\n\r\n/* _content ==========================================*/\r\ndiv#mainContent {\r\nwidth:800px;\r\nfloat:left;\r\ntext-align:justify;\r\npadding-bottom:30px;\r\n}\r\n\r\ndiv#leftCol {\r\nwidth:565px;\r\nfloat:left;\r\npadding:15px 48px 0 0;\r\n}\r\n\r\ndiv#rightCol {\r\nwidth:180px;\r\nfloat:left;\r\npadding-top:15px;\r\n}\r\n\r\ndiv.block {\r\nwidth:180px;\r\nfloat:left;\r\n}\r\n\r\n/* _footer ==========================================*/\r\ndiv#footer {\r\nwidth:800px;\r\nfloat:left;\r\nheight:50px;\r\nborder-top:1px dotted #696969;\r\npadding:5px 0 0;\r\nmargin-right:-3px;\r\n}\r\n\r\ndiv.copyright {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:100;\r\ncolor:#5a9096;\r\ntext-align:left;\r\nwidth:300px;\r\nfloat:left;\r\n}\r\n\r\ndiv.norexlink {\r\nfloat:right;\r\ntext-align:right;\r\nwidth:400px;\r\n}\r\n\r\ndiv.norexlink a {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:700;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\ndiv.norexlink a:hover {\r\nbackground-image:url(/mockup/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\ncolor:#5a9096;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\n/* _customEnd ==========================================\r\n _contentStyles ==========================================*/\r\np {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\nfont-weight:100;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\na {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nfont-weight:700;\r\nfont-size:14px;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\na:hover {\r\ncolor:#5a9096;\r\n}\r\n\r\ndiv#rightCol a:hover {\r\ncolor:#f3a800;\r\n}\r\n\r\nh1 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#5a9096;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:24px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 a {\r\nfont-size:18px;\r\n}\r\n\r\nh3 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:18px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh4 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:14px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh5 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:12px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh6 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:9px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nul,ol {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 0 30px;\r\n}\r\n\r\nul {\r\nlist-style-image:url(/mockup/images/bullet.jpg);\r\n}\r\n\r\n/* _contentStylesEnd ==========================================\r\n _custom ==========================================*/\r\ndiv.divider {\r\nheight:1px;\r\nline-height:1px;\r\nwidth:180px;\r\nborder-top:1px dotted #696969;\r\nfloat:left;\r\nmargin:10px 0 0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh1.bannerText {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#fff;\r\nfont-weight:700;\r\nfloat:left;\r\nwidth:320px;\r\nmargin:0;\r\npadding:20px 0 10px;\r\n}\r\n\r\nh1.bannerText b {\r\ncolor:#a4c93d;\r\n}\r\n\r\ndiv#banner img {\r\nfloat:left;\r\nclear:left;\r\npadding:10px 0 0;\r\n}\r\n\r\ndiv#navSpacer {\r\nfloat:left;\r\nheight:41px;\r\n}\r\n\r\ndiv#rightCol a {\r\ncolor:#5a9096;\r\n}', '2008-08-06 10:27:07', 62);
INSERT INTO `templates` VALUES ('CMS', 'site.tpl', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<meta name="keywords" content="{$metaKeywords}" />\r\n<meta name="description" content="{$metaDescription}" />\r\n<meta name="title" content="{$metaTitle}" />\r\n<title>Safe Ballot | The Intelligent Solution to Online Voting Systems</title>\r\n<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css" />\r\n<script type="text/javascript" src="/js/prototype.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n<center>\r\n	<!--Begin Container-->\r\n	<div id="container">\r\n		<!--Begin Header-->\r\n\r\n		<div id="header">\r\n			<div id="logo">\r\n				&nbsp;\r\n			</div>\r\n			<!--Begin Nav-->\r\n			<div id="navSpacer">&nbsp;</div>\r\n			{module class="Menu"}\r\n		</div>\r\n		<div id="banner">\r\n			<h1 class="bannerText">The <b>easy</b> and <b>intelligent</b> way to create user-friendly, informative surveys for an <b>unlimited</b> number of applications!</h1>\r\n\r\n			<a href="#"><img src="images/joinBtn.png" border="0" alt="Join Now!" /></a>\r\n		</div>\r\n		<div id="mainContent">\r\n			<div id="leftCol">\r\n				{module class=$module}\r\n			</div>\r\n			<div id="rightCol">\r\n				BLOCK CODE HERE\r\n			</div>\r\n		</div>\r\n		<div id="footer">\r\n			<div class="copyright">\r\n				Copyright &copy; 2008 Safe Ballot\r\n			</div>\r\n\r\n			<div class="norexlink">\r\n				<a href="http://www.norex.ca" target="_blank">Site by Norex</a>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</center>\r\n</body>\r\n</html>\r\n\r\n', '2008-08-06 10:42:47', 63);
INSERT INTO `templates` VALUES ('CMS', 'css/style.css', '/******************************************************************************************************************************\r\n  Dynamic ASP / Norex.com LTD Content Management System (CMS) Software\r\n  Using this script without obtaining licenses from Norex.com LTD. is illegal.\r\n\r\n  Copyright (c) 2003-2007 Norex.com LTD\r\n  This program is a commercially licensed product. No person may redistribute it and/or modify it under the terms of the License agreement.\r\n*****************************************************************************************************************************\r\n============================================================================================================================\r\n\r\n    * Filename: style.css\r\n    * Version: 1.0.1 (2008-02-05) YYYY-MM-DD\r\n		* Changelog : 2008-02-07 - Added a banner section\r\n    * Website: http://www.?\r\n    * Author: Norex.com LTD (Justin Bellefontaine, Eric Covert)\r\n    * Description: Standard Cascading Style Sheet for CMS Installation - Handles site-wide styling of elements and structure.\r\n	* Notes: No notes at this time.\r\n\r\n    == STRUCTURE NOTES: ========================\r\n    * Page width: 800px\r\n    * Number of columns: 2\r\n    ============================================\r\n	\r\n	== INDEX: ======================================================\r\n	_container : Site Container\r\n	_header : Site Header\r\n	_navi : Site Navigation\r\n	_banner : Banner\r\n	_content : Main Content Area (Left Column/Right Column)\r\n	_footer : Site Footer\r\n	_contentStyles : General Content styles (p, a, h1, h2, etc.)\r\n	_custom : Custom CSS section (Unique to all sites)\r\n	================================================================\r\n\r\n=============================================================================================================================*/\r\nol {\r\n	list-style-type: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\nfieldset {\r\n	border: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\n\r\nbody {\r\nbackground-image:url(/mockup/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\ndiv#banner { behavior: url(/iepngfix.htc) }\r\n\r\n/* _container ==========================================*/\r\ndiv#container {\r\nwidth:800px;\r\n}\r\n\r\n/* _header ==========================================*/\r\ndiv#header {\r\nwidth:800px;\r\nheight:76px;\r\nfloat:left;\r\n}\r\n\r\ndiv#logo {\r\nwidth:232px;\r\nheight:76px;\r\nfloat:left;\r\nbackground-image:url(/mockup/images/logo.jpg);\r\nbackground-repeat:no-repeat;\r\npadding:0 20px 0 0;\r\n}\r\n\r\n/* _navi ==========================================*/\r\ndiv#nav {\r\nwidth:548px;\r\nheight:35px;\r\nfloat:left;\r\n}\r\n\r\n/* _banner ==========================================*/\r\ndiv#banner {\r\nwidth:800px;\r\nheight:274px;\r\nfloat:left;\r\nbackground-image:url(/mockup/images/banner_bg.png);\r\nbackground-repeat:no-repeat;\r\ntext-align:left;\r\n}\r\n\r\n/* _content ==========================================*/\r\ndiv#mainContent {\r\nwidth:800px;\r\nfloat:left;\r\ntext-align:justify;\r\npadding-bottom:30px;\r\n}\r\n\r\ndiv#leftCol {\r\nwidth:565px;\r\nfloat:left;\r\npadding:15px 48px 0 0;\r\n}\r\n\r\ndiv#rightCol {\r\nwidth:180px;\r\nfloat:left;\r\npadding-top:15px;\r\n}\r\n\r\ndiv.block {\r\nwidth:180px;\r\nfloat:left;\r\n}\r\n\r\n/* _footer ==========================================*/\r\ndiv#footer {\r\nwidth:800px;\r\nfloat:left;\r\nheight:50px;\r\nborder-top:1px dotted #696969;\r\npadding:5px 0 0;\r\nmargin-right:-3px;\r\n}\r\n\r\ndiv.copyright {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:100;\r\ncolor:#5a9096;\r\ntext-align:left;\r\nwidth:300px;\r\nfloat:left;\r\n}\r\n\r\ndiv.norexlink {\r\nfloat:right;\r\ntext-align:right;\r\nwidth:400px;\r\n}\r\n\r\ndiv.norexlink a {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:700;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\ndiv.norexlink a:hover {\r\nbackground-image:url(/mockup/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\ncolor:#5a9096;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\n/* _customEnd ==========================================\r\n _contentStyles ==========================================*/\r\np {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\nfont-weight:100;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\na {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nfont-weight:700;\r\nfont-size:14px;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\na:hover {\r\ncolor:#5a9096;\r\n}\r\n\r\ndiv#rightCol a:hover {\r\ncolor:#f3a800;\r\n}\r\n\r\nh1 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#5a9096;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:24px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 a {\r\nfont-size:18px;\r\n}\r\n\r\nh3 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:18px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh4 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:14px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh5 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:12px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh6 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:9px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nul,ol {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 0 30px;\r\n}\r\n\r\nul {\r\nlist-style-image:url(/mockup/images/bullet.jpg);\r\n}\r\n\r\n/* _contentStylesEnd ==========================================\r\n _custom ==========================================*/\r\ndiv.divider {\r\nheight:1px;\r\nline-height:1px;\r\nwidth:180px;\r\nborder-top:1px dotted #696969;\r\nfloat:left;\r\nmargin:10px 0 0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh1.bannerText {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#fff;\r\nfont-weight:700;\r\nfloat:left;\r\nwidth:320px;\r\nmargin:0;\r\npadding:20px 0 10px;\r\n}\r\n\r\nh1.bannerText b {\r\ncolor:#a4c93d;\r\n}\r\n\r\ndiv#banner img {\r\nfloat:left;\r\nclear:left;\r\npadding:10px 0 0;\r\n}\r\n\r\ndiv#navSpacer {\r\nfloat:left;\r\nheight:41px;\r\n}\r\n\r\ndiv#rightCol a {\r\ncolor:#5a9096;\r\n}\r\n', '2008-08-06 10:43:30', 64);
INSERT INTO `templates` VALUES ('CMS', 'css/style.css', '/******************************************************************************************************************************\r\n  Dynamic ASP / Norex.com LTD Content Management System (CMS) Software\r\n  Using this script without obtaining licenses from Norex.com LTD. is illegal.\r\n\r\n  Copyright (c) 2003-2007 Norex.com LTD\r\n  This program is a commercially licensed product. No person may redistribute it and/or modify it under the terms of the License agreement.\r\n*****************************************************************************************************************************\r\n============================================================================================================================\r\n\r\n    * Filename: style.css\r\n    * Version: 1.0.1 (2008-02-05) YYYY-MM-DD\r\n		* Changelog : 2008-02-07 - Added a banner section\r\n    * Website: http://www.?\r\n    * Author: Norex.com LTD (Justin Bellefontaine, Eric Covert)\r\n    * Description: Standard Cascading Style Sheet for CMS Installation - Handles site-wide styling of elements and structure.\r\n	* Notes: No notes at this time.\r\n\r\n    == STRUCTURE NOTES: ========================\r\n    * Page width: 800px\r\n    * Number of columns: 2\r\n    ============================================\r\n	\r\n	== INDEX: ======================================================\r\n	_container : Site Container\r\n	_header : Site Header\r\n	_navi : Site Navigation\r\n	_banner : Banner\r\n	_content : Main Content Area (Left Column/Right Column)\r\n	_footer : Site Footer\r\n	_contentStyles : General Content styles (p, a, h1, h2, etc.)\r\n	_custom : Custom CSS section (Unique to all sites)\r\n	================================================================\r\n\r\n=============================================================================================================================*/\r\nol {\r\n	list-style-type: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\nfieldset {\r\n	border: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\n\r\nbody {\r\nbackground-image:url(/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\ndiv#banner { behavior: url(/iepngfix.htc) }\r\n\r\n/* _container ==========================================*/\r\ndiv#container {\r\nwidth:800px;\r\n}\r\n\r\n/* _header ==========================================*/\r\ndiv#header {\r\nwidth:800px;\r\nheight:76px;\r\nfloat:left;\r\n}\r\n\r\ndiv#logo {\r\nwidth:232px;\r\nheight:76px;\r\nfloat:left;\r\nbackground-image:url(/images/logo.jpg);\r\nbackground-repeat:no-repeat;\r\npadding:0 20px 0 0;\r\n}\r\n\r\n/* _navi ==========================================*/\r\ndiv#nav {\r\nwidth:548px;\r\nheight:35px;\r\nfloat:left;\r\n}\r\n\r\n/* _banner ==========================================*/\r\ndiv#banner {\r\nwidth:800px;\r\nheight:274px;\r\nfloat:left;\r\nbackground-image:url(/images/banner_bg.png);\r\nbackground-repeat:no-repeat;\r\ntext-align:left;\r\n}\r\n\r\n/* _content ==========================================*/\r\ndiv#mainContent {\r\nwidth:800px;\r\nfloat:left;\r\ntext-align:justify;\r\npadding-bottom:30px;\r\n}\r\n\r\ndiv#leftCol {\r\nwidth:565px;\r\nfloat:left;\r\npadding:15px 48px 0 0;\r\n}\r\n\r\ndiv#rightCol {\r\nwidth:180px;\r\nfloat:left;\r\npadding-top:15px;\r\n}\r\n\r\ndiv.block {\r\nwidth:180px;\r\nfloat:left;\r\n}\r\n\r\n/* _footer ==========================================*/\r\ndiv#footer {\r\nwidth:800px;\r\nfloat:left;\r\nheight:50px;\r\nborder-top:1px dotted #696969;\r\npadding:5px 0 0;\r\nmargin-right:-3px;\r\n}\r\n\r\ndiv.copyright {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:100;\r\ncolor:#5a9096;\r\ntext-align:left;\r\nwidth:300px;\r\nfloat:left;\r\n}\r\n\r\ndiv.norexlink {\r\nfloat:right;\r\ntext-align:right;\r\nwidth:400px;\r\n}\r\n\r\ndiv.norexlink a {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:700;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\ndiv.norexlink a:hover {\r\nbackground-image:url(/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\ncolor:#5a9096;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\n/* _customEnd ==========================================\r\n _contentStyles ==========================================*/\r\np {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\nfont-weight:100;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\na {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nfont-weight:700;\r\nfont-size:14px;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\na:hover {\r\ncolor:#5a9096;\r\n}\r\n\r\ndiv#rightCol a:hover {\r\ncolor:#f3a800;\r\n}\r\n\r\nh1 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#5a9096;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:24px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 a {\r\nfont-size:18px;\r\n}\r\n\r\nh3 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:18px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh4 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:14px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh5 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:12px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh6 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:9px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nul,ol {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 0 30px;\r\n}\r\n\r\nul {\r\nlist-style-image:url(/images/bullet.jpg);\r\n}\r\n\r\n/* _contentStylesEnd ==========================================\r\n _custom ==========================================*/\r\ndiv.divider {\r\nheight:1px;\r\nline-height:1px;\r\nwidth:180px;\r\nborder-top:1px dotted #696969;\r\nfloat:left;\r\nmargin:10px 0 0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh1.bannerText {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#fff;\r\nfont-weight:700;\r\nfloat:left;\r\nwidth:320px;\r\nmargin:0;\r\npadding:20px 0 10px;\r\n}\r\n\r\nh1.bannerText b {\r\ncolor:#a4c93d;\r\n}\r\n\r\ndiv#banner img {\r\nfloat:left;\r\nclear:left;\r\npadding:10px 0 0;\r\n}\r\n\r\ndiv#navSpacer {\r\nfloat:left;\r\nheight:41px;\r\n}\r\n\r\ndiv#rightCol a {\r\ncolor:#5a9096;\r\n}\r\n\r\n', '2008-08-06 10:44:45', 65);
INSERT INTO `templates` VALUES ('CMS', 'css/style.css', '/******************************************************************************************************************************\r\n  Dynamic ASP / Norex.com LTD Content Management System (CMS) Software\r\n  Using this script without obtaining licenses from Norex.com LTD. is illegal.\r\n\r\n  Copyright (c) 2003-2007 Norex.com LTD\r\n  This program is a commercially licensed product. No person may redistribute it and/or modify it under the terms of the License agreement.\r\n*****************************************************************************************************************************\r\n============================================================================================================================\r\n\r\n    * Filename: style.css\r\n    * Version: 1.0.1 (2008-02-05) YYYY-MM-DD\r\n		* Changelog : 2008-02-07 - Added a banner section\r\n    * Website: http://www.?\r\n    * Author: Norex.com LTD (Justin Bellefontaine, Eric Covert)\r\n    * Description: Standard Cascading Style Sheet for CMS Installation - Handles site-wide styling of elements and structure.\r\n	* Notes: No notes at this time.\r\n\r\n    == STRUCTURE NOTES: ========================\r\n    * Page width: 800px\r\n    * Number of columns: 2\r\n    ============================================\r\n	\r\n	== INDEX: ======================================================\r\n	_container : Site Container\r\n	_header : Site Header\r\n	_navi : Site Navigation\r\n	_banner : Banner\r\n	_content : Main Content Area (Left Column/Right Column)\r\n	_footer : Site Footer\r\n	_contentStyles : General Content styles (p, a, h1, h2, etc.)\r\n	_custom : Custom CSS section (Unique to all sites)\r\n	================================================================\r\n\r\n=============================================================================================================================*/\r\nol {\r\n	list-style-type: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\nfieldset {\r\n	border: none;\r\n	padding-left: 0px;\r\n	margin-left: 0px;\r\n}\r\n\r\n\r\nbody {\r\nbackground-image:url(/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\nbody.tinymce {\r\n	background-image: none;\r\n	background-color: #fff;\r\n}\r\n\r\ndiv#banner { behavior: url(/iepngfix.htc) }\r\n\r\n/* _container ==========================================*/\r\ndiv#container {\r\nwidth:800px;\r\n}\r\n\r\n/* _header ==========================================*/\r\ndiv#header {\r\nwidth:800px;\r\nheight:76px;\r\nfloat:left;\r\n}\r\n\r\ndiv#logo {\r\nwidth:232px;\r\nheight:76px;\r\nfloat:left;\r\nbackground-image:url(/images/logo.jpg);\r\nbackground-repeat:no-repeat;\r\npadding:0 20px 0 0;\r\n}\r\n\r\n/* _navi ==========================================*/\r\ndiv#nav {\r\nwidth:548px;\r\nheight:35px;\r\nfloat:left;\r\n}\r\n\r\n/* _banner ==========================================*/\r\ndiv#banner {\r\nwidth:800px;\r\nheight:274px;\r\nfloat:left;\r\nbackground-image:url(/images/banner_bg.png);\r\nbackground-repeat:no-repeat;\r\ntext-align:left;\r\n}\r\n\r\n/* _content ==========================================*/\r\ndiv#mainContent {\r\nwidth:800px;\r\nfloat:left;\r\ntext-align:justify;\r\npadding-bottom:30px;\r\n}\r\n\r\ndiv#leftCol {\r\nwidth:565px;\r\nfloat:left;\r\npadding:15px 48px 0 0;\r\n}\r\n\r\ndiv#rightCol {\r\nwidth:180px;\r\nfloat:left;\r\npadding-top:15px;\r\n}\r\n\r\ndiv.block {\r\nwidth:180px;\r\nfloat:left;\r\n}\r\n\r\n/* _footer ==========================================*/\r\ndiv#footer {\r\nwidth:800px;\r\nfloat:left;\r\nheight:50px;\r\nborder-top:1px dotted #696969;\r\npadding:5px 0 0;\r\nmargin-right:-3px;\r\n}\r\n\r\ndiv.copyright {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:100;\r\ncolor:#5a9096;\r\ntext-align:left;\r\nwidth:300px;\r\nfloat:left;\r\n}\r\n\r\ndiv.norexlink {\r\nfloat:right;\r\ntext-align:right;\r\nwidth:400px;\r\n}\r\n\r\ndiv.norexlink a {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:12px;\r\nfont-weight:700;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\ndiv.norexlink a:hover {\r\nbackground-image:url(/images/bg.jpg);\r\nbackground-repeat:repeat-x;\r\ncolor:#5a9096;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\n/* _customEnd ==========================================\r\n _contentStyles ==========================================*/\r\np {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\nfont-weight:100;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\na {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ntext-decoration:none;\r\ncolor:#a4c93d;\r\nfont-weight:700;\r\nfont-size:14px;\r\nmargin:0;\r\npadding:0;\r\n}\r\n\r\n\r\na:hover {\r\ncolor:#5a9096;\r\n}\r\n\r\ndiv#rightCol a:hover {\r\ncolor:#f3a800;\r\n}\r\n\r\nh1 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#5a9096;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:24px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh2 a {\r\nfont-size:18px;\r\n}\r\n\r\nh3 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:18px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh4 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:14px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh5 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#a4c93d;\r\nfont-size:12px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh6 {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\ncolor:#5a9096;\r\nfont-size:9px;\r\nfont-weight:700;\r\nmargin:0;\r\npadding:0 0 10px;\r\n}\r\n\r\nul,ol {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:14px;\r\ncolor:#696969;\r\nmargin:0;\r\npadding:0 0 0 30px;\r\n}\r\n\r\nul {\r\nlist-style-image:url(/images/bullet.jpg);\r\n}\r\n\r\n/* _contentStylesEnd ==========================================\r\n _custom ==========================================*/\r\ndiv.divider {\r\nheight:1px;\r\nline-height:1px;\r\nwidth:180px;\r\nborder-top:1px dotted #696969;\r\nfloat:left;\r\nmargin:10px 0 0;\r\npadding:0 0 10px;\r\n}\r\n\r\nh1.bannerText {\r\nfont-family:Trebuchet MS, Arial, sans-serif;\r\nfont-size:24px;\r\ncolor:#fff;\r\nfont-weight:700;\r\nfloat:left;\r\nwidth:320px;\r\nmargin:0;\r\npadding:20px 0 10px;\r\n}\r\n\r\nh1.bannerText b {\r\ncolor:#a4c93d;\r\n}\r\n\r\ndiv#banner img {\r\nfloat:left;\r\nclear:left;\r\npadding:10px 0 0;\r\n}\r\n\r\ndiv#navSpacer {\r\nfloat:left;\r\nheight:41px;\r\n}\r\n\r\ndiv#rightCol a {\r\ncolor:#5a9096;\r\n}\r\n\r\n\r\n', '2008-08-11 09:16:16', 66);
INSERT INTO `templates` VALUES ('CMS', 'site.tpl', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<meta name="keywords" content="{$metaKeywords}" />\r\n<meta name="description" content="{$metaDescription}" />\r\n<meta name="title" content="{$metaTitle}" />\r\n<title>Safe Ballot | The Intelligent Solution to Online Voting Systems</title>\r\n<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css" />\r\n<script type="text/javascript" src="/js/prototype.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n<center>\r\n	<!--Begin Container-->\r\n	<div id="container">\r\n		<!--Begin Header-->\r\n\r\n		<div id="header">\r\n			<div id="logo">\r\n				 \r\n			</div>\r\n			<!--Begin Nav-->\r\n			<div id="navSpacer"> </div>\r\n			{module class="Menu"}\r\n		</div>\r\n		<div id="banner">\r\n			<h1 class="bannerText">The <b>easy</b> and <b>intelligent</b> way to create user-friendly, informative surveys for an <b>unlimited</b> number of applications!</h1>\r\n\r\n			<a href="#"><img src="/images/joinBtn.png" border="0" alt="Join Now!" /></a>\r\n		</div>\r\n		<div id="mainContent">\r\n			<div id="leftCol">\r\n				{module class=$module}\r\n			</div>\r\n			<div id="rightCol">\r\n				BLOCK CODE HERE\r\n			</div>\r\n		</div>\r\n		<div id="footer">\r\n			<div class="copyright">\r\n				Copyright © 2008 Safe Ballot\r\n			</div>\r\n\r\n			<div class="norexlink">\r\n				<a href="http://www.norex.ca" target="_blank">Site by Norex</a>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</center>\r\n</body>\r\n</html>\r\n\r\n\r\n', '2008-08-15 15:27:45', 67);
INSERT INTO `templates` VALUES ('CMS', 'site.tpl', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<meta name="keywords" content="{$metaKeywords}" />\r\n<meta name="description" content="{$metaDescription}" />\r\n<meta name="title" content="{$metaTitle}" />\r\n<title>Safe Ballot | The Intelligent Solution to Online Voting Systems</title>\r\n<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css" />\r\n<script type="text/javascript" src="/js/prototype.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n<center>\r\n	<!--Begin Container-->\r\n	<div id="container">\r\n		<!--Begin Header-->\r\n\r\n		<div id="header">\r\n			<div id="logo">\r\n				 \r\n			</div>\r\n			<!--Begin Nav-->\r\n			<div id="navSpacer"> </div>\r\n			{module class="Menu"}\r\n		</div>\r\n		<div id="banner">\r\n			<h1 class="bannerText">The <b>easy</b> and <b>intelligent</b> way to create user-friendly, informative surveys for an <b>unlimited</b> number of applications!</h1>\r\n\r\n			<a href="#"><img src="/images/joinBtn.png" border="0" alt="Join Now!" /></a>\r\n		</div>\r\n		<div id="mainContent">\r\n			<div id="leftCol">\r\n				{module class=$module}\r\n			</div>\r\n			<div id="rightCol">\r\n				{if $module!="Campaigns"}\r\n					{module class="Campaigns"}\r\n				{/if}\r\n				{module class="Blocks"}\r\n			</div>\r\n		</div>\r\n		<div id="footer">\r\n			<div class="copyright">\r\n				Copyright © 2008 Safe Ballot\r\n			</div>\r\n\r\n			<div class="norexlink">\r\n				<a href="http://www.norex.ca" target="_blank">Site by Norex</a>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</center>\r\n</body>\r\n</html>\r\n\r\n\r\n\r\n', '2008-08-18 16:01:53', 68);
INSERT INTO `templates` VALUES ('CMS', 'site.tpl', '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />\r\n<meta name="keywords" content="{$metaKeywords}" />\r\n<meta name="description" content="{$metaDescription}" />\r\n<meta name="title" content="{$metaTitle}" />\r\n<title>Safe Ballot | The Intelligent Solution to Online Voting Systems</title>\r\n<link rel="stylesheet" href="/css/style.css,/css/cssMenus.css{foreach from=$css item=cssUrl},{$cssUrl}{/foreach}" type="text/css" />\r\n<script type="text/javascript" src="/js/prototype.js{foreach from=$js item=jsUrl},{$jsUrl}{/foreach}"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n<center>\r\n	<!--Begin Container-->\r\n	<div id="container">\r\n		<!--Begin Header-->\r\n\r\n		<div id="header">\r\n			<div id="logo">\r\n				 \r\n			</div>\r\n			<!--Begin Nav-->\r\n			<div id="navSpacer"> </div>\r\n			{module class="Menu"}\r\n		</div>\r\n		<div id="banner">\r\n			<h1 class="bannerText">The <b>easy</b> and <b>intelligent</b> way to create user-friendly, informative surveys for an <b>unlimited</b> number of applications!</h1>\r\n\r\n			<a href="/Vote/register"><img src="/images/joinBtn.png" border="0" alt="Join Now!" /></a>\r\n		</div>\r\n		<div id="mainContent">\r\n			<div id="leftCol">\r\n				{module class=$module}\r\n			</div>\r\n			<div id="rightCol">\r\n				{if $module!="Campaigns"}\r\n					{module class="Campaigns"}\r\n				{/if}\r\n				{module class="Blocks"}\r\n			</div>\r\n		</div>\r\n		<div id="footer">\r\n			<div class="copyright">\r\n				Copyright © 2008 Safe Ballot\r\n			</div>\r\n\r\n			<div class="norexlink">\r\n				<a href="http://www.norex.ca" target="_blank">Site by Norex</a>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</center>\r\n</body>\r\n</html>\r\n\r\n\r\n\r\n\r\n', '2008-08-19 14:36:05', 69);
ERROR 1045 (28000): Access denied for user 'root'@'localhost' (using password: YES)
ERROR 1045 (28000): Access denied for user 'admin'@'localhost' (using password: YES)
ERROR 1045 (28000): Access denied for user 'root'@'localhost' (using password: YES)
ERROR 1045 (28000): Access denied for user 'root'@'localhost' (using password: YES)

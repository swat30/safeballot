-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 23, 2008 at 04:54 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `trunk`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `menu`
-- 

DROP TABLE IF EXISTS `menu`;
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `menu_loaded`
-- 

DROP TABLE IF EXISTS `menu_loaded`;
CREATE TABLE `menu_loaded` (
  `id` int(11) NOT NULL auto_increment,
  `menu` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 15, 2008 at 03:58 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `safeballot`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `campaign_choices`
-- 

CREATE TABLE `campaign_choices` (
  `id` int(11) NOT NULL auto_increment,
  `campaign_id` int(11) NOT NULL,
  `choice` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `campaign_hash_requests`
-- 

CREATE TABLE `campaign_hash_requests` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`IP` VARCHAR( 64 ) NOT NULL ,
`email` TEXT NOT NULL ,
`date` DATE NOT NULL
) ENGINE = MYISAM ;
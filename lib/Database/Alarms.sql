-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2015 at 10:55 AM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

USE Alarms;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Alarms`
--

-- --------------------------------------------------------

--
-- Table structure for table `Carwash_alarms`
--

CREATE TABLE IF NOT EXISTS `Carwash_alarms` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `ifsf_id` int(11) NOT NULL,
  `alarm_type` int(10) NOT NULL,
  `prog_number` int(10) NOT NULL,
  `line_number` int(10) NOT NULL,
  `operation_mode` int(10) NOT NULL,
  `program_step` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=255 ;


CREATE TABLE IF NOT EXISTS `Ifsf_alarm_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ifsf_id` int(10) NOT NULL,
  `alarm_type` int(10) NOT NULL,
  `visibility` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `Ifsf_alarm_table`
--

INSERT INTO `Ifsf_alarm_table` (`id`, `ifsf_id`, `alarm_type`, `visibility`) VALUES
(3, 4, 88, 1),
(4, 4, 92, 1),
(5, 4, 104, 1),
(6, 4, 105, 1),
(7, 4, 106, 1),
(8, 5, 80, 1),
(9, 5, 81, 1),
(10, 5, 82, 1),
(11, 5, 99, 1),
(12, 5, 109, 1),
(13, 6, 83, 1),
(14, 12, 91, 1),
(15, 13, 93, 1),
(16, 13, 94, 1),
(17, 14, 95, 1),
(18, 15, 85, 1),
(19, 15, 86, 1),
(20, 15, 87, 1),
(21, 15, 89, 1),
(22, 15, 90, 1),
(23, 33, 116, 1),
(24, 33, 117, 1),
(25, 33, 118, 1),
(26, 33, 121, 1),
(27, 37, 84, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Ifsf_error_data`
--

CREATE TABLE IF NOT EXISTS `Ifsf_error_data` (
  `ifsf_error` tinyint(1) unsigned NOT NULL,
  `manufacturer_code` tinyint(1) unsigned NOT NULL,
  `error_state` tinyint(1) unsigned NOT NULL,
  `count` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`ifsf_error`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

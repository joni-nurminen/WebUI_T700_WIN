-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2014 at 09:09 AM
-- Server version: 5.1.66
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `t700_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `CheckSum2`
--

CREATE TABLE IF NOT EXISTS `CheckSum2` (
  `sum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CheckSum2`
--

INSERT INTO `CheckSum2` (`sum`) VALUES
(20);

-- --------------------------------------------------------

--
-- Table structure for table `Lang2`
--

CREATE TABLE IF NOT EXISTS `Lang2` (
  `language` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lang2`
--

INSERT INTO `Lang2` (`language`) VALUES
('uk');

-- --------------------------------------------------------

--
-- Table structure for table `LoadedSet2`
--

CREATE TABLE IF NOT EXISTS `LoadedSet2` (
  `set_number` int(11) NOT NULL,
  `synced_set` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LoadedSet2`
--

INSERT INTO `LoadedSet2` (`set_number`, `synced_set`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Password2`
--

CREATE TABLE IF NOT EXISTS `Password2` (
  `pass` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Password2`
--

INSERT INTO `Password2` (`pass`) VALUES
('');

-- --------------------------------------------------------

--
-- Table structure for table `UserIp2`
--

CREATE TABLE IF NOT EXISTS `UserIp2` (
  `ip` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UserIp2`
--

INSERT INTO `UserIp2` (`ip`, `user`, `time_in`, `time_out`) VALUES
('12.12.12.12.', 'Kekkone', '2014-07-17 16:44:16', '2014-07-31 16:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `Users2`
--

CREATE TABLE IF NOT EXISTS `Users2` (
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users2`
--

INSERT INTO `Users2` (`username`, `password`) VALUES
('Importer', '8cb2237d0679ca88db6464eac60da96345513964'),
('TM', '8cb2237d0679ca88db6464eac60da96345513964'),
('Admin', '8cb2237d0679ca88db6464eac60da96345513964'),
('Operator', '8cb2237d0679ca88db6464eac60da96345513964'),
('Chain', '8cb2237d0679ca88db6464eac60da96345513964');

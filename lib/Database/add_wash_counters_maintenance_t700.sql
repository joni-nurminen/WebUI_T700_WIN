-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2015 at 09:21 AM
-- Server version: 5.5.32
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wash_counters_t700`
--

-- --------------------------------------------------------

--
-- Table structure for table `WashCountersMaintenance`
--

CREATE TABLE IF NOT EXISTS `WashCountersMaintenance` (
  `Timestamp` int(255) NOT NULL,
  `Program1` int(11) NOT NULL,
  `Program2` int(11) NOT NULL,
  `Program3` int(11) NOT NULL,
  `Program4` int(11) NOT NULL,
  `Program5` int(11) NOT NULL,
  `Program6` int(11) NOT NULL,
  `Program7` int(11) NOT NULL,
  `Program8` int(11) NOT NULL,
  `Program9` int(11) NOT NULL,
  `Program10` int(11) NOT NULL,
  `Program11` int(11) NOT NULL,
  `Program12` int(11) NOT NULL,
  `Program13` int(11) NOT NULL,
  `Program14` int(11) NOT NULL,
  `Program15` int(11) NOT NULL,
  `Program16` int(11) NOT NULL,
  `Program17` int(11) NOT NULL,
  `Program18` int(11) NOT NULL,
  `Program19` int(11) NOT NULL,
  `Program20` int(11) NOT NULL,
  `Program21` int(11) NOT NULL,
  `Program22` int(11) NOT NULL,
  `Program23` int(11) NOT NULL,
  `Program24` int(11) NOT NULL,
  `Program25` int(11) NOT NULL,
  `Program26` int(11) NOT NULL,
  `Program27` int(11) NOT NULL,
  `Program28` int(11) NOT NULL,
  `Program29` int(11) NOT NULL,
  `Program30` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `WashCountersMaintenance`
--

INSERT INTO `WashCountersMaintenance` (`Timestamp`, `Program1`, `Program2`, `Program3`, `Program4`, `Program5`, `Program6`, `Program7`, `Program8`, `Program9`, `Program10`, `Program11`, `Program12`, `Program13`, `Program14`, `Program15`, `Program16`, `Program17`, `Program18`, `Program19`, `Program20`, `Program21`, `Program22`, `Program23`, `Program24`, `Program25`, `Program26`, `Program27`, `Program28`, `Program29`, `Program30`) VALUES
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

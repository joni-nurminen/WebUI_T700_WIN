-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2015 at 10:38 AM
-- Server version: 5.1.66
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wash_counters_t700`
--

-- --------------------------------------------------------

--
-- Table structure for table `WashCounters`
--

USE wash_counters_t700;

ALTER TABLE  `WashCounters` ADD  `Timestamp` INT( 255 ) NOT NULL FIRST;

ALTER TABLE  `WashCounters2` ADD  `Timestamp` INT( 255 ) NOT NULL FIRST;

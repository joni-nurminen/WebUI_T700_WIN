-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Palvelin: localhost
-- Luontiaika: 08.04.2016 klo 10:15
-- Palvelimen versio: 5.5.32
-- PHP:n versio: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Tietokanta: `Ifsf`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `Ifsf_alarm_table`
--

DROP TABLE IF EXISTS `Ifsf_alarm_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ifsf_alarm_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ifsf_id` int(10) NOT NULL,
  `alarm_type` int(10) NOT NULL,
  `visibility` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ifsf_alarm_table`
--
/* (10,12,91,1), TODO: E-Stop ? */
LOCK TABLES `Ifsf_alarm_table` WRITE;
/*!40000 ALTER TABLE `Ifsf_alarm_table` DISABLE KEYS */;
INSERT INTO `Ifsf_alarm_table` (`id`, `ifsf_id`, `alarm_type`, `visibility`) VALUES
(1,4,88,1),
(2,4,92,1),
(3,4,104,1),
(4,4,105,1),
(5,4,106,1),
(6,5,81,1),
(7,5,82,1),
(8,5,99,1),
(9,5,109,1),
(10,13,93,1),
(11,14,96,1),
(12,15,85,1),
(13,15,86,1),
(14,15,87,1),
(15,15,89,1),
(16,33,83,1),
(17,33,116,1),
(18,33,117,1),
(19,33,118,1),
(20,33,119,1),
(21,33,121,1),
(22,37,84,1),
(23,39,100,1),
(24,39,101,1),
(25,39,122,1),
(26,39,123,1),
(27,40,90,1),
(28,40,91,1),
(29,40,94,1),
(30,40,95,1),
(31,40,97,1),
(32,40,98,1),
(33,40,102,1),
(34,40,103,1),
(35,40,108,1),
(36,40,110,1),
(37,40,111,1),
(38,40,112,1),
(39,40,113,1),
(40,40,114,1),
(41,40,115,1),
(42,40,120,1),
(43,56,56,1),
(44,57,57,1),
(45,40,0,1);


/*!40000 ALTER TABLE `Ifsf_alarm_table` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

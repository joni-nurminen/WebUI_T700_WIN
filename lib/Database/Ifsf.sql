-- MySQL dump 10.11
--
-- Host: localhost    Database: Ifsf
-- ------------------------------------------------------
-- Server version	5.0.95

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Carwash_alarms`
--

DROP TABLE IF EXISTS `Carwash_alarms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Carwash_alarms` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `ifsf_id` int(11) NOT NULL,
  `alarm_type` int(10) NOT NULL,
  `prog_number` int(10) NOT NULL,
  `line_number` int(10) NOT NULL,
  `operation_mode` int(10) NOT NULL,
  `program_step` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`,`timestamp`)
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Carwash_alarms`
--

LOCK TABLES `Carwash_alarms` WRITE;
/*!40000 ALTER TABLE `Carwash_alarms` DISABLE KEYS */;
INSERT INTO `Carwash_alarms` VALUES (256,57,57,0,0,7,57,'2015-07-30 13:03:00'),(495,5,81,0,0,0,3,'2015-04-29 10:47:00');
/*!40000 ALTER TABLE `Carwash_alarms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ifsf_alarm_table`
--

DROP TABLE IF EXISTS `Ifsf_alarm_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ifsf_alarm_table` (
  `id` int(11) NOT NULL auto_increment,
  `ifsf_id` int(10) NOT NULL,
  `alarm_type` int(10) NOT NULL,
  `visibility` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ifsf_alarm_table`
--

LOCK TABLES `Ifsf_alarm_table` WRITE;
/*!40000 ALTER TABLE `Ifsf_alarm_table` DISABLE KEYS */;
INSERT INTO `Ifsf_alarm_table` VALUES (1,4,88,1),(2,4,92,1),(3,4,104,1),(4,4,105,1),(5,4,106,1),(6,5,81,1),(7,5,82,1),(8,5,99,1),(9,5,109,1),(10,13,93,1),(11,14,96,1),(12,15,85,1),(13,15,86,1),(14,15,87,1),(15,15,89,1),(16,33,83,1),(17,33,116,1),(18,33,117,1),(19,33,118,1),(20,33,119,1),(21,33,121,1),(22,37,84,1),(23,39,100,1),(24,39,101,1),(25,39,122,1),(26,39,123,1),(27,40,90,1),(28,40,91,1),(29,40,94,1),(30,40,95,1),(31,40,97,1),(32,40,98,1),(33,40,102,1),(34,40,103,1),(35,40,108,1),(36,40,110,1),(37,40,111,1),(38,40,112,1),(39,40,113,1),(40,40,114,1),(41,40,115,1),(42,40,120,1),(43,56,56,1),(44,57,57,1),(45,40,0,1);
/*!40000 ALTER TABLE `Ifsf_alarm_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ifsf_error_data`
--

DROP TABLE IF EXISTS `Ifsf_error_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ifsf_error_data` (
  `ifsf_error` tinyint(1) unsigned NOT NULL,
  `manufacturer_code` tinyint(1) unsigned NOT NULL,
  `error_state` tinyint(1) unsigned NOT NULL,
  `count` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY  (`ifsf_error`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ifsf_error_data`
--

LOCK TABLES `Ifsf_error_data` WRITE;
/*!40000 ALTER TABLE `Ifsf_error_data` DISABLE KEYS */;
INSERT INTO `Ifsf_error_data` VALUES (0,255,3,0);
/*!40000 ALTER TABLE `Ifsf_error_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ifsf_conf`
--

DROP TABLE IF EXISTS `ifsf_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ifsf_conf` (
  `server_lon_addr` varchar(50) NOT NULL default '0',
  `cw_lon_addr` varchar(50) NOT NULL default '0',
  `cw_lon_dev` varchar(50) NOT NULL default '0',
  `code_veh_ord` varchar(50) NOT NULL default '0',
  `stand_alone_auth` varchar(50) NOT NULL default '0',
  `ifsf_bus` varchar(50) NOT NULL default '0',
  `ifsf_version` varchar(30) NOT NULL,
  `uniqueId` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`uniqueId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ifsf_conf`
--

LOCK TABLES `ifsf_conf` WRITE;
/*!40000 ALTER TABLE `ifsf_conf` DISABLE KEYS */;
INSERT INTO `ifsf_conf` VALUES ('0201','0a01','/dev/lon/mip0','1','0','0','    T700 1.9',1);
/*!40000 ALTER TABLE `ifsf_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ifsf_transactions`
--

DROP TABLE IF EXISTS `ifsf_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ifsf_transactions` (
  `id` int(11) NOT NULL auto_increment,
  `sequenceNumber` varchar(30) NOT NULL,
  `controlID` varchar(30) NOT NULL,
  `releaseKey` varchar(30) NOT NULL,
  `washingMode` varchar(30) NOT NULL,
  `totalAmount` varchar(30) NOT NULL,
  `washingCode` varchar(30) NOT NULL,
  `optionsMask` varchar(30) NOT NULL,
  `programmeMask` varchar(30) NOT NULL,
  `programmeDescription` varchar(30) NOT NULL,
  `errorCode` varchar(30) NOT NULL,
  `washSeconds` varchar(30) NOT NULL,
  `entrySeconds` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ifsf_transactions`
--

LOCK TABLES `ifsf_transactions` WRITE;
/*!40000 ALTER TABLE `ifsf_transactions` DISABLE KEYS */;
INSERT INTO `ifsf_transactions` VALUES (1,'2','','','','','','','1','','0','','');
/*!40000 ALTER TABLE `ifsf_transactions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-04 11:26:10

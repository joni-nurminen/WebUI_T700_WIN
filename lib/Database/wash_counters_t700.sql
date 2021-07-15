-- MySQL dump 10.11
--
-- Host: localhost    Database: wash_counters_t700
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
-- Table structure for table `WashCounters`
--

DROP TABLE IF EXISTS `WashCounters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WashCounters` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WashCounters`
--

LOCK TABLES `WashCounters` WRITE;
/*!40000 ALTER TABLE `WashCounters` DISABLE KEYS */;
INSERT INTO `WashCounters` VALUES (82928,657,484,70,95,51,1,54,104,54,134,51,0,185,199,0,6,6,72,68,18,0,5,30,3,31,25,27,75,77,521);
/*!40000 ALTER TABLE `WashCounters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WashCounters2`
--

DROP TABLE IF EXISTS `WashCounters2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WashCounters2` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WashCounters2`
--

LOCK TABLES `WashCounters2` WRITE;
/*!40000 ALTER TABLE `WashCounters2` DISABLE KEYS */;
INSERT INTO `WashCounters2` VALUES (1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `WashCounters2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WashCountersMaintenance`
--

DROP TABLE IF EXISTS `WashCountersMaintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WashCountersMaintenance` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WashCountersMaintenance`
--

LOCK TABLES `WashCountersMaintenance` WRITE;
/*!40000 ALTER TABLE `WashCountersMaintenance` DISABLE KEYS */;
INSERT INTO `WashCountersMaintenance` VALUES (0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `WashCountersMaintenance` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-15 10:32:57

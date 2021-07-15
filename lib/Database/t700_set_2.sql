-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: t700
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `savedprograms`
--

DROP TABLE IF EXISTS `savedprograms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `savedprograms` (
  `SlotNumber` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `MainProgram` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `LangIdMain` int(11) NOT NULL,
  `Cmr_MainProgram` int(11) DEFAULT NULL,
  `PassStyle` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `SideProgram1` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `LangIdSide1` int(11) NOT NULL,
  `Cmr_SideProgram1` int(11) DEFAULT NULL,
  `SideProgram2` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `LangIdSide2` int(11) NOT NULL,
  `Cmr_SideProgram2` int(11) DEFAULT NULL,
  `SideProgram3` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `LangIdSide3` int(11) NOT NULL,
  `Cmr_SideProgram3` int(11) DEFAULT NULL,
  `SideProgram4` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `LangIdSide4` int(11) NOT NULL,
  `Cmr_SideProgram4` int(11) DEFAULT NULL,
  `SideProgram5` text COLLATE utf8_unicode_ci NOT NULL,
  `LangIdSide5` int(11) NOT NULL,
  `Cmr_SideProgram5` int(11) NOT NULL,
  `Speed_MainProgram` int(11) NOT NULL,
  `Direction` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Program_Type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Set_Number` int(11) NOT NULL,
  PRIMARY KEY (`SlotNumber`,`id`),
  KEY `Cmr_MainProgram` (`Cmr_MainProgram`),
  KEY `Cmr_MainProgram_2` (`Cmr_MainProgram`),
  KEY `Direction_2` (`Direction`),
  FULLTEXT KEY `Direction_3` (`Direction`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `savedprograms`
--

LOCK TABLES `savedprograms` WRITE;
/*!40000 ALTER TABLE `savedprograms` DISABLE KEYS */;
INSERT INTO `savedprograms` VALUES (4,5,'HARJAT',9,0,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(13,7,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(14,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(13,5,'HARJAT',9,0,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(13,6,'LOISTOVAHA',23,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(14,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,5,'HARJAT',9,0,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(5,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(13,8,'RAINLUX',24,40,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,8,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(10,7,'LOISTOVAHA',23,85,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,5,'HARJAT',9,0,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(9,8,'KIILLOTUS',16,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(13,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(13,3,'KATTOKP',8,50,'FC','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(30,9,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,8,'LOISTOVAHA',23,85,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,7,'HARJAT',9,0,'FC','PYORAT',6,50,'VESIHUUHTELU',10,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,6,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,5,'ESIPESU1',1,45,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,10,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,1,'ESIPESU1',1,100,'FC','PAKU',18,50,'PYORAESIPESU',20,15,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,10,'RAINLUX',24,80,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,11,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,12,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(30,13,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(14,5,'HARJAT',9,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(14,6,'LOISTOVAHA',23,85,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(13,9,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(13,10,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(6,6,'HARJAVAHA',15,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,7,'KIILLOTUS',16,65,'FC','RAINLUX',24,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,6,'HARJAVAHA',15,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,6,'HARJAVAHA',15,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(10,6,'HARJAT',9,0,'FC','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(9,7,'LOISTOVAHA',23,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,6,'HARJAT',9,0,'FC','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(8,6,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,9,'RAINLUX',24,40,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,10,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(9,5,'ESIPESU1',1,15,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(14,7,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(14,8,'RAINLUX',24,65,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(12,5,'HARJAT',9,0,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(6,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,5,'>>>','none',0),(4,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,4,'HARJAT',9,1,'RS','ALUSTA',5,50,'RAINLUX',24,50,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(3,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(2,3,'HARJAT',9,65,'FC','SIVUKP',7,50,'KPHUUHTELU',11,30,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(3,3,'PYORAT',6,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(2,2,'PYORAT',6,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(15,6,'VESIHUUHTELU',10,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(7,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,20,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,11,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,5,'ESIPESU1',1,15,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,6,'LOISTOVAHA',23,30,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,7,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(12,8,'RAINLUX',24,40,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,4,'>>>','none',0),(8,7,'HARJAT',9,0,'FC','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(12,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,5,'>>>','none',0),(12,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,8,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(10,9,'RAINLUX',24,65,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,6,'<<<','none',0),(14,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(14,1,'ESIPESU1',1,30,'FO','PAKU',18,50,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(3,4,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(15,5,'HARJAT',9,50,'FC','PYORAT',6,70,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,5,'HARJAT',9,0,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,6,'HARJAVAHA',15,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(3,1,'ESIPESU1',1,100,'FO','PAKU',18,100,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(7,2,'VAAHTO',3,65,'','ALUSTA',5,100,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,5,'>>>','none',0),(7,1,'ESIPESU1',1,65,'FC','PAKU',18,100,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(27,7,'HARJAT',9,45,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(27,8,'HARJAT',9,0,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(27,9,'KATTOKP',8,50,'FC','SIVUKP',7,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(27,10,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(27,11,'KUIVAUSVAHA',14,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','winter_program',0),(27,12,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(27,13,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(27,14,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(25,9,'KUIVAUSVAHA',14,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','winter_program',0),(25,8,'VESIHUUHTELU',10,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(25,7,'HARJAT',9,0,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(25,6,'HARJAT',9,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(25,5,'KATTOKP',8,50,'SB','SIVUKP',7,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(25,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(25,3,'VAAHTO',3,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(25,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(25,1,'ESIPESU1',1,65,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(25,10,'KUIVAUS',17,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(25,11,'KUIVAUS',17,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(27,6,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(27,5,'SIVUKP',7,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(27,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(27,3,'PYORAT',6,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(27,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(27,1,'ESIPESU1',1,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','winter_program',0),(1,3,'HARJAT',9,65,'FC','SIVUKP',7,65,'KPHUUHTELU',11,30,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(1,4,'HARJAT',9,65,'RS','KUIVAUSVAHA',14,1,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(8,5,'ESIPESU1',1,15,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(16,1,'SKANNAUS',25,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(16,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(16,3,'HARJAT',9,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(16,4,'HARJAT',9,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(1,2,'KATTOKP',8,50,'FC','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(2,5,'KUIVAUS',17,51,'FC','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(3,5,'SIVUKP',7,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(6,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,7,'KIILLOTUS',16,65,'FC','KUIVAUSVAHA',14,65,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(7,8,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(7,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(8,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(9,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(9,3,'KATTOKP',8,50,'FC','SIVUKP',7,15,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(10,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(11,9,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(12,9,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,10,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(12,11,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(13,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(13,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(13,11,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(14,9,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(14,10,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(14,11,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,7,'KIILLOTUS',16,65,'FC','LOISTOVAHA',23,70,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,8,'KUIVAUSVAHA',14,50,'','RENGASKIILLOTIN',22,40,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(5,7,'KIILLOTUS',16,65,'FC','RAINLUX',24,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,8,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(4,7,'KIILLOTUS',16,65,'FC','RAINLUX',24,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,8,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(1,5,'KIILLOTUS',16,65,'FC','LOISTOVAHA',23,70,'KUIVAUSVAHA',14,1,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(8,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,4,'HARJAT',9,65,'FC','KPHUUHTELU',11,30,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(15,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(29,1,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(29,2,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,8,'LOISTOVAHA',23,30,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,9,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,10,'RAINLUX',24,40,'','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(17,1,'ESIPESU1',1,100,'NF','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(17,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(11,8,'LOISTOVAHA',23,35,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(11,7,'HARJAT',9,0,'FC','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','winter_program',0),(11,6,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(11,5,'ESIPESU1',1,59,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(8,11,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(8,12,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,13,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(10,1,'ESIPESU1',1,40,'FC','PAKU',18,50,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,10,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(10,11,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(1,1,'ESIPESU1',1,88,'NF','PAKU',18,70,'PYORAESIPESU',20,88,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(2,1,'ESIPESU1',1,88,'FO','PYORAESIPESU',20,88,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(3,6,'RAINLUX',24,80,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,5,'>>>','winter_program',0),(3,7,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,5,'<<<','winter_program',0),(11,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','winter_program',0),(11,4,'HARJAT',9,50,'FC','KPHUUHTELU',11,20,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','winter_program',0),(11,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,9,'>>>','winter_program',0),(11,1,'ESIPESU1',1,100,'FC','PAKU',18,100,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(11,10,'KUIVAUSVAHA',14,80,'','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','winter_program',0),(11,11,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','winter_program',0),(11,12,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'<<<','winter_program',0),(11,13,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(15,9,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(15,10,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(15,2,'VAAHTO',3,65,'','ALUSTA',5,50,'PYORAT',6,50,'',0,0,'',0,0,'',0,0,5,'>>>','none',0),(15,1,'ESIPESU1',1,100,'FC','PAKU',18,100,'PYORAESIPESU',20,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,11,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,6,'RAINLUX',24,35,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','winter_program',0),(1,7,'KUIVAUS',17,51,'FC','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','winter_program',0),(1,8,'KUIVAUS',17,51,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','winter_program',0),(2,6,'KUIVAUS',17,51,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','winter_program',0);
/*!40000 ALTER TABLE `savedprograms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-22 11:16:45

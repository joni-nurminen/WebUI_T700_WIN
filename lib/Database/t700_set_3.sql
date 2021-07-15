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
INSERT INTO `savedprograms` VALUES (1,1,'SKANNAUS',25,100,'FO','PYORAESIPESU',20,100,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,2,'ESIPESU2',2,65,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,3,'ESIPESU1',1,65,'NF','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(1,5,'SIVUKP',7,50,'','PYORAT',6,100,'',0,0,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(1,6,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(1,7,'VAHA',13,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(1,8,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(2,8,'RAINLUX',24,60,'','RENGASKIILLOTIN',22,45,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(2,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(2,7,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(2,6,'SIVUKP',7,50,'','PYORAT',6,100,'',0,0,'',0,0,'',0,0,'',0,0,5,'>>>','none',0),(2,5,'LAAVAVAAHTO',26,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'<<<','none',0),(2,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(2,2,'ESIPESU2',2,65,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,3,'ESIPESU1',1,65,'NF','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,1,'SKANNAUS',25,100,'FO','PYORAESIPESU',20,100,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,1,'SKANNAUS',25,100,'NF','ESIPESU1',1,65,'PYORAESIPESU',20,100,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,2,'VAAHTO',3,65,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(3,3,'HARJAT',9,61,'FC','SIVUKP',7,100,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,4,'HARJAT',9,60,'FC','KPHUUHTELU',11,30,'VAHA',13,65,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(3,5,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,6,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(4,1,'SKANNAUS',25,100,'NF','ESIPESU1',1,65,'PYORAESIPESU',20,86,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,2,'VAAHTO',3,65,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,3,'KATTOKP',8,50,'FC','SIVUKP',7,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,4,'HARJAT',9,61,'FC','ALUSTA',5,65,'KPHUUHTELU',11,30,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,5,'HARJAT',9,61,'FC','VAHA',13,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,6,'VAHA',13,60,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,7,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,8,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(5,1,'SKANNAUS',25,100,'FO','ESIPESU2',2,86,'PYORAESIPESU',20,86,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,2,'ESIPESU1',1,65,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,3,'LAAVAVAAHTO',26,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'<<<','none',0),(5,4,'KATTOKP',8,50,'FC','PYORAT',6,86,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,5,'HARJAT',9,61,'FC','KPHUUHTELU',11,30,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,6,'HARJAT',9,61,'FC','ALUSTA',5,65,'VAHA',13,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,7,'RAINLUX',24,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(5,8,'KUIVAUS',17,50,'FC','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(6,4,'HARJAT',9,61,'FC','ALUSTA',5,86,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,3,'KATTOKP',8,50,'FC','SIVUKP',7,86,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,2,'VAAHTO',3,75,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,1,'SKANNAUS',25,100,'NF','ESIPESU1',1,86,'PYORAESIPESU',20,86,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,5,'HARJAT',9,61,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,6,'HARJAVAHA',15,80,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,7,'KIILLOTUS',16,65,'FC','VAHA',13,35,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,8,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,9,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(7,1,'SKANNAUS',25,100,'NF','ESIPESU2',2,86,'PYORAESIPESU',20,86,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,2,'PYORAT',6,51,'','ALUSTA',5,30,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(7,3,'LAAVAVAAHTO',26,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'<<<','none',0),(7,4,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(7,5,'HARJAT',9,61,'FC','SIVUKP',7,86,'KPHUUHTELU',11,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,6,'HARJAT',9,61,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(7,7,'KIILLOTUS',16,65,'FC','HARJAVAHA',15,95,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,8,'KIILLOTUS',16,65,'FC','RAINLUX',24,40,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(7,9,'KUIVAUS',17,50,'FC','RENGASKIILLOTIN',22,45,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,10,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0);
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

-- Dump completed on 2020-01-21  9:40:45

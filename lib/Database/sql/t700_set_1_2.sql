-- MySQL dump 10.13  Distrib 5.1.66, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: t700
-- ------------------------------------------------------
-- Server version	5.1.66-0+squeeze1

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
-- Table structure for table `SavedPrograms2`
--

DROP TABLE IF EXISTS `SavedPrograms2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SavedPrograms2` (
  `SlotNumber` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `MainProgram` text COLLATE utf8_unicode_ci,
  `LangIdMain` int(11) NOT NULL,
  `Cmr_MainProgram` int(11) DEFAULT NULL,
  `PassStyle` text COLLATE utf8_unicode_ci,
  `SideProgram1` text COLLATE utf8_unicode_ci,
  `LangIdSide1` int(11) NOT NULL,
  `Cmr_SideProgram1` int(11) DEFAULT NULL,
  `SideProgram2` text COLLATE utf8_unicode_ci,
  `LangIdSide2` int(11) NOT NULL,
  `Cmr_SideProgram2` int(11) DEFAULT NULL,
  `SideProgram3` text COLLATE utf8_unicode_ci,
  `LangIdSide3` int(11) NOT NULL,
  `Cmr_SideProgram3` int(11) DEFAULT NULL,
  `SideProgram4` text COLLATE utf8_unicode_ci,
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
-- Dumping data for table `SavedPrograms2`
--

LOCK TABLES `SavedPrograms2` WRITE;
/*!40000 ALTER TABLE `SavedPrograms2` DISABLE KEYS */;
INSERT INTO `SavedPrograms2` VALUES (1,2,'ESIPESU2',2,65,'SB','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,3,'VESIHUUHTELU',10,50,'','KUIVAUSVAHA',14,65,'RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,2,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,2,'VESIHUUHTELU',10,50,'','KUIVAUSVAHA',14,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','summer_program',0),(7,1,'KUIVAUSVAHA',14,65,'','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(8,3,'PYORAT',6,50,'','PAKU ',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(8,2,'ESIPESU2',2,65,'PU','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(8,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(0,0,'',0,0,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,0,'','',0),(8,4,'VESIHUUHTELU',10,50,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(25,2,'VAAHTO',3,65,'','ALUSTA',5,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(25,1,'ESIPESU2',2,65,'FO','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(7,3,'ESIPESU2',2,65,'SB','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(7,4,'KUIVAUSVAHA',14,65,'','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','summer_program',0),(1,3,'VAAHTO',3,65,'','ALUSTA',5,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,4,'VAHA',13,65,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(20,1,'ESIPESU1',1,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,1,'ALUSTA',5,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(16,1,'ESIPESU2',2,65,'FC','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(17,1,'ESIPESU2',2,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(18,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,1,'ESIPESU1',1,65,'FC','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0);
/*!40000 ALTER TABLE `SavedPrograms2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-12  8:11:27

-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: t700
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.12.04.1

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
-- Table structure for table `SavedPrograms`
--

DROP TABLE IF EXISTS `SavedPrograms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SavedPrograms` (
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
-- Dumping data for table `SavedPrograms`
--

LOCK TABLES `SavedPrograms` WRITE;
/*!40000 ALTER TABLE `SavedPrograms` DISABLE KEYS */;
INSERT INTO `SavedPrograms` VALUES (8,11,'VAAHTO',3,59,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(8,10,'VAAHTO',3,59,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,9,'VAAHTO',3,59,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(8,8,'ESIPESU2',2,70,'FO','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(8,7,'ESIPESU1',1,65,'','PAKU',18,50,'SISAANESIPESU',21,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(8,6,'VAAHTO',3,59,'','KPHUUHTELU',11,50,'SISAANESIPESU',21,65,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(8,5,'VAAHTO',3,59,'','KPHUUHTELU',11,50,'SISAANESIPESU',21,65,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(8,4,'SKANNAUS',25,1,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,3,'>>>','none',0),(8,3,'ALUSTA',5,50,'','PYORAT',6,54,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,2,'ESIPESU2',2,70,'','VAIKUTUS',4,51,'PAKU',18,54,'PYORAESIPESU',20,64,'',0,0,'',0,0,8,'>>>','none',0),(8,1,'ESIPESU1',1,65,'','VAIKUTUS',4,69,'PAKU',18,50,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(13,1,'ESIPESU1',1,65,'SB','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(13,2,'ESIPESU1',1,65,'SB','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,1,'ESIPESU1',1,63,'FO','VAIKUTUS',4,47,'PAKU',18,52,'',0,0,'',0,0,'',0,0,3,'<<<','none',0),(5,2,'ESIPESU2',2,70,'FO','VAIKUTUS',4,44,'PAKU',18,54,'',0,0,'',0,0,'',0,0,4,'>>>','none',0),(6,1,'ESIPESU1',1,65,'','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(6,2,'ESIPESU2',2,70,'FO','VAIKUTUS',4,44,'PAKU',18,54,'',0,0,'',0,0,'',0,0,4,'>>>','summer_program',0),(10,1,'ESIPESU1',1,65,'SB','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,2,'ESIPESU1',1,65,'SB','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(12,1,'ESIPESU1',1,69,'FO','SISAANESIPESU',21,68,'VAAHTO',3,69,'ESIPESU2',2,65,'',0,0,'',0,0,8,'<<<','none',0),(9,10,'ESIPESU2',2,70,'FO','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(9,9,'ESIPESU1',1,65,'','PAKU',18,50,'SISAANESIPESU',21,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,8,'VAAHTO',3,59,'','KPHUUHTELU',11,50,'SISAANESIPESU',21,65,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(9,7,'VAAHTO',3,59,'','KPHUUHTELU',11,50,'SISAANESIPESU',21,65,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(9,6,'SKANNAUS',25,1,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,3,'>>>','none',0),(9,5,'PYORAT',6,59,'','ESIPESU1',1,69,'ESIPESU2',2,65,'VAAHTO',3,65,'',0,0,'',0,0,3,'<<<','none',0),(9,4,'ALUSTA',5,50,'','PYORAT',6,54,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,3,'VAAHTO',3,59,'','SISAANESIPESU',21,70,'ALUSTA',5,61,'PYORAT',6,55,'',0,0,'',0,0,8,'<<<','none',0),(9,2,'ESIPESU2',2,70,'','VAIKUTUS',4,51,'PAKU',18,54,'PYORAESIPESU',20,64,'',0,0,'',0,0,8,'>>>','none',0),(9,1,'ESIPESU1',1,65,'','VAIKUTUS',4,69,'PAKU',18,50,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(4,1,'ESIPESU2',2,65,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(12,3,'PYORAT',6,66,'','ESIPESU1',1,61,'ESIPESU2',2,63,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(12,4,'KATTOKP',8,59,'PU','SIVUKP',7,61,'PYORAT',6,63,'ALUSTA',5,50,'PAKU',18,68,'',0,0,9,'>>>','none',0),(12,5,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,6,'SKANNAUS',25,100,'SB','PYORAESIPESU',20,65,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(12,7,'SKANNAUS',25,100,'','PYORAESIPESU',20,65,'SISAANESIPESU',21,72,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,8,'SKANNAUS',25,100,'SB','PYORAESIPESU',20,69,'VAAHTO',3,65,'SISAANESIPESU',21,72,'',0,0,'',0,0,9,'>>>','none',0),(7,1,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','winter_program',0),(3,1,'ESIPESU1',1,65,'','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(3,2,'ESIPESU2',2,70,'FO','VAIKUTUS',4,44,'PAKU',18,54,'',0,0,'',0,0,'',0,0,4,'>>>','summer_program',0),(14,1,'ESIPESU1',1,63,'FO','VAIKUTUS',4,47,'PAKU',18,52,'',0,0,'',0,0,'',0,0,3,'<<<','summer_program',0),(14,2,'ESIPESU2',2,70,'FO','VAIKUTUS',4,44,'PAKU',18,54,'',0,0,'',0,0,'',0,0,4,'>>>','summer_program',0),(3,3,'ESIPESU1',1,65,'','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(3,4,'ESIPESU1',1,65,'','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'>>>','summer_program',0),(8,12,'VAAHTO',3,59,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,3,'ESIPESU1',1,65,'','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(6,4,'ESIPESU1',1,65,'','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'>>>','summer_program',0),(6,5,'ESIPESU1',1,65,'','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(17,1,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,4,'ESIPESU1',1,65,'','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(15,3,'ESIPESU1',1,65,'','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,2,'ESIPESU1',1,65,'','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(15,1,'ESIPESU1',1,65,'','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(17,2,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(17,3,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(11,4,'ESIPESU2',2,65,'SB','VAIKUTUS',4,53,'PAKU',18,43,'PYORAESIPESU',20,64,'ESIPESU1',1,70,'SISAANESIPESU',21,65,9,'>>>','none',0),(11,3,'ESIPESU2',2,68,'SB','PYORAESIPESU',20,61,'ESIPESU1',1,71,'SISAANESIPESU',21,65,'',0,0,'',0,0,7,'<<<','none',0),(11,1,'ESIPESU1',1,67,'','VAIKUTUS',4,53,'PAKU',18,46,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(11,2,'ESIPESU2',2,71,'PU','PYORAESIPESU',20,61,'ESIPESU1',1,71,'',0,0,'',0,0,'',0,0,4,'>>>','none',0),(1,3,'ESIPESU1',1,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,11,'VAAHTO',3,59,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,12,'VAAHTO',3,59,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,13,'VAAHTO',3,59,'','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,1,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(30,2,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,3,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,1,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0);
/*!40000 ALTER TABLE `SavedPrograms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-18 12:52:17

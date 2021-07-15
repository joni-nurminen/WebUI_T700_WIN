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
-- Table structure for table `IoData`
--

DROP TABLE IF EXISTS `IoData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IoData` (
  `id` int(11) NOT NULL,
  `card` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IoData`
--

LOCK TABLES `IoData` WRITE;
/*!40000 ALTER TABLE `IoData` DISABLE KEYS */;
INSERT INTO `IoData` VALUES (124,22),(123,22),(122,22),(26,2),(149,33),(28,2),(27,2),(74,4),(148,33),(25,2),(73,4),(173,44),(172,44),(147,33),(121,22),(49,3),(50,3),(51,3),(52,3),(53,3),(146,33),(145,33),(75,4),(76,4),(77,4),(171,44),(170,44),(169,44),(125,22),(126,22),(127,22),(128,22),(129,22),(130,22),(131,22),(132,22),(133,22),(134,22),(135,22),(136,22),(137,22),(138,22),(139,22),(140,22),(141,22),(142,22),(143,22),(144,22),(150,33),(151,33),(152,33),(153,33),(154,33),(155,33),(156,33),(157,33),(158,33),(159,33),(160,33),(161,33),(162,33),(163,33),(164,33),(165,33),(166,33),(167,33),(168,33),(174,44),(175,44),(176,44),(177,44),(178,44),(179,44),(180,44),(181,44),(182,44),(183,44),(184,44),(185,44),(186,44),(187,44),(188,44),(189,44),(190,44),(191,44),(192,44),(265,66),(266,66),(268,66),(241,55),(242,55),(243,55),(244,55),(245,55),(246,55),(247,55),(248,55),(249,55);
/*!40000 ALTER TABLE `IoData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IoData2`
--

DROP TABLE IF EXISTS `IoData2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IoData2` (
  `id` int(11) NOT NULL,
  `card` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IoData2`
--

LOCK TABLES `IoData2` WRITE;
/*!40000 ALTER TABLE `IoData2` DISABLE KEYS */;
INSERT INTO `IoData2` VALUES (1,1),(25,2),(2,1),(3,1),(4,1),(5,1),(6,1),(98,11),(100,11),(101,11),(102,11),(103,11),(194,33),(193,33),(171,22),(170,22),(169,22),(78,4),(80,4),(82,4),(84,4),(26,2),(27,2),(28,2),(29,2),(195,33),(196,33),(197,33),(198,33),(199,33);
/*!40000 ALTER TABLE `IoData2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Lang`
--

DROP TABLE IF EXISTS `Lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Lang` (
  `language` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Lang`
--

LOCK TABLES `Lang` WRITE;
/*!40000 ALTER TABLE `Lang` DISABLE KEYS */;
INSERT INTO `Lang` VALUES ('uk');
/*!40000 ALTER TABLE `Lang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LoadedSet`
--

DROP TABLE IF EXISTS `LoadedSet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LoadedSet` (
  `set_number` int(11) NOT NULL,
  `synced_set` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LoadedSet`
--

LOCK TABLES `LoadedSet` WRITE;
/*!40000 ALTER TABLE `LoadedSet` DISABLE KEYS */;
INSERT INTO `LoadedSet` VALUES (4,4);
/*!40000 ALTER TABLE `LoadedSet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MachineSetupData`
--

DROP TABLE IF EXISTS `MachineSetupData`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MachineSetupData` (
  `machine_type` int(11) NOT NULL,
  `bay_type` int(11) NOT NULL,
  `door_control` int(11) NOT NULL,
  `door_function` int(11) NOT NULL,
  `wax_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MachineSetupData`
--

LOCK TABLES `MachineSetupData` WRITE;
/*!40000 ALTER TABLE `MachineSetupData` DISABLE KEYS */;
INSERT INTO `MachineSetupData` VALUES (5,0,1,1,1);
/*!40000 ALTER TABLE `MachineSetupData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MachineSetupFunctions`
--

DROP TABLE IF EXISTS `MachineSetupFunctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MachineSetupFunctions` (
  `function` text NOT NULL,
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MachineSetupFunctions`
--

LOCK TABLES `MachineSetupFunctions` WRITE;
/*!40000 ALTER TABLE `MachineSetupFunctions` DISABLE KEYS */;
INSERT INTO `MachineSetupFunctions` VALUES ('null',13,1),('wheel_wash',2,1),('prewash_2',3,1),('van_nozzles',4,1),('ro_water',5,1),('wheel_brush',6,1),('buffing_wax',7,0),('wheel_prewash',8,1),('tyre_shiner',9,1),('opt_scanner',10,1),('wash_counters',11,0),('biojet_in_use',12,0),('chassis_wash',1,1);
/*!40000 ALTER TABLE `MachineSetupFunctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MainPrograms`
--

DROP TABLE IF EXISTS `MainPrograms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MainPrograms` (
  `MainProgram` text COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LangId` int(11) NOT NULL,
  `Cmr_MainProgram` int(10) NOT NULL DEFAULT '50',
  `Speed_MainProgram` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MainPrograms`
--

LOCK TABLES `MainPrograms` WRITE;
/*!40000 ALTER TABLE `MainPrograms` DISABLE KEYS */;
INSERT INTO `MainPrograms` VALUES ('ESIPESU1',1,1,60,9),('ESIPESU2',2,2,47,9),('VAAHTO',3,3,68,9),('VAIKUTUS',4,4,38,9),('ALUSTA',5,5,68,9),('PYORAT',6,6,57,9),('SIVUKP',7,7,54,9),('KATTOKP',8,8,50,9),('HARJAT',9,9,50,9),('VESIHUUHTELU',10,10,56,9),('KPHUUHTELU',11,11,50,9),('OSMOOSIVESI',12,12,50,9),('VAHA',13,13,50,9),('PAKU',18,18,50,9),('KUIVAUS',17,17,50,9),('KIILLOTUS',16,16,50,9),('KUIVAUSVAHA',14,14,50,9),('HARJAVAHA',15,15,50,9),('ODOTUS',19,19,50,9),('PYORAESIPESU',20,20,50,9),('SISAANESIPESU',21,21,50,9),('RENGASKIILLOTIN',22,22,50,9),('LOISTOVAHA',23,23,50,9);
/*!40000 ALTER TABLE `MainPrograms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PassStyles`
--

DROP TABLE IF EXISTS `PassStyles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PassStyles` (
  `PassStyle` text COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PassStyles`
--

LOCK TABLES `PassStyles` WRITE;
/*!40000 ALTER TABLE `PassStyles` DISABLE KEYS */;
INSERT INTO `PassStyles` VALUES ('FC',1),('FO',1),('SB',1),('PU',1),('RS',1),('FC',2),('FO',2),('SB',2),('PU',2),('RS',2),('FC',8),('FO',8),('SB',8),('PU',8),('RS',8),('FC',9),('FO',9),('SB',9),('PU',9),('RS',9),('FC',16),('FO',16),('SB',16),('PU',16),('RS',16),('FC',17),('FO',17),('SB',17),('PU',17),('RS',17);
/*!40000 ALTER TABLE `PassStyles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Password`
--

DROP TABLE IF EXISTS `Password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Password` (
  `pass` varchar(30) NOT NULL DEFAULT '0000'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Password`
--

LOCK TABLES `Password` WRITE;
/*!40000 ALTER TABLE `Password` DISABLE KEYS */;
INSERT INTO `Password` VALUES ('0000');
/*!40000 ALTER TABLE `Password` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `SavedPrograms` VALUES (1,7,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,6,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,3,'ALUSTA',5,63,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(1,5,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,4,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,3,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,2,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,1,'ESIPESU1',1,60,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,10,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,9,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,8,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,7,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,8,'ESIPESU1',1,60,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,9,'ESIPESU1',1,60,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,10,'ESIPESU1',1,60,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,6,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,5,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,4,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,3,'ESIPESU2',2,47,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,2,'VAAHTO',3,68,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,1,'VAAHTO',3,68,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,2,'ESIPESU1',1,60,'','PAKU',18,50,'PYORAESIPESU',20,50,'SISAANESIPESU',21,50,'VAAHTO',3,50,'',0,0,9,'>>>','fast_program',0),(2,1,'ESIPESU1',1,60,'','PAKU',18,50,'PYORAESIPESU',20,50,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(2,4,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(2,5,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(2,6,'VAIKUTUS',4,38,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(2,7,'ESIPESU1',1,60,'','PAKU',18,50,'PYORAESIPESU',20,50,'SISAANESIPESU',21,50,'VAAHTO',3,50,'',0,0,9,'<<<','fast_program',0),(2,8,'ESIPESU1',1,60,'','PAKU',18,50,'PYORAESIPESU',20,50,'SISAANESIPESU',21,50,'VAAHTO',3,50,'',0,0,9,'>>>','fast_program',0),(3,1,'ESIPESU1',1,64,'','VAIKUTUS',4,56,'PAKU',18,55,'PYORAESIPESU',20,45,'',0,0,'',0,0,8,'<<<','summer_program',0),(3,2,'ESIPESU1',1,64,'','VAIKUTUS',4,56,'PAKU',18,55,'PYORAESIPESU',20,45,'',0,0,'',0,0,8,'>>>','summer_program',0),(3,3,'ESIPESU1',1,64,'SB','VAIKUTUS',4,56,'PAKU',18,55,'PYORAESIPESU',20,45,'SISAANESIPESU',21,52,'',0,0,8,'<<<','summer_program',0);
/*!40000 ALTER TABLE `SavedPrograms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SelectedMachine`
--

DROP TABLE IF EXISTS `SelectedMachine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SelectedMachine` (
  `number` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SelectedMachine`
--

LOCK TABLES `SelectedMachine` WRITE;
/*!40000 ALTER TABLE `SelectedMachine` DISABLE KEYS */;
INSERT INTO `SelectedMachine` VALUES (1);
/*!40000 ALTER TABLE `SelectedMachine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SideProgramRule`
--

DROP TABLE IF EXISTS `SideProgramRule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SideProgramRule` (
  `SideProgram` text COLLATE utf8_unicode_ci NOT NULL,
  `MainId` int(11) NOT NULL,
  `Cmr_SideProgram` int(11) NOT NULL DEFAULT '50',
  `id` int(11) NOT NULL,
  `LangId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SideProgramRule`
--

LOCK TABLES `SideProgramRule` WRITE;
/*!40000 ALTER TABLE `SideProgramRule` DISABLE KEYS */;
INSERT INTO `SideProgramRule` VALUES ('VAIKUTUS',1,50,1,4),('PAKU',1,50,2,18),('PYORAESIPESU',1,50,3,20),('SISAANESIPESU',1,50,4,21),('VAIKUTUS',2,50,1,4),('PAKU',2,50,2,18),('PYORAESIPESU',2,50,3,20),('VAIKUTUS',3,50,1,4),('PYORAT',3,50,2,6),('PYORAESIPESU',3,50,3,20),('SISAANESIPESU',7,50,1,21),('PAKU',7,50,2,18),('SIVUKP',8,50,1,7),('ALUSTA',9,50,1,5),('PYORAT',9,50,2,6),('SIVUKP',9,50,3,7),('KPHUUHTELU',9,50,4,11),('VAHA',10,50,1,13),('KUIVAUSVAHA',10,50,2,14),('RENGASKIILLOTIN',10,50,3,22),('VAHA',12,50,1,13),('KUIVAUSVAHA',12,50,2,14),('OSMOOSIVESI',13,50,3,12),('KUIVAUSVAHA',13,50,1,14),('VAHA',14,50,1,13),('RENGASKIILLOTIN',14,50,2,22),('VAIKUTUS',20,50,2,4),('SISAANESIPESU',20,50,1,21),('VAAHTO',1,50,5,3),('HARJAVAHA',16,50,1,15),('RENGASKIILLOTIN',13,50,2,22),('LOISTOVAHA',16,50,2,23),('ESIPESU2',1,50,6,2),('ESIPESU1',2,50,4,1),('SISAANESIPESU',2,50,5,21),('SISAANESIPESU',3,50,4,21),('PYORAT',5,50,1,6),('ESIPESU1',6,50,1,1),('ESIPESU2',6,50,2,2),('VAAHTO',6,50,3,3),('ALUSTA',6,50,4,5),('SIVUKP',6,50,5,7),('PAKU ',6,50,6,18),('PYORAT',7,50,3,6),('PYORAT',8,50,2,6),('ALUSTA',8,50,3,5),('PAKU',8,50,4,18),('SISAANESIPESU',8,50,5,21),('PAKU',9,50,5,18),('SISAANESIPESU',9,50,6,21),('VESIHUUHTELU',13,50,4,10),('OSMOOSIVESI',14,50,3,12),('VESIHUUHTELU',14,50,4,10),('KUIVAUSVAHA',9,50,7,14),('PYORAESIPESU',8,50,6,20);
/*!40000 ALTER TABLE `SideProgramRule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES ('Importer','8cb2237d0679ca88db6464eac60da96345513964',0),('TM','8cb2237d0679ca88db6464eac60da96345513964',0),('admin','8cb2237d0679ca88db6464eac60da96345513964',0),('Operator','8cb2237d0679ca88db6464eac60da96345513964',0),('Chain','8cb2237d0679ca88db6464eac60da96345513964',0);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-04 16:28:21

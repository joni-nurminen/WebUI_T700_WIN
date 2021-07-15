-- MySQL dump 10.11
--
-- Host: localhost    Database: t700
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
-- Table structure for table `CopiedProgram`
--

DROP TABLE IF EXISTS `CopiedProgram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CopiedProgram` (
  `SlotNumber` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `MainProgram` text NOT NULL,
  `LangIdMain` int(11) NOT NULL,
  `Cmr_MainProgram` int(11) NOT NULL,
  `PassStyle` text NOT NULL,
  `SideProgram1` text NOT NULL,
  `LangIdSide1` int(11) NOT NULL,
  `Cmr_SideProgram1` int(11) NOT NULL,
  `SideProgram2` text NOT NULL,
  `LangIdSide2` int(11) NOT NULL,
  `Cmr_SideProgram2` int(11) NOT NULL,
  `SideProgram3` text NOT NULL,
  `LangIdSide3` int(11) NOT NULL,
  `Cmr_SideProgram3` int(11) NOT NULL,
  `SideProgram4` text NOT NULL,
  `LangIdSide4` int(11) NOT NULL,
  `Cmr_SideProgram4` int(11) NOT NULL,
  `SideProgram5` text NOT NULL,
  `LangIdSide5` int(11) NOT NULL,
  `Cmr_SideProgram5` int(11) NOT NULL,
  `Speed_MainProgram` int(11) NOT NULL,
  `Direction` varchar(5) NOT NULL,
  `Program_Type` varchar(30) NOT NULL,
  `Set_Number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CopiedProgram`
--

LOCK TABLES `CopiedProgram` WRITE;
/*!40000 ALTER TABLE `CopiedProgram` DISABLE KEYS */;
INSERT INTO `CopiedProgram` VALUES (2,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,100,'PYORAESIPESU',20,100,'SISAANESIPESU',21,100,'',0,0,'',0,0,9,'<<<','none',0),(2,2,'VAAHTO',3,100,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,3,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,4,'SIVUKP',7,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,5,'HARJAT',9,80,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,6,'HARJAT',9,80,'FC','KPHUUHTELU',11,80,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,7,'KIILLOTUS',16,65,'FC','HARJAVAHA',15,80,'VAHA',13,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,8,'OSMOOSIVESI',12,50,'','KUIVAUSVAHA',14,100,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,9,'RENGASKIILLOTIN',22,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,10,'RENGASKIILLOTIN',22,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0);
/*!40000 ALTER TABLE `CopiedProgram` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CopiedProgram2`
--

DROP TABLE IF EXISTS `CopiedProgram2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CopiedProgram2` (
  `SlotNumber` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `MainProgram` text NOT NULL,
  `LangIdMain` int(11) NOT NULL,
  `Cmr_MainProgram` int(11) NOT NULL,
  `PassStyle` text NOT NULL,
  `SideProgram1` text NOT NULL,
  `LangIdSide1` int(11) NOT NULL,
  `Cmr_SideProgram1` int(11) NOT NULL,
  `SideProgram2` text NOT NULL,
  `LangIdSide2` int(11) NOT NULL,
  `Cmr_SideProgram2` int(11) NOT NULL,
  `SideProgram3` text NOT NULL,
  `LangIdSide3` int(11) NOT NULL,
  `Cmr_SideProgram3` int(11) NOT NULL,
  `SideProgram4` text NOT NULL,
  `LangIdSide4` int(11) NOT NULL,
  `Cmr_SideProgram4` int(11) NOT NULL,
  `SideProgram5` text NOT NULL,
  `LangIdSide5` int(11) NOT NULL,
  `Cmr_SideProgram5` int(11) NOT NULL,
  `Speed_MainProgram` int(11) NOT NULL,
  `Direction` varchar(5) NOT NULL,
  `Program_Type` varchar(30) NOT NULL,
  `Set_Number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CopiedProgram2`
--

LOCK TABLES `CopiedProgram2` WRITE;
/*!40000 ALTER TABLE `CopiedProgram2` DISABLE KEYS */;
INSERT INTO `CopiedProgram2` VALUES (7,1,'KUIVAUSVAHA',14,65,'','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(7,2,'VESIHUUHTELU',10,50,'','KUIVAUSVAHA',14,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','summer_program',0),(7,3,'ESIPESU2',2,65,'SB','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0);
/*!40000 ALTER TABLE `CopiedProgram2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IoCardSelections`
--

DROP TABLE IF EXISTS `IoCardSelections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IoCardSelections` (
  `in1` int(11) NOT NULL,
  `in2` int(11) NOT NULL,
  `in3` int(11) NOT NULL,
  `in4` int(11) NOT NULL,
  `in5` int(11) NOT NULL,
  `in6` int(11) NOT NULL,
  `out1` int(11) NOT NULL,
  `out2` int(11) NOT NULL,
  `out3` int(11) NOT NULL,
  `out4` int(11) NOT NULL,
  `out5` int(11) NOT NULL,
  `out6` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IoCardSelections`
--

LOCK TABLES `IoCardSelections` WRITE;
/*!40000 ALTER TABLE `IoCardSelections` DISABLE KEYS */;
INSERT INTO `IoCardSelections` VALUES (1,1,1,0,0,0,1,1,1,1,1,1);
/*!40000 ALTER TABLE `IoCardSelections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IoCardSelections2`
--

DROP TABLE IF EXISTS `IoCardSelections2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IoCardSelections2` (
  `in1` int(11) NOT NULL,
  `in2` int(11) NOT NULL,
  `in3` int(11) NOT NULL,
  `in4` int(11) NOT NULL,
  `in5` int(11) NOT NULL,
  `in6` int(11) NOT NULL,
  `out1` int(11) NOT NULL,
  `out2` int(11) NOT NULL,
  `out3` int(11) NOT NULL,
  `out4` int(11) NOT NULL,
  `out5` int(11) NOT NULL,
  `out6` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IoCardSelections2`
--

LOCK TABLES `IoCardSelections2` WRITE;
/*!40000 ALTER TABLE `IoCardSelections2` DISABLE KEYS */;
INSERT INTO `IoCardSelections2` VALUES (1,1,1,0,0,0,1,1,1,0,1,1),(1,1,1,0,0,0,1,1,1,1,1,1);
/*!40000 ALTER TABLE `IoCardSelections2` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `IoData` VALUES (224,44),(223,44),(158,11),(252,55),(195,33),(194,33),(245,55),(193,33),(155,11),(170,22),(198,33),(197,33),(196,33),(283,66);
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
INSERT INTO `IoData2` VALUES (7,1),(6,1),(5,1),(4,1),(3,1),(2,1),(1,1),(7,1),(6,1),(5,1),(4,1),(3,1),(2,1),(1,1),(193,33),(194,33),(195,33),(196,33),(197,33),(198,33);
/*!40000 ALTER TABLE `IoData2` ENABLE KEYS */;
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
  `wax_type` int(11) NOT NULL,
  `email_interval` int(11) NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MachineSetupData`
--

LOCK TABLES `MachineSetupData` WRITE;
/*!40000 ALTER TABLE `MachineSetupData` DISABLE KEYS */;
INSERT INTO `MachineSetupData` VALUES (1,0,0,0,0,0);
/*!40000 ALTER TABLE `MachineSetupData` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MachineSetupData2`
--

DROP TABLE IF EXISTS `MachineSetupData2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MachineSetupData2` (
  `machine_type` int(11) NOT NULL,
  `bay_type` int(11) NOT NULL,
  `door_control` int(11) NOT NULL,
  `door_function` int(11) NOT NULL,
  `wax_type` int(11) NOT NULL,
  `email_interval` int(11) NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MachineSetupData2`
--

LOCK TABLES `MachineSetupData2` WRITE;
/*!40000 ALTER TABLE `MachineSetupData2` DISABLE KEYS */;
INSERT INTO `MachineSetupData2` VALUES (6,1,0,1,0,1);
/*!40000 ALTER TABLE `MachineSetupData2` ENABLE KEYS */;
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
INSERT INTO `MachineSetupFunctions` VALUES ('chassis_wash',1,1),('wheel_wash',2,1),('prewash_2',3,1),('van_nozzles',4,1),('ro_water',5,0),('wheel_brush',6,1),('buffing_wax',7,1),('wheel_prewash',8,1),('tyre_shiner',9,1),('opt_scanner',10,1),('air_wax',11,0),('biojet_in_use',12,0),('drive_in_prewash',13,1),('option1',14,0),('option2',15,0),('null',16,0);
/*!40000 ALTER TABLE `MachineSetupFunctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MachineSetupFunctions2`
--

DROP TABLE IF EXISTS `MachineSetupFunctions2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MachineSetupFunctions2` (
  `function` text NOT NULL,
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MachineSetupFunctions2`
--

LOCK TABLES `MachineSetupFunctions2` WRITE;
/*!40000 ALTER TABLE `MachineSetupFunctions2` DISABLE KEYS */;
INSERT INTO `MachineSetupFunctions2` VALUES ('chassis_wash',1,1),('wheel_wash',2,1),('prewash_2',3,1),('van_nozzles',4,1),('ro_water',5,0),('wheel_brush',6,1),('buffing_wax',7,1),('wheel_prewash',8,1),('tyre_shiner',9,1),('opt_scanner',10,1),('air_wax',11,1),('biojet_in_use',12,0),('drive_in_prewash',13,1),('option1',14,0),('option2',15,0),('null',16,0),('chassis_wash',1,1),('wheel_wash',2,1),('prewash_2',3,0),('van_nozzles',4,0),('ro_water',5,0),('wheel_brush',6,1),('buffing_wax',7,1),('wheel_prewash',8,0),('tyre_shiner',9,0),('opt_scanner',10,1),('air_wax',11,1),('biojet_in_use',12,0),('drive_in_prewash',13,1),('option1',14,0),('option2',15,0),('null',16,0);
/*!40000 ALTER TABLE `MachineSetupFunctions2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MainPrograms`
--

DROP TABLE IF EXISTS `MainPrograms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MainPrograms` (
  `MainProgram` text collate utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `LangId` int(11) NOT NULL,
  `Cmr_MainProgram` int(10) NOT NULL default '50',
  `Speed_MainProgram` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MainPrograms`
--

LOCK TABLES `MainPrograms` WRITE;
/*!40000 ALTER TABLE `MainPrograms` DISABLE KEYS */;
INSERT INTO `MainPrograms` VALUES ('ESIPESU1',1,1,65,9,1),('ESIPESU2',2,2,65,9,1),('VAAHTO',3,3,65,9,1),('VAIKUTUS',4,4,50,9,1),('ALUSTA',5,5,50,9,1),('PYORAT',6,6,50,9,1),('SIVUKP',7,7,50,9,1),('KATTOKP',8,8,50,9,1),('HARJAT',9,9,50,9,1),('VESIHUUHTELU',10,10,50,9,1),('KPHUUHTELU',11,11,50,9,1),('OSMOOSIVESI',12,12,50,9,0),('VAHA',13,13,65,9,1),('KUIVAUSVAHA',14,14,65,9,1),('HARJAVAHA',15,15,65,9,1),('KIILLOTUS',16,16,65,9,1),('KUIVAUS',17,17,50,9,1),('PAKU',18,18,50,9,0),('AIRLUX',19,19,65,9,1),('PYORAESIPESU',20,20,65,9,1),('SISAANESIPESU',21,21,50,9,0),('RENGASKIILLOTIN',22,22,65,9,1),('LOISTOVAHA',23,23,65,9,1),('RAINLUX',24,24,65,9,1),('SKANNAUS',25,25,100,9,1),('LAAVAVAAHTO',26,26,65,9,1),('ITIKKAEP',27,27,65,9,0);
/*!40000 ALTER TABLE `MainPrograms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MainPrograms2`
--

DROP TABLE IF EXISTS `MainPrograms2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MainPrograms2` (
  `MainProgram` text collate utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `LangId` int(11) NOT NULL,
  `Cmr_MainProgram` int(10) NOT NULL default '50',
  `Speed_MainProgram` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MainPrograms2`
--

LOCK TABLES `MainPrograms2` WRITE;
/*!40000 ALTER TABLE `MainPrograms2` DISABLE KEYS */;
INSERT INTO `MainPrograms2` VALUES ('ESIPESU1',1,1,65,9,1),('ESIPESU2',2,2,65,9,1),('VAAHTO',3,3,65,9,1),('VAIKUTUS',4,4,50,9,1),('ALUSTA',5,5,50,9,1),('PYORAT',6,6,50,9,1),('SIVUKP',7,7,50,9,1),('KATTOKP',8,8,50,9,1),('HARJAT',9,9,50,9,1),('VESIHUUHTELU',10,10,50,9,1),('KPHUUHTELU',11,11,50,9,1),('OSMOOSIVESI',12,12,50,9,1),('VAHA',13,13,65,9,1),('KUIVAUSVAHA',14,14,65,9,1),('HARJAVAHA',15,15,65,9,1),('KIILLOTUS',16,16,65,9,1),('KUIVAUS',17,17,50,9,1),('PAKU',18,18,50,9,1),('AIRLUX',19,19,65,9,1),('PYORAESIPESU',20,20,65,9,1),('SISAANESIPESU',21,21,50,9,1),('RENGASKIILLOTIN',22,22,65,9,1),('LOISTOVAHA',23,23,65,9,1),('RAINLUX',24,24,65,9,1),('SKANNAUS',25,25,100,9,1),('LAAVAVAAHTO',26,26,65,9,1),('ITIKKAEP',27,27,65,9,1);
/*!40000 ALTER TABLE `MainPrograms2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PassStyles`
--

DROP TABLE IF EXISTS `PassStyles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PassStyles` (
  `PassStyle` text collate utf8_unicode_ci NOT NULL,
  `pass_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PassStyles`
--

LOCK TABLES `PassStyles` WRITE;
/*!40000 ALTER TABLE `PassStyles` DISABLE KEYS */;
INSERT INTO `PassStyles` VALUES ('FC',1,1),('FO',1,2),('SB',1,3),('PU',1,4),('RS',1,5),('NF',1,6),('FC',2,1),('FO',2,2),('SB',2,3),('PU',2,4),('RS',2,5),('NF',2,6),('FC',8,1),('FO',8,2),('SB',8,3),('PU',8,4),('RS',8,5),('NF',8,6),('FC',9,1),('FO',9,2),('SB',9,3),('PU',9,4),('RS',9,5),('NF',9,6),('FC',16,1),('FO',16,2),('SB',16,3),('PU',16,4),('RS',16,5),('NF',16,6),('FC',17,1),('FO',17,2),('SB',17,3),('PU',17,4),('RS',17,5),('NF',17,6),('FC',19,1),('FO',19,2),('SB',19,3),('PU',19,4),('RS',19,5),('NF',19,6),('FC',25,1),('FO',25,2),('NF',25,3),('FO',26,1),('SB',26,2),('PU',26,3),('FC',27,1),('FO',27,2),('SB',27,3),('PU',27,4),('RS',27,5),('NF',27,6);
/*!40000 ALTER TABLE `PassStyles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PassStyles2`
--

DROP TABLE IF EXISTS `PassStyles2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PassStyles2` (
  `PassStyle` text collate utf8_unicode_ci NOT NULL,
  `pass_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PassStyles2`
--

LOCK TABLES `PassStyles2` WRITE;
/*!40000 ALTER TABLE `PassStyles2` DISABLE KEYS */;
INSERT INTO `PassStyles2` VALUES ('FC',1,1),('FO',1,2),('SB',1,3),('PU',1,4),('RS',1,5),('NF',1,6),('FC',2,1),('FO',2,2),('SB',2,3),('PU',2,4),('RS',2,5),('NF',2,6),('FC',8,1),('FO',8,2),('SB',8,3),('PU',8,4),('RS',8,5),('NF',8,6),('FC',9,1),('FO',9,2),('SB',9,3),('PU',9,4),('RS',9,5),('NF',9,6),('FC',16,1),('FO',16,2),('SB',16,3),('PU',16,4),('RS',16,5),('NF',16,6),('FC',17,1),('FO',17,2),('SB',17,3),('PU',17,4),('RS',17,5),('NF',17,6),('FC',19,1),('FO',19,2),('SB',19,3),('PU',19,4),('RS',19,5),('NF',19,6),('FC',25,1),('FO',25,2),('NF',25,3),('FO',26,1),('SB',26,2),('PU',26,3),('FC',27,1),('FO',27,2),('SB',27,3),('PU',27,4),('RS',27,5),('NF',27,6);
/*!40000 ALTER TABLE `PassStyles2` ENABLE KEYS */;
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
  `MainProgram` text collate utf8_unicode_ci,
  `LangIdMain` int(11) NOT NULL,
  `Cmr_MainProgram` int(11) default NULL,
  `PassStyle` text collate utf8_unicode_ci,
  `SideProgram1` text collate utf8_unicode_ci,
  `LangIdSide1` int(11) NOT NULL,
  `Cmr_SideProgram1` int(11) default NULL,
  `SideProgram2` text collate utf8_unicode_ci,
  `LangIdSide2` int(11) NOT NULL,
  `Cmr_SideProgram2` int(11) default NULL,
  `SideProgram3` text collate utf8_unicode_ci,
  `LangIdSide3` int(11) NOT NULL,
  `Cmr_SideProgram3` int(11) default NULL,
  `SideProgram4` text collate utf8_unicode_ci,
  `LangIdSide4` int(11) NOT NULL,
  `Cmr_SideProgram4` int(11) default NULL,
  `SideProgram5` text collate utf8_unicode_ci NOT NULL,
  `LangIdSide5` int(11) NOT NULL,
  `Cmr_SideProgram5` int(11) NOT NULL,
  `Speed_MainProgram` int(11) NOT NULL,
  `Direction` varchar(5) collate utf8_unicode_ci default NULL,
  `Program_Type` varchar(30) collate utf8_unicode_ci NOT NULL,
  `Set_Number` int(11) NOT NULL,
  PRIMARY KEY  (`SlotNumber`,`id`),
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
INSERT INTO `SavedPrograms` VALUES (3,3,'KATTOKP',8,51,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,4,'KATTOKP',8,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,2,'VAAHTO',3,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,3,'KATTOKP',8,50,'SB','SIVUKP',7,15,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,5,'HARJAT',9,70,'PU','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,3,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(7,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(8,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,5,'HARJAT',9,70,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(8,6,'HARJAT',9,70,'FC','KPHUUHTELU',11,15,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,3,'KATTOKP',8,50,'FC','SIVUKP',7,100,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,2,'VAAHTO',3,70,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(11,2,'VAAHTO',3,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(11,3,'KATTOKP',8,50,'SB','SIVUKP',7,15,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(11,4,'KATTOKP',8,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(11,5,'HARJAT',9,70,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(11,6,'HARJAT',9,70,'SB','ALUSTA',5,15,'KPHUUHTELU',11,15,'KUIVAUSVAHA',14,40,'',0,0,'',0,0,9,'>>>','none',0),(12,3,'KATTOKP',8,50,'PU','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,2,'VAAHTO',3,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,5,'HARJAT',9,70,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,3,'KATTOKP',8,50,'PU','SIVUKP',7,100,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,2,'VAAHTO',3,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(7,5,'SIVUKP',7,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(7,6,'KUIVAUSVAHA',14,45,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,2,'VAAHTO',3,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(9,2,'VAAHTO',3,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(12,2,'VAAHTO',3,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(15,5,'HARJAT',9,80,'FC','SIVUKP',7,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,4,'VAAHTO',3,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(15,3,'ESIPESU1',1,90,'','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,6,'HARJAT',9,70,'PU','KUIVAUSVAHA',14,40,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,7,'KIILLOTUS',16,65,'FC','HARJAVAHA',15,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,5,'HARJAT',9,70,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,6,'HARJAT',9,70,'FC','KPHUUHTELU',11,15,'KUIVAUSVAHA',14,40,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(12,4,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(12,5,'HARJAT',9,70,'PU','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,6,'HARJAT',9,70,'PU','KUIVAUSVAHA',14,40,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(15,6,'HARJAT',9,50,'FC','KPHUUHTELU',11,50,'KUIVAUSVAHA',14,65,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(5,6,'HARJAT',9,50,'SB','ALUSTA',5,15,'KPHUUHTELU',11,15,'KUIVAUSVAHA',14,40,'',0,0,'',0,0,9,'>>>','none',0),(5,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'VAIKUTUS',4,50,'SISAANESIPESU',21,30,'',0,0,'',0,0,9,'<<<','none',0),(8,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'SISAANESIPESU',21,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'SISAANESIPESU',21,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,3,'HARJAT',9,71,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,4,'HARJAT',9,50,'FC','KPHUUHTELU',11,20,'KUIVAUSVAHA',14,30,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(11,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'SISAANESIPESU',21,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'SISAANESIPESU',21,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,1,'SKANNAUS',25,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,4,'SIVUKP',7,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,4,'HARJAT',9,59,'FC','KPHUUHTELU',11,30,'KUIVAUSVAHA',14,40,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(3,2,'VAAHTO',3,50,'','ALUSTA',5,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(16,11,'KUIVAUSVAHA',14,45,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,4,'<<<','none',0),(16,10,'KIILLOTUS',16,65,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(16,9,'LOISTOVAHA',23,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(16,8,'HARJAT',9,50,'FC','KPHUUHTELU',11,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(16,7,'HARJAT',9,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(16,6,'VAIKUTUS',4,50,'','ALUSTA',5,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(16,5,'ESIPESU1',1,90,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(16,4,'SIVUKP',7,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(16,3,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(16,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(16,1,'SKANNAUS',25,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,3,'ESIPESU1',1,100,'FC','VAAHTO',3,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,5,'HARJAT',9,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(3,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'SISAANESIPESU',21,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,2,'ALUSTA',5,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(3,6,'HARJAT',9,50,'FC','KPHUUHTELU',11,50,'KUIVAUSVAHA',14,45,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(3,7,'KUIVAUS',17,100,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,3,'<<<','none',0),(4,4,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(5,7,'KUIVAUS',17,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(5,8,'KUIVAUS',17,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(6,7,'KUIVAUS',17,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(6,8,'KUIVAUS',17,50,'PU','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(7,7,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,8,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(8,8,'KUIVAUSVAHA',14,45,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(8,9,'KUIVAUS',17,50,'NF','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(8,10,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(9,7,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(9,8,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(10,1,'SKANNAUS',25,100,'NF','ESIPESU1',1,100,'SISAANESIPESU',21,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(11,7,'KUIVAUS',17,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(11,8,'KUIVAUS',17,50,'SB','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(12,7,'KUIVAUS',17,50,'PU','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(12,8,'KUIVAUS',17,50,'PU','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(16,12,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(16,13,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(16,14,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(15,7,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(15,8,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,5,'>>>','none',0),(2,3,'HARJAT',9,59,'FC','PYORAT',6,50,'SIVUKP',7,50,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,2,'VAAHTO',3,100,'','ALUSTA',5,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,5,'SIVUKP',7,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,6,'<<<','none',0),(4,6,'KUIVAUSVAHA',14,45,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'>>>','none',0),(4,1,'SKANNAUS',25,99,'FO','ESIPESU1',1,100,'SISAANESIPESU',21,40,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,7,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(4,8,'KUIVAUS',17,100,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,6,'>>>','none',0),(1,9,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(1,8,'RAINLUX',24,30,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(2,1,'SKANNAUS',25,100,'FO','ESIPESU1',1,90,'SISAANESIPESU',21,30,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(2,5,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(2,6,'KUIVAUS',17,100,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(25,1,'SKANNAUS',25,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(25,2,'ALUSTA',5,50,'','PYORAT',6,50,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(26,1,'SKANNAUS',25,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(26,2,'RAINLUX',24,65,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(26,3,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(26,4,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(27,1,'SKANNAUS',25,100,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(27,2,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,5,'>>>','none',0),(27,3,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,4,'<<<','none',0),(27,4,'KUIVAUS',17,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,3,'>>>','none',0),(13,1,'SKANNAUS',25,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(13,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,7,'KIILLOTUS',16,65,'FC','LOISTOVAHA',23,65,'KUIVAUSVAHA',14,1,'',0,0,'',0,0,'',0,0,7,'<<<','none',0),(1,6,'HARJAT',9,51,'FC','KPHUUHTELU',11,30,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(10,5,'KIILLOTUS',16,65,'FC','HARJAVAHA',15,100,'KUIVAUSVAHA',14,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(10,6,'RAINLUX',24,30,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(10,7,'KUIVAUS',17,99,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(10,8,'KUIVAUS',17,100,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(13,3,'LAAVAVAAHTO',26,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(13,4,'VESIHUUHTELU',10,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(28,1,'SKANNAUS',25,99,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(28,2,'VESIHUUHTELU',10,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,1,'>>>','none',0),(25,3,'KATTOKP',8,50,'FC','SIVUKP',7,50,'',0,0,'',0,0,'',0,0,'',0,0,8,'<<<','none',0),(1,3,'LAAVAVAAHTO',26,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,5,'<<<','none',0),(1,4,'KATTOKP',8,50,'FC','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,5,'HARJAT',9,61,'FC','PYORAT',6,50,'SIVUKP',7,50,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,2,'ALUSTA',5,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,1,'SKANNAUS',25,100,'NF','ESIPESU1',1,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(1,10,'KUIVAUS',17,100,'FC','RENGASKIILLOTIN',22,40,'',0,0,'',0,0,'',0,0,'',0,0,7,'>>>','none',0),(30,2,'VAIKUTUS',4,50,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(30,1,'SKANNAUS',25,100,'FO','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0);
/*!40000 ALTER TABLE `SavedPrograms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SavedPrograms2`
--

DROP TABLE IF EXISTS `SavedPrograms2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SavedPrograms2` (
  `SlotNumber` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `MainProgram` text collate utf8_unicode_ci,
  `LangIdMain` int(11) NOT NULL,
  `Cmr_MainProgram` int(11) default NULL,
  `PassStyle` text collate utf8_unicode_ci,
  `SideProgram1` text collate utf8_unicode_ci,
  `LangIdSide1` int(11) NOT NULL,
  `Cmr_SideProgram1` int(11) default NULL,
  `SideProgram2` text collate utf8_unicode_ci,
  `LangIdSide2` int(11) NOT NULL,
  `Cmr_SideProgram2` int(11) default NULL,
  `SideProgram3` text collate utf8_unicode_ci,
  `LangIdSide3` int(11) NOT NULL,
  `Cmr_SideProgram3` int(11) default NULL,
  `SideProgram4` text collate utf8_unicode_ci,
  `LangIdSide4` int(11) NOT NULL,
  `Cmr_SideProgram4` int(11) default NULL,
  `SideProgram5` text collate utf8_unicode_ci NOT NULL,
  `LangIdSide5` int(11) NOT NULL,
  `Cmr_SideProgram5` int(11) NOT NULL,
  `Speed_MainProgram` int(11) NOT NULL,
  `Direction` varchar(5) collate utf8_unicode_ci default NULL,
  `Program_Type` varchar(30) collate utf8_unicode_ci NOT NULL,
  `Set_Number` int(11) NOT NULL,
  PRIMARY KEY  (`SlotNumber`,`id`),
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
INSERT INTO `SavedPrograms2` VALUES (1,2,'ESIPESU2',2,65,'SB','PAKU',18,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(1,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'PAKU',18,50,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,3,'VESIHUUHTELU',10,50,'','KUIVAUSVAHA',14,65,'RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,2,'ESIPESU2',2,65,'SB','VAIKUTUS',4,50,'PYORAESIPESU',20,65,'',0,0,'',0,0,'',0,0,9,'>>>','none',0),(4,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(7,2,'VESIHUUHTELU',10,50,'','KUIVAUSVAHA',14,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','summer_program',0),(7,1,'KUIVAUSVAHA',14,65,'','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(8,3,'PYORAT',6,50,'','PAKU ',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(8,2,'ESIPESU2',2,65,'PU','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(8,1,'ESIPESU1',1,65,'FC','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(0,0,'',0,0,'','',0,0,'',0,0,'',0,0,'',0,0,'',0,0,0,'','',0),(8,4,'VESIHUUHTELU',10,50,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(25,2,'VAAHTO',3,65,'','ALUSTA',5,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','fast_program',0),(25,1,'ESIPESU2',2,65,'FO','VAIKUTUS',4,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','fast_program',0),(7,3,'ESIPESU2',2,65,'SB','PAKU',18,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','summer_program',0),(7,4,'KUIVAUSVAHA',14,65,'','RENGASKIILLOTIN',22,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','summer_program',0),(1,3,'VAAHTO',3,65,'','ALUSTA',5,50,'',0,0,'',0,0,'',0,0,'',0,0,9,'<<<','none',0),(4,4,'VAHA',13,65,'','RENGASKIILLOTIN',22,65,'',0,0,'',0,0,'',0,0,'',0,0,9,'>>>','none',0);
/*!40000 ALTER TABLE `SavedPrograms2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SideProgramRule`
--

DROP TABLE IF EXISTS `SideProgramRule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SideProgramRule` (
  `SideProgram` text collate utf8_unicode_ci NOT NULL,
  `MainId` int(11) NOT NULL,
  `Cmr_SideProgram` int(11) NOT NULL default '50',
  `id` int(11) NOT NULL,
  `LangId` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SideProgramRule`
--

LOCK TABLES `SideProgramRule` WRITE;
/*!40000 ALTER TABLE `SideProgramRule` DISABLE KEYS */;
INSERT INTO `SideProgramRule` VALUES ('VAIKUTUS',1,50,1,4,1),('PAKU',1,50,2,18,1),('PYORAESIPESU',1,65,3,20,1),('SISAANESIPESU',1,65,4,21,1),('VAAHTO',1,65,5,3,1),('ESIPESU2',1,65,6,2,1),('ITIKKAEP',1,65,7,27,1),('VAIKUTUS',2,50,1,4,1),('PAKU',2,50,2,18,1),('PYORAESIPESU',2,65,3,20,1),('ESIPESU1',2,65,4,1,1),('SISAANESIPESU',2,65,5,21,1),('VAAHTO',2,65,6,3,1),('ITIKKAEP',2,65,7,27,1),('VAIKUTUS',3,50,1,4,1),('KPHUUHTELU',3,50,2,11,1),('PYORAESIPESU',3,65,3,20,1),('SISAANESIPESU',3,65,4,21,1),('ALUSTA',3,50,5,5,1),('PYORAT',3,50,6,6,1),('ITIKKAEP',3,65,7,27,1),('PYORAT',5,50,1,6,1),('VAAHTO',6,65,3,3,0),('ALUSTA',6,50,4,5,1),('SIVUKP',6,50,5,7,1),('PAKU ',6,50,6,18,1),('KPHUUHTELU',6,50,7,11,1),('SISAANESIPESU',7,65,1,21,1),('PAKU',7,50,2,18,1),('PYORAT',7,50,3,6,1),('ALUSTA',7,50,4,5,1),('ITIKKAEP',7,65,5,27,1),('SIVUKP',8,50,1,7,1),('PYORAT',8,50,2,6,1),('ALUSTA',8,50,3,5,1),('PAKU',8,50,4,18,1),('SISAANESIPESU',8,65,5,21,1),('PYORAESIPESU',8,65,6,20,0),('ITIKKAEP',8,65,7,27,1),('ALUSTA',9,50,1,5,1),('PYORAT',9,50,2,6,1),('SIVUKP',9,50,3,7,1),('KPHUUHTELU',9,50,4,11,1),('PAKU',9,50,5,18,1),('SISAANESIPESU',9,65,6,21,1),('KUIVAUSVAHA',9,65,7,14,1),('VAHA',9,65,8,13,1),('RAINLUX',9,65,9,24,1),('VESIHUUHTELU',9,65,10,10,1),('ITIKKAEP',9,65,11,27,0),('KUIVAUSVAHA',10,65,1,14,1),('RENGASKIILLOTIN',10,65,2,22,1),('VAHA',10,65,3,13,1),('RAINLUX',10,65,4,24,1),('KUIVAUSVAHA',12,65,1,14,0),('RENGASKIILLOTIN',12,65,2,22,0),('VAHA',12,65,3,13,0),('RAINLUX',12,65,4,24,0),('KUIVAUSVAHA',13,65,1,14,1),('RENGASKIILLOTIN',13,65,2,22,1),('OSMOOSIVESI',13,50,3,12,0),('VESIHUUHTELU',13,50,4,10,1),('VAIKUTUS',13,50,5,4,1),('RENGASKIILLOTIN',14,50,1,22,1),('OSMOOSIVESI',14,50,2,12,0),('VESIHUUHTELU',14,50,3,10,1),('VAHA',14,65,4,13,1),('VAIKUTUS',14,50,5,4,1),('HARJAVAHA',16,65,1,15,1),('LOISTOVAHA',16,65,2,23,1),('KUIVAUSVAHA',16,65,3,14,1),('RENGASKIILLOTIN',16,65,4,22,1),('VAHA',16,65,5,13,1),('RAINLUX',16,65,6,24,1),('RENGASKIILLOTIN',17,65,1,22,1),('SISAANESIPESU',20,65,1,21,1),('VAIKUTUS',20,50,2,4,1),('ITIKKAEP',20,65,3,27,1),('VAHA',24,65,1,13,1),('KUIVAUSVAHA',24,65,2,14,1),('RENGASKIILLOTIN',24,65,3,22,1),('OSMOOSIVESI',24,50,4,12,0),('VESIHUUHTELU',24,50,5,10,1),('VAIKUTUS',24,50,6,4,1),('ESIPESU1',25,65,1,1,1),('ESIPESU2',25,65,2,2,1),('PYORAESIPESU',25,65,3,20,1),('VAAHTO',25,65,4,3,1),('VAIKUTUS',25,50,5,4,1),('PAKU',25,50,6,18,1),('SISAANESIPESU',25,65,7,21,1),('KUIVAUS',25,50,8,17,1),('LAAVAVAAHTO',25,65,9,26,0),('ITIKKAEP',25,65,10,27,1),('VAIKUTUS',26,50,1,4,0),('SISAANESIPESU',26,65,2,21,0),('ITIKKAEP',26,65,3,27,1),('VAIKUTUS',27,50,1,4,0),('SISAANESIPESU',27,65,2,21,0);
/*!40000 ALTER TABLE `SideProgramRule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SideProgramRule2`
--

DROP TABLE IF EXISTS `SideProgramRule2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SideProgramRule2` (
  `SideProgram` text collate utf8_unicode_ci NOT NULL,
  `MainId` int(11) NOT NULL,
  `Cmr_SideProgram` int(11) NOT NULL default '50',
  `id` int(11) NOT NULL,
  `LangId` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SideProgramRule2`
--

LOCK TABLES `SideProgramRule2` WRITE;
/*!40000 ALTER TABLE `SideProgramRule2` DISABLE KEYS */;
INSERT INTO `SideProgramRule2` VALUES ('VAIKUTUS',1,50,1,4,1),('PAKU',1,50,2,18,1),('PYORAESIPESU',1,65,3,20,1),('SISAANESIPESU',1,65,4,21,1),('VAAHTO',1,65,5,3,1),('ESIPESU2',1,65,6,2,1),('ITIKKAEP',1,65,7,27,1),('VAIKUTUS',2,50,1,4,1),('PAKU',2,50,2,18,1),('PYORAESIPESU',2,65,3,20,1),('ESIPESU1',2,65,4,1,1),('SISAANESIPESU',2,65,5,21,1),('VAAHTO',2,65,6,3,1),('ITIKKAEP',2,65,7,27,1),('VAIKUTUS',3,50,1,4,1),('KPHUUHTELU',3,50,2,11,1),('PYORAESIPESU',3,65,3,20,1),('SISAANESIPESU',3,65,4,21,1),('ALUSTA',3,50,5,5,1),('PYORAT',3,50,6,6,1),('ITIKKAEP',3,65,7,27,1),('PYORAT',5,50,1,6,1),('VAAHTO',6,65,3,3,1),('ALUSTA',6,50,4,5,1),('SIVUKP',6,50,5,7,1),('PAKU ',6,50,6,18,1),('KPHUUHTELU',6,50,7,11,1),('SISAANESIPESU',7,65,1,21,1),('PAKU',7,50,2,18,1),('PYORAT',7,50,3,6,1),('ALUSTA',7,50,4,5,1),('ITIKKAEP',7,65,5,27,1),('SIVUKP',8,50,1,7,1),('PYORAT',8,50,2,6,1),('ALUSTA',8,50,3,5,1),('PAKU',8,50,4,18,1),('SISAANESIPESU',8,65,5,21,1),('PYORAESIPESU',8,65,6,20,1),('ITIKKAEP',8,65,7,27,1),('ALUSTA',9,50,1,5,1),('PYORAT',9,50,2,6,1),('SIVUKP',9,50,3,7,1),('KPHUUHTELU',9,50,4,11,1),('PAKU',9,50,5,18,1),('SISAANESIPESU',9,65,6,21,1),('KUIVAUSVAHA',9,65,7,14,1),('VAHA',9,65,8,13,1),('RAINLUX',9,65,9,24,1),('VESIHUUHTELU',9,65,10,10,1),('ITIKKAEP',9,65,11,27,1),('KUIVAUSVAHA',10,65,1,14,1),('RENGASKIILLOTIN',10,65,2,22,1),('VAHA',10,65,3,13,1),('RAINLUX',10,65,4,24,1),('KUIVAUSVAHA',12,65,1,14,1),('RENGASKIILLOTIN',12,65,2,22,1),('VAHA',12,65,3,13,1),('RAINLUX',12,65,4,24,1),('KUIVAUSVAHA',13,65,1,14,1),('RENGASKIILLOTIN',13,65,2,22,1),('OSMOOSIVESI',13,50,3,12,1),('VESIHUUHTELU',13,50,4,10,1),('VAIKUTUS',13,50,5,4,1),('RENGASKIILLOTIN',14,50,1,22,1),('OSMOOSIVESI',14,50,2,12,1),('VESIHUUHTELU',14,50,3,10,1),('VAHA',14,65,4,13,1),('VAIKUTUS',14,50,5,4,1),('HARJAVAHA',16,65,1,15,1),('LOISTOVAHA',16,65,2,23,1),('KUIVAUSVAHA',16,65,3,14,1),('RENGASKIILLOTIN',16,65,4,22,1),('VAHA',16,65,5,13,1),('RAINLUX',16,65,6,24,1),('RENGASKIILLOTIN',17,65,1,22,1),('SISAANESIPESU',20,65,1,21,1),('VAIKUTUS',20,50,2,4,1),('ITIKKAEP',20,65,3,27,1),('VAHA',24,65,1,13,1),('KUIVAUSVAHA',24,65,2,14,1),('RENGASKIILLOTIN',24,65,3,22,1),('OSMOOSIVESI',24,50,4,12,1),('VESIHUUHTELU',24,50,5,10,1),('VAIKUTUS',24,50,6,4,1),('ESIPESU1',25,65,1,1,1),('ESIPESU2',25,65,2,2,1),('PYORAESIPESU',25,65,3,20,1),('VAAHTO',25,65,4,3,1),('VAIKUTUS',25,50,5,4,1),('PAKU',25,50,6,18,1),('SISAANESIPESU',25,65,7,21,1),('KUIVAUS',25,50,8,17,1),('LAAVAVAAHTO',25,65,9,26,1),('ITIKKAEP',25,65,10,27,1),('VAIKUTUS',26,50,1,4,1),('SISAANESIPESU',26,65,2,21,1),('ITIKKAEP',26,65,3,27,1),('VAIKUTUS',27,50,1,4,0),('SISAANESIPESU',27,65,2,21,0);
/*!40000 ALTER TABLE `SideProgramRule2` ENABLE KEYS */;
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

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
  `UseModule` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MainPrograms`
--

LOCK TABLES `MainPrograms` WRITE;
/*!40000 ALTER TABLE `MainPrograms` DISABLE KEYS */;
INSERT INTO `MainPrograms` VALUES ('ESIPESU1',1,1,65,9,1),
('ESIPESU2',2,2,65,9,1),
('VAAHTO',3,3,65,9,1),
('VAIKUTUS',4,4,50,9,1),
('ALUSTA',5,5,50,9,1),
('PYORAT',6,6,50,9,1),
('SIVUKP',7,7,50,9,1),
('KATTOKP',8,8,50,9,1),
('HARJAT',9,9,50,9,1),
('VESIHUUHTELU',10,10,50,9,1),
('KPHUUHTELU',11,11,50,9,1),
('OSMOOSIVESI',12,12,50,9,1),
('VAHA',13,13,65,9,1),
('KUIVAUSVAHA',14,14,65,9,1),
('HARJAVAHA',15,15,65,9,1),
('KIILLOTUS',16,16,65,9,1),
('KUIVAUS',17,17,50,9,1),
('PAKU',18,18,50,9,1),
('AIRLUX',19,19,65,9,1),
('PYORAESIPESU',20,20,65,9,1),
('SISAANESIPESU',21,21,50,9,1),
('RENGASKIILLOTIN',22,22,65,9,1),
('LOISTOVAHA',23,23,65,9,1),
('RAINLUX',24,24,65,9,1),
('SKANNAUS',25,25,100,9,1),
('LAAVAVAAHTO',26,26,65,9,1),
('ITIKKAEP',27,27,65,9,1);
/*!40000 ALTER TABLE `MainPrograms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MainPrograms2`
--

DROP TABLE IF EXISTS `MainPrograms2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MainPrograms2` (
  `MainProgram` text COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LangId` int(11) NOT NULL,
  `Cmr_MainProgram` int(10) NOT NULL DEFAULT '50',
  `Speed_MainProgram` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MainPrograms2`
--

LOCK TABLES `MainPrograms2` WRITE;
/*!40000 ALTER TABLE `MainPrograms2` DISABLE KEYS */;
INSERT INTO `MainPrograms2` VALUES ('ESIPESU1',1,1,65,9,1),
('ESIPESU2',2,2,65,9,1),
('VAAHTO',3,3,65,9,1),
('VAIKUTUS',4,4,50,9,1),
('ALUSTA',5,5,50,9,1),
('PYORAT',6,6,50,9,1),
('SIVUKP',7,7,50,9,1),
('KATTOKP',8,8,50,9,1),
('HARJAT',9,9,50,9,1),
('VESIHUUHTELU',10,10,50,9,1),
('KPHUUHTELU',11,11,50,9,1),
('OSMOOSIVESI',12,12,50,9,1),
('VAHA',13,13,65,9,1),
('KUIVAUSVAHA',14,14,65,9,1),
('HARJAVAHA',15,15,65,9,1),
('KIILLOTUS',16,16,65,9,1),
('KUIVAUS',17,17,50,9,1),
('PAKU',18,18,50,9,1),
('AIRLUX',19,19,65,9,1),
('PYORAESIPESU',20,20,65,9,1),
('SISAANESIPESU',21,21,50,9,1),
('RENGASKIILLOTIN',22,22,65,9,1),
('LOISTOVAHA',23,23,65,9,1),
('RAINLUX',24,24,65,9,1),
('SKANNAUS',25,25,100,9,1),
('LAAVAVAAHTO',26,26,65,9,1),
('ITIKKAEP',27,27,65,9,1);
/*!40000 ALTER TABLE `MainPrograms2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PassStyles`
--

DROP TABLE IF EXISTS `PassStyles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PassStyles` (
  `PassStyle` text COLLATE utf8_unicode_ci NOT NULL,
  `pass_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PassStyles`
--

LOCK TABLES `PassStyles` WRITE;
/*!40000 ALTER TABLE `PassStyles` DISABLE KEYS */;
INSERT INTO `PassStyles` VALUES ('FC',1,1),('FO',1,2),('SB',1,3),('PU',1,4),('RS',1,5),('NF',1,6),
('FC',2,1),('FO',2,2),('SB',2,3),('PU',2,4),('RS',2,5),('NF',2,6),
('FC',8,1),('FO',8,2),('SB',8,3),('PU',8,4),('RS',8,5),('NF',8,6),
('FC',9,1),('FO',9,2),('SB',9,3),('PU',9,4),('RS',9,5),('NF',9,6),
('FC',16,1),('FO',16,2),('SB',16,3),('PU',16,4),('RS',16,5),('NF',16,6),
('FC',17,1),('FO',17,2),('SB',17,3),('PU',17,4),('RS',17,5),('NF',17,6),
('FC',19,1),('FO',19,2),('SB',19,3),('PU',19,4),('RS',19,5),('NF',19,6),
('FC',25,1),('FO',25,2),('NF',25,3),
('FO',26,1),('SB',26,2),('PU',26,3),
('FC',27,1),('FO',27,2),('SB',27,3),('PU',27,4),('RS',27,5),('NF',27,6);
/*!40000 ALTER TABLE `PassStyles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PassStyles2`
--

DROP TABLE IF EXISTS `PassStyles2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PassStyles2` (
  `PassStyle` text COLLATE utf8_unicode_ci NOT NULL,
  `pass_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PassStyles2`
--

LOCK TABLES `PassStyles2` WRITE;
/*!40000 ALTER TABLE `PassStyles2` DISABLE KEYS */;
INSERT INTO `PassStyles2` VALUES ('FC',1,1),('FO',1,2),('SB',1,3),('PU',1,4),('RS',1,5),('NF',1,6),
('FC',2,1),('FO',2,2),('SB',2,3),('PU',2,4),('RS',2,5),('NF',2,6),
('FC',8,1),('FO',8,2),('SB',8,3),('PU',8,4),('RS',8,5),('NF',8,6),
('FC',9,1),('FO',9,2),('SB',9,3),('PU',9,4),('RS',9,5),('NF',9,6),
('FC',16,1),('FO',16,2),('SB',16,3),('PU',16,4),('RS',16,5),('NF',16,6),
('FC',17,1),('FO',17,2),('SB',17,3),('PU',17,4),('RS',17,5),('NF',17,6),
('FC',19,1),('FO',19,2),('SB',19,3),('PU',19,4),('RS',19,5),('NF',19,6),
('FC',25,1),('FO',25,2),('NF',25,3),
('FO',26,1),('SB',26,2),('PU',26,3),
('FC',27,1),('FO',27,2),('SB',27,3),('PU',27,4),('RS',27,5),('NF',27,6);
/*!40000 ALTER TABLE `PassStyles2` ENABLE KEYS */;
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
  `LangId` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SideProgramRule`
--

LOCK TABLES `SideProgramRule` WRITE;
/*!40000 ALTER TABLE `SideProgramRule` DISABLE KEYS */;
INSERT INTO `SideProgramRule` VALUES ('VAIKUTUS',1,50,1,4,1),('PAKU',1,50,2,18,1),('PYORAESIPESU',1,65,3,20,1),('SISAANESIPESU',1,65,4,21,1),('VAAHTO',1,65,5,3,1),('ESIPESU2',1,65,6,2,1),('ITIKKAEP',1,65,7,27,1),
('VAIKUTUS',2,50,1,4,1),('PAKU',2,50,2,18,1),('PYORAESIPESU',2,65,3,20,1),('ESIPESU1',2,65,4,1,1),('SISAANESIPESU',2,65,5,21,1),('VAAHTO',2,65,6,3,1),('ITIKKAEP',2,65,7,27,1),
('VAIKUTUS',3,50,1,4,1),('KPHUUHTELU',3,50,2,11,1),('PYORAESIPESU',3,65,3,20,1),('SISAANESIPESU',3,65,4,21,1),('ALUSTA',3,50,5,5,1),('PYORAT',3,50,6,6,1),('ITIKKAEP',3,65,7,27,1),
('PYORAT',5,50,1,6,1),
('VAAHTO',6,65,3,3,1),('ALUSTA',6,50,4,5,1),('SIVUKP',6,50,5,7,1),('PAKU ',6,50,6,18,1),('KPHUUHTELU',6,50,7,11,1),
('SISAANESIPESU',7,65,1,21,1),('PAKU',7,50,2,18,1),('PYORAT',7,50,3,6,1),('ALUSTA',7,50,4,5,1),('ITIKKAEP',7,65,5,27,1),
('SIVUKP',8,50,1,7,1),('PYORAT',8,50,2,6,1),('ALUSTA',8,50,3,5,1),('PAKU',8,50,4,18,1),('SISAANESIPESU',8,65,5,21,1),('PYORAESIPESU',8,65,6,20,1),('ITIKKAEP',8,65,7,27,1),
('ALUSTA',9,50,1,5,1),('PYORAT',9,50,2,6,1),('SIVUKP',9,50,3,7,1),('KPHUUHTELU',9,50,4,11,1),('PAKU',9,50,5,18,1),('SISAANESIPESU',9,65,6,21,1),('KUIVAUSVAHA',9,65,7,14,1),('VAHA',9,65,8,13,1),('RAINLUX',9,65,9,24,1),('VESIHUUHTELU',9,65,10,10,1),('ITIKKAEP',9,65,11,27,1),
('KUIVAUSVAHA',10,65,1,14,1),('RENGASKIILLOTIN',10,65,2,22,1),('VAHA',10,65,3,13,1),('RAINLUX',10,65,4,24,1),
('KUIVAUSVAHA',12,65,1,14,1),('RENGASKIILLOTIN',12,65,2,22,1),('VAHA',12,65,3,13,1),('RAINLUX',12,65,4,24,1),
('KUIVAUSVAHA',13,65,1,14,1),('RENGASKIILLOTIN',13,65,2,22,1),('OSMOOSIVESI',13,50,3,12,1),('VESIHUUHTELU',13,50,4,10,1),('VAIKUTUS',13,50,5,4,1),
('RENGASKIILLOTIN',14,50,1,22,1),('OSMOOSIVESI',14,50,2,12,1),('VESIHUUHTELU',14,50,3,10,1),('VAHA',14,65,4,13,1),('VAIKUTUS',14,50,5,4,1),
('HARJAVAHA',16,65,1,15,1),('LOISTOVAHA',16,65,2,23,1),('KUIVAUSVAHA',16,65,3,14,1),('RENGASKIILLOTIN',16,65,4,22,1),('VAHA',16,65,5,13,1),('RAINLUX',16,65,6,24,1),
('RENGASKIILLOTIN',17,65,1,22,1),
('SISAANESIPESU',20,65,1,21,1),('VAIKUTUS',20,50,2,4,1),('ITIKKAEP',20,65,3,27,1),
('VAHA',24,65,1,13,1),('KUIVAUSVAHA',24,65,2,14,1),('RENGASKIILLOTIN',24,65,3,22,1),('OSMOOSIVESI',24,50,4,12,1),('VESIHUUHTELU',24,50,5,10,1),('VAIKUTUS',24,50,6,4,1),
('ESIPESU1',25,65,1,1,1),('ESIPESU2',25,65,2,2,1),('PYORAESIPESU',25,65,3,20,1),('VAAHTO',25,65,4,3,1),('VAIKUTUS',25,50,5,4,1),('PAKU',25,50,6,18,1),('SISAANESIPESU',25,65,7,21,1),('KUIVAUS',25,50,8,17,1),('LAAVAVAAHTO',25,65,9,26,1),('ITIKKAEP',25,65,10,27,1),
('VAIKUTUS',26,50,1,4,1),('SISAANESIPESU',26,65,2,21,1),('ITIKKAEP',26,65,3,27,1),
('VAIKUTUS',27,50,1,4,0),('SISAANESIPESU',27,65,2,21,0);
/*!40000 ALTER TABLE `SideProgramRule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SideProgramRule2`
--

DROP TABLE IF EXISTS `SideProgramRule2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SideProgramRule2` (
  `SideProgram` text COLLATE utf8_unicode_ci NOT NULL,
  `MainId` int(11) NOT NULL,
  `Cmr_SideProgram` int(11) NOT NULL DEFAULT '50',
  `id` int(11) NOT NULL,
  `LangId` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SideProgramRule2`
--

LOCK TABLES `SideProgramRule2` WRITE;
/*!40000 ALTER TABLE `SideProgramRule2` DISABLE KEYS */;
INSERT INTO `SideProgramRule2` VALUES ('VAIKUTUS',1,50,1,4,1),('PAKU',1,50,2,18,1),('PYORAESIPESU',1,65,3,20,1),('SISAANESIPESU',1,65,4,21,1),('VAAHTO',1,65,5,3,1),('ESIPESU2',1,65,6,2,1),('ITIKKAEP',1,65,7,27,1),
('VAIKUTUS',2,50,1,4,1),('PAKU',2,50,2,18,1),('PYORAESIPESU',2,65,3,20,1),('ESIPESU1',2,65,4,1,1),('SISAANESIPESU',2,65,5,21,1),('VAAHTO',2,65,6,3,1),('ITIKKAEP',2,65,7,27,1),
('VAIKUTUS',3,50,1,4,1),('KPHUUHTELU',3,50,2,11,1),('PYORAESIPESU',3,65,3,20,1),('SISAANESIPESU',3,65,4,21,1),('ALUSTA',3,50,5,5,1),('PYORAT',3,50,6,6,1),('ITIKKAEP',3,65,7,27,1),
('PYORAT',5,50,1,6,1),
('VAAHTO',6,65,3,3,1),('ALUSTA',6,50,4,5,1),('SIVUKP',6,50,5,7,1),('PAKU ',6,50,6,18,1),('KPHUUHTELU',6,50,7,11,1),
('SISAANESIPESU',7,65,1,21,1),('PAKU',7,50,2,18,1),('PYORAT',7,50,3,6,1),('ALUSTA',7,50,4,5,1),('ITIKKAEP',7,65,5,27,1),
('SIVUKP',8,50,1,7,1),('PYORAT',8,50,2,6,1),('ALUSTA',8,50,3,5,1),('PAKU',8,50,4,18,1),('SISAANESIPESU',8,65,5,21,1),('PYORAESIPESU',8,65,6,20,1),('ITIKKAEP',8,65,7,27,1),
('ALUSTA',9,50,1,5,1),('PYORAT',9,50,2,6,1),('SIVUKP',9,50,3,7,1),('KPHUUHTELU',9,50,4,11,1),('PAKU',9,50,5,18,1),('SISAANESIPESU',9,65,6,21,1),('KUIVAUSVAHA',9,65,7,14,1),('VAHA',9,65,8,13,1),('RAINLUX',9,65,9,24,1),('VESIHUUHTELU',9,65,10,10,1),('ITIKKAEP',9,65,11,27,1),
('KUIVAUSVAHA',10,65,1,14,1),('RENGASKIILLOTIN',10,65,2,22,1),('VAHA',10,65,3,13,1),('RAINLUX',10,65,4,24,1),
('KUIVAUSVAHA',12,65,1,14,1),('RENGASKIILLOTIN',12,65,2,22,1),('VAHA',12,65,3,13,1),('RAINLUX',12,65,4,24,1),
('KUIVAUSVAHA',13,65,1,14,1),('RENGASKIILLOTIN',13,65,2,22,1),('OSMOOSIVESI',13,50,3,12,1),('VESIHUUHTELU',13,50,4,10,1),('VAIKUTUS',13,50,5,4,1),
('RENGASKIILLOTIN',14,50,1,22,1),('OSMOOSIVESI',14,50,2,12,1),('VESIHUUHTELU',14,50,3,10,1),('VAHA',14,65,4,13,1),('VAIKUTUS',14,50,5,4,1),
('HARJAVAHA',16,65,1,15,1),('LOISTOVAHA',16,65,2,23,1),('KUIVAUSVAHA',16,65,3,14,1),('RENGASKIILLOTIN',16,65,4,22,1),('VAHA',16,65,5,13,1),('RAINLUX',16,65,6,24,1),
('RENGASKIILLOTIN',17,65,1,22,1),
('SISAANESIPESU',20,65,1,21,1),('VAIKUTUS',20,50,2,4,1),('ITIKKAEP',20,65,3,27,1),
('VAHA',24,65,1,13,1),('KUIVAUSVAHA',24,65,2,14,1),('RENGASKIILLOTIN',24,65,3,22,1),('OSMOOSIVESI',24,50,4,12,1),('VESIHUUHTELU',24,50,5,10,1),('VAIKUTUS',24,50,6,4,1),
('ESIPESU1',25,65,1,1,1),('ESIPESU2',25,65,2,2,1),('PYORAESIPESU',25,65,3,20,1),('VAAHTO',25,65,4,3,1),('VAIKUTUS',25,50,5,4,1),('PAKU',25,50,6,18,1),('SISAANESIPESU',25,65,7,21,1),('KUIVAUS',25,50,8,17,1),('LAAVAVAAHTO',25,65,9,26,1),('ITIKKAEP',25,65,10,27,1),
('VAIKUTUS',26,50,1,4,1),('SISAANESIPESU',26,65,2,21,1),('ITIKKAEP',26,65,3,27,1),
('VAIKUTUS',27,50,1,4,0),('SISAANESIPESU',27,65,2,21,0);
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

-- Dump completed on 2016-04-07 10:00:30


ALTER TABLE  `MachineSetupData` ADD `email_interval` INT( 11 ) NOT NULL DEFAULT '1';
ALTER TABLE  `MachineSetupData2` ADD `email_interval` INT( 11 ) NOT NULL DEFAULT '1';
ALTER TABLE  `MachineSetupData` ADD `sum_of_deiceseqs` INT( 11 ) NOT NULL DEFAULT '1';
ALTER TABLE  `MachineSetupData2` ADD `sum_of_deiceseqs` INT( 11 ) NOT NULL DEFAULT '1';
ALTER TABLE  `MachineSetupData` ADD `sum_of_pumps` INT( 11 ) NOT NULL DEFAULT '1';
ALTER TABLE  `MachineSetupData2` ADD `sum_of_pumps` INT( 11 ) NOT NULL DEFAULT '1';



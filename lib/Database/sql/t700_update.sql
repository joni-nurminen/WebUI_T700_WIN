-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2014 at 09:11 AM
-- Server version: 5.1.66
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `t700`
--

-- --------------------------------------------------------

--
-- Table structure for table `CopiedProgram2`
--

CREATE TABLE IF NOT EXISTS `CopiedProgram2` (
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

--
-- Dumping data for table `CopiedProgram2`
--

INSERT INTO `CopiedProgram2` (`SlotNumber`, `id`, `MainProgram`, `LangIdMain`, `Cmr_MainProgram`, `PassStyle`, `SideProgram1`, `LangIdSide1`, `Cmr_SideProgram1`, `SideProgram2`, `LangIdSide2`, `Cmr_SideProgram2`, `SideProgram3`, `LangIdSide3`, `Cmr_SideProgram3`, `SideProgram4`, `LangIdSide4`, `Cmr_SideProgram4`, `SideProgram5`, `LangIdSide5`, `Cmr_SideProgram5`, `Speed_MainProgram`, `Direction`, `Program_Type`, `Set_Number`) VALUES
(7, 1, 'KUIVAUSVAHA', 14, 65, '', 'RENGASKIILLOTIN', 22, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'summer_program', 0),
(7, 2, 'VESIHUUHTELU', 10, 50, '', 'KUIVAUSVAHA', 14, 65, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'summer_program', 0),
(7, 3, 'ESIPESU2', 2, 65, 'SB', 'PAKU', 18, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'summer_program', 0);

-- --------------------------------------------------------

--
-- Table structure for table `IoCardSelections2`
--

CREATE TABLE IF NOT EXISTS `IoCardSelections2` (
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

--
-- Dumping data for table `IoCardSelections2`
--

INSERT INTO `IoCardSelections2` (`in1`, `in2`, `in3`, `in4`, `in5`, `in6`, `out1`, `out2`, `out3`, `out4`, `out5`, `out6`) VALUES
(1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `IoData2`
--

CREATE TABLE IF NOT EXISTS `IoData2` (
  `id` int(11) NOT NULL,
  `card` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `IoData2`
--

INSERT INTO `IoData2` (`id`, `card`) VALUES
(7, 1),
(6, 1),
(5, 1),
(4, 1),
(3, 1),
(2, 1),
(1, 1),
(193, 33),
(194, 33),
(195, 33),
(196, 33),
(197, 33),
(198, 33);

-- --------------------------------------------------------

--
-- Table structure for table `MachineSetupData2`
--

CREATE TABLE IF NOT EXISTS `MachineSetupData2` (
  `machine_type` int(11) NOT NULL,
  `bay_type` int(11) NOT NULL,
  `door_control` int(11) NOT NULL,
  `door_function` int(11) NOT NULL,
  `wax_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MachineSetupData2`
--

INSERT INTO `MachineSetupData2` (`machine_type`, `bay_type`, `door_control`, `door_function`, `wax_type`) VALUES
(3, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `MachineSetupFunctions2`
--

CREATE TABLE IF NOT EXISTS `MachineSetupFunctions2` (
  `function` text NOT NULL,
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MachineSetupFunctions2`
--

INSERT INTO `MachineSetupFunctions2` (`function`, `id`, `value`) VALUES
('chassis_wash', 1, 1),
('wheel_wash', 2, 1),
('prewash_2', 3, 0),
('van_nozzles', 4, 0),
('ro_water', 5, 0),
('wheel_brush', 6, 1),
('buffing_wax', 7, 1),
('wheel_prewash', 8, 0),
('tyre_shiner', 9, 0),
('opt_scanner', 10, 1),
('air_wax', 11, 1),
('biojet_in_use', 12, 0),
('drive_in_prewash', 13, 1),
('option1', 14, 0),
('option2', 15, 0),
('null', 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `MainPrograms2`
--

CREATE TABLE IF NOT EXISTS `MainPrograms2` (
  `MainProgram` text COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LangId` int(11) NOT NULL,
  `Cmr_MainProgram` int(10) NOT NULL DEFAULT '50',
  `Speed_MainProgram` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `MainPrograms2`
--

INSERT INTO `MainPrograms2` (`MainProgram`, `id`, `LangId`, `Cmr_MainProgram`, `Speed_MainProgram`, `UseModule`) VALUES
('ESIPESU1', 1, 1, 65, 9, 1),
('ESIPESU2', 2, 2, 65, 9, 1),
('VAAHTO', 3, 3, 65, 9, 1),
('VAIKUTUS', 4, 4, 50, 9, 0),
('ALUSTA', 5, 5, 50, 9, 1),
('PYORAT', 6, 6, 50, 9, 1),
('SIVUKP', 7, 7, 50, 9, 0),
('KATTOKP', 8, 8, 50, 9, 0),
('HARJAT', 9, 9, 50, 9, 0),
('VESIHUUHTELU', 10, 10, 50, 9, 1),
('KPHUUHTELU', 11, 11, 50, 9, 0),
('OSMOOSIVESI', 12, 12, 50, 9, 0),
('VAHA', 13, 13, 65, 9, 1),
('KUIVAUSVAHA', 14, 14, 65, 9, 1),
('HARJAVAHA', 15, 15, 65, 9, 1),
('KIILLOTUS', 16, 16, 65, 9, 1),
('KUIVAUS', 17, 17, 50, 9, 1),
('', 18, 18, 50, 9, 0),
('AIRLUX', 19, 19, 65, 9, 1),
('PYORAESIPESU', 20, 20, 65, 9, 1),
('', 21, 21, 50, 9, 0),
('RENGASKIILLOTIN', 22, 22, 65, 9, 1),
('LOISTOVAHA', 23, 23, 65, 9, 1),
('RAINLUX', 24, 24, 65, 9, 1),
('SKANNAUS', 25, 25, 100, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PassStyles`
--
DROP TABLE PassStyles;

CREATE TABLE IF NOT EXISTS `PassStyles` (
  `PassStyle` text COLLATE utf8_unicode_ci NOT NULL,
  `pass_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `PassStyles`
--

INSERT INTO `PassStyles` (`PassStyle`, `pass_id`, `id`) VALUES
('FC', 1, 1),
('FO', 1, 2),
('SB', 1, 3),
('PU', 1, 4),
('RS', 1, 5),
('NF', 1, 6),
('FC', 2, 1),
('FO', 2, 2),
('SB', 2, 3),
('PU', 2, 4),
('RS', 2, 5),
('NF', 2, 6),
('FC', 8, 1),
('FO', 8, 2),
('SB', 8, 3),
('PU', 8, 4),
('RS', 8, 5),
('NF', 8, 6),
('FC', 9, 1),
('FO', 9, 2),
('SB', 9, 3),
('PU', 9, 4),
('RS', 9, 5),
('NF', 9, 6),
('FC', 16, 1),
('FO', 16, 2),
('SB', 16, 3),
('PU', 16, 4),
('RS', 16, 5),
('NF', 16, 6),
('FC', 17, 1),
('FO', 17, 2),
('SB', 17, 3),
('PU', 17, 4),
('RS', 17, 5),
('NF', 17, 6),
('FC', 19, 1),
('FO', 19, 2),
('SB', 19, 3),
('PU', 19, 4),
('RS', 19, 5),
('NF', 19, 6),
('FO', 25, 1),
('SB', 25, 2),
('NF', 25, 3);

-- --------------------------------------------------------

--
-- Table structure for table `PassStyles2`
--

CREATE TABLE IF NOT EXISTS `PassStyles2` (
  `PassStyle` text COLLATE utf8_unicode_ci NOT NULL,
  `pass_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `PassStyles2`
--

INSERT INTO `PassStyles2` (`PassStyle`, `pass_id`, `id`) VALUES
('FC', 1, 1),
('FO', 1, 2),
('SB', 1, 3),
('PU', 1, 4),
('RS', 1, 5),
('NF', 1, 6),
('FC', 2, 1),
('FO', 2, 2),
('SB', 2, 3),
('PU', 2, 4),
('RS', 2, 5),
('NF', 2, 6),
('FC', 8, 1),
('FO', 8, 2),
('SB', 8, 3),
('PU', 8, 4),
('RS', 8, 5),
('NF', 8, 6),
('FC', 9, 1),
('FO', 9, 2),
('SB', 9, 3),
('PU', 9, 4),
('RS', 9, 5),
('NF', 9, 6),
('FC', 16, 1),
('FO', 16, 2),
('SB', 16, 3),
('PU', 16, 4),
('RS', 16, 5),
('NF', 16, 6),
('FC', 17, 1),
('FO', 17, 2),
('SB', 17, 3),
('PU', 17, 4),
('RS', 17, 5),
('NF', 17, 6),
('FC', 19, 1),
('FO', 19, 2),
('SB', 19, 3),
('PU', 19, 4),
('RS', 19, 5),
('NF', 19, 6),
('FO', 25, 1),
('SB', 25, 2),
('NF', 25, 3);

-- --------------------------------------------------------

--
-- Table structure for table `SavedPrograms2`
--

CREATE TABLE IF NOT EXISTS `SavedPrograms2` (
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

--
-- Dumping data for table `SavedPrograms2`
--

INSERT INTO `SavedPrograms2` (`SlotNumber`, `id`, `MainProgram`, `LangIdMain`, `Cmr_MainProgram`, `PassStyle`, `SideProgram1`, `LangIdSide1`, `Cmr_SideProgram1`, `SideProgram2`, `LangIdSide2`, `Cmr_SideProgram2`, `SideProgram3`, `LangIdSide3`, `Cmr_SideProgram3`, `SideProgram4`, `LangIdSide4`, `Cmr_SideProgram4`, `SideProgram5`, `LangIdSide5`, `Cmr_SideProgram5`, `Speed_MainProgram`, `Direction`, `Program_Type`, `Set_Number`) VALUES
(1, 2, 'ESIPESU2', 2, 65, 'SB', 'PAKU', 18, 50, 'PYORAESIPESU', 20, 65, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'none', 0),
(1, 1, 'ESIPESU1', 1, 65, 'FC', 'VAIKUTUS', 4, 50, 'PAKU', 18, 50, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'none', 0),
(4, 3, 'VESIHUUHTELU', 10, 50, '', 'KUIVAUSVAHA', 14, 65, 'RENGASKIILLOTIN', 22, 65, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'none', 0),
(4, 2, 'ESIPESU2', 2, 65, 'SB', 'VAIKUTUS', 4, 50, 'PYORAESIPESU', 20, 65, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'none', 0),
(4, 1, 'ESIPESU1', 1, 65, 'FC', 'VAIKUTUS', 4, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'none', 0),
(7, 2, 'VESIHUUHTELU', 10, 50, '', 'KUIVAUSVAHA', 14, 65, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'summer_program', 0),
(7, 1, 'KUIVAUSVAHA', 14, 65, '', 'RENGASKIILLOTIN', 22, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'summer_program', 0),
(8, 3, 'PYORAT', 6, 50, '', 'PAKU ', 18, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'fast_program', 0),
(8, 2, 'ESIPESU2', 2, 65, 'PU', 'VAIKUTUS', 4, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'fast_program', 0),
(8, 1, 'ESIPESU1', 1, 65, 'FC', 'VAIKUTUS', 4, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'fast_program', 0),
(0, 0, '', 0, 0, '', '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 0, '', '', 0),
(8, 4, 'VESIHUUHTELU', 10, 50, '', 'RENGASKIILLOTIN', 22, 65, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'fast_program', 0),
(25, 2, 'VAAHTO', 3, 65, '', 'ALUSTA', 5, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'fast_program', 0),
(25, 1, 'ESIPESU2', 2, 65, 'FO', 'VAIKUTUS', 4, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'fast_program', 0),
(7, 3, 'ESIPESU2', 2, 65, 'SB', 'PAKU', 18, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'summer_program', 0),
(7, 4, 'KUIVAUSVAHA', 14, 65, '', 'RENGASKIILLOTIN', 22, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'summer_program', 0),
(1, 3, 'VAAHTO', 3, 65, '', 'ALUSTA', 5, 50, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '<<<', 'none', 0),
(4, 4, 'VAHA', 13, 65, '', 'RENGASKIILLOTIN', 22, 65, '', 0, 0, '', 0, 0, '', 0, 0, '', 0, 0, 9, '>>>', 'none', 0);

-- --------------------------------------------------------

--
-- Table structure for table `SideProgramRule2`
--

CREATE TABLE IF NOT EXISTS `SideProgramRule2` (
  `SideProgram` text COLLATE utf8_unicode_ci NOT NULL,
  `MainId` int(11) NOT NULL,
  `Cmr_SideProgram` int(11) NOT NULL DEFAULT '50',
  `id` int(11) NOT NULL,
  `LangId` int(11) NOT NULL,
  `UseModule` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `SideProgramRule2`
--

INSERT INTO `SideProgramRule2` (`SideProgram`, `MainId`, `Cmr_SideProgram`, `id`, `LangId`, `UseModule`) VALUES
('VAIKUTUS', 1, 50, 1, 4, 1),
('PAKU', 1, 50, 2, 18, 1),
('PYORAESIPESU', 1, 65, 3, 20, 1),
('SISAANESIPESU', 1, 65, 4, 21, 1),
('VAAHTO', 1, 65, 5, 3, 1),
('ESIPESU2', 1, 65, 6, 2, 0),
('VAIKUTUS', 2, 50, 1, 4, 1),
('PAKU', 2, 50, 2, 18, 1),
('PYORAESIPESU', 2, 65, 3, 20, 1),
('ESIPESU1', 2, 65, 4, 1, 0),
('SISAANESIPESU', 2, 65, 5, 21, 1),
('VAAHTO', 2, 65, 6, 3, 1),
('VAIKUTUS', 3, 50, 1, 4, 0),
('KPHUUHTELU', 3, 50, 2, 11, 0),
('PYORAESIPESU', 3, 65, 3, 20, 0),
('SISAANESIPESU', 3, 65, 4, 21, 0),
('ALUSTA', 3, 50, 5, 5, 1),
('PYORAT', 3, 50, 6, 6, 0),
('PYORAT', 5, 50, 1, 6, 1),
('VAAHTO', 6, 65, 3, 3, 0),
('ALUSTA', 6, 50, 4, 5, 1),
('SIVUKP', 6, 50, 5, 7, 1),
('PAKU ', 6, 50, 6, 18, 1),
('SISAANESIPESU', 7, 65, 1, 21, 0),
('PAKU', 7, 50, 2, 18, 0),
('PYORAT', 7, 50, 3, 6, 0),
('ALUSTA', 7, 50, 4, 5, 0),
('SIVUKP', 8, 50, 1, 7, 0),
('PYORAT', 8, 50, 2, 6, 0),
('ALUSTA', 8, 50, 3, 5, 0),
('PAKU', 8, 50, 4, 18, 0),
('SISAANESIPESU', 8, 65, 5, 21, 0),
('PYORAESIPESU', 8, 65, 6, 20, 0),
('ALUSTA', 9, 50, 1, 5, 0),
('PYORAT', 9, 50, 2, 6, 0),
('SIVUKP', 9, 50, 3, 7, 0),
('KPHUUHTELU', 9, 50, 4, 11, 0),
('PAKU', 9, 50, 5, 18, 0),
('SISAANESIPESU', 9, 65, 6, 21, 0),
('KUIVAUSVAHA', 9, 65, 7, 14, 0),
('VAHA', 9, 65, 8, 13, 0),
('RAINLUX', 9, 65, 9, 24, 0),
('VESIHUUHTELU', 9, 65, 10, 10, 0),
('KUIVAUSVAHA', 10, 65, 1, 14, 1),
('RENGASKIILLOTIN', 10, 65, 2, 22, 1),
('VAHA', 10, 65, 3, 13, 0),
('RAINLUX', 10, 65, 4, 24, 0),
('KUIVAUSVAHA', 12, 65, 1, 14, 0),
('RENGASKIILLOTIN', 12, 65, 2, 22, 0),
('VAHA', 12, 65, 3, 13, 0),
('RAINLUX', 12, 65, 4, 24, 0),
('KUIVAUSVAHA', 13, 65, 1, 14, 1),
('RENGASKIILLOTIN', 13, 65, 2, 22, 1),
('OSMOOSIVESI', 13, 50, 3, 12, 0),
('VESIHUUHTELU', 13, 50, 4, 10, 0),
('RENGASKIILLOTIN', 14, 50, 1, 22, 1),
('OSMOOSIVESI', 14, 50, 2, 12, 0),
('VESIHUUHTELU', 14, 50, 3, 10, 1),
('VAHA', 14, 65, 4, 13, 1),
('HARJAVAHA', 16, 65, 1, 15, 1),
('LOISTOVAHA', 16, 65, 2, 23, 1),
('KUIVAUSVAHA', 16, 65, 3, 14, 1),
('RENGASKIILLOTIN', 16, 65, 4, 22, 1),
('VAHA', 16, 65, 5, 13, 1),
('RAINLUX', 16, 65, 6, 24, 1),
('RENGASKIILLOTIN', 17, 65, 1, 22, 1),
('SISAANESIPESU', 20, 65, 1, 21, 1),
('VAIKUTUS', 20, 50, 2, 4, 1),
('VAHA', 24, 65, 1, 13, 1),
('KUIVAUSVAHA', 24, 65, 2, 14, 1),
('RENGASKIILLOTIN', 24, 65, 3, 22, 1),
('OSMOOSIVESI', 24, 50, 4, 12, 0),
('VESIHUUHTELU', 24, 50, 5, 10, 1),
('ESIPESU1', 25, 65, 1, 1, 1),
('ESIPESU2', 25, 65, 2, 2, 1),
('PYORAESIPESU', 25, 65, 3, 20, 1),
('VAAHTO', 25, 65, 4, 3, 1),
('VAIKUTUS', 25, 50, 5, 4, 1),
('PAKU', 25, 50, 6, 18, 0),
('SISAANESIPESU', 25, 65, 7, 21, 1),
('KUIVAUS', 25, 50, 8, 17, 1);

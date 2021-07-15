<?php
/** IFSF-toimintatilat     */
define('INOPERATIVE',       1);
define('CLOSED',            2);
define('IDLE',              3);
define('CUSTOMER_ENTRY',    4);
define('AUTHORISED',        5);
define('WASHING',           6);
define('SUSPENDED_WASHING', 7);
define('DONE_WASHING',      8);
define('MAINTENANCE',       9);

/** Misc   */
define('OPERATION_MODE',        31324);
define('SHAREDMEMORY_SIZE',     48360); // size in bytes
//define('VERSION_NRO',           19846); // version nro data
define('VERSION_NRO',           31312); // version nro data, updKHu v4.7
define('IFSF_BUS_CONTROL',		31292); // bus control for ifsf
define('OPTION4',               19698); // Option4
define('OPTION5',               19699); // Option5
define('OPTION6',               19700); // Option6
define('IFSF_OPTION',           19701); // ifsf activated - Option7
define('MAINTENANCE_MODE',		19702); // maintenance mode
define('ALLOW_CONTINUE_CANCEL', 19703); // Emergency stop released -> allow cancel and continue commands
define('WATER_PRESS',     		19710); // Harjaveden paineanturi
define('STATION_NAME',     		27084); // Aseman nimi, updKHu v4.7

/** Program number   */
define('PROGRAM_NUMBER',		31332); // poletti
define('PROGRAM_LINE_NUMBER',	31289);
define('WASHINGTIME_L',			31440); // 4
define('WASHINGTIME_H',			31441); // 4

define('ALLOWSTART',			31340);
define('ALLOWSTART_L',			31340);
define('ALLOWSTART_H',			31341);
define('ALLOWSTART_LL',			31342);
define('ALLOWSTART_HH',			31343);

define('SHM_FLASH_CACHE',		2252);
define('WASHING_COUNTER',		19504); // Polettilaskureiden alkukohta EEPROM:lla
define('WASHING_COUNTER_BUP',	21836); // Polettilaskureiden backup alkukohta, updKHu v4.7
define('WASHING_COUNTER_START',	SHM_FLASH_CACHE + WASHING_COUNTER);
define('SUSPENDED_WASHES',		21820); // keskeytyneet pesut

define('WASHING_COUNTER2_START',19712); // Polettilaskurit 17 ja 18 alkukohta
define('WASHING_COUNTER_RESET',	0x4FFF);    // Laskureiden nollauslippu BB=nollattu

/** Inputs / Outputs */
define ('INPUT_HWMASK', 		272);   //+272(18) - 6 boards, each contains 3*8bit bytes -> 6 * 24bits
define ('OUTPUT_CACHE_STATE', 	290);   //+290(144)- 6 boards each contains  3*8bit bytes, , each byte has written IO status
define ('OUTPUT_HWMASK', 		434);   //+434(18) - 6 boards each contains  3*8bit bytes, , each byte has actual output that has been written to HW
define ('OUTPUT_CACHE_TIMER', 	452);   //+452(576)- 6 boards each contains  3*8bit bytes, each byte has written Absolutetime when pulse is done (lsb's 00xx are state,active)
/* Output7  */
define ('OUTPUT_EX_HWMASK',     31812); //+31812(4)  - ExtendedOutputHwMask

// Output_CacheState[6][3][8]; //+290(144) // 6 boards each contains  3*8bit bytes, , each byte has written IO status
define ('GOUT_00', 	290); // 290
define ('GOUT_01', 	298); // 298
define ('GOUT_02', 	306); // 306

define ('GOUT_10', 	314); // 314
define ('GOUT_21', 	322); // 322
define ('GOUT_22', 	330); // 330

define ('GOUT_30', 	338); // 338
define ('GOUT_31', 	346); // 346
define ('GOUT_32', 	354); // 354

define ('GOUT_40', 	362); // 362
define ('GOUT_41', 	370); // 370
define ('GOUT_42', 	378); // 378

define ('GOUT_50', 	386); // 386
define ('GOUT_51', 	394); // 394
define ('GOUT_52', 	402); // 402

define ('GOUT_60', 	410); // 410
define ('GOUT_61', 	418); // 418
define ('GOUT_62', 	426); // 426

define ('GOUT_70', 	31808); // 31808    // use for new IO's in Beckhoff
define ('GOUT_71', 	31809); // 31809    // use for new IO's in Beckhoff
define ('GOUT_72', 	31810); // 31810    // use for new IO's in Beckhoff

/** Timestamps for alarms  */
define ('HAIRIO1_TIME', 	0x4350  + SHM_FLASH_CACHE); // Timestamp for alarm 1
define ('HAIRIO2_TIME', 	0x4360  + SHM_FLASH_CACHE); // Timestamp for alarm 2
define ('HAIRIO3_TIME', 	0x4370  + SHM_FLASH_CACHE); // Timestamp for alarm 3
define ('HAIRIO4_TIME', 	0x4380  + SHM_FLASH_CACHE); // Timestamp for alarm 4
define ('HAIRIO5_TIME', 	0x4390  + SHM_FLASH_CACHE); // Timestamp for alarm 5
define ('HAIRIO6_TIME', 	0x43A0  + SHM_FLASH_CACHE); // Timestamp for alarm 6
define ('HAIRIO7_TIME', 	0x43B0  + SHM_FLASH_CACHE); // Timestamp for alarm 7
define ('HAIRIO8_TIME', 	0x43C0  + SHM_FLASH_CACHE); // Timestamp for alarm 8
define ('HAIRIO9_TIME', 	0x43D0  + SHM_FLASH_CACHE); // Timestamp for alarm 9
define ('HAIRIO10_TIME', 	0x43E0  + SHM_FLASH_CACHE); // Timestamp for alarm 10


/** BB-message text  */
define ('BB_STRING', 			1220);
define ('UPDATES_WRITING', 		0);
define ('UPDATES_FINISHED', 	4);
define ('SIZE', 				8);
define ('TEKSTI', 				9);

/** Machinesetup  */
define ('MACHINE_TYPE',			0x4400);
define ('MACHINE_HEIGHT',    	0x4402);
define ('MACHINE_HEIGHT_KH',    0x4404);
define ('HALL_LENGTH',    		0x4406);
/** washbay  */
define ('BAY_TYPE',				0x440A); // bay type
define ('DOOR_CONTROL',    		0x440B); // doorcontrol
define ('DOOR_FUNCTION',    	0x440C); // doorfunction
define ('VAHATYYPPI',    		0x441A); // waxtype
define ('VAAHTOTYYPPI',    		0x4437); // foamtype
/* io-data */
define ('TOP_BRUSH_PW',    		31794); // TopBrush PW%
define ('NOZZLE_PW',    		31793); // Nozzle PW%
define ('GANTRY_PW',    		31792); // Gantry PW%
/** Log  */
define ('LOG_START',			31972); // log start offset 31972
define ('LOG_ROW',    			256);   // length of row
define ('LOG_ROW_MAX',    		64);    // max sum of log rows
define ('LOG_SIZE',    			16384); // log size 64*256
/** pumps  */
define ('KP_PUMPS',     		17456);  // KP-pumppujen määr443c
/** iceseqs  */
define ('DEICE_SEQS',     		17468);  // deice cycles


global $FUNCTIONS;
$FUNCTIONS = array (
	1 =>    	17428, //ALUSTAPESURI
	2 =>    	17429, //PYORAPESURI
	3 =>    	17430, //TOINEN_ESIPESU
	4 =>    	17431, //PAKUSUUTTIMET
	5 =>    	17432, //OSMOOSIKAARI
	6 =>    	17433, //KP_HUUHT_KAARI
	7 =>    	17435, //HARJAVAHA_LAITE
	8 =>    	17436, //PYORA_ESIPESU
	9 =>    	17440, //PYORA_KIILLOTUS
	10 =>    	17441, //SCANNERILAITE
	11 =>    	17421, //AIRLUX
	12 =>    	17422, //BIOJET
	13 =>		17442, //DRIVEINPREWASH
	14 =>		17443, //OPTION1
	15 =>		17444, //OPTION2
	16 =>		17445, //OPTION3
	17 =>		17446, //OPTION4
	18 =>		17447, //OPTION5
	19 =>		17448, //OPTION6
	20 =>		17449, //OPTION7
	21 =>		17458, //OPTION8    updKHu v4.6
	22 =>		17459, //OPTION9    updKHu v4.6
	23 =>		17460, //OPTION10   updKHu v4.6
	24 =>		17461, //OPTION11   updKHu v4.6
	25 =>		17462  //OPTION12   updKHu v4.6
);

/** offsetit pesumooduuleille jaetussa muistissa  */
global $MODULES;
$MODULES = array(
	"PROG1" => 22412,
	"PROG2" => 22423,
	"PROG3" => 22434,
	"PROG4" => 22445,
	"PROG5" => 22456,
	"PROG6" => 22467,
	"PROG7" => 22478,
	"PROG8" => 22489,
	"PROG9" => 22500,
	"PROG10" => 22511,
	"PROG11" => 22522,
	"PROG12" => 22533,
	"PROG13" => 22544,
	"PROG14" => 22555,
	"PROG15" => 22566,
	"PROG16" => 22577,
	"PROG17" => 22588,
	"PROG18" => 22599,
	"PROG19" => 22610,
	"PROG20" => 22621,
	"PROG21" => 22632,
	"PROG22" => 22643,
	"PROG23" => 22654,
	"PROG24" => 22665,
	"PROG25" => 22676,
	"PROG26" => 22687
);


/**  KONEMALLIT */
define('HARJAKONE', 		1);
define('KP_KONE', 			2);
define('COMBI_KONE', 		3);
define('KUIVAAJA_KONE', 	4);
define('HARJA_DUO_MASTER', 	5);
define('HARJA_DUO_SLAVE', 	6);
define('KP_DUO_MASTER', 	7);
define('KP_DUO_SLAVE', 		8);
define('COMBI_DUO_MASTER', 	9);
define('COMBI_DUO_SLAVE', 	10);

global $ERRORS;
$ERRORS = array (
	'Yhteyskatkos (PC)' ,
    'Taajuusmuuttaja U4' ,
    'Taajuusmuuttaja U6' ,
    'Mikroterminaali' ,
	'Pesuvaiheen aikaraja' ,
    'Teho: vasen harja' ,
    'Teho: oikea harja' ,
    'Teho: kattoharja' ,
	'Moott.suoja/SH ylikallistus' ,
    'Hihnaraja' ,
    'Ajoturvat' ,
    'Hataseis' ,
    'Pumput suojakytkin' ,
	'Valisailion pinta' ,
    'BioJet vedenpinta' ,
    'BioJet taytto' ,
    'Ilmanpaine' ,
    'Suuttimen asento' ,
	'Suutin siirtynyt' ,
    'Jarjestelmavirhe' ,
    'Suutin alaraja' ,
    'Kattoharja alaraja' ,
    'Suutin valunut' ,
	'Kattoharja valunut' ,
    'Alijännite 80V',
    'Alijännite 80-160V',
    'Ylijännite 260V',
    'CPU reset',
    'Taajuusmuuttaja ramppi',
    'Taajuusmuuttaja T11',
    'Kulkupulssit B10',
    'Kattosuutin pulssit B11',
    'Kattoharja pulssit B12',
    'Ylikorkea ajoneuvo',
    'Pyöräharja juuttunut',
    'Sivuharjan ylikallistus',
    'ETHERNET Master',
    'ETHERNET Slave',
    'ETHERNET Kuivain',
    'Rinnakkaiskoneen hälytys',
    'Sivuharja siirtynyt',
    'Skanneri virhe',
    'Kattosuuttimen yläraja' ,
    'Kattoharjan yläraja' ,
    'Virhe124' ,
    'Virhe125' ,
    'Virhe126' ,
    'Virhe127'
);


global $WASHCOUNTERS; //2 tavua
$WASHCOUNTERS = array(
    "PROG_1_COUNTER" => WASHING_COUNTER_START+0,
    "PROG_2_COUNTER" => WASHING_COUNTER_START+2,
	"PROG_3_COUNTER" => WASHING_COUNTER_START+4,
	"PROG_4_COUNTER" => WASHING_COUNTER_START+6,
	"PROG_5_COUNTER" => WASHING_COUNTER_START+8,
	"PROG_6_COUNTER" => WASHING_COUNTER_START+10,
	"PROG_7_COUNTER" => WASHING_COUNTER_START+12,
	"PROG_8_COUNTER" => WASHING_COUNTER_START+14,
    "PROG_9_COUNTER" => WASHING_COUNTER_START+16,
	"PROG_10_COUNTER" => WASHING_COUNTER_START+18,
	"PROG_11_COUNTER" => WASHING_COUNTER_START+20,
	"PROG_12_COUNTER" => WASHING_COUNTER_START+22,
	"PROG_13_COUNTER" => WASHING_COUNTER_START+24,
	"PROG_14_COUNTER" => WASHING_COUNTER_START+26,
	"PROG_15_COUNTER" => WASHING_COUNTER_START+28,
	"PROG_16_COUNTER" => WASHING_COUNTER_START+30,
	"PROG_17_COUNTER" => WASHING_COUNTER_START+32,
	"PROG_18_COUNTER" => WASHING_COUNTER_START+34,
	"PROG_19_COUNTER" => WASHING_COUNTER_START+36,
	"PROG_20_COUNTER" => WASHING_COUNTER_START+38,
	"PROG_21_COUNTER" => WASHING_COUNTER_START+40,
	"PROG_22_COUNTER" => WASHING_COUNTER_START+42,
	"PROG_23_COUNTER" => WASHING_COUNTER_START+44,
	"PROG_24_COUNTER" => WASHING_COUNTER_START+46,
	"PROG_25_COUNTER" => WASHING_COUNTER_START+48,
	"PROG_26_COUNTER" => WASHING_COUNTER_START+50,
	"PROG_27_COUNTER" => WASHING_COUNTER_START+52,
	"PROG_28_COUNTER" => WASHING_COUNTER_START+54,
	"PROG_29_COUNTER" => WASHING_COUNTER_START+56,
	"PROG_30_COUNTER" => WASHING_COUNTER_START+58,
	"PROG_31_COUNTER" => WASHING_COUNTER_START+60,
	"PROG_32_COUNTER" => WASHING_COUNTER_START+62
);

global $PROGRAMS;
$PROGRAMS = array(
    "KOODAAMATON" => 0,
    "ESIPESU1" => 1,
	"ESIPESU2" => 2,
	"VAAHTO" => 3,
	"VAIKUTUS" => 4,
	"ALUSTA" => 5,
	"PYORAT" => 6,
	"SIVUKP" => 7,
    "KATTOKP" => 8,
	"HARJAT" => 9,
	"VESIHUUHTELU" => 10,
	"KPHUUHTELU" => 11,
	"OSMOOSIVESI" => 12,
	"VAHA" => 13,
	"KUIVAUSVAHA" => 14,
	"HARJAVAHA" => 15,
	"KIILLOTUS" => 16,
	"KUIVAUS" => 17,
	"PAKU" => 18,
	"AIRLUX" => 19,
	"PYORAESIPESU" => 20,
	"SISAANESIPESU" => 21,
	"RENGASKIILLOTIN" => 22,
	"LOISTOVAHA" => 23,
	"RAINLUX" => 24,
	"SKANNAUS" => 25,
    "LAAVAVAAHTO" => 26,
    "ITIKKAEP" => 27,
	"MAXMODULI" => 27,
	"MAXRINMODULI" => 5,
	"MAX_PGM_LINE_SIZE" => 16,
	"MAX_PGM_LINES" => 32,
	"MAX_PGM_SIZE" => 512
);

global $PROGRAMSCODE;
$PROGRAMSCODE= array(
    0 => "KOODAAMATON",
    1 => "ESIPESU1",
	2 => "ESIPESU2",
	3 => "VAAHTO",
    4 => "VAIKUTUS",
	5 => "ALUSTA",
	6 => "PYORAT",
	7 => "SIVUKP",
    8 => "KATTOKP",
	9 => "HARJAT",
	10 => "VESIHUUHTELU",
	11 => "KPHUUHTELU",
	12 => "OSMOOSIVESI",
	13 => "VAHA",
	14 => "KUIVAUSVAHA",
	15 => "HARJAVAHA",
	16 => "KIILLOTUS",
	17 => "KUIVAUS",
	18 => "PAKU",
	19 => "AIRLUX",
	20 => "PYORAESIPESU",
	21 => "SISAANESIPESU",
	22 => "RENGASKIILLOTIN",
	23 => "LOISTOVAHA",
	24 => "RAINLUX",
	25 => "SKANNAUS",
    26 => "LAAVAVAAHTO",
    27 => "ITIKKAEP"
);

global $PASS_STYLES;
$PASS_STYLES = array
(
	" "  => 0,
	"FC" => 1,
    "FO" => 2,
	"SB" => 4,
	"PU" => 8,
    "FS" => 16,
	"RS" => 32,
	"NF" => 64
);

/** SEURAUSMUODOT  */
define('EI_MAARITELTY_SEUR', 	0x00);
define('NORMAALIOHJ', 			0x01);
define('EI_SEURAAVA', 			0x02);
define('SUKSIBOXI', 			0x04);
define('PICKUP', 				0x08);
define('ETUSPOILERI', 			0x10);
define('TAKASPOILERI', 			0x20);
define('ETUJATAKASPOILERI', 	(ETUSPOILERI | TAKASPOILERI));

global $PROGRAM_OFFSETS;
$PROGRAM_OFFSETS = array(

	"OHJ01" => 0x0000,
    "OHJ02" => 0x0200,
	"OHJ03" => 0x0400,
	"OHJ04" => 0x0600,
	"OHJ05" => 0x0800,
	"OHJ06" => 0x0A00,
	"OHJ07" => 0x0C00,
	"OHJ08" => 0x0E00,
    "OHJ09" => 0x1000,
	"OHJ010" => 0x1200,

	"OHJ011" => 0x1400,
	"OHJ012" => 0x1600,
	"OHJ013" => 0x1800,
	"OHJ014" => 0x1A00,
	"OHJ015" => 0x1C00,
	"OHJ016" => 0x1E00,
	"OHJ017" => 0x2000,
	"OHJ018" => 0x2200,
	"OHJ019" => 0x2400,
	"OHJ020" => 0x2600,

	"OHJ021" => 0x2800,
	"OHJ022" => 0x2A00,
	"OHJ023" => 0x2C00,
	"OHJ024" => 0x2E00,
	"OHJ025" => 0x3000,
	"OHJ026" => 0x3200,
	"OHJ027" => 0x3400,
	"OHJ028" => 0x3600,
	"OHJ029" => 0x3800,
	"OHJ030" => 0x3A00,

	"OHJ031" => 0x3C00,
	"OHJ032" => 0x3E00
);


?>

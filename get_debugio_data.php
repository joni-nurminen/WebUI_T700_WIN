<?php
$id = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;
$id = explode("_",$id);

$id_numb = $id[0];
$id_type = $id[1];

/* Include definations */
include 'defines.php';
/* Include functions */
include 'sync/sync_server_functions.php';
// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';
//$messagequeue = msg_get_queue($mqueue_key,0666);

// Open memory for reading
function convert($shid, $offset)
{

	$byte_L = ord(shmop_read($shid, $offset, 1));
	$byte_H = ord(shmop_read($shid, $offset+1, 1));
	$byte_L2 = ord(shmop_read($shid, $offset+2, 1));
	$byte_H2 = ord(shmop_read($shid, $offset+3, 1));
/*
	$word16b = ($byte_H << 8) + $byte_L;
	$word24b = ($word16b << 8) + $byte_L2;
	$word32b = ($word24b << 8) + $byte_H2;
	return $word32b;
    */
    $word16b = ($byte_H2 << 8) + $byte_L2;
	$word24b = ($word16b << 8) + $byte_H;
	$word32b = ($word24b << 8) + $byte_L;
	return $word32b;
}

$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE)
{
    printf("Error: can't shm_open memory(key:%d) for writing\n", $shm_key);
    $shid = shmop_open($shm_key, "c", 0666, $shm_size);
    //exit(0);
}

 // TOPBRUSH
usleep(10000);  			// sleep 10ms
$shm_OrgPos_tbrush = shmop_read($shid, 1028, 24);   //8*4 32
usleep(10000);  			// sleep 10ms
$shm_EstPos_tbrush = shmop_read($shid, 31656, 44);  //8*4 32
usleep(10000);  			// sleep 10ms
$shm_tbrush_Spd = shmop_read($shid, 31800, 4);      //4

// NOZZLE
usleep(10000);  			// sleep 10ms
$shm_OrgPos_nozzle = shmop_read($shid, 1052, 24);   //8*4 32
usleep(10000);  			// sleep 10ms
$shm_EstPos_nozzle = shmop_read($shid, 31700, 44);  //8*4 32
usleep(10000);  			// sleep 10ms
$shm_Nozzle_Spd = shmop_read($shid, 31384, 4);      //4

// GANTRY
usleep(10000);  			// sleep 10ms
$shm_OrgPos_gantry = shmop_read($shid, 1076, 24);   //8*4 32
usleep(10000);  			// sleep 10ms
$shm_EstPos_gantry = shmop_read($shid, 31744, 44);  //8*4 32
usleep(10000);  			// sleep 10ms
$shm_Gantry_Spd = shmop_read($shid, 31380, 4);      //4

$topBrushPW = ord(shmop_read($shid, TOP_BRUSH_PW, 1));
$nozzlePW = ord(shmop_read($shid, NOZZLE_PW, 1));
$gantryPW = ord(shmop_read($shid, GANTRY_PW, 1));

$shm_scannertype = shmop_read($shid, 19712, 1);  // updKHu
$shm_scanner_res = shmop_read($shid, 2160, 1);   // Scanner resolution, 2cm/3cm, updKHu v4.8
$shm_datascanner = shmop_read($shid, 31637, 19); // updKHu
$shm_datascanner2 = shmop_read($shid, 2192, 4);  // updKHu, updKHu v4.8
$shm_datascanner3 = shmop_read($shid, 31620, 4); // Telco extra heigth upper beams, updKHu, updKHu v4.8

$Tbrush_OrgPos = ord(substr($shm_OrgPos_tbrush,8,1)) + (ord(substr($shm_OrgPos_tbrush,9,1))<<8);
//$Tbrush_EstSpd = ord(substr($shm_EstPos_tbrush,0,1)) + (ord(substr($shm_EstPos_tbrush,1,1))<<8);
$Tbrush_EstSpd = (ord(substr($shm_tbrush_Spd,0,1)) + (ord(substr($shm_tbrush_Spd,1,1))<<8))/10;
$Tbrush_EstPos = ord(substr($shm_EstPos_tbrush,4,1)) + (ord(substr($shm_EstPos_tbrush,5,1))<<8);

$Nozzle_OrgPos = ord(substr($shm_OrgPos_nozzle,8,1)) + (ord(substr($shm_OrgPos_nozzle,9,1))<<8);
//$Nozzle_EstSpd = ord(substr($shm_EstPos_nozzle,0,1)) + (ord(substr($shm_EstPos_nozzle,1,1))<<8);
$Nozzle_EstSpd = (ord(substr($shm_Nozzle_Spd,0,1)) + (ord(substr($shm_Nozzle_Spd,1,1))<<8))/10;
$Nozzle_EstPos = ord(substr($shm_EstPos_nozzle,4,1)) + (ord(substr($shm_EstPos_nozzle,5,1))<<8);

$Gantry_OrgPos = ord(substr($shm_OrgPos_gantry,8,1)) + (ord(substr($shm_OrgPos_gantry,9,1))<<8);
//$Gantry_EstSpd = ord(substr($shm_EstPos_gantry,0,1)) + (ord(substr($shm_EstPos_gantry,1,1))<<8);
$Gantry_EstSpd = (ord(substr($shm_Gantry_Spd,0,1)) + (ord(substr($shm_Gantry_Spd,1,1))<<8))/10;
$Gantry_EstPos = ord(substr($shm_EstPos_gantry,4,1)) + (ord(substr($shm_EstPos_gantry,5,1))<<8);

$Nozzle_Angle = convert($shid, 31804); // nozzle angle
//$Nozzle = ord(substr($roof_nozzle,0,1)) + (ord(substr($roof_nozzle,1,1))<<8);
$Main_Voltage = convert($shid, 1212);   // Verkkojännite, updKHu
$Scan_Target  = convert($shid, 31648);  // Scannaus step, updKHu
$Scanner_type = ord(substr($shm_scannertype,0,1)); // Scannerin type, 0=Reer 1=Telco, updKHu
$Scanner_res  = ord(substr($shm_scanner_res,0,1)); // Scannerin resoluutio, 1=Reer/3cm 3=Telco/2cm, updKHu v4.8

$ScanData_0   = ord(substr($shm_datascanner,0,1)); // Scannerin data, updKHu
$ScanData_1   = ord(substr($shm_datascanner,1,1));
$ScanData_2   = ord(substr($shm_datascanner,2,1));
$ScanData_3   = ord(substr($shm_datascanner,3,1));
$ScanData_4   = ord(substr($shm_datascanner,4,1));
$ScanData_5   = ord(substr($shm_datascanner,5,1));
$ScanData_6   = ord(substr($shm_datascanner,6,1));
$ScanData_7   = ord(substr($shm_datascanner,7,1));
// 2cm resoluution lisädata, updKHu v4.8
$ScanData_8   = ord(substr($shm_datascanner2,0,1));
$ScanData_9   = ord(substr($shm_datascanner2,1,1));
$ScanData_10  = ord(substr($shm_datascanner2,2,1));
$ScanData_11  = ord(substr($shm_datascanner2,3,1));
// Erikoiskorkean lisädata, updKHu v4.8
$ScanData_12  = ord(substr($shm_datascanner3,0,1));
$ScanData_13  = ord(substr($shm_datascanner3,1,1));
$ScanData_14  = ord(substr($shm_datascanner3,2,1));
$ScanData_15  = ord(substr($shm_datascanner3,3,1));

$ScanErr      = ord(substr($shm_datascanner,8,1));
$NozzleLevel  = ord(substr($shm_datascanner,15,1)); // distance level 1...5
$TBrushLevel  = ord(substr($shm_datascanner,17,1)); // distance level 1...5


// READ OPERATION STATE
$shm_operation_state = ord(shmop_read($shid,31324,1));   //8*4 32
//echo "state : " + $shm_operation_state;
// TOPBRUSH
usleep(10000);  			// sleep 10ms
if ($shm_operation_state == 6 or $shm_operation_state==7)
{
    $shm_top_brush_power = convert($shid,1104);   //8*4 32
}
else
{
    $shm_top_brush_power = convert($shid, 1108, 4);   //8*4 32
}

// LEFT BRUSH
usleep(10000);  			// sleep 10ms
if ($shm_operation_state == 6 or $shm_operation_state==7)
{
    $shm_left_brush_power = convert($shid, 1140);   //8*4 32
}
else
{
    $shm_left_brush_power = convert($shid,1144);   //8*4 32
}

// RIGHT BRUSH
usleep(10000);  			// sleep 10ms
if ($shm_operation_state == 6 or $shm_operation_state==7)
{
    $shm_right_brush_power = convert($shid,1176);   //8*4 32
}
else
{
    $shm_right_brush_power = convert($shid,1180);   //8*4 32
}


$speed_data = array(
        "Tbrush_OrgPos" => $Tbrush_OrgPos,
        "Tbrush_EstSpd" => $Tbrush_EstSpd,
        "Tbrush_EstPos" => $Tbrush_EstPos,
        "Nozzle_OrgPos" => $Nozzle_OrgPos,
        "Nozzle_EstSpd" => $Nozzle_EstSpd,
        "Nozzle_EstPos" => $Nozzle_EstPos,
        "Gantry_OrgPos" => $Gantry_OrgPos,
        "Gantry_EstSpd" => $Gantry_EstSpd,
        "Gantry_EstPos" => $Gantry_EstPos,
        "Nozzle_angle"  => $Nozzle_Angle,
        "Top_Brush_Power"  => $shm_top_brush_power,
        "Left_Brush_Power"  => $shm_left_brush_power,
        "Right_Brush_Power"  => $shm_right_brush_power,
        "topBrushPW"  => $topBrushPW,
        "nozzlePW"  => $nozzlePW,
        "gantryPW"  => $gantryPW,
        "Main_Voltage" => $Main_Voltage, // updKHu
		"Scan_Target"  => $Scan_Target,  // updKHu
		"ScanType"     => $Scanner_type, // updKHu
		"ScanRes"      => $Scanner_res,  // updKHu v4.8
        "ScanData_0"   => $ScanData_0,   // updKHu
        "ScanData_1"   => $ScanData_1,   // updKHu
        "ScanData_2"   => $ScanData_2,   // updKHu
        "ScanData_3"   => $ScanData_3,   // updKHu
        "ScanData_4"   => $ScanData_4,   // updKHu
        "ScanData_5"   => $ScanData_5,   // updKHu
        "ScanData_6"   => $ScanData_6,   // updKHu
        "ScanData_7"   => $ScanData_7,   // updKHu
        "ScanData_8"   => $ScanData_8,   // updKHu v4.8
        "ScanData_9"   => $ScanData_9,   // updKHu v4.8
        "ScanData_10"  => $ScanData_10,  // updKHu v4.8
        "ScanData_11"  => $ScanData_11,  // updKHu v4.8
        "ScanData_12"  => $ScanData_12,  // updKHu v4.8
        "ScanData_13"  => $ScanData_13,  // updKHu v4.8
        "ScanData_14"  => $ScanData_14,  // updKHu v4.8
        "ScanData_15"  => $ScanData_15,  // updKHu v4.8		
        "ScanError"    => $ScanErr,      // updKHu
        "NozzleDist"   => $NozzleLevel,  // updKHu
        "TBrushDist"   => $TBrushLevel,  // updKHu
        );



$shm_data_inputs = shmop_read($shid, INPUT_HWMASK, 18);     // read 18 bytes from shared memory (input data)
$shm_data_outputs = shmop_read($shid, OUTPUT_HWMASK, 18);   // read 18 bytes from shared memory (outputdata data)
// Output7
$shm_ex_data_outputs = shmop_read($shid, OUTPUT_EX_HWMASK, 4);  // read 4 bytes from shared memory (outputextdata)

// declare inputs
$bitmask_Gin00 =0;
$bitmask_Gin01 =0;
$bitmask_Gin02 =0;

$bitmask_Gin10 =0;
$bitmask_Gin11 =0;
$bitmask_Gin12 =0;

$bitmask_Gin20 =0;
$bitmask_Gin21 =0;
$bitmask_Gin22 =0;

$bitmask_Gin30 =0;
$bitmask_Gin31 =0;
$bitmask_Gin32 =0;

$bitmask_Gin40 =0;
$bitmask_Gin41 =0;
$bitmask_Gin42 =0;

$bitmask_Gin50 =0;
$bitmask_Gin51 =0;
$bitmask_Gin52 =0;

// declare outputs
$bitmask_Gout00 =0;
$bitmask_Gout01 =0;
$bitmask_Gout02 =0;

$bitmask_Gout10 =0;
$bitmask_Gout11 =0;
$bitmask_Gout12 =0;

$bitmask_Gout20 =0;
$bitmask_Gout21 =0;
$bitmask_Gout22 =0;

$bitmask_Gout30 =0;
$bitmask_Gout31 =0;
$bitmask_Gout32 =0;

$bitmask_Gout40 =0;
$bitmask_Gout41 =0;
$bitmask_Gout42 =0;

$bitmask_Gout50 =0;
$bitmask_Gout51 =0;
$bitmask_Gout52 =0;

// Output7 = Extened Output7 on Bechoff
$bitmask_Gout70 =0;
$bitmask_Gout71 =0;
$bitmask_Gout72 =0;

// parse data inputs
$Gin00			= ord(substr($shm_data_inputs,0,1)); // 8
$Gin01			= ord(substr($shm_data_inputs,1,1)); // 16
$Gin02			= ord(substr($shm_data_inputs,2,1)); // 24

$Gin10			= ord(substr($shm_data_inputs,3,1));
$Gin11			= ord(substr($shm_data_inputs,4,1));
$Gin12			= ord(substr($shm_data_inputs,5,1));

$Gin20			= ord(substr($shm_data_inputs,6,1));
$Gin21			= ord(substr($shm_data_inputs,7,1));
$Gin22			= ord(substr($shm_data_inputs,8,1));

$Gin30			= ord(substr($shm_data_inputs,9,1));
$Gin31			= ord(substr($shm_data_inputs,10,1));
$Gin32			= ord(substr($shm_data_inputs,11,1));

$Gin40			= ord(substr($shm_data_inputs,12,1));
$Gin41			= ord(substr($shm_data_inputs,13,1));
$Gin42			= ord(substr($shm_data_inputs,14,1));

$Gin50			= ord(substr($shm_data_inputs,15,1));
$Gin51			= ord(substr($shm_data_inputs,16,1));
$Gin52			= ord(substr($shm_data_inputs,17,1));
// parse data outputs
$Gout00			= ord(substr($shm_data_outputs,0,1));
$Gout01			= ord(substr($shm_data_outputs,1,1));
$Gout02			= ord(substr($shm_data_outputs,2,1));

$Gout10			= ord(substr($shm_data_outputs,3,1));
$Gout11			= ord(substr($shm_data_outputs,4,1));
$Gout12			= ord(substr($shm_data_outputs,5,1));

$Gout20			= ord(substr($shm_data_outputs,6,1));
$Gout21			= ord(substr($shm_data_outputs,7,1));
$Gout22			= ord(substr($shm_data_outputs,8,1));

$Gout30			= ord(substr($shm_data_outputs,9,1));
$Gout31			= ord(substr($shm_data_outputs,10,1));
$Gout32			= ord(substr($shm_data_outputs,11,1));

$Gout40			= ord(substr($shm_data_outputs,12,1));
$Gout41			= ord(substr($shm_data_outputs,13,1));
$Gout42			= ord(substr($shm_data_outputs,14,1));

$Gout50			= ord(substr($shm_data_outputs,15,1));
$Gout51			= ord(substr($shm_data_outputs,16,1));
$Gout52			= ord(substr($shm_data_outputs,17,1));

// Output7 = Extened Output7 on Bechoff
$Gout70			= ord(substr($shm_ex_data_outputs,0,1));
$Gout71			= ord(substr($shm_ex_data_outputs,1,1));
$Gout72			= ord(substr($shm_ex_data_outputs,2,1));

$arr = array(1,2,4,8,16,32,64,128);

/*
for($i = 1; $i<9; $i++)
{
    // inputs
    $bitmask_Gin00 += ($Gin00 << $i);
    $bitmask_Gin01 += ($Gin01 << $i);
    $bitmask_Gin02 += ($Gin02 << $i);

    $bitmask_Gin10 += ($Gin10 << $i);
    $bitmask_Gin11 += ($Gin11 << $i);
    $bitmask_Gin12 += ($Gin12 << $i);

    $bitmask_Gin20 += ($Gin20 << $i);
    $bitmask_Gin21 += ($Gin21 << $i);
    $bitmask_Gin22 += ($Gin22 << $i);

    $bitmask_Gin30 += ($Gin30 << $i);
    $bitmask_Gin31 += ($Gin31 << $i);
    $bitmask_Gin32 += ($Gin32 << $i);
    // outputs
    $bitmask_Gout00 += ($Gout00 << $i);
    $bitmask_Gout01 += ($Gout01 << $i);
    $bitmask_Gout02 += ($Gout02 << $i);

    $bitmask_Gout10 += ($Gout10 << $i);
    $bitmask_Gout11 += ($Gout11 << $i);
    $bitmask_Gout21 += ($Gout12 << $i);

    $bitmask_Gout20 += ($Gout20 << $i);
    $bitmask_Gout21 += ($Gout21 << $i);
    $bitmask_Gout22 += ($Gout22 << $i);

    $bitmask_Gout30 += ($Gout30 << $i);
    $bitmask_Gout31 += ($Gout31 << $i);
    $bitmask_Gout32 += ($Gout32 << $i);
}
*/

for ($i = 0 ; $i < count($arr) ; ++$i)
{
    // inputs
    $Gin00_bit[] = (($Gin00 & $arr[$i]) == 0) ? '0' : '1';
    $Gin01_bit[] = (($Gin01 & $arr[$i]) == 0) ? '0' : '1';
    $Gin02_bit[] = (($Gin02 & $arr[$i]) == 0) ? '0' : '1';

    $Gin10_bit[] = (($Gin10 & $arr[$i]) == 0) ? '0' : '1';
    $Gin11_bit[] = (($Gin11 & $arr[$i]) == 0) ? '0' : '1';
    $Gin12_bit[] = (($Gin12 & $arr[$i]) == 0) ? '0' : '1';

    $Gin20_bit[] = (($Gin20 & $arr[$i]) == 0) ? '0' : '1';
    $Gin21_bit[] = (($Gin21 & $arr[$i]) == 0) ? '0' : '1';
    $Gin22_bit[] = (($Gin22 & $arr[$i]) == 0) ? '0' : '1';

    $Gin30_bit[] = (($Gin30 & $arr[$i]) == 0) ? '0' : '1';
    $Gin31_bit[] = (($Gin31 & $arr[$i]) == 0) ? '0' : '1';
    $Gin32_bit[] = (($Gin32 & $arr[$i]) == 0) ? '0' : '1';

    $Gin40_bit[] = (($Gin40 & $arr[$i]) == 0) ? '0' : '1';
    $Gin41_bit[] = (($Gin41 & $arr[$i]) == 0) ? '0' : '1';
    $Gin42_bit[] = (($Gin42 & $arr[$i]) == 0) ? '0' : '1';

    $Gin50_bit[] = (($Gin50 & $arr[$i]) == 0) ? '0' : '1';
    $Gin51_bit[] = (($Gin51 & $arr[$i]) == 0) ? '0' : '1';
    $Gin52_bit[] = (($Gin52 & $arr[$i]) == 0) ? '0' : '1';
    //outputs
    $Gout00_bit[] = (($Gout00 & $arr[$i]) == 0) ? '0' : '1';
    $Gout01_bit[] = (($Gout01 & $arr[$i]) == 0) ? '0' : '1';
    $Gout02_bit[] = (($Gout02 & $arr[$i]) == 0) ? '0' : '1';

    $Gout10_bit[] = (($Gout10 & $arr[$i]) == 0) ? '0' : '1';
    $Gout11_bit[] = (($Gout11 & $arr[$i]) == 0) ? '0' : '1';
    $Gout12_bit[] = (($Gout12 & $arr[$i]) == 0) ? '0' : '1';

    $Gout20_bit[] = (($Gout20 & $arr[$i]) == 0) ? '0' : '1';
    $Gout21_bit[] = (($Gout21 & $arr[$i]) == 0) ? '0' : '1';
    $Gout22_bit[] = (($Gout22 & $arr[$i]) == 0) ? '0' : '1';

    $Gout30_bit[] = (($Gout30 & $arr[$i]) == 0) ? '0' : '1';
    $Gout31_bit[] = (($Gout31 & $arr[$i]) == 0) ? '0' : '1';
    $Gout32_bit[] = (($Gout32 & $arr[$i]) == 0) ? '0' : '1';

    $Gout40_bit[] = (($Gout40 & $arr[$i]) == 0) ? '0' : '1';
    $Gout41_bit[] = (($Gout41 & $arr[$i]) == 0) ? '0' : '1';
    $Gout42_bit[] = (($Gout42 & $arr[$i]) == 0) ? '0' : '1';

    $Gout50_bit[] = (($Gout50 & $arr[$i]) == 0) ? '0' : '1';
    $Gout51_bit[] = (($Gout51 & $arr[$i]) == 0) ? '0' : '1';
    $Gout52_bit[] = (($Gout52 & $arr[$i]) == 0) ? '0' : '1';

    // Output7
    $Gout70_bit[] = (($Gout70 & $arr[$i]) == 0) ? '0' : '1';
    $Gout71_bit[] = (($Gout71 & $arr[$i]) == 0) ? '0' : '1';
    $Gout72_bit[] = (($Gout72 & $arr[$i]) == 0) ? '0' : '1';
}

shmop_close($shid);

$result = mysqli_query($link2, "SELECT number FROM SelectedMachine");  // get selected machine number
if(!$result)
{
  echo("Error description: " . mysqli_error($link2));
} 
						
$row = mysqli_fetch_array( $result );
$selected_machine = $row['number'];

if($selected_machine == 1)
    $end = "";
if($selected_machine == 2)
    $end = "_s";

// OUTPUTS
$parameters_out =
    array( 1 => array(
        array("io" => "Output 1", "value" =>"image", "id" => "145".$end, "state" =>$Gout00_bit[0],"description" =>"Output 1"),
        array("io" => "Output 2", "value" =>"image", "id" => "146".$end, "state" =>$Gout00_bit[1],"description" =>"Output 2"),
        array("io" => "Output 3", "value" =>"image", "id" => "147".$end, "state" =>$Gout00_bit[2],"description" =>"Output 3"),
        array("io" => "Output 4", "value" =>"image", "id" => "148".$end, "state" =>$Gout00_bit[3],"description" =>"Output 4"),
        array("io" => "Output 5", "value" =>"image", "id" => "149".$end, "state" =>$Gout00_bit[4],"description" =>"Output 5"),
        array("io" => "Output 6", "value" =>"image", "id" => "150".$end, "state" =>$Gout00_bit[5],"description" =>"Output 6"),
        array("io" => "Output 7", "value" =>"image", "id" => "151".$end, "state" =>$Gout00_bit[6],"description" =>"Output 7"),
        array("io" => "Output 8", "value" =>"image", "id" => "152".$end, "state" =>$Gout00_bit[7],"description" =>"Output 8"),

        array("io" => "Output 9",  "value" =>"image", "id" => "153".$end, "state" =>$Gout01_bit[0],"description" =>"Output 9"),
        array("io" => "Output 10", "value" =>"image", "id" => "154".$end, "state" =>$Gout01_bit[1],"description" =>"Output 10"),
        array("io" => "Output 11", "value" =>"image", "id" => "155".$end, "state" =>$Gout01_bit[2],"description" =>"Output 11"),
        array("io" => "Output 12", "value" =>"image", "id" => "156".$end, "state" =>$Gout01_bit[3],"description" =>"Output 12"),
        array("io" => "Output 13", "value" =>"image", "id" => "157".$end, "state" =>$Gout01_bit[4],"description" =>"Output 13"),
        array("io" => "Output 14", "value" =>"image", "id" => "158".$end, "state" =>$Gout01_bit[5],"description" =>"Output 14"),
        array("io" => "Output 15", "value" =>"image", "id" => "159".$end, "state" =>$Gout01_bit[6],"description" =>"Output 15"),
        array("io" => "Output 16", "value" =>"image", "id" => "160".$end, "state" =>$Gout01_bit[7],"description" =>"Output 16"),

        array("io" => "Output 17", "value" =>"image", "id" => "161".$end, "state" =>$Gout02_bit[0],"description" =>"Output 17"),
        array("io" => "Output 18", "value" =>"image", "id" => "162".$end, "state" =>$Gout02_bit[1],"description" =>"Output 18"),
        array("io" => "Output 19", "value" =>"image", "id" => "163".$end, "state" =>$Gout02_bit[2],"description" =>"Output 19"),
        array("io" => "Output 20", "value" =>"image", "id" => "164".$end, "state" =>$Gout02_bit[3],"description" =>"Output 20"),
        array("io" => "Output 21", "value" =>"image", "id" => "165".$end, "state" =>$Gout02_bit[4],"description" =>"Output 21"),
        array("io" => "Output 22", "value" =>"image", "id" => "166".$end, "state" =>$Gout02_bit[5],"description" =>"Output 22"),
        array("io" => "Output 23", "value" =>"image", "id" => "167".$end, "state" =>$Gout02_bit[6],"description" =>"Output 23"),
        array("io" => "Output 24", "value" =>"image", "id" => "168".$end, "state" =>$Gout02_bit[7],"description" =>"Output 24")),

    2 => array(
        array("io" => "Output 1", "value" =>"image", "id" => "169".$end, "state" =>$Gout10_bit[0],"description" =>"Output 1"),
        array("io" => "Output 2", "value" =>"image", "id" => "170".$end, "state" =>$Gout10_bit[1],"description" =>"Output 2"),
        array("io" => "Output 3", "value" =>"image", "id" => "171".$end, "state" =>$Gout10_bit[2],"description" =>"Output 3"),
        array("io" => "Output 4", "value" =>"image", "id" => "172".$end, "state" =>$Gout10_bit[3],"description" =>"Output 4"),
        array("io" => "Output 5", "value" =>"image", "id" => "173".$end, "state" =>$Gout10_bit[4],"description" =>"Output 5"),
        array("io" => "Output 6", "value" =>"image", "id" => "174".$end, "state" =>$Gout10_bit[5],"description" =>"Output 6"),
        array("io" => "Output 7", "value" =>"image", "id" => "175".$end, "state" =>$Gout10_bit[6],"description" =>"Output 7"),
        array("io" => "Output 8", "value" =>"image", "id" => "176".$end, "state" =>$Gout10_bit[7],"description" =>"Output 8"),

        array("io" => "Output 9",  "value" =>"image", "id" => "177".$end, "state" =>$Gout11_bit[0],"description" =>"Output 9"),
        array("io" => "Output 10", "value" =>"image", "id" => "178".$end, "state" =>$Gout11_bit[1],"description" =>"Output 10"),
        array("io" => "Output 11", "value" =>"image", "id" => "179".$end, "state" =>$Gout11_bit[2],"description" =>"Output 11"),
        array("io" => "Output 12", "value" =>"image", "id" => "180".$end, "state" =>$Gout11_bit[3],"description" =>"Output 12"),
        array("io" => "Output 13", "value" =>"image", "id" => "181".$end, "state" =>$Gout11_bit[4],"description" =>"Output 13"),
        array("io" => "Output 14", "value" =>"image", "id" => "182".$end, "state" =>$Gout11_bit[5],"description" =>"Output 14"),
        array("io" => "Output 15", "value" =>"image", "id" => "183".$end, "state" =>$Gout11_bit[6],"description" =>"Output 15"),
        array("io" => "Output 16", "value" =>"image", "id" => "184".$end, "state" =>$Gout11_bit[7],"description" =>"Output 16"),

        array("io" => "Output 17", "value" =>"image", "id" => "185".$end, "state" =>$Gout12_bit[0],"description" =>"Output 17"),
        array("io" => "Output 18", "value" =>"image", "id" => "186".$end, "state" =>$Gout12_bit[1],"description" =>"Output 18"),
        array("io" => "Output 19", "value" =>"image", "id" => "187".$end, "state" =>$Gout12_bit[2],"description" =>"Output 19"),
        array("io" => "Output 20", "value" =>"image", "id" => "188".$end, "state" =>$Gout12_bit[3],"description" =>"Output 20"),
        array("io" => "Output 21", "value" =>"image", "id" => "189".$end, "state" =>$Gout12_bit[4],"description" =>"Output 21"),
        array("io" => "Output 22", "value" =>"image", "id" => "190".$end, "state" =>$Gout12_bit[5],"description" =>"Output 22"),
        array("io" => "Output 23", "value" =>"image", "id" => "191".$end, "state" =>$Gout12_bit[6],"description" =>"Output 23"),
        array("io" => "Output 24", "value" =>"image", "id" => "192".$end, "state" =>$Gout12_bit[7],"description" =>"Output 24")),

    3 => array(
        array("io" => "Output 1", "value" =>"image", "id" => "193".$end, "state" =>$Gout20_bit[0],"description" =>"Output 1"),
        array("io" => "Output 2", "value" =>"image", "id" => "194".$end, "state" =>$Gout20_bit[1],"description" =>"Output 2"),
        array("io" => "Output 3", "value" =>"image", "id" => "195".$end, "state" =>$Gout20_bit[2],"description" =>"Output 3"),
        array("io" => "Output 4", "value" =>"image", "id" => "196".$end, "state" =>$Gout20_bit[3],"description" =>"Output 4"),
        array("io" => "Output 5", "value" =>"image", "id" => "197".$end, "state" =>$Gout20_bit[4],"description" =>"Output 5"),
        array("io" => "Output 6", "value" =>"image", "id" => "198".$end, "state" =>$Gout20_bit[5],"description" =>"Output 6"),
        array("io" => "Output 7", "value" =>"image", "id" => "199".$end, "state" =>$Gout20_bit[6],"description" =>"Output 7"),
        array("io" => "Output 8", "value" =>"image", "id" => "200".$end, "state" =>$Gout20_bit[7],"description" =>"Output 8"),

        array("io" => "Output 9",  "value" =>"image", "id" => "201".$end, "state" =>$Gout21_bit[0],"description" =>"Output 9"),
        array("io" => "Output 10", "value" =>"image", "id" => "202".$end, "state" =>$Gout21_bit[1],"description" =>"Output 10"),
        array("io" => "Output 11", "value" =>"image", "id" => "203".$end, "state" =>$Gout21_bit[2],"description" =>"Output 11"),
        array("io" => "Output 12", "value" =>"image", "id" => "204".$end, "state" =>$Gout21_bit[3],"description" =>"Output 12"),
        array("io" => "Output 13", "value" =>"image", "id" => "205".$end, "state" =>$Gout21_bit[4],"description" =>"Output 13"),
        array("io" => "Output 14", "value" =>"image", "id" => "206".$end, "state" =>$Gout21_bit[5],"description" =>"Output 14"),
        array("io" => "Output 15", "value" =>"image", "id" => "207".$end, "state" =>$Gout21_bit[6],"description" =>"Output 15"),
        array("io" => "Output 16", "value" =>"image", "id" => "208".$end, "state" =>$Gout21_bit[7],"description" =>"Output 16"),

        array("io" => "Output 17", "value" =>"image", "id" => "209".$end, "state" =>$Gout22_bit[0],"description" =>"Output 17"),
        array("io" => "Output 18", "value" =>"image", "id" => "210".$end, "state" =>$Gout22_bit[1],"description" =>"Output 18"),
        array("io" => "Output 19", "value" =>"image", "id" => "211".$end, "state" =>$Gout22_bit[2],"description" =>"Output 19"),
        array("io" => "Output 20", "value" =>"image", "id" => "212".$end, "state" =>$Gout22_bit[3],"description" =>"Output 20"),
        array("io" => "Output 21", "value" =>"image", "id" => "213".$end, "state" =>$Gout22_bit[4],"description" =>"Output 21"),
        array("io" => "Output 22", "value" =>"image", "id" => "214".$end, "state" =>$Gout22_bit[5],"description" =>"Output 22"),
        array("io" => "Output 23", "value" =>"image", "id" => "215".$end, "state" =>$Gout22_bit[6],"description" =>"Output 23"),
        array("io" => "Output 24", "value" =>"image", "id" => "216".$end, "state" =>$Gout22_bit[7],"description" =>"Output 24")),

//#if 1 == Extened Output7 on Bechoff
    4 => array(
        array("io" => "Output 1", "value" =>"image", "id" => "217".$end, "state" =>$Gout70_bit[0],"description" =>"Output 1"),
        array("io" => "Output 2", "value" =>"image", "id" => "218".$end, "state" =>$Gout70_bit[1],"description" =>"Output 2"),
        array("io" => "Output 3", "value" =>"image", "id" => "219".$end, "state" =>$Gout70_bit[2],"description" =>"Output 3"),
        array("io" => "Output 4", "value" =>"image", "id" => "220".$end, "state" =>$Gout70_bit[3],"description" =>"Output 4"),
        array("io" => "Output 5", "value" =>"image", "id" => "221".$end, "state" =>$Gout70_bit[4],"description" =>"Output 5"),
        array("io" => "Output 6", "value" =>"image", "id" => "222".$end, "state" =>$Gout70_bit[5],"description" =>"Output 6"),
        array("io" => "Output 7", "value" =>"image", "id" => "223".$end, "state" =>$Gout70_bit[6],"description" =>"Output 7"),
        array("io" => "Output 8", "value" =>"image", "id" => "224".$end, "state" =>$Gout70_bit[7],"description" =>"Output 8"),

        array("io" => "Output 9",  "value" =>"image", "id" => "225".$end, "state" =>$Gout71_bit[0],"description" =>"Output 9"),
        array("io" => "Output 10", "value" =>"image", "id" => "226".$end, "state" =>$Gout71_bit[1],"description" =>"Output 1"),
        array("io" => "Output 11", "value" =>"image", "id" => "227".$end, "state" =>$Gout71_bit[2],"description" =>"Output 1"),
        array("io" => "Output 12", "value" =>"image", "id" => "228".$end, "state" =>$Gout71_bit[3],"description" =>"Output 1"),
        array("io" => "Output 13", "value" =>"image", "id" => "229".$end, "state" =>$Gout71_bit[4],"description" =>"Output 1"),
        array("io" => "Output 14", "value" =>"image", "id" => "230".$end, "state" =>$Gout71_bit[5],"description" =>"Output 1"),
        array("io" => "Output 15", "value" =>"image", "id" => "231".$end, "state" =>$Gout71_bit[6],"description" =>"Output 1"),
        array("io" => "Output 16", "value" =>"image", "id" => "232".$end, "state" =>$Gout71_bit[7],"description" =>"Output 1"),

        array("io" => "Output 17", "value" =>"image", "id" => "233".$end, "state" =>$Gout72_bit[0],"description" =>"Output 1"),
        array("io" => "Output 18", "value" =>"image", "id" => "234".$end, "state" =>$Gout72_bit[1],"description" =>"Output 1"),
        array("io" => "Output 19", "value" =>"image", "id" => "235".$end, "state" =>$Gout72_bit[2],"description" =>"Output 1"),
        array("io" => "Output 20", "value" =>"image", "id" => "236".$end, "state" =>$Gout72_bit[3],"description" =>"Output 2"),
        array("io" => "Output 21", "value" =>"image", "id" => "237".$end, "state" =>$Gout72_bit[4],"description" =>"Output 2"),
        array("io" => "Output 22", "value" =>"image", "id" => "238".$end, "state" =>$Gout72_bit[5],"description" =>"Output 2"),
        array("io" => "Output 23", "value" =>"image", "id" => "239".$end, "state" =>$Gout72_bit[6],"description" =>"Output 2"),
        array("io" => "Output 24", "value" =>"image", "id" => "240".$end, "state" =>$Gout72_bit[7],"description" =>"Output 2")),
//#else
//    4 => array(
//        array("io" => "Output 1", "value" =>"image", "id" => "217".$end, "state" =>$Gout30_bit[0],"description" =>"Output "),
//        array("io" => "Output 2", "value" =>"image", "id" => "218".$end, "state" =>$Gout30_bit[1],"description" =>"Output "),
//        array("io" => "Output 3", "value" =>"image", "id" => "219".$end, "state" =>$Gout30_bit[2],"description" =>"Output "),
//        array("io" => "Output 4", "value" =>"image", "id" => "220".$end, "state" =>$Gout30_bit[3],"description" =>"Output "),
//        array("io" => "Output 5", "value" =>"image", "id" => "221".$end, "state" =>$Gout30_bit[4],"description" =>"Output "),
//        array("io" => "Output 6", "value" =>"image", "id" => "222".$end, "state" =>$Gout30_bit[5],"description" =>"Output "),
//        array("io" => "Output 7", "value" =>"image", "id" => "223".$end, "state" =>$Gout30_bit[6],"description" =>"Output "),
//        array("io" => "Output 8", "value" =>"image", "id" => "224".$end, "state" =>$Gout30_bit[7],"description" =>"Output "),
//
//        array("io" => "Output 9",  "value" =>"image", "id" => "225".$end, "state" =>$Gout31_bit[0],"description" =>"Output "),
//        array("io" => "Output 10", "value" =>"image", "id" => "226".$end, "state" =>$Gout31_bit[1],"description" =>"Output "),
//        array("io" => "Output 11", "value" =>"image", "id" => "227".$end, "state" =>$Gout31_bit[2],"description" =>"Output "),
//        array("io" => "Output 12", "value" =>"image", "id" => "228".$end, "state" =>$Gout31_bit[3],"description" =>"Output "),
//        array("io" => "Output 13", "value" =>"image", "id" => "229".$end, "state" =>$Gout31_bit[4],"description" =>"Output "),
//        array("io" => "Output 14", "value" =>"image", "id" => "230".$end, "state" =>$Gout31_bit[5],"description" =>"Output "),
//        array("io" => "Output 15", "value" =>"image", "id" => "231".$end, "state" =>$Gout31_bit[6],"description" =>"Output "),
//        array("io" => "Output 16", "value" =>"image", "id" => "232".$end, "state" =>$Gout31_bit[7],"description" =>"Output "),
//
//        array("io" => "Output 17", "value" =>"image", "id" => "233".$end, "state" =>$Gout32_bit[0],"description" =>"Output "),
//        array("io" => "Output 18", "value" =>"image", "id" => "234".$end, "state" =>$Gout32_bit[1],"description" =>"Output "),
//        array("io" => "Output 19", "value" =>"image", "id" => "235".$end, "state" =>$Gout32_bit[2],"description" =>"Output "),
//        array("io" => "Output 20", "value" =>"image", "id" => "236".$end, "state" =>$Gout32_bit[3],"description" =>"Output "),
//        array("io" => "Output 21", "value" =>"image", "id" => "237".$end, "state" =>$Gout32_bit[4],"description" =>"Output "),
//        array("io" => "Output 22", "value" =>"image", "id" => "238".$end, "state" =>$Gout32_bit[5],"description" =>"Output "),
//        array("io" => "Output 23", "value" =>"image", "id" => "239".$end, "state" =>$Gout32_bit[6],"description" =>"Output "),
//        array("io" => "Output 24", "value" =>"image", "id" => "240".$end, "state" =>$Gout32_bit[7],"description" =>"Output ")),
//#endif

    5 => array(
        array("io" => "Output 1", "value" =>"image", "id" => "241".$end, "state" =>$Gout40_bit[0],"description" =>"Output "),
        array("io" => "Output 2", "value" =>"image", "id" => "242".$end, "state" =>$Gout40_bit[1],"description" =>"Output "),
        array("io" => "Output 3", "value" =>"image", "id" => "243".$end, "state" =>$Gout40_bit[2],"description" =>"Output "),
        array("io" => "Output 4", "value" =>"image", "id" => "244".$end, "state" =>$Gout40_bit[3],"description" =>"Output "),
        array("io" => "Output 5", "value" =>"image", "id" => "245".$end, "state" =>$Gout40_bit[4],"description" =>"Output "),
        array("io" => "Output 6", "value" =>"image", "id" => "246".$end, "state" =>$Gout40_bit[5],"description" =>"Output "),
        array("io" => "Output 7", "value" =>"image", "id" => "247".$end, "state" =>$Gout40_bit[6],"description" =>"Output "),
        array("io" => "Output 8", "value" =>"image", "id" => "248".$end, "state" =>$Gout40_bit[7],"description" =>"Output "),

        array("io" => "Output 9",  "value" =>"image", "id" => "249".$end, "state" =>$Gout41_bit[0],"description" =>"Output "),
        array("io" => "Output 10", "value" =>"image", "id" => "250".$end, "state" =>$Gout41_bit[1],"description" =>"Output "),
        array("io" => "Output 11", "value" =>"image", "id" => "251".$end, "state" =>$Gout41_bit[2],"description" =>"Output "),
        array("io" => "Output 12", "value" =>"image", "id" => "252".$end, "state" =>$Gout41_bit[3],"description" =>"Output "),
        array("io" => "Output 13", "value" =>"image", "id" => "253".$end, "state" =>$Gout41_bit[4],"description" =>"Output "),
        array("io" => "Output 14", "value" =>"image", "id" => "254".$end, "state" =>$Gout41_bit[5],"description" =>"Output "),
        array("io" => "Output 15", "value" =>"image", "id" => "255".$end, "state" =>$Gout41_bit[6],"description" =>"Output "),
        array("io" => "Output 16", "value" =>"image", "id" => "256".$end, "state" =>$Gout41_bit[7],"description" =>"Output "),

        array("io" => "Output 17", "value" =>"image", "id" => "257".$end, "state" =>$Gout42_bit[0],"description" =>"Output "),
        array("io" => "Output 18", "value" =>"image", "id" => "258".$end, "state" =>$Gout42_bit[1],"description" =>"Output "),
        array("io" => "Output 19", "value" =>"image", "id" => "259".$end, "state" =>$Gout42_bit[2],"description" =>"Output "),
        array("io" => "Output 20", "value" =>"image", "id" => "260".$end, "state" =>$Gout42_bit[3],"description" =>"Output "),
        array("io" => "Output 21", "value" =>"image", "id" => "261".$end, "state" =>$Gout42_bit[4],"description" =>"Output "),
        array("io" => "Output 22", "value" =>"image", "id" => "262".$end, "state" =>$Gout42_bit[5],"description" =>"Output "),
        array("io" => "Output 23", "value" =>"image", "id" => "263".$end, "state" =>$Gout42_bit[6],"description" =>"Output "),
        array("io" => "Output 24", "value" =>"image", "id" => "264".$end, "state" =>$Gout42_bit[7],"description" =>"Output ")),

    6 => array(
        array("io" => "Output 1", "value" =>"image", "id" => "265".$end, "state" =>$Gout50_bit[0],"description" =>"Output "),
        array("io" => "Output 2", "value" =>"image", "id" => "266".$end, "state" =>$Gout50_bit[1],"description" =>"Output "),
        array("io" => "Output 3", "value" =>"image", "id" => "267".$end, "state" =>$Gout50_bit[2],"description" =>"Output "),
        array("io" => "Output 4", "value" =>"image", "id" => "268".$end, "state" =>$Gout50_bit[3],"description" =>"Output "),
        array("io" => "Output 5", "value" =>"image", "id" => "269".$end, "state" =>$Gout50_bit[4],"description" =>"Output "),
        array("io" => "Output 6", "value" =>"image", "id" => "270".$end, "state" =>$Gout50_bit[5],"description" =>"Output "),
        array("io" => "Output 7", "value" =>"image", "id" => "271".$end, "state" =>$Gout50_bit[6],"description" =>"Output "),
        array("io" => "Output 8", "value" =>"image", "id" => "272".$end, "state" =>$Gout50_bit[7],"description" =>"Output "),

        array("io" => "Output 9",  "value" =>"image", "id" => "273".$end, "state" =>$Gout51_bit[0],"description" =>"Output "),
        array("io" => "Output 10", "value" =>"image", "id" => "274".$end, "state" =>$Gout51_bit[1],"description" =>"Output "),
        array("io" => "Output 11", "value" =>"image", "id" => "275".$end, "state" =>$Gout51_bit[2],"description" =>"Output "),
        array("io" => "Output 12", "value" =>"image", "id" => "276".$end, "state" =>$Gout51_bit[3],"description" =>"Output "),
        array("io" => "Output 13", "value" =>"image", "id" => "277".$end, "state" =>$Gout51_bit[4],"description" =>"Output "),
        array("io" => "Output 14", "value" =>"image", "id" => "278".$end, "state" =>$Gout51_bit[5],"description" =>"Output "),
        array("io" => "Output 15", "value" =>"image", "id" => "279".$end, "state" =>$Gout51_bit[6],"description" =>"Output "),
        array("io" => "Output 16", "value" =>"image", "id" => "280".$end, "state" =>$Gout51_bit[7],"description" =>"Output "),

        array("io" => "Output 17", "value" =>"image", "id" => "281".$end, "state" =>$Gout52_bit[0],"description" =>"Output "),
        array("io" => "Output 18", "value" =>"image", "id" => "282".$end, "state" =>$Gout52_bit[1],"description" =>"Output "),
        array("io" => "Output 19", "value" =>"image", "id" => "283".$end, "state" =>$Gout52_bit[2],"description" =>"Output "),
        array("io" => "Output 20", "value" =>"image", "id" => "284".$end, "state" =>$Gout52_bit[3],"description" =>"Output "),
        array("io" => "Output 21", "value" =>"image", "id" => "285".$end, "state" =>$Gout52_bit[4],"description" =>"Output "),
        array("io" => "Output 22", "value" =>"image", "id" => "286".$end, "state" =>$Gout52_bit[5],"description" =>"Output "),
        array("io" => "Output 23", "value" =>"image", "id" => "287".$end, "state" =>$Gout52_bit[6],"description" =>"Output "),
        array("io" => "Output 24", "value" =>"image", "id" => "288".$end, "state" =>$Gout52_bit[7],"description" =>"Output ")),
    );

// INPUTS
$parameters_in =
    array( 1 => array(
        array("io" => "Input 1", "value" =>"image", "id" => "1".$end, "state" =>$Gin00_bit[0],"description" =>"Input 1"),
        array("io" => "Input 2", "value" =>"image", "id" => "2".$end, "state" =>$Gin00_bit[1],"description" =>"Input 2"),
        array("io" => "Input 3", "value" =>"image", "id" => "3".$end, "state" =>$Gin00_bit[2],"description" =>"Input 3"),
        array("io" => "Input 4", "value" =>"image", "id" => "4".$end, "state" =>$Gin00_bit[3],"description" =>"Input 4"),
        array("io" => "Input 5", "value" =>"image", "id" => "5".$end, "state" =>$Gin00_bit[4],"description" =>"Input 5"),
        array("io" => "Input 6", "value" =>"image", "id" => "6".$end, "state" =>$Gin00_bit[5],"description" =>"Input 6"),
        array("io" => "Input 7", "value" =>"image", "id" => "7".$end, "state" =>$Gin00_bit[6],"description" =>"Input 7"),
        array("io" => "Input 8", "value" =>"image", "id" => "8".$end, "state" =>$Gin00_bit[7],"description" =>"Input 8"),

        array("io" => "Input 9",  "value" =>"image", "id" => "9".$end,  "state" =>$Gin01_bit[0],"description" =>"Input 9"),
        array("io" => "Input 10", "value" =>"image", "id" => "10".$end, "state" =>$Gin01_bit[1],"description" =>"Input 10"),
        array("io" => "Input 11", "value" =>"image", "id" => "11".$end, "state" =>$Gin01_bit[2],"description" =>"Input 11"),
        array("io" => "Input 12", "value" =>"image", "id" => "12".$end, "state" =>$Gin01_bit[3],"description" =>"Input 12"),
        array("io" => "Input 13", "value" =>"image", "id" => "13".$end, "state" =>$Gin01_bit[4],"description" =>"Input 13"),
        array("io" => "Input 14", "value" =>"image", "id" => "14".$end, "state" =>$Gin01_bit[5],"description" =>"Input 14"),
        array("io" => "Input 15", "value" =>"image", "id" => "15".$end, "state" =>$Gin01_bit[6],"description" =>"Input 15"),
        array("io" => "Input 16", "value" =>"image", "id" => "16".$end, "state" =>$Gin01_bit[7],"description" =>"Input 16"),

        array("io" => "Input 17", "value" =>"image", "id" => "17".$end, "state" =>$Gin02_bit[0],"description" =>"Input 17"),
        array("io" => "Input 18", "value" =>"image", "id" => "18".$end, "state" =>$Gin02_bit[1],"description" =>"Input 18"),
        array("io" => "Input 19", "value" =>"image", "id" => "19".$end, "state" =>$Gin02_bit[2],"description" =>"Input 19"),
        array("io" => "Input 20", "value" =>"image", "id" => "20".$end, "state" =>$Gin02_bit[3],"description" =>"Input 20"),
        array("io" => "Input 21", "value" =>"image", "id" => "21".$end, "state" =>$Gin02_bit[4],"description" =>"Input 21"),
        array("io" => "Input 22", "value" =>"image", "id" => "22".$end, "state" =>$Gin02_bit[5],"description" =>"Input 22"),
        array("io" => "Input 23", "value" =>"image", "id" => "23".$end, "state" =>$Gin02_bit[6],"description" =>"Input 23"),
        array("io" => "Input 24", "value" =>"image", "id" => "24".$end, "state" =>$Gin02_bit[7],"description" =>"Input 24")),

    // I-O-card 2
    2 => array(
        array("io" => "input 1", "value" =>"image", "id" => "25".$end, "state" =>$Gin10_bit[0],"description" =>"Input "),
        array("io" => "input 2", "value" =>"image", "id" => "26".$end, "state" =>$Gin10_bit[1],"description" =>"Input "),
        array("io" => "input 3", "value" =>"image", "id" => "27".$end, "state" =>$Gin10_bit[2],"description" =>"Input "),
        array("io" => "input 4", "value" =>"image", "id" => "28".$end, "state" =>$Gin10_bit[3],"description" =>"Input "),
        array("io" => "input 5", "value" =>"image", "id" => "29".$end, "state" =>$Gin10_bit[4],"description" =>"Input "),
        array("io" => "input 6", "value" =>"image", "id" => "30".$end, "state" =>$Gin10_bit[5],"description" =>"Input "),
        array("io" => "input 7", "value" =>"image", "id" => "31".$end, "state" =>$Gin10_bit[6],"description" =>"Input "),
        array("io" => "input 8", "value" =>"image", "id" => "32".$end, "state" =>$Gin10_bit[7],"description" =>"Input "),

        array("io" => "input 9", "value" =>"image", "id" => "33".$end,  "state" =>$Gin11_bit[0],"description" =>"Input "),
        array("io" => "input 10", "value" =>"image", "id" => "34".$end, "state" =>$Gin11_bit[1],"description" =>"Input "),
        array("io" => "input 11", "value" =>"image", "id" => "35".$end, "state" =>$Gin11_bit[2],"description" =>"Input "),
        array("io" => "input 12", "value" =>"image", "id" => "36".$end, "state" =>$Gin11_bit[3],"description" =>"Input "),
        array("io" => "input 13", "value" =>"image", "id" => "37".$end, "state" =>$Gin11_bit[4],"description" =>"Input "),
        array("io" => "input 14", "value" =>"image", "id" => "38".$end, "state" =>$Gin11_bit[5],"description" =>"Input "),
        array("io" => "input 15", "value" =>"image", "id" => "39".$end, "state" =>$Gin11_bit[6],"description" =>"Input "),
        array("io" => "input 16", "value" =>"image", "id" => "40".$end, "state" =>$Gin11_bit[7],"description" =>"Input "),

        array("io" => "input 17", "value" =>"image", "id" => "41".$end, "state" =>$Gin12_bit[0],"description" =>"Input "),
        array("io" => "input 18", "value" =>"image", "id" => "42".$end, "state" =>$Gin12_bit[1],"description" =>"Input "),
        array("io" => "input 19", "value" =>"image", "id" => "43".$end, "state" =>$Gin12_bit[2],"description" =>"Input "),
        array("io" => "input 20", "value" =>"image", "id" => "44".$end, "state" =>$Gin12_bit[3],"description" =>"Input "),
        array("io" => "input 21", "value" =>"image", "id" => "45".$end, "state" =>$Gin12_bit[4],"description" =>"Input "),
        array("io" => "input 22", "value" =>"image", "id" => "46".$end, "state" =>$Gin12_bit[5],"description" =>"Input "),
        array("io" => "input 23", "value" =>"image", "id" => "47".$end, "state" =>$Gin12_bit[6],"description" =>"Input "),
        array("io" => "input 24", "value" =>"image", "id" => "48".$end, "state" =>$Gin12_bit[7],"description" =>"Input ")),

    // I-O-card 3
    3 => array(
        array("io" => "input 1", "value" =>"image", "id" => "49".$end, "state" =>$Gin20_bit[0],"description" =>"Input "),
        array("io" => "input 2", "value" =>"image", "id" => "50".$end, "state" =>$Gin20_bit[1],"description" =>"Input "),
        array("io" => "input 3", "value" =>"image", "id" => "51".$end, "state" =>$Gin20_bit[2],"description" =>"Input "),
        array("io" => "input 4", "value" =>"image", "id" => "52".$end, "state" =>$Gin20_bit[3],"description" =>"Input "),
        array("io" => "input 5", "value" =>"image", "id" => "53".$end, "state" =>$Gin20_bit[4],"description" =>"Input "),
        array("io" => "input 6", "value" =>"image", "id" => "54".$end, "state" =>$Gin20_bit[5],"description" =>"Input "),
        array("io" => "input 7", "value" =>"image", "id" => "55".$end, "state" =>$Gin20_bit[6],"description" =>"Input "),
        array("io" => "input 8", "value" =>"image", "id" => "56".$end, "state" =>$Gin20_bit[7],"description" =>"Input "),

        array("io" => "input 9", "value" =>"image", "id" => "57".$end, "state"  =>$Gin21_bit[0],"description" =>"Input "),
        array("io" => "input 10", "value" =>"image", "id" => "58".$end, "state" =>$Gin21_bit[1],"description" =>"Input "),
        array("io" => "input 11", "value" =>"image", "id" => "59".$end, "state" =>$Gin21_bit[2],"description" =>"Input "),
        array("io" => "input 12", "value" =>"image", "id" => "60".$end, "state" =>$Gin21_bit[3],"description" =>"Input "),
        array("io" => "input 13", "value" =>"image", "id" => "61".$end, "state" =>$Gin21_bit[4],"description" =>"Input "),
        array("io" => "input 14", "value" =>"image", "id" => "62".$end, "state" =>$Gin21_bit[5],"description" =>"Input "),
        array("io" => "input 15", "value" =>"image", "id" => "63".$end, "state" =>$Gin21_bit[6],"description" =>"Input "),
        array("io" => "input 16", "value" =>"image", "id" => "64".$end, "state" =>$Gin21_bit[7],"description" =>"Input "),

        array("io" => "input 17", "value" =>"image", "id" => "65".$end, "state" =>$Gin22_bit[0],"description" =>"Input "),
        array("io" => "input 18", "value" =>"image", "id" => "66".$end, "state" =>$Gin22_bit[1],"description" =>"Input "),
        array("io" => "input 19", "value" =>"image", "id" => "67".$end, "state" =>$Gin22_bit[2],"description" =>"Input "),
        array("io" => "input 20", "value" =>"image", "id" => "68".$end, "state" =>$Gin22_bit[3],"description" =>"Input "),
        array("io" => "input 21", "value" =>"image", "id" => "69".$end, "state" =>$Gin22_bit[4],"description" =>"Input "),
        array("io" => "input 22", "value" =>"image", "id" => "70".$end, "state" =>$Gin22_bit[5],"description" =>"Input "),
        array("io" => "input 23", "value" =>"image", "id" => "71".$end, "state" =>$Gin22_bit[6],"description" =>"Input "),
        array("io" => "input 24", "value" =>"image", "id" => "72".$end, "state" =>$Gin22_bit[7],"description" =>"Input ")),

    // I-O-card 4
    4 => array(
        array("io" => "input 1", "value" =>"image", "id" => "73".$end, "state" =>$Gin30_bit[0],"description" =>"Input "),
        array("io" => "input 2", "value" =>"image", "id" => "74".$end, "state" =>$Gin30_bit[1],"description" =>"Input "),
        array("io" => "input 3", "value" =>"image", "id" => "75".$end, "state" =>$Gin30_bit[2],"description" =>"Input "),
        array("io" => "input 4", "value" =>"image", "id" => "76".$end, "state" =>$Gin30_bit[3],"description" =>"Input "),
        array("io" => "input 5", "value" =>"image", "id" => "77".$end, "state" =>$Gin30_bit[4],"description" =>"Input "),
        array("io" => "input 6", "value" =>"image", "id" => "78".$end, "state" =>$Gin30_bit[5],"description" =>"Input "),
        array("io" => "input 7", "value" =>"image", "id" => "79".$end, "state" =>$Gin30_bit[6],"description" =>"Input "),
        array("io" => "input 8", "value" =>"image", "id" => "80".$end, "state" =>$Gin30_bit[7],"description" =>"Input "),

        array("io" => "input 9",  "value" =>"image", "id" => "81".$end, "state" =>$Gin31_bit[0],"description" =>"Input "),
        array("io" => "input 10", "value" =>"image", "id" => "82".$end, "state" =>$Gin31_bit[1],"description" =>"Input "),
        array("io" => "input 11", "value" =>"image", "id" => "83".$end, "state" =>$Gin31_bit[2],"description" =>"Input "),
        array("io" => "input 12", "value" =>"image", "id" => "84".$end, "state" =>$Gin31_bit[3],"description" =>"Input "),
        array("io" => "input 13", "value" =>"image", "id" => "85".$end, "state" =>$Gin31_bit[4],"description" =>"Input "),
        array("io" => "input 14", "value" =>"image", "id" => "86".$end, "state" =>$Gin31_bit[5],"description" =>"Input "),
        array("io" => "input 15", "value" =>"image", "id" => "87".$end, "state" =>$Gin31_bit[6],"description" =>"Input "),
        array("io" => "input 16", "value" =>"image", "id" => "88".$end, "state" =>$Gin31_bit[7],"description" =>"Input "),

        array("io" => "input 17", "value" =>"image", "id" => "89".$end, "state" =>$Gin32_bit[0],"description" =>"jInput "),
        array("io" => "input 18", "value" =>"image", "id" => "90".$end, "state" =>$Gin32_bit[1],"description" =>"Input "),
        array("io" => "input 19", "value" =>"image", "id" => "91".$end, "state" =>$Gin32_bit[2],"description" =>"Input "),
        array("io" => "input 20", "value" =>"image", "id" => "92".$end, "state" =>$Gin32_bit[3],"description" =>"jInput "),
        array("io" => "input 21", "value" =>"image", "id" => "93".$end, "state" =>$Gin32_bit[4],"description" =>"Input "),
        array("io" => "input 22", "value" =>"image", "id" => "94".$end, "state" =>$Gin32_bit[5],"description" =>"Input "),
        array("io" => "input 23", "value" =>"image", "id" => "95".$end, "state" =>$Gin32_bit[6],"description" =>"Input "),
        array("io" => "input 24", "value" =>"image", "id" => "96".$end, "state" =>$Gin32_bit[7],"description" =>"Input ")),

    // I-O-card 5
    5 => array(
        array("io" => "input 1", "value" =>"image", "id" => "97".$end, "state" =>$Gin40_bit[0],"description" =>"Input "),
        array("io" => "input 2", "value" =>"image", "id" => "98".$end, "state" =>$Gin40_bit[1],"description" =>"Input "),
        array("io" => "input 3", "value" =>"image", "id" => "99".$end, "state" =>$Gin40_bit[2],"description" =>"Input "),
        array("io" => "input 4", "value" =>"image", "id" => "100".$end, "state" =>$Gin40_bit[3],"description" =>"Input "),
        array("io" => "input 5", "value" =>"image", "id" => "101".$end, "state" =>$Gin40_bit[4],"description" =>"Input "),
        array("io" => "input 6", "value" =>"image", "id" => "102".$end, "state" =>$Gin40_bit[5],"description" =>"Input "),
        array("io" => "input 7", "value" =>"image", "id" => "103".$end, "state" =>$Gin40_bit[6],"description" =>"Input "),
        array("io" => "input 8", "value" =>"image", "id" => "104".$end, "state" =>$Gin40_bit[7],"description" =>"Input "),

        array("io" => "input 9",  "value" =>"image", "id" => "105".$end, "state" =>$Gin41_bit[0],"description" =>"Input "),
        array("io" => "input 10", "value" =>"image", "id" => "106".$end, "state" =>$Gin41_bit[1],"description" =>"Input "),
        array("io" => "input 11", "value" =>"image", "id" => "107".$end, "state" =>$Gin41_bit[2],"description" =>"Input "),
        array("io" => "input 12", "value" =>"image", "id" => "108".$end, "state" =>$Gin41_bit[3],"description" =>"Input "),
        array("io" => "input 13", "value" =>"image", "id" => "109".$end, "state" =>$Gin41_bit[4],"description" =>"Input "),
        array("io" => "input 14", "value" =>"image", "id" => "110".$end, "state" =>$Gin41_bit[5],"description" =>"Input "),
        array("io" => "input 15", "value" =>"image", "id" => "111".$end, "state" =>$Gin41_bit[6],"description" =>"Input "),
        array("io" => "input 16", "value" =>"image", "id" => "112".$end, "state" =>$Gin41_bit[7],"description" =>"Input "),

        array("io" => "input 17", "value" =>"image", "id" => "113".$end, "state" =>$Gin42_bit[0],"description" =>"Input "),
        array("io" => "input 18", "value" =>"image", "id" => "114".$end, "state" =>$Gin42_bit[1],"description" =>"Input "),
        array("io" => "input 19", "value" =>"image", "id" => "115".$end, "state" =>$Gin42_bit[2],"description" =>"Input "),
        array("io" => "input 20", "value" =>"image", "id" => "116".$end, "state" =>$Gin42_bit[3],"description" =>"Input "),
        array("io" => "input 21", "value" =>"image", "id" => "117".$end, "state" =>$Gin42_bit[4],"description" =>"Input "),
        array("io" => "input 22", "value" =>"image", "id" => "118".$end, "state" =>$Gin42_bit[5],"description" =>"Input "),
        array("io" => "input 23", "value" =>"image", "id" => "119".$end, "state" =>$Gin42_bit[6],"description" =>"Input "),
        array("io" => "input 24", "value" =>"image", "id" => "120".$end, "state" =>$Gin42_bit[7],"description" =>"Input ")),

    // I-O-card 6
    6 => array(
        array("io" => "input 1", "value" =>"image", "id" => "121".$end, "state" =>$Gin50_bit[0],"description" =>"Input "),
        array("io" => "input 2", "value" =>"image", "id" => "122".$end, "state" =>$Gin50_bit[1],"description" =>"Input "),
        array("io" => "input 3", "value" =>"image", "id" => "123".$end, "state" =>$Gin50_bit[2],"description" =>"Input "),
        array("io" => "input 4", "value" =>"image", "id" => "124".$end, "state" =>$Gin50_bit[3],"description" =>"Input "),
        array("io" => "input 5", "value" =>"image", "id" => "125".$end, "state" =>$Gin50_bit[4],"description" =>"Input "),
        array("io" => "input 6", "value" =>"image", "id" => "126".$end, "state" =>$Gin50_bit[5],"description" =>"Input "),
        array("io" => "input 7", "value" =>"image", "id" => "127".$end, "state" =>$Gin50_bit[6],"description" =>"Input "),
        array("io" => "input 8", "value" =>"image", "id" => "128".$end, "state" =>$Gin50_bit[7],"description" =>"Input "),

        array("io" => "input 9",  "value" =>"image", "id" => "129".$end, "state" =>$Gin51_bit[0],"description" =>"Input "),
        array("io" => "input 10", "value" =>"image", "id" => "130".$end, "state" =>$Gin51_bit[1],"description" =>"Input "),
        array("io" => "input 11", "value" =>"image", "id" => "131".$end, "state" =>$Gin51_bit[2],"description" =>"Input "),
        array("io" => "input 12", "value" =>"image", "id" => "132".$end, "state" =>$Gin51_bit[3],"description" =>"Input "),
        array("io" => "input 13", "value" =>"image", "id" => "133".$end, "state" =>$Gin51_bit[4],"description" =>"Input "),
        array("io" => "input 14", "value" =>"image", "id" => "134".$end, "state" =>$Gin51_bit[5],"description" =>"Input "),
        array("io" => "input 15", "value" =>"image", "id" => "135".$end, "state" =>$Gin51_bit[6],"description" =>"Input "),
        array("io" => "input 16", "value" =>"image", "id" => "136".$end, "state" =>$Gin51_bit[7],"description" =>"Input "),

        array("io" => "input 17", "value" =>"image", "id" => "137".$end, "state" =>$Gin52_bit[0],"description" =>"Input "),
        array("io" => "input 18", "value" =>"image", "id" => "138".$end, "state" =>$Gin52_bit[1],"description" =>"Input "),
        array("io" => "input 19", "value" =>"image", "id" => "139".$end, "state" =>$Gin52_bit[2],"description" =>"Input "),
        array("io" => "input 20", "value" =>"image", "id" => "140".$end, "state" =>$Gin52_bit[3],"description" =>"Input "),
        array("io" => "input 21", "value" =>"image", "id" => "141".$end, "state" =>$Gin52_bit[4],"description" =>"Input "),
        array("io" => "input 22", "value" =>"image", "id" => "142".$end, "state" =>$Gin52_bit[5],"description" =>"Input "),
        array("io" => "input 23", "value" =>"image", "id" => "143".$end, "state" =>$Gin52_bit[6],"description" =>"Input "),
        array("io" => "input 24", "value" =>"image", "id" => "144".$end, "state" =>$Gin52_bit[7],"description" =>"Input ")),
    );

switch ($_SERVER['REQUEST_METHOD'])
{
case 'GET':
    $result = mysqli_query($link2,"SELECT number FROM SelectedMachine");  // get selected machine number
	if(!$result)
	{
	  echo("Error description: " . mysqli_error($link2));
	} 
						
    $row = mysqli_fetch_array( $result );
    $selected_machine = $row['number'];

    if($selected_machine == 1)
    {
        $io = "IoData";
        $e = "";
    }
    if($selected_machine == 2)
    {
        $io = "IoData2";
        $e = "_s";
    }

    if($id_type == "in")
    {
        if($id_numb != NULL)
        {
            echo json_encode($parameters_in[$id_numb]), "\n";
        }
        else
        {
            $result = mysqli_query($link,"SELECT * FROM $io ORDER BY id");
            while($row = mysqli_fetch_assoc($result))
            {
                if($selected_machine == 2)
                    $id_list[] = $row['id']."_s";
                if($selected_machine == 1)
                    $id_list[] = $row['id'];
            }
            // loop cards
            for($c = 1; $c<7; $c++)
            {
                unset($myarr);
                $myarr = "";
                for($i = 0; $i <count($id_list); $i++)
                {
                    for($j = 0; $j <count($parameters_in[$c]); $j++)
                    {
                        if($id_list[$i] == $parameters_in[$c][$j]['id'])
                        {
                            $myarr[] =  $parameters_in[$c][$j];
                        }
                    }
                }
                $all_data[] = $myarr;
            }
            $all_data[] = $speed_data;
            echo json_encode($all_data), "\n";
        }
        //print_r($parameters_in);
    }
    else if ($id_type == "out")
    {
        if($id_numb != NULL)
        {
            echo json_encode($parameters_out[$id_numb]), "\n";
        }
        else
        {
            $result = mysqli_query($link,"SELECT * FROM $io ORDER BY id");
            while($row = mysqli_fetch_assoc($result))
            {
                if($selected_machine == 2)
                    $id_list[] = $row['id']."_s";
                if($selected_machine == 1)
                    $id_list[] = $row['id'];
            }
            // loop cards
            for($c = 1; $c<7; $c++)
            {
                unset($myarr);
                $myarr = "";
                for($i = 0; $i <count($id_list); $i++)
                {
                    for($j = 0; $j <count($parameters_out[$c]); $j++)
                    {
                        if($id_list[$i] == $parameters_out[$c][$j]['id'])
                        {
                            $myarr[] =  $parameters_out[$c][$j];
                        }
                    }
                }
                $all_data[] = $myarr;
            }
            $all_data[] = $speed_data;
            echo json_encode($all_data), "\n";
        }
        //print_r($parameters_out);
    }
    else
    {
        if($id_numb != NULL)
        {
            echo json_encode($parameters_out[$id_numb]), "\n";
        }
        else
        {
            $result = mysqli_query($link,"SELECT * FROM $io ORDER BY id");
            while($row = mysqli_fetch_assoc($result))
            {
                if($selected_machine == 2)
                    $id_list[] = $row['id']."_s";
                if($selected_machine == 1)
                    $id_list[] = $row['id'];
            }
            // loop cards
            for($c = 1; $c<7; $c++)
            {
                unset($myarr);
                $myarr = [];
                for($i = 0; $i <count($id_list); $i++)
                {
                    for($j = 0; $j <count($parameters_in[$c]); $j++)
                    {
                        if($id_list[$i] == $parameters_in[$c][$j]['id'])
                        {
                            $myarr[] =  $parameters_in[$c][$j];
                        }
                    }
                }
                for($i = 0; $i <count($id_list); $i++)
                {
                    for($j = 0; $j <count($parameters_out[$c]); $j++)
                    {
                        if($id_list[$i] == $parameters_out[$c][$j]['id'])
                        {
                            $myarr[] =  $parameters_out[$c][$j];
                        }
                    }
                }
                $all_data[] = $myarr;
            }
            $all_data[] = $speed_data;
            echo json_encode($all_data), "\n";
        }
        //print_r($parameters_out);
    }

    break;
case 'POST':
    $update = json_decode(file_get_contents('php://input'), true);
    $output_id = $update['output_id'];  // button id
    $state = $update['state'];          // button state on/off

    switch($state)
    {
    case 'off':
        // output card 1
        if($output_id >= 145 && $output_id <= 153)
        {
            $output_id = $output_id - 145;
            write_command(GOUT_00 + $output_id,0);
        }
        if($output_id >= 154 && $output_id <= 161)
        {
            $output_id = $output_id - 153;
            write_command(GOUT_01 + $output_id,0);
        }
        if($output_id >= 162 && $output_id <= 169)
        {
            $output_id = $output_id - 161;
            write_command(GOUT_02 + $output_id,0);
        }
        // output card 2
        if($output_id >= 170 && $output_id <= 177)
        {
            $output_id = $output_id - 169;
            write_command(GOUT_10 + $output_id,0);
        }
        if($output_id >= 178 && $output_id <= 185)
        {
            $output_id = $output_id - 177;
            write_command(GOUT_21 + $output_id,0);
        }
        if($output_id >= 186 && $output_id <= 193)
        {
            $output_id = $output_id - 185;
            write_command(GOUT_22 + $output_id,0);
        }
        //output card 3
        if($output_id >= 194 && $output_id <= 201)
        {
            $output_id = $output_id - 193;
            write_command(GOUT_30 + $output_id,0);
        }
        if($output_id >= 202 && $output_id <= 209)
        {
            $output_id = $output_id - 201;
            write_command(GOUT_31 + $output_id,0);
        }
        if($output_id >= 210 && $output_id < 217)
        {
            $output_id = $output_id - 209;
            write_command(GOUT_32 + $output_id,0);
        }

//#if 1 = Extened Output7 on Bechoff

//      if($output_id >= 217 && $output_id <= 225) //updKHu
        if($output_id >= 217 && $output_id < 225)
        {
            $output_id = $output_id - 217;
            $out70 = ($Gout70 & (~(1 << $output_id)) ); // Clear bit
//              $log = sprintf("Clear Out70: output_id:%d %x -> %x \n", $output_id, $Gout70 ,$out70);
//              error_log($log, 3, "/var/log/t700-php.log");
            write_command(GOUT_70, $Gout70);   //DEBUG
            write_command(GOUT_70,  $out70);
        }
//      if($output_id >= 226 && $output_id <= 233) //updKHu
        if($output_id >= 225 && $output_id < 233)
        {
//          $output_id = $output_id - 226; //updKHu
            $output_id = $output_id - 225;
            $out71 = ($Gout71 & (~(1 << $output_id)) ); // Clear bit
//              $log = sprintf("Clear Out71: output_id:%d %x -> %x \n", $output_id, $Gout71 ,$out71);
//              error_log($log, 3, "/var/log/t700-php.log");
            write_command(GOUT_71, $Gout71);   //DEBUG
            write_command(GOUT_71, $out71);
        }
//      if($output_id >= 234 && $output_id < 241) //updKHu
        if($output_id >= 233 && $output_id < 241)
        {
//          $output_id = $output_id - 234; //updKHu
            $output_id = $output_id - 233;
            $out72 = ($Gout72 & (~(1 << $output_id)) ); // Clear bit
//              $log = sprintf("Clear Out72: output_id:%d %x -> %x \n", $output_id, $Gout72 ,$out72);
//              error_log($log, 3, "/var/log/t700-php.log");
            write_command(GOUT_72, $Gout72);   //DEBUG
            write_command(GOUT_72, $out72);
        }


        //output card 5
        if($output_id >= 241 && $output_id <= 249)
        {
            $output_id = $output_id - 241;
            write_command(GOUT_50 + $output_id,0);
        }
        if($output_id >= 250 && $output_id <= 257)
        {
            $output_id = $output_id - 249;
            write_command(GOUT_51 + $output_id,0);
        }
        if($output_id >= 258 && $output_id <= 265)
        {
            $output_id = $output_id - 257;
            write_command(GOUT_52 + $output_id,0);
        }
        //output card 6
        if($output_id >= 266 && $output_id <= 273)
        {
            $output_id = $output_id - 265;
            write_command(GOUT_60 + $output_id,0);
        }
        if($output_id >= 274 && $output_id <= 281)
        {
            $output_id = $output_id - 273;
            write_command(GOUT_61 + $output_id,0);
        }
        if($output_id >= 282 && $output_id <= 289)
        {
            $output_id = $output_id - 281;
            write_command(GOUT_62 + $output_id,0);
        }
        break;

    case 'on':
        // output card 1
        if($output_id >= 145 && $output_id <= 153)
        {
            $output_id = $output_id - 145;
            write_command(GOUT_00 + $output_id,1);
        }
        if($output_id >= 154 && $output_id <= 161)
        {
            $output_id = $output_id - 153;
            write_command(GOUT_01 + $output_id,1);
        }
        if($output_id >= 162 && $output_id <= 169)
        {
            $output_id = $output_id - 161;
            write_command(GOUT_02 + $output_id,1);
        }
        // output card 2
        if($output_id >= 170 && $output_id <= 177)
        {
            $output_id = $output_id - 169;
            write_command(GOUT_10 + $output_id,1);
        }
        if($output_id >= 178 && $output_id <= 185)
        {
            $output_id = $output_id - 177;
            write_command(GOUT_21 + $output_id,1);
        }
        if($output_id >= 186 && $output_id <= 193)
        {
            $output_id = $output_id - 185;
            write_command(GOUT_22 + $output_id,1);
        }
        //output card 3
        if($output_id >= 194 && $output_id <= 201)
        {
            $output_id = $output_id - 193;
            write_command(GOUT_30 + $output_id,1);
        }
        if($output_id >= 202 && $output_id <= 209)
        {
            $output_id = $output_id - 201;
            write_command(GOUT_31 + $output_id,1);
        }
        if($output_id >= 210 && $output_id < 217)  //TODO: 217 idexing over ???
        {
            $output_id = $output_id - 209;
            write_command(GOUT_32 + $output_id,1);
        }

//#if 1 = Extened Output7 on Bechoff

        if($output_id >= 217 && $output_id < 225)
        {
            $output_id = $output_id - 217;
            $out70 = ($Gout70 | (1 << $output_id) );    // Set bit
//              $log = sprintf("Set Out70: output_id:%d %x -> %x \n", $output_id, $Gout70 ,$out70);
//              error_log($log, 3, "/var/log/t700-php.log");
        //    write_command(GOUT_70, $Gout70);   //DEBUG
            write_command(GOUT_70, $out70);
        }
        if($output_id >= 225 && $output_id < 233)
        {
            $output_id = $output_id - 225;
            $out71 = ($Gout71 | (1 << $output_id) );    // Set bit
//              $log = sprintf("Set Out71: output_id:%d %x -> %x \n", $output_id, $Gout71 ,$out71);
//              error_log($log, 3, "/var/log/t700-php.log");
        //    write_command(GOUT_71, $Gout71);   //DEBUG
            write_command(GOUT_71, $out71);
        }
        if($output_id >= 233 && $output_id < 241)
        {
            $output_id = $output_id - 233;
            $out72 = ($Gout72 | (1 << $output_id) );    // Set bit
//              $log = sprintf("Set Out72: output_id:%d %x -> %x \n", $output_id, $Gout72 ,$out72);
//              error_log($log, 3, "/var/log/t700-php.log");
        //    write_command(GOUT_72, $Gout72);   //DEBUG
            write_command(GOUT_72, $out72);
        }


        //output card 5
        if($output_id >= 241 && $output_id <= 249)
        {
            $output_id = $output_id - 241;
            write_command(GOUT_50 + $output_id,1);
        }
        if($output_id >= 250 && $output_id <= 257)
        {
            $output_id = $output_id - 249;
            write_command(GOUT_51 + $output_id,1);
        }
        if($output_id >= 258 && $output_id <= 265)
        {
            $output_id = $output_id - 257;
            write_command(GOUT_52 + $output_id,1);
        }
        //output card 6
        if($output_id >= 266 && $output_id <= 273)
        {
            $output_id = $output_id - 265;
            write_command(GOUT_60 + $output_id,1);
        }
        if($output_id >= 274 && $output_id <= 281)
        {
            $output_id = $output_id - 273;
            write_command(GOUT_61 + $output_id,1);
        }
        if($output_id >= 282 && $output_id <= 289)
        {
            $output_id = $output_id - 281;
            write_command(GOUT_62 + $output_id,1);
        }
        break;
    }
    break;
}

?>

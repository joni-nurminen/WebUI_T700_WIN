<?php

/* Include definations */
include '/xampp/htdocs/defines.php';
/* Include functions */
include '/xampp/htdocs/sync/sync_server_functions.php';
// Parse config
$config = parse_config($config_file_name);

include '/xampp/htdocs/select_shared_mem.php';
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

function convert24($shid, $offset)
{
	$byte_L = ord(shmop_read($shid, $offset, 1));
	$byte_H = ord(shmop_read($shid, $offset+1, 1));
	$byte_L2 = ord(shmop_read($shid, $offset+2, 1));
	$byte_H2 = ord(shmop_read($shid, $offset+3, 1));

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

$shm_data_inputs = shmop_read($shid, INPUT_HWMASK, 18);     // read 18 bytes from shared memory (input data)
$shm_data_outputs = shmop_read($shid, OUTPUT_HWMASK, 18);   // read 18 bytes from shared memory (outputdata data)
// Output7
$shm_ex_data_outputs = shmop_read($shid, OUTPUT_EX_HWMASK, 4);  // read 4 bytes from shared memory (outputextdata)

$out100  = convert24($shid, 434);
$out200  = convert24($shid, 437);
$out300  = convert24($shid, 440);
$out400  = convert24($shid, 443);

$out500  = convert24($shid, 446);
$out600  = convert24($shid, 449);
$out700  = convert24($shid, 31812);

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
        "NozzleDist"   => $NozzleLevel,  // updKHu
        "TBrushDist"   => $TBrushLevel,  // updKHu
		"out100"   => $out100, 
		"out200"   => $out200, 
		"out300"   => $out300,
		"out400"   => $out400,
		"out500"   => $out500,
		"out600"   => $out600,
		"out700"   => $out700,		
        );
		
 echo json_encode($speed_data), "\n";



shmop_close($shid);

?>

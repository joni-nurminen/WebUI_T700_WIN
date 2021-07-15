<?php
include "defines.php";
include "sync/sync_server_functions.php";

global $config_file_name; 	
$config_file_name = "sync/sync_server.conf";

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';

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


// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
	{
	printf("Error: can't shm_open memory(key:%d) for writing\n", $shm_key);
	$shid = shmop_open($shm_key, "c", 0666, $shm_size);
	//exit(0);
	}
	
    usleep(10000);  			// sleep 10ms
    $shm_OrgPos_tbrush = shmop_read($shid, 1028, 24);   //8*4 32
    usleep(10000);  			// sleep 10ms
    $shm_EstPos_tbrush = shmop_read($shid, 31656, 44);   //8*4 32
    usleep(10000);  			// sleep 10ms
    $shm_tbrush_Spd = shmop_read($shid, 31800, 4);      //4 

    usleep(10000);  			// sleep 10ms
    $shm_OrgPos_nozzle = shmop_read($shid, 1052, 24);   //8*4 32
    usleep(10000);  			// sleep 10ms
    $shm_EstPos_nozzle = shmop_read($shid, 31700, 44);   //8*4 32
    usleep(10000);  			// sleep 10ms
    $shm_Nozzle_Spd = shmop_read($shid, 31384, 4);      //4 

    usleep(10000);  			// sleep 10ms
    $shm_OrgPos_gantry = shmop_read($shid, 1076, 24);   //8*4 32
    usleep(10000);  			// sleep 10ms
    $shm_EstPos_gantry = shmop_read($shid, 31744, 44);   //8*4 32
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
	
	$shm_top_brush_power = convert($shid,1104);   //8*4 32
	$shm_left_brush_power = convert($shid, 1140);   //8*4 32
	$shm_right_brush_power = convert($shid,1176);   //8*4 32
	
	$Nozzle_Angle =  convert($shid, 31804); // nozzle angle	
	
	

$json['nop_harja']=  $Tbrush_EstSpd;
$json['nop_suutin']=  $Nozzle_EstSpd;
$json['nop_kone']=  $Gantry_EstSpd;

$json['pos_harja']=  $Tbrush_OrgPos;
$json['pos_suutin']= $Nozzle_OrgPos;
$json['pos_kone']= $Gantry_OrgPos/2;

$json['kattoharja_teho']= $shm_top_brush_power;
$json['vasharja_teho']= $shm_left_brush_power;
$json['oikharja_teho']= $shm_right_brush_power;

$json['kattosuutin_kulma']= $Nozzle_Angle;
echo json_encode($json), "\n";	

?>
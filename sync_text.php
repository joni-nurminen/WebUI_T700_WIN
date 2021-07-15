<?php

session_start();
$texts = json_decode(file_get_contents('php://input'), true);

include "defines.php";
include 'sync/sync_server_functions.php';
	
global $config_file_name; 	
$config_file_name = "sync/sync_server.conf";

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';

// Open queue
//global $messagequeue;
//$messagequeue = msg_get_queue($mqueue_key,0666);
// Open memory for reading
$shm_id = shmop_open($shm_key, "w", 0666, $shm_size );

if($shm_id == FALSE) 
{
	//$json['error']="Cant open shared memory";
	echo "NOT OK.";
	return;
}

$txt16count = 0;		// updKHu
$txt32count = 0; 		// updKHu
$tmpstr16 = "Jepulis";	// updKHu
$tmpstr32 = "Jepulis";	// updKHu

for($i=0;$i<count($texts[data]);$i++)
{	
	$name = $texts[data][$i];
	$name = utf8_decode($name);
	$name_arr = str_split($name);
	
	for($j=0;$j<16;$j++)
	{
		$new_arr16[$j] = ord($name_arr[$j]);
	}

	$txt16count++;
	$array16[] = $new_arr16;
	$tmpstr16 = $name;
}

$shm_bytes_written = write_string(array("ordered",16,22732,count($array16),$array16)); // type, ramp, start offset, len, data array

//sleep(3);

for($i=0;$i<count($texts[data32]);$i++)
{	
//	$name = $texts[data][$i]; // updKHu
	$name = $texts[data32][$i];
	$name = utf8_decode($name);
	$name_arr = str_split($name);
	
	for($j=0;$j<32;$j++)
	{
		$new_arr32[$j] = ord($name_arr[$j]);
	}

	$txt32count++;	
	$array32[] = $new_arr32;
	$tmpstr32 = $name;
}

$shm_bytes_written = write_string(array("ordered",32,24780,count($array32),$array32));

/*
$count32 = 0;
for($i=0;$i<count($texts[data32]);$i++)
{	
	//$arr = str_split($texts[data32][$i]); // updKHu
	$arr = $texts[data32][$i];
	$arr = utf8_decode($arr); // ääkköset yhteen tavuun, 8 bit, UTF-8 -> ISO-8859-1, updKHu
	$new_arr = array();
	for($j=0;$j<32;$j++)
		$new_arr[] = ord($arr[$j]);

	$shm_bytes_written = write_string($messagequeue,1,24780+$count32,$new_arr);
	$count32 = $count32+32;
}
*/

//echo "OK."; // updKHu
echo "Txt16Cnt=" . $txt16count . " Txt32Cnt=" . $txt32count . " Last16=" . $tmpstr16 . " Last32=" . $tmpstr32;

?>
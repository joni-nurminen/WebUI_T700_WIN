<?php 

/**
 * @file   	sync_server.php
 * @brief  	This file receives shared memory block from the client and writes it to local shared memory. This script also checks if message queue contains commands.
 * @details	Detailed info here.
 * @date   	$Date: 2013-07-01 12:50:54 +0300 (ma, 01 heinä 2013) $
 * @version	$Revision: 5191 $
 */
include "sync_server_functions.php";

//========
// Globals
//========
global $config_file_name; 	$config_file_name = "sync_server.conf";

//debugLog("on kutsuttu");

//============
// Server code
//============

// Open config data
$config = parse_config($config_file_name);

// Get php post data
$received_data = file_get_contents("php://input");

// Process data
$data = unserialize($received_data);

// Get id from data
$data_from = $data[1];

// Get uptime from data
$uptime = $data[2];

// Get IP from data
$ip = $data[3];


// Set local shared memory variables.
// Set variables for t700-1
if ($data_from == "t700-1")
	{
		$shm_key   = $config["t700-1"]["Sharedmemory-key"];
		$shm_mode  = $config["t700-1"]["Sharedmemory-mode"];
		$shm_size  = $config["t700-1"]["Sharedmemory-size"];
		$msg_key   = $config["t700-1"]["Messagequeue-key"];
	}
	
// Set variables for t700-2
if ($data_from == "t700-2")
	{
		$shm_key   = $config["t700-2"]["Sharedmemory-key"];
		$shm_mode  = $config["t700-2"]["Sharedmemory-mode"];
		$shm_size  = $config["t700-2"]["Sharedmemory-size"];
		$msg_key   = $config["t700-2"]["Messagequeue-key"];
	}

// TODO 
// else: set here some flag etc for indicating that we are receiving data from unknown client

// DEBUG
//$myFile = "debug.txt";
//$fh = fopen($myFile, 'a') or die("can't open file");
//fwrite($fh, $data_from.",".$msg_key.",".$ip."\n");
//fclose($fh);
	

// Write remote uptime data and write it to file
set_remote_uptime($data_from,$uptime);

// Write remote ip data to file
set_remote_ip($data_from, $ip);

// Open memory and write to it
$shid = shmop_open($shm_key, "w", 0666, $shm_size);


// Do we have a valid shared memory available
if($shid == FALSE) 
	{
	printf("\n".date("M j H:i:s")." Server: Warning! Can't shm_open memory(key:%d) for writing. Trying to create empty memory.", $shm_key);
	system("ipcrm -M ".$shm_key);
	$shid = shmop_open($shm_key, "n", 0666, $shm_size);
	if($shid != FALSE)
		{
		printf("\n".date("M j H:i:s")." Server: Shared memory created.", $shm_key);
		}
	//exit(0);
	}

// Write data to shared memory
$shm_bytes_written = shmop_write($shid, $data[0], 0);

// Check if write was successful
if($shm_bytes_written != FALSE)
	{
		system("type nul > shared_memory_updated");	// This is for backward compatibility..
		system("type nul > ".$data_from."_shared_memory_updated");
	//	print_log("Jaettu muisti kopattu ja päivitetty: ".$shm_bytes_written);
		$operation_mode = ord(shmop_read($shid, 31324, 1));
		if($operation_mode != $operation_mode_old)
		{
			$operation_mode_old = $operation_mode;
			//send_status("94.237.42.151", $operation_mode);
		}
	}
else
	{
	print_log("Error! can't write to shared memory. Key ".$shm_key);
	}

// Check command message queue. Create queue if it doesn't exist.
/*
$seg = msg_get_queue($msg_key,0666);

// Is there any messages for me?
$status=msg_stat_queue($seg);
if($status['msg_qnum'] != 0)
	{
	$temp = array();
	for($i=0;$i<$status['msg_qnum'];$i++)
		{
		msg_receive($seg, "0", $type, 1024, $data);
		array_push($temp,$data);
		$data_to_send=serialize($temp);
		}
		// Send messages to client.
		print_r($data_to_send);	
	}
*/
/*
function debugLog($text)
{
	$fh = fopen("C:\xampp\htdocs\sync\debug.txt", 'a') or die("can't open file for debuglog");
	fwrite($fh, $text."\n");
	fclose($fh);
}
*/
?>

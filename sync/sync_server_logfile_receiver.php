<?php 
/**
 * @file   	sync_server_logfile_receiver.php
 * @brief  	This file receives logfile from the client and writes it to local disk.
 * @details	Detailed info here.
 * @date   	$Date: 2013-07-01 12:50:54 +0300 (ma, 01 heinä 2013) $
 * @version	$Revision: 5191 $
 */
include "sync_server_functions.php";

//========
// Globals
//========
global $config_file_name; 	$config_file_name = "sync_server.conf";

// Open config data
$config = parse_config($config_file_name);

// Get php post data
$received_data = file_get_contents("php://input");

// Process data
$data = unserialize($received_data);
$log_data = unserialize($data[0]);
$type = $data[1];
$data_from = $data[2];
$fh = null;

// Get local logfilename
$logfilename = $config[$data_from]["Logfile1_name"];

if($type=="1")
	{
	print_log("Logfile receiver get type ".$type);
	//fwrite($fh,"receiver get type 1\n");
	$logfilename = $config[$data_from]["Logfile1_name"];
	}
if($type=="2")
	{
	print_log("Logfile receiver get type ".$type);
	//fwrite($fh,"receiver get type 2\n");
	$logfilename = $config[$data_from]["Logfile2_name"];
	}
if($type=="3")
	{
	print_log("Logfile receiver get type ".$type);
	//fwrite($fh,"receiver get type 3\n");
	$logfilename = $config[$data_from]["Logfile3_name"];
	}


//DEBUG
if($fh != null)
	fclose($fh);

//print "LOGDATA: ".$received_data."\n";

// Remove old file
unlink($logfilename);

// Open and write data to file
$fh = fopen($logfilename,'w');
if($fh != null)
{
	fwrite($fh,$log_data);
	fclose($fh);
	print_log("Wrote logfile ".$logfilename." type".$type);
}

// Update timestampfile
//system("touch logfile_updated");
//print_log("Log updated");
?>

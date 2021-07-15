<?php 
/**
 * @file   	sync_server_image_receiver.php
 * @brief  	This file receives scanned image file from the client and writes it to local disk.
 * @details	Detailed info here.
 * @date   	$Date: 2013-09-05 10:08:28 +0300 (to, 05 syys 2013) $
 * @version	$Revision: 5235 $
 */
include "sync_server_functions.php";

//========
// Globals
//========
global $config_file_name; 	
$config_file_name = "sync_server.conf";

// Current time
$t=time();
$date = $t;//date("Y-d-m_H:i:s",$t);

// Open config data
$config = parse_config($config_file_name);

// Get php post data
$received_data = file_get_contents("php://input");

// Process data
$data = unserialize($received_data);
$image_data = unserialize($data[0]);
$data_from = unserialize($data[1]);

// Get local imagefilename
$imagename = $config[$data_from]["Image_name"];
$backupimage_path = $config[$data_from]["Image_name_backup"];

$scanned_file_size;
$previous_size;

// Open and write data to file
$fh = fopen($imagename,'w') or die("can't open file to write imagedata");;
fwrite($fh,$image_data);
fclose($fh);

$scanned_file_size = 0;
$previous_size = 0;

// Save image also to backup folder if image is not a blank
if (strlen($image_data) > 1000)
{
	$myFile = "size.txt";
	$fh = fopen($myFile, 'r');
	if ($fh == FALSE)
		$previous_size = 0;
	else
		$previous_size = fread($fh, filesize($myFile));
	fclose($fh);
	$scanned_file_size = strlen($image_data); // updKHu
	
	if ($scanned_file_size == $previous_size) // Prevent the duplicate after save to flash, updKHu
	{
		$handle = fopen("debug_on.txt", "r");
		if ($handle != FALSE)
		{
			// Write debug information to file if switched on, updKHu
			$debug_text = 'Same scanned image size, not save (';
			$myFile = "debug.txt";
			$fh = fopen($myFile, 'a');
			fwrite($fh, $date." ".$debug_text.$scanned_file_size.")"." Previous size ".$previous_size."\n");
			fclose($fh);
		}
		return;
	}
	else
	{
		$handle = fopen("debug_on.txt", "r");
		if ($handle != FALSE)
		{
			// Write debug information to file if switched on, updKHu
			$debug_text = 'Scanned image size (';
			$myFile = "debug.txt";
			$fh = fopen($myFile, 'a');
			fwrite($fh, $date." ".$debug_text.$scanned_file_size.")"." Previous size ".$previous_size."\n");
			fclose($fh);
		}
	}
	
	$path = $backupimage_path.$date.".jpg";
	$fh = fopen($path,'w') or die("can't open file to write backupimage ".$path);
	fwrite($fh,$image_data);
	fclose($fh);
	// Save also the image file size to file, updKHu
	$myFile = "size.txt";
	$fh = fopen($myFile, 'w');
	fwrite($fh, $scanned_file_size);
	fclose($fh);
}
else
{
	$handle = fopen("debug_on.txt", "r");
	if ($handle != FALSE)
	{
		// Write debug information to file if switched on, updKHu
		$debug_text = 'Scanned image size too small (';
		$image_size = strlen($image_data);
		$myFile = "debug.txt";
		$fh = fopen($myFile, 'a');
		fwrite($fh, $date." ".$debug_text.$image_size.")"."\n");
		fclose($fh);
	}
	fclose($handle);
}
//DEBUG
//$myFile = "debug.txt";
//$fh = fopen($myFile, 'a') or die("can't open file");
//fwrite($fh, $data_from."\n");
//fclose($fh);

//system('touch '.$imagename);

?>

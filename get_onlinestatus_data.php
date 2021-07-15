<?php
session_start();

$scanner_image = null;

include "defines.php";
include "sync/sync_server_functions.php";

$logged_user = $_SESSION['username'];

global $config_file_name; 	
$config_file_name = "sync/sync_server.conf";

// Parse config
$config = parse_config($config_file_name);

include 'select_shared_mem.php';

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, $shm_size );
if($shid == FALSE) 
	{
	$json['error']="Cant open shared memory";
	$shid = shmop_open($shm_key, "c", 0666, $shm_size);
	//exit(0);
	}
$path = "lib/css/images/ScannedImage/";

$dir = @ opendir("lib/css/images/ScannedImage");
switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET': 
			//	$file = readdir($dir);
				
				while (($file = readdir($dir)) !== false)
				  {
						if($file == "scanned.jpg")
						{	
							$time = time();
							clearstatcache();
							$scanner_image = $file ."?". $time;
						}
						if($file == "scanned2.jpg")
						{
							$time = time();
							clearstatcache();
							$scanner_image_slave = $file ."?". $time;
						}
				  }
				
				$result = mysqli_query($link3, "SELECT * FROM ifsf_conf");
				if(!$result)
				{
				  echo("Error description: " . mysqli_error($link3));
				}				
				$row = mysqli_fetch_array($result);
				$code_veh_ord = $row['code_veh_ord']; 
				$stand_alone_auth = $row['stand_alone_auth']; 
				$ifsf_version = $row['ifsf_version']; 
				
				if($code_veh_ord == 0 && $stand_alone_auth == 0)
					$code = "1A";
				else if($code_veh_ord == 0 && $stand_alone_auth == 1)
					$code = "1B";
				else if($code_veh_ord == 1 && $stand_alone_auth == 0)
					$code = "2A";
				else if($code_veh_ord == 1 && $stand_alone_auth == 1)
					$code = "2B";
				else
					$code = "N/A";
					
				$u_ticker = ord(shmop_read($shid, 44, 1)); // read running tick counter
				$u_ticker1 = ord(shmop_read($shid, 45, 1)); // read running tick counter
				$u_ticker2 = ord(shmop_read($shid, 46, 1)); // read running tick counter
				$u_ticker3 = ord(shmop_read($shid, 47, 1)); // read running tick counter
				
				$ret     = ($u_ticker + ($u_ticker1<<8));
				$ret     = ($ret + ($u_ticker2<<16));
				$ret     = ($ret + ($u_ticker3<<24));
				$ret     = ($ret + ($u_ticker4<<32));
				
				$prog_number = ord(shmop_read($shid, PROGRAM_NUMBER, 4)); // read running program number from shared mem
				$prog_line_number = ord(shmop_read($shid, PROGRAM_LINE_NUMBER, 4)); // read running program number from shared mem
				$operation_mode = ord(shmop_read($shid, OPERATION_MODE, 1)); // get operation mode from shared mem
				$version_nro = ord(shmop_read($shid, VERSION_NRO, 1)); // get operation mode from shared mem
				$machine_type = ord(shmop_read($shid, MACHINE_TYPE + SHM_FLASH_CACHE, 1)); // read machinetype
				$is_scanner = ord(shmop_read($shid, $FUNCTIONS[10] + SHM_FLASH_CACHE, 1)); //SCANNERILAITE
				$maintenance = ord(shmop_read($shid, MAINTENANCE_MODE, 1)); // maintenance
				$allow_continue_cancel = ord(shmop_read($shid, ALLOW_CONTINUE_CANCEL, 1)); // After emergencybutton is released -> allow continue and cancel commands
				$ifsf_available = ord(shmop_read($shid, $FUNCTIONS[20] + SHM_FLASH_CACHE, 1)); //is ifsf available
				if($ifsf_available == 1 )
                {
                    $cw_status = shell_exec('pidof CW-Server'); // read status of cw-server
                    $ifsf_status = shell_exec('pidof ifsf_server_easylon'); // read status of ifsf-server
				} else {
                    $cw_status = 0;
                    $ifsf_status = 0;
				}
                    
				if($operation_mode == 7 || $operation_mode == 8) // if mode is suspended washing or washing done --> read washing counter data.
				{
				/*
					for($i=1; $i<31; $i++) // read all counters
					{
						$counter_data = ord(shmop_read($shid, 21756 +$i+$i, 2)); // read 2 bytes
					}
					*/
				}
				
				//######### BurrBrown
				$BBtextwriting = ord(shmop_read($shid, (BB_STRING + UPDATES_WRITING), 4)); 
				$BBtextfinished = ord(shmop_read($shid, (BB_STRING + UPDATES_FINISHED), 4));
				$BBtextsize = ord(shmop_read($shid, (BB_STRING + SIZE), 1));
				$BBtextline = shmop_read($shid, (BB_STRING + 9), 255);
				
				$BBtextline = str_from_mem($BBtextline); // get bb-text
				$BBtextline = utf8_encode($BBtextline);  // ISO8859-1, updKHu
				$BBtextline = str_replace("/\r\n|\r|\n/",'',$BBtextline);
				//$BBtextline = trim(preg_replace('/\s+/', ' ', $BBtextline));
				
				$GpesuaikaL         = ord(shmop_read($shid, WASHINGTIME_L, 1));
				$GpesuaikaH         = ord(shmop_read($shid, WASHINGTIME_H, 1));
				
				$cumsek     = ($GpesuaikaL + ($GpesuaikaH<<8));
				$washingtime_min   = (int)($cumsek/60);
				$washingtime_sek   = ($cumsek%60);
				
				$json['operation_mode']=$operation_mode; // add operationmode
				
				$version_nro /= 100; // updKHu
				$json['version_nro']= "TC $version_nro"." (".$code.") "; // add version
				
				$json['washingtime_min']=$washingtime_min; // add washingtime
				$json['washingtime_sek']=$washingtime_sek; // add washingtime
				$json['logged_user']=$logged_user; // add washingtime
				$json['bb_textline']=$BBtextline; // add bb-text
				$json['scanner_image']=$scanner_image; // add iamge name
				$json['scanner_image_slave']=$scanner_image_slave; // add image name slave
				$json['machine_type'] =  $machine_type; // machine type
				$json['is_scanner'] =  $is_scanner; // is scanner in use
				$json['uptime_master'] =  get_remote_uptime("t700-1"); // get master uptime	
				$json['uptime_slave'] =  get_remote_uptime("t700-2");	// get slave uptime	
				$json['ip_master'] =  get_remote_ip("t700-1");	// get master ip
				$json['ip_slave'] =  get_remote_ip("t700-2");	// get slave ip
				$json['maintenance'] =  $maintenance;	// is in maintenance mode
				$json['allow_continue_cancel'] =  $allow_continue_cancel;	// allow continue and cancel
				$json['cw_status'] =  $cw_status;	// cw-server status
				$json['ifsf_status'] =  $ifsf_status;	// ifsf-server status
				$json['ifsf_version'] =  $ifsf_version;	// ifsf versionnumber
				$json['ifsf_available'] =  $ifsf_available;	// ifsf available ?
				$json['u_ticker'] =  $ret;	// tick counter
				
				
				$result = mysqli_query($link2, "SELECT number FROM SelectedMachine");  // get selected machine number
				if(!$result)
				{
				  echo("Error description: " . mysqli_error($link2));
				}
				$row = mysqli_fetch_array( $result );
				$selected_machine = $row['number'];
			
				$json['selected_machine'] = $selected_machine;
				
				if($prog_number > 0)
				{
					$result = mysqli_query($link,"SELECT * FROM SavedPrograms WHERE SlotNumber='$prog_number' ORDER BY id"); // get saved program from database
					if(!$result)
					{
						$json['error']="mysqli_query : " .  mysqli_error($link); // give error message
					}
					else
					{
						while($row = mysqli_fetch_assoc($result))
						{
						 $pl[] = $row; // get program data from database
						}
						$json['prog_line_number']=$prog_line_number; // add current programline number
						$json['prog_number']=$prog_number; // add current program number
						$json['pl']=$pl;
					}
				}
				else
					$json['error']=$prog_number;
					
				echo json_encode($json), "\n";

         break;
    }	
function str_from_mem(&$value) 
{
  $i = strpos($value, "\0");
  if ($i === false) 
  {
    return $value;
  }
  $result =  substr($value, 0, $i);
  return $result;
}	



	
?>

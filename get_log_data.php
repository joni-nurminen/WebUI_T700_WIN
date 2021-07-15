<?php
include "sync/sync_server_functions.php";
/* Include defines */
include 'defines.php';
// Parse config
$config = parse_config($config_file_name);
// Get queue key from config
include 'select_shared_mem.php';
// Open queue
//$messagequeue = msg_get_queue($mqueue_key,0666);

//which log is selected
$selected_log = isset($_SERVER['PATH_INFO']) ? ltrim($_SERVER['PATH_INFO'], '/') : null;

//echo "valittu kone ".$selected_machine. "  ";

// Open memory for reading
$shid = shmop_open($shm_key, "w", 0666, SHAREDMEMORY_SIZE);
$line = null;
$handle = null;


//$selected_log = 'syslog';

if($shid == FALSE) 
	{
	printf("Error: can't shm_open memory(key:%d) for writing\n", $shid);
	//exit(0);
	}

	switch($selected_log)
	{
	case 'conflog':
	write_command_log(0,0,3); // conf
	$log_path = substr($config["t700-$selected_machine"]["Logfile3_name"],3);
			$handle = @fopen($log_path, "r");
				if ($handle) 
				{
				$i= 1;
				   while (!feof($handle)) 
				   {
					   $line = fgets($handle);
					   if($line == false)
							break;
							
					   $log_obj[] = array("id" => $i, "logrow" => $line);
					   $i++;

				   }
					
				   fclose($handle);
				} 
		break;
		case 'debuglog':
	//	write_command($messagequeue,"log_2",0,0,0);	//debug
		//write_command("log_2",0,0);	//debug
		write_command_log(0,0,2);
		$log_path = substr($config["t700-$selected_machine"]["Logfile2_name"],3);
			$handle = @fopen($log_path, "r"); // t700-1-messages.log
				if ($handle) 
				{
				$i= 1;
				   while (!feof($handle)) 
				   {
					   $line = fgets($handle);
					   if($line == false)
							break;
							
					   $log_obj[] = array("id" => $i, "logrow" => $line);
					   $i++;

				   }
					
				   fclose($handle);
				} 
		break;
		
		case 'syslog':
		write_command_log(0,0,1); // syslog
		$log_path = substr($config["t700-$selected_machine"]["Logfile1_name"],3);

			$handle = @fopen($log_path, "r");

				if ($handle) 
				{
				$i= 1;
				   while (!feof($handle)) 
				   {
					   $line = fgets($handle);
					   if($line == false)
							break;
							
					   $log_obj[] = array("id" => $i, "logrow" => $line);
					   $i++;

				   }
					
				   fclose($handle);
				} 
		break;
		case 'shared_mem_log':
					$shm_latest = ord(shmop_read($shid, (2252+(0x5ffa)), 1));
					$reading = $shm_latest;

					for($i = 0; $i < 64; $i++)
					{
						$shm_data = shmop_read($shid, (LOG_START+($reading*256)), 255);
					//	$shm_data = shmop_read($shid, LOG_START, LOG_SIZE); // lueataan koko logi jaetusta muistista
						
						
						 $k = strpos($shm_data, "\0");
						 
						   if ($k === false)
						   {
								$line .= $shm_data;
						   }
						   else
						   {
								$line .= substr($shm_data, 0, $k);	
						   }
							$log_obj[] = array("id" => $i, "logrow" => $line);
							$line = null;
							

						if($reading < 1) // onko 0:lla 
							$reading = 63;
						else // on 1 tai enemman  
							$reading -= 1;
							
					}
		break;
	}
	
echo json_encode($log_obj), "\n";
?>